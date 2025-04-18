<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\VendorProjectDataTable;
use App\Models\User;
use App\Models\VendorContract;
use App\Models\ProjectStatusSetting;
use App\Models\ProjectVendorCustomFilter;
use App\Models\ProjectVendor;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\WorkOrderStatus;
use App\Helper\Reply;
use Carbon\Carbon;

class VendorProjectController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Projects - Vendors';
    }

    public function index(VendorProjectDataTable $dataTable)
    {
        if (!request()->ajax()) {
            $this->clients = User::allClients();
            $this->allEmployees = User::allEmployees(null, true, 'all');
            $this->allEmployeesInactive = User::allEmployees(null, null, 'all');
            $this->vendor =  VendorContract::all();
            // $this->projectvendor = ProjectVendor::all();
            $this->projectStatus = ProjectStatusSetting::where('status', 'active')->get();
            $this->projectVendorFilter = ProjectVendorCustomFilter::where('user_id', user()->id)->get();
            $this->categories = ProjectCategory::all();
            $this->wostatus = WorkOrderStatus::all();
        }
        $this->view = 'vendors-projects.index';
        return $dataTable->render('vendors-projects.create', $this->data);
    }

    public function applyQuickAction(Request $request)
    {
        
        switch ($request->action_type) {
            
        case 'change-follow-up':
            $items = explode(',', $request->row_ids);

            foreach ($items as $item) {
                
                $projectvendor = ProjectVendor::findOrFail($item);
                $project = Project::withTrashed()->findOrFail($projectvendor->project_id);
                $project->nxt_follow_up_date=$request->nxt_follow_up_action == null ? null : companyToYmd($request->nxt_follow_up_action);
                $project->save();
            }

            return Reply::success(__('messages.updateSuccess'));

        case 'change-follow-up-time':
            $items = explode(',', $request->row_ids);

            foreach ($items as $item) {
                
                $projectvendor = ProjectVendor::findOrFail($item);
                $project = Project::withTrashed()->findOrFail($projectvendor->project_id);
                $project->nxt_follow_up_time = $request->nxt_follow_up_time == null ? null : Carbon::createFromFormat($this->company->time_format, $request->nxt_follow_up_time)->format('H:i:s');
                $project->save();
            }

            return Reply::success(__('messages.updateSuccess'));

        case 'change-project-coordinator':
            $items = explode(',', $request->row_ids);

            foreach ($items as $item) {

                $projectvendor = ProjectVendor::findOrFail($item);
                $project = Project::withTrashed()->findOrFail($projectvendor->project_id);
                $project->project_coordinator_id = $request->member;
                $project->save();
            }
            return Reply::success(__('messages.updateSuccess'));

        default:
            return Reply::error(__('messages.selectAction'));
        }
    }
}
