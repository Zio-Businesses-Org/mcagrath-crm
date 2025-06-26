<?php

namespace App\Http\Controllers;

use App\DataTables\ExpensesDataTable;
use App\Helper\Files;
use App\Helper\Reply;
use App\Http\Requests\Admin\Employee\ImportProcessRequest;
use App\Http\Requests\Admin\Employee\ImportRequest;
use App\Http\Requests\Expenses\StoreExpense;
use App\Imports\ExpenseImport;
use App\Jobs\ImportExpenseJob;
use App\Models\BankAccount;
use App\Models\Currency;
use App\Models\Expense;
use App\Models\ExpensesCategory;
use App\Models\ExpensesCategoryRole;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectVendor;
use App\Models\VendorContract;
use App\Scopes\ActiveScope;
use App\Traits\ImportExcel;
use Illuminate\Http\Request;
use App\Models\ExpenseStatus;
use App\Models\ExpensePartialPay;

class ExpenseController extends AccountBaseController
{
    use ImportExcel;

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.expenses';
        $this->middleware(function ($request, $next) {
            abort_403(!in_array('expenses', $this->user->modules));
            return $next($request);
        });
    }

    public function index(ExpensesDataTable $dataTable)
    {
        $viewPermission = user()->permission('view_expenses');
        abort_403(!in_array($viewPermission, ['all', 'added', 'owned', 'both']));

        if (!request()->ajax()) {
            $this->employees = User::allEmployees(null, true);
            $this->projects = Project::allProjects();
            $this->categories = ExpenseCategoryController::getCategoryByCurrentRole();
            //$this->categories = ExpenseCategoryController::all();
        }

        return $dataTable->render('expenses.index', $this->data);

    }

    public function changeStatus(Request $request)
    {
        abort_403(user()->permission('approve_expenses') != 'all');
        $expenseId = $request->expenseId;
        $status = $request->status;
        $expense = Expense::findOrFail($expenseId);
        $expense->status = $status;
        $expense->save();
        return Reply::success(__('messages.updateSuccess'));
    }

    public function show($id)
    {
        $this->expense = Expense::with(['user', 'project', 'category', 'transactions' => function($q){
            $q->orderByDesc('id')->limit(1);
        }, 'transactions.bankAccount'])->findOrFail($id)->withCustomFields();

        $this->viewPermission = user()->permission('view_expenses');
        $viewProjectPermission = user()->permission('view_project_expenses');
        $this->editExpensePermission = user()->permission('edit_expenses');
        $this->deleteExpensePermission = user()->permission('delete_expenses');

        abort_403(!($this->viewPermission == 'all'
        || ($this->viewPermission == 'added' && $this->expense->added_by == user()->id)
        || ($viewProjectPermission == 'owned' || $this->expense->user_id == user()->id)));

        if ($this->expense->getCustomFieldGroupsWithFields()) {
            $this->fields = $this->expense->getCustomFieldGroupsWithFields()->fields;
        }

        $this->pageTitle = $this->expense->projectvendor->vendor_name;
        $this->view = 'expenses.ajax.show';

        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }

        return view('expenses.show', $this->data);

    }

    public function create()
    {
        $this->addPermission = user()->permission('add_expenses');
        abort_403(!in_array($this->addPermission, ['all', 'added']));

        $this->currencies = Currency::all();
        $this->categories = ExpenseCategoryController::getCategoryByCurrentRole();
        $this->linkExpensePermission = user()->permission('link_expense_bank_account');
        $this->viewBankAccountPermission = user()->permission('view_bankaccount');
        $this->paymentMethods = \App\Models\ExpensesPaymentMethod::all(); // ✅ Fetch payment methods
        $this->feeMethods = \App\Models\ExpenseAdditionalFee::all(); // ✅ Fetch fee methods

        

        $bankAccounts = BankAccount::where('status', 1)->where('currency_id', company()->currency_id);


        if($this->viewBankAccountPermission == 'added'){
            $bankAccounts = $bankAccounts->where('added_by', user()->id);
        }

        $bankAccounts = $bankAccounts->get();
        $this->bankDetails = $bankAccounts;
        $this->companyCurrency = Currency::where('id', company()->currency_id)->first();

        // Get only current login employee projects
        if ($this->addPermission == 'added') {
            $this->projects = Project::where('added_by', user()->id)->orWhereHas('projectMembers', function ($query) {
                $query->where('user_id', user()->id);
            })->get();

        } else {
            $this->projects = Project::all();
        }

        $this->pageTitle = __('modules.expenses.addExpense');
        $this->projectId = request('project_id') ? request('project_id') : null;

        if (!is_null($this->projectId)) {
            $this->project = Project::with('projectMembers')->where('id', $this->projectId)->first();
            $this->projectName = $this->project->project_name;
            $this->projectShort = $this->project->project_short_code;
            $this->employees = $this->project->projectMembers;
            $this->vendor = ProjectVendor::where('project_id',$this->projectId)->where('link_status', 'accepted')->get();

        } else {
            $this->employees = User::allEmployees(null, false);
        }

        $expense = new Expense();

        if ($expense->getCustomFieldGroupsWithFields()) {
            $this->fields = $expense->getCustomFieldGroupsWithFields()->fields;
        }

        $this->view = 'expenses.ajax.create';

        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }

        return view('expenses.show', $this->data);

    }

    public function store(StoreExpense $request)
    {
        \Log::info($request);
        // $userRole = session('user_roles');
        // $expense = new Expense();
        // $expense->item_name = '--';
        // $expense->purchase_date = date('Y-m-d');
        // $expense->purchase_from = '--';
        // $expense->price = round($request->price, 2);
        // $expense->currency_id = $request->currency_id;
        // $expense->category_id = $request->category_id;
        // $expense->user_id = user()->id;
        // $expense->default_currency_id = company()->currency_id;
        // $expense->exchange_rate = $request->exchange_rate;
        // $expense->description = trim_editor($request->description);
        // $expense->vendor_id = $request->vendor_id;
        // $expense->pay_date =  $request->pay_date == null ? null : companyToYmd($request->pay_date);
        // $expense->wo_status = $request->wo_status;
        // $expense->bid_approved_amt = $request->bid_approved_amount;
        // $expense->change_amt = $request->change_order_amount;
        // $expense->additional_fee = $request->fee_method_id;
        // $expense->payment_method = $request->payment_method; // Store the name
        // $expense->status = 'Pending';
        // if((float)$request->pending_amount > 0)
        // {
        //     $expense->status = 'Paid Off';   
        // }
        // if ($userRole[0] == 'admin') {
        //     //$expense->status = 'Paid';
        //     $expense->approver_id = user()->id;
        // }

        // if ($request->has('status')) {
            
        //     $expense->approver_id = user()->id;
        // }
       

        // if ($request->has('project_id') && $request->project_id != '0') {
        //     $expense->project_id = $request->project_id;
        // }

        // if ($request->hasFile('bill')) {
        //     $filename = Files::uploadLocalOrS3($request->bill, Expense::FILE_PATH);
        //     $expense->bill = $filename;
        // }

        // $expense->bank_account_id = $request->bank_account_id;

        // $expense->save();

        // if((float)$request->pending_amount > 0)
        // {
            
        //     $expensep = new ExpensePartialPay();
        
        //     $expensep->price = round($request->price, 2);
            
        //     $expensep->category_id = $request->category_id;
        //     $expensep->added_by = user()->id;
        //     $expensep->project_id = $request->project_id;
        //     $expensep->vendor_id = $request->vendor_id;
        //     $expensep->expense_id = $expense->id;
        //     $expensep->pay_date =  $request->pay_date == null ? null : companyToYmd($request->pay_date);
        //     $expensep->additional_fee = $request->fee_method_id;
        //     $expensep->payment_method = $request->payment_method; // Store the name
        //     if ($request->hasFile('bill')) {
        //         $filename = Files::uploadLocalOrS3($request->bill, ExpensePartialPay::FILE_PATH);
        //         $expensep->bill = $filename;
        //     }
        //     $expensep->save();
        // }
        // // To add custom fields data
        // if ($request->custom_fields_data) {
        //     $expense->updateCustomFieldData($request->custom_fields_data);
        // }

        // $redirectUrl = urldecode($request->redirect_url);

        // if ($redirectUrl == '') {
        //     $redirectUrl = route('expenses.index');
        // }

        // return Reply::successWithData(__('messages.recordSaved'), ['redirectUrl' => $redirectUrl]);
    }

    public function edit($id)
    {
        $this->expense = Expense::findOrFail($id)->withCustomFields();
        $this->editPermission = user()->permission('edit_expenses');

        abort_403(!($this->editPermission == 'all' || ($this->editPermission == 'added' && $this->expense->added_by == user()->id)));

        $this->currencies = Currency::all();
        $this->categories = ExpenseCategoryController::getCategoryByCurrentRole();
        $this->employees = User::allEmployees();
        $this->feeMethods = \App\Models\ExpenseAdditionalFee::all(); // ✅ Ensure fee methods are loaded
        $this->paymentMethods = \App\Models\ExpensesPaymentMethod::all(); // ✅ Ensure payment methods are loaded
        $this->expenseStatus = ExpenseStatus::all();
        $this->pageTitle = __('modules.expenses.updateExpense');
        $this->linkExpensePermission = user()->permission('link_expense_bank_account');
        $this->viewBankAccountPermission = user()->permission('view_bankaccount');
        $this->vendor = ProjectVendor::where('project_id',$this->expense->project_id)->where('link_status', 'accepted')->get();
        $bankAccounts = BankAccount::where('status', 1)->where('currency_id', $this->expense->currency_id);

        if($this->viewBankAccountPermission == 'added'){
            $bankAccounts = $bankAccounts->where('added_by', user()->id);
        }

        $bankAccounts = $bankAccounts->get();
        $this->bankDetails = $bankAccounts;


        $projectId = $this->expense->project_id;

        if (!is_null($projectId)) {
            $this->projects = Project::where('id',$projectId)->get();
        }
        else {
            $this->projects = Project::get();
        }

        $this->companyCurrency = Currency::where('id', company()->currency_id)->first();

        $expense = new Expense();

        if ($expense->getCustomFieldGroupsWithFields()) {
            $this->fields = $expense->getCustomFieldGroupsWithFields()->fields;
        }

        $this->view = 'expenses.ajax.edit';

        if (request()->ajax()) {

            return $this->returnAjax($this->view);
        }

        return view('expenses.show', $this->data);

    }

    public function update(StoreExpense $request, $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->item_name = '--';
        $expense->purchase_date = date('Y-m-d');
        $expense->purchase_from = '--';
        $expense->price = round($request->price, 2);
        $expense->currency_id = $request->currency_id;
        $expense->user_id = user()->id;
        $expense->category_id = $request->category_id;
        $expense->default_currency_id = company()->currency_id;
        $expense->exchange_rate = $request->exchange_rate;
        $expense->description = trim_editor($request->description);
        $expense->vendor_id = $request->vendor_id;
        $expense->pay_date =  $request->pay_date == null ? null : companyToYmd($request->pay_date);
        $expense->wo_status = $request->wo_status;
        $expense->bid_approved_amt = $request->bid_approved_amount;
        $expense->change_amt = $request->change_order_amount;
        $expense->project_id = ($request->project_id > 0) ? $request->project_id : null;


        if ($request->bill_delete == 'yes') {
            Files::deleteFile($expense->bill, Expense::FILE_PATH);
            $expense->bill = null;
        }

        if ($request->hasFile('bill')) {
            Files::deleteFile($expense->bill, Expense::FILE_PATH);

            $filename = Files::uploadLocalOrS3($request->bill, Expense::FILE_PATH);
            $expense->bill = $filename;
        }

        $expense->payment_method = $request->payment_method;
        $expense->additional_fee = $request->additional_fee_id;

        if ($request->has('status')) {
            $expense->status = $request->status;
        }

        $expense->bank_account_id = $request->bank_account_id;
        $expense->save();

        // To add custom fields data
        if ($request->custom_fields_data) {
            $expense->updateCustomFieldData($request->custom_fields_data);
        }
        
        if ($request->project_id == '') {
            $redirectUrl = route('expenses.index');
        }
        else{
            $redirectUrl =route('projects.show', ['project' => $request->project_id, 'tab' => 'expenses']);
        }
        return Reply::successWithData(__('messages.updateSuccess'), ['redirectUrl' => $redirectUrl]);

    }

    public function destroy($id)
    {
        $this->expense = Expense::findOrFail($id);
        $this->deletePermission = user()->permission('delete_expenses');
        abort_403(!($this->deletePermission == 'all' || ($this->deletePermission == 'added' && $this->expense->added_by == user()->id)));

        Expense::destroy($id);
        return Reply::success(__('messages.deleteSuccess'));
    }

    /**
     * XXXXXXXXXXX
     *
     * @return \Illuminate\Http\Response
     */
    public function applyQuickAction(Request $request)
    {
        switch ($request->action_type) {
        case 'delete':
            $this->deleteRecords($request);
                return Reply::success(__('messages.deleteSuccess'));
        case 'change-status':
            $this->changeBulkStatus($request);
                return Reply::success(__('messages.updateSuccess'));
        default:
                return Reply::error(__('messages.selectAction'));
        }
    }

    protected function deleteRecords($request)
    {
        abort_403(user()->permission('delete_employees') != 'all');

        // Did this to call observer
        foreach (Expense::withoutGlobalScope(ActiveScope::class)->whereIn('id', explode(',', $request->row_ids))->get() as $delete) {
            $delete->delete();
        }
    }

    protected function changeBulkStatus($request)
    {
        abort_403(user()->permission('edit_employees') != 'all');

        $expenses = Expense::withoutGlobalScope(ActiveScope::class)->whereIn('id', explode(',', $request->row_ids))->get();

        $expenses->each(function ($expense) use ($request) {
            $expense->status = $request->status;
            $expense->save();
        });
    }

    protected function getEmployeeProjects(Request $request)
    {
        // Get employee category
        if (!is_null($request->userId)) {
            $categories = ExpensesCategory::with('roles')->whereHas('roles', function($q) use ($request) {
                $user = User::withoutGlobalScope(ActiveScope::class)->findOrFail($request->userId);

                $roleId = (count($user->role) > 1) ? $user->role[1]->role_id : $user->role[0]->role_id;
                $q->where('role_id', $roleId);
            })->get();

        }
        else {
            $categories = ExpensesCategory::get();
        }

        if($categories) {
            foreach ($categories as $category) {
                $selected = $category->id == $request->categoryId ? 'selected' : '';
                $categories .= '<option value="' . $category->id . '"'.$selected.'>' . $category->category_name . '</option>';
            }
        }

        // Get employee project
        if (!is_null($request->userId)) {
            $projects = Project::with('members')->whereHas('members', function ($q) use ($request) {
                $q->where('user_id', $request->userId);
            })->get();
        }
        else if(user()->permission('add_expenses') == 'all' && is_null($request->userId))
        {
            $projects = [];
        }
        else {
            $projects = Project::get();
        }

        $data = null;

        if ($projects) {
            foreach ($projects as $project) {
                $data .= '<option data-currency-id="'. $project->currency_id .'" value="' . $project->id . '">' . $project->project_name . '</option>';
            }
        }


        return Reply::dataOnly(['status' => 'success', 'data' => $data, 'category' => $categories]);
    }

    protected function getCategoryEmployee(Request $request)
    {
        $expenseCategory = ExpensesCategoryRole::where('expenses_category_id', $request->categoryId)->get();
        $roleId = [];
        $managers = [];
        $employees = [];

        foreach($expenseCategory as $category) {
            array_push($roleId, $category->role_id);
        }

        if (count($roleId ) == 1 && $roleId != null) {
            $users = User::whereHas(
                'role', function($q)  use ($roleId) {
                    $q->whereIn('role_id', $roleId);
                }
            )->get();

            foreach ($users as $user) {
                ($user->hasRole('Manager')) ? array_push($managers, $user) : array_push($employees, $user);
            }
        }
        else {
            $employees = User::allEmployees(null, false);
        }

        $data = null;

        if ($employees) {
            foreach ($employees as $employee) {

                $data .= '<option ';

                $content = ($employee->status == 'deactive') ?  "<span class='badge badge-pill badge-danger border align-center ml-2 px-2'>Inactive</span>" : '';
                $selected = $employee->id == $request->userId ? 'selected' : '';
                $itsYou = $employee->id == user()->id ? "<span class='ml-2 badge badge-secondary pr-1'>". __('app.itsYou') .'</span>' : '';

                $data .= 'data-content="<div class=\'d-inline-block mr-1\'><img class=\'taskEmployeeImg rounded-circle\' src=\'' . $employee->image_url . '\' ></div> '.$employee->name.$itsYou.$content.'"
                value="' . $employee->id . '"'.$selected.'>'.$employee->name.'</option>';

            }
        }
        else {
            foreach ($managers as $manager) {
                $data .= '<option ';

                $selected = $manager->id == $request->userId ? 'selected' : '';
                $itsYou = $manager->id == user()->id ? "<span class='ml-2 badge badge-secondary pr-1'>" . __('app.itsYou') . '</span>' : '';
                $data .= 'data-content="<div class=\'d-inline-block mr-1\'><img class=\'taskEmployeeImg rounded-circle\' src=\'' . $manager->image_url . '\' ></div> '.$manager->name.'"
                value="' . $manager->id . '"'.$selected.'>'.$manager->name.$itsYou.'</option>';
            }
        }

        return Reply::dataOnly(['status' => 'success', 'employees' => $data]);
    }

    public function import()
    {
        $this->pageTitle = __('app.importExcel') . ' ' . __('app.menu.expenses');

        $addPermission = user()->permission('add_expenses');
        abort_403(!in_array($addPermission, ['all', 'added']));

        $this->view = 'expenses.ajax.import';

        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }

        return view('expenses.show', $this->data);
    }

    public function importStore(ImportRequest $request)
    {
        $this->importFileProcess($request, ExpenseImport::class);

        $view = view('expenses.ajax.import_progress', $this->data)->render();

        return Reply::successWithData(__('messages.importUploadSuccess'), ['view' => $view]);
    }

    public function importProcess(ImportProcessRequest $request)
    {
        $batch = $this->importJobProcess($request, ExpenseImport::class, ImportExpenseJob::class);

        return Reply::successWithData(__('messages.importProcessStart'), ['batch' => $batch]);
    }

}
