<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClientLeadCustomFilter;
use App\Helper\Reply;
use App\Models\StatusLead;
use App\Models\CompanyType;

class LeadClientCustomFilterController extends AccountBaseController
{
    public function store(Request $request)
    { 
        $request->validate([
            'client_name' => 'required',
        ]);
        $clcf = new ClientLeadCustomFilter();
        $clcf->user_id = $request->user_id;
        $clcf->last_called_start_date = $request->startDateLast;
        $clcf->last_called_end_date = $request->endDateLast;
        $clcf->next_follow_start_date = $request->startDateNext;
        $clcf->next_follow_end_date = $request->endDateNext;
        $clcf->client_lead_status = $request->client_status;
        $clcf->company_type = $request->client_types;
        $clcf->added_by = $request->client_members;
        $clcf->name = $request->client_name;
        $clcf->save();

        return Reply::success(__('Filter Saved'));
    }

    public function edit($id)
    {
        $this->allEmployees = User::allEmployees(null, null, 'all');
        $this->statusLeads = StatusLead::all();
        $this->companyTypes = CompanyType::all();
        $this->filter = ClientLeadCustomFilter::findOrFail($id);
        return view('lead-contact.edit-filter', $this->data);
    }

    public function update (Request $request,$id)
    { 
        $request->validate([
            'client_name' => 'required',
        ]);
        
        $clcf = ClientLeadCustomFilter::findOrFail($id);
        $clcf->last_called_start_date = $request->filterstartDateLast;
        $clcf->last_called_end_date = $request->filterendDateLast;
        $clcf->next_follow_start_date = $request->filterstartDateNext;
        $clcf->next_follow_end_date = $request->filterendDateNext;
        $clcf->client_lead_status = $request->client_status;
        $clcf->company_type = $request->client_types;
        $clcf->added_by = $request->client_members;
        $clcf->name = $request->client_name;
        $clcf->save();

        return Reply::success(__('Filter Saved'));
    }

    public function destroy($id)
    {
        ClientLeadCustomFilter::destroy($id);
        return Reply::success(__('Deleted Successfully'));
    }
    
    public function changestatus($id){
        $clientLeadFilter = ClientLeadCustomFilter::where('user_id', user()->id)->get();
        foreach ($clientLeadFilter as $filter)
        {
            $filter->status='inactive';
            $filter->save();
        }
        $filter = ClientLeadCustomFilter::findOrFail($id);
        $filter->status = 'active';
        $filter->save();
        return Reply::success(__('Filter Applied'));
    }

    public function clear($id){

        $filter = ClientLeadCustomFilter::findOrFail($id);
        $filter->status = 'inactive';
        $filter->save();
        return Reply::success(__('Filter Removed'));
    }
}
