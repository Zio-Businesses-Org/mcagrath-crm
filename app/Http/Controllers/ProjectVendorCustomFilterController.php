<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectVendorCustomFilter;
use App\Models\User;
use App\Models\VendorContract;
use App\Models\ProjectStatusSetting;
use App\Models\WorkOrderStatus;
use App\Models\ProjectVendor;
use App\Models\ProjectCategory;
use Exception;
use App\Helper\Reply;

class ProjectVendorCustomFilterController extends AccountBaseController
{
    public function store(Request $request)
    {
        
        $request->validate([
            'filter_name' => 'required',
        ]);
        $pcvf = new ProjectVendorCustomFilter();
        $pcvf->user_id = $request->user_id;
        $pcvf->start_date = $request->startDate;
        $pcvf->end_date = $request->endDate;
        $pcvf->project_category = $request->filter_category_id;
        $pcvf->vendor_id = $request->filter_vendor;
        $pcvf->link_status = $request->filter_link_status;
        $pcvf->work_order_status = $request->filter_wo_status;
        $pcvf->project_status = $request->filter_project_status;
        $pcvf->client_id = $request->filter_client;
        $pcvf->project_members = $request->filter_members;
        $pcvf->name=$request->filter_name;
        $pcvf->status_oc=$request->filter_status_oc;
        $pcvf->save();

        return Reply::success(__('Filter Saved'));
    }
    public function edit($id)
    {
        $this->clients = User::allClients();
        $this->allEmployees = User::allEmployees(null, true, 'all');
        $this->vendor =  VendorContract::all();
        // $this->projectvendor = ProjectVendor::all();
        $this->projectStatus = ProjectStatusSetting::where('status', 'active')->get();
        $this->projectVendorFilter = ProjectVendorCustomFilter::where('user_id', user()->id)->get();
        $this->categories = ProjectCategory::all();
        $this->wostatus = WorkOrderStatus::all();
        $this->filter = ProjectVendorCustomFilter::findOrFail($id);
        return view('vendors-projects.edit-filter', $this->data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'filter_name' => 'required',
        ]);
        $pcvf = ProjectVendorCustomFilter::findOrFail($id);
        $pcvf->start_date = $request->filterstartDate;
        $pcvf->end_date = $request->filterendDate;
        $pcvf->project_category = $request->filter_category_id;
        $pcvf->vendor_id = $request->filter_vendor;
        $pcvf->link_status = $request->filter_link_status;
        $pcvf->work_order_status = $request->filter_wo_status;
        $pcvf->project_status = $request->filter_project_status;
        $pcvf->client_id = $request->filter_client;
        $pcvf->project_members = $request->filter_members;
        $pcvf->name=$request->filter_name;
        $pcvf->status_oc=$request->filter_status_oc;
        $pcvf->save();
        return Reply::success(__('Filter Updated'));
    }
    public function destroy($id)
    {
        ProjectVendorCustomFilter::destroy($id);
        return Reply::success(__('Deleted Successfully'));
    }

    public function changestatus($id){
        $projectFilter = ProjectVendorCustomFilter::where('user_id', user()->id)->get();
        foreach ($projectFilter as $filter)
        {
            $filter->status='inactive';
            $filter->save();
        }
        $filter = ProjectVendorCustomFilter::findOrFail($id);
        $filter->status = 'active';
        $filter->save();
        return Reply::success(__('Filter Applied'));
    }

    public function clear($id){

        $filter = ProjectVendorCustomFilter::findOrFail($id);
        $filter->status = 'inactive';
        $filter->save();
        return Reply::success(__('Filter Removed'));
    }
}
