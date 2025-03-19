<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseStatus;
use App\Helper\Reply;

class ExpenseStatusController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Expense Status';
        $this->middleware(function ($request, $next) {
            abort_403(!in_array('expenses', $this->user->modules));

            return $next($request);
        });
    }

    public function create()
    {
        $this->status = ExpenseStatus::all(); // ✅ Fetch payment methods

        return view('expenses.status.create', $this->data); // ✅ Pass data to view
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
        ]);
    
        $exp = new ExpenseStatus();
        $exp->status = $request->status;
        $exp->save();
    
    
        return Reply::success(__('messages.recordSaved'));
    }
    

    public function getList()
    {
        $paymentMethods = ExpenseStatus::all();
        return Reply::dataOnly(['statusDrop' => $paymentMethods]); // ✅ Return updated list
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);
    
        $exp = ExpenseStatus::findOrFail($id);
        $exp->status = $request->status;
        $exp->save();
    
    
        return Reply::success(__('messages.recordSaved'));
    }

    public function destroy($id)
    {
        $exp = ExpenseStatus::findOrFail($id);
        $exp->delete();

        return Reply::success(__('messages.deleteSuccess'));
    }
}
