<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpensePartialPay;
use App\Helper\Files;
use App\Helper\Reply;

class ExpensePartialPayController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Add Partial Pay';
        $this->middleware(function ($request, $next) {
            abort_403(!in_array('expenses', $this->user->modules));
            return $next($request);
        });
    }

    public function create($expenseId,$projectId,$vendorId)
    {
        // $this->addPermission = user()->permission('add_expenses');
        // abort_403(!in_array($this->addPermission, ['all', 'added']));
        $this->project = \App\Models\Project::findOrFail($projectId);
        $this->vendor = \App\Models\ProjectVendor::findOrFail($vendorId);
        $this->expense_id = $expenseId;
        $this->categories = ExpenseCategoryController::getCategoryByCurrentRole();
        $this->paymentMethods = \App\Models\ExpensesPaymentMethod::all(); // ✅ Fetch payment methods
        $this->feeMethods = \App\Models\ExpenseAdditionalFee::all(); // ✅ Fetch fee methods

        $this->view = 'expenses.partial_pay.ajax.create';

        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }
        return view('expenses.partial_pay.show', $this->data);

    }

    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required',
        ]);
        $expense = new ExpensePartialPay();
        
        $expense->price = round($request->price, 2);
        
        $expense->category_id = $request->category_id;
        $expense->added_by = user()->id;
        $expense->project_id = $request->project_id;
        $expense->vendor_id = $request->vendor_id;
        $expense->expense_id = $request->expense_id;
        $expense->pay_date =  $request->pay_date == null ? null : companyToYmd($request->pay_date);
        $expense->additional_fee = $request->fee_method_id;
        $expense->payment_method = $request->payment_method; // Store the name
        if ($request->hasFile('bill')) {
            $filename = Files::uploadLocalOrS3($request->bill, ExpensePartialPay::FILE_PATH);
            $expense->bill = $filename;
        }
        $expense->save();

        return Reply::successWithData(__('messages.recordSaved'), ['redirectUrl' => route('projects.show', $request->project_id) . '?tab=expenses']);

    }
}
