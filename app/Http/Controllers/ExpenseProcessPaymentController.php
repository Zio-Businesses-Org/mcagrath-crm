<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseProcessPayment;
use App\Models\ExpensesPaymentMethod;
use App\Models\ExpenseAdditionalFee;
use App\Helper\Reply;
use App\Http\Requests\Expenses\StoreExpensePayment;
use App\Models\Expense;
use App\Helper\Files;

class ExpenseProcessPaymentController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Expense Payment Info';
        $this->middleware(function ($request, $next) {
            abort_403(!in_array('expenses', $this->user->modules));

            return $next($request);
        });
    }

    public function create()
    {
        $this->expense_id = request('id');

        $expense = Expense::with(['processPayment','projectvendor'])->findOrFail($this->expense_id);

        $processPaymentSum = $expense->processPayment->sum('price');
        $bid_approved_amount = $expense->projectvendor->bid_approved_amount;
        $this->pending_price = $bid_approved_amount - $processPaymentSum;
        $this->paymentMethods = ExpensesPaymentMethod::all(); // ✅ Fetch payment methods
        $this->feeMethods = ExpenseAdditionalFee::all(); // ✅ Fetch fee method
        return view('expenses.process_payment.ajax.create', $this->data);
    }

    public function store(StoreExpensePayment $request)
    {
        $expensePayment = new ExpenseProcessPayment();
        $expense = Expense::findOrFail($request->expense_id);
        $expensePayment->expense_id = $request->expense_id;
        $expensePayment->project_id = $expense->project_id;
        $expensePayment->vendor_id = $expense->vendor_id;
        $expensePayment->payment_date =  $request->pay_date == null ? null : companyToYmd($request->pay_date);
        $expensePayment->price = $request->price;
        $expensePayment->payment_method = $request->payment_method;
        $expensePayment->additional_fee = $request->fee_method_id;
         if ($request->hasFile('bill') ) {
            $filename = Files::uploadLocalOrS3($request->bill, ExpenseProcessPayment::FILE_PATH);
            $expensePayment->bill = $filename;
        }
        $expensePayment->added_by = user()->id;
        $expensePayment->save();

        $html = view('expenses.process_payment.table_partials', [
            'item' => $expensePayment
        ])->render();

        return Reply::successWithData(__('messages.recordSaved'), ['html' => $html]);

    }

    public function edit($id)
    {
        $this->expensePayment =  ExpenseProcessPayment::findOrFail($id);
        $this->paymentMethods = ExpensesPaymentMethod::all(); // ✅ Fetch payment methods
        $this->feeMethods = ExpenseAdditionalFee::all(); // ✅ Fetch fee method
        return view('expenses.process_payment.ajax.edit', $this->data);

    }

    public function update(StoreExpensePayment $request, $id)
    {
        $expensePayment = ExpenseProcessPayment::findOrFail($id);
        
        $expensePayment->payment_date =  $request->pay_date == null ? null : companyToYmd($request->pay_date);
        $expensePayment->price = $request->price;
        $expensePayment->payment_method = $request->payment_method;
        $expensePayment->additional_fee = $request->fee_method_id;

        if ($request->bill_delete == 'yes') {
            Files::deleteFile($expensePayment->bill, ExpenseProcessPayment::FILE_PATH);
            $expensePayment->bill = null;
        }

        if ($request->hasFile('bill') ) {

            Files::deleteFile($expensePayment->bill, ExpenseProcessPayment::FILE_PATH);
            $filename = Files::uploadLocalOrS3($request->bill, ExpenseProcessPayment::FILE_PATH);
            $expensePayment->bill = $filename;
        }

        $expensePayment->last_updated_by = user()->id;
        $expensePayment->save();

        $redirectUrl = route('expenses.index');

        return Reply::successWithData(__('messages.recordSaved'), ['redirectUrl' => $redirectUrl]);

    }

    public function destroy($id)
    {
        ExpenseProcessPayment::destroy($id);
        return Reply::success(__('messages.deleteSuccess'));
    }

}
