<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectCustomFilter;
use App\Models\ProjectCategory;
use App\Models\ProjectSubCategory;
use App\Models\ProjectType;
use App\Models\ProjectPriority;
use App\Models\Team;
use App\Models\ProjectStatusSetting;
use App\Models\DelayedBy;
use App\Models\PropertyDetails; 
use App\Models\User;
use Exception;
use App\Helper\Reply;

class ProjectCustomFilterController extends AccountBaseController
{
    public function store(Request $request)
    {
        
            $request->validate([
                'filter_name' => 'required',
            ]);
            $pcf = new ProjectCustomFilter();
            $pcf->user_id = $request->user_id;
            $pcf->filter_on = $request->custom_date_filter_on;
            $pcf->start_date = $request->startDate;
            $pcf->end_date = $request->endDate;
            $pcf->start_date_nxt = $request->startDatenxt;
            $pcf->end_date_nxt = $request->endDatenxt;
            $pcf->project_category = $request->filter_category_id;
            $pcf->project_sub_category = $request->filter_sub_category;
            $pcf->project_type = $request->filter_type;
            $pcf->project_priority = $request->filter_priority;
            $pcf->project_status = $request->filter_status;
            $pcf->delayed_by = $request->filter_delayed;
            $pcf->client_id = $request->filter_client;
            $pcf->city = $request->filter_city;
            $pcf->county = $request->filter_county;
            $pcf->state = $request->filter_state;
            $pcf->project_members = $request->filter_members;
            $pcf->sort_order = $request->sort_order;
            $pcf->name=$request->filter_name;
            $pcf->save();
    
            return Reply::success(__('Filter Saved'));
     
    }
    public function destroy($id)
    {
        ProjectCustomFilter::destroy($id);
        return Reply::success(__('Deleted Successfully'));
    }
    public function edit($id)
    {
        $viewPermission = user()->permission('view_projects');
        abort_403((!in_array($viewPermission, ['all', 'added', 'owned', 'both'])));

        if (in_array('client', user_roles())) {
            $this->clients = User::client();
        }
        else {
            $this->clients = User::allClients();
            $this->allEmployees = User::allEmployees(null, true, ($viewPermission == 'all' ? 'all' : null));
        }
        $this->filter = ProjectCustomFilter::findOrFail($id);
        $this->categories = ProjectCategory::all();
        $this->subcategories=ProjectSubCategory::all();
        $this->projecttype=ProjectType::all();
        $this->projectpriority=ProjectPriority::all();
        $this->departments = Team::all();
        $this->projectStatus = ProjectStatusSetting::where('status', 'active')->get();
        $this->delayedby=DelayedBy::all();
        $this->city = PropertyDetails::distinct()->pluck('city');
        $this->county = PropertyDetails::distinct()->pluck('county');
        $this->state = PropertyDetails::distinct()->pluck('state');
        return view('projects.edit-filter', $this->data);
    }
    public function update(Request $request, $id)
    {
        \Log::info('ProjectCustomFilter update request:', $request->all());
        $request->validate([
            'filter_name' => 'required',
        ]);
        $pcf = ProjectCustomFilter::findOrFail($id);
        $pcf->filter_on = $request->custom_date_filter_on;
        $pcf->start_date = $request->filterstartDate;
        $pcf->end_date = $request->filterendDate;
        $pcf->project_category = $request->filter_category_id;
        $pcf->project_sub_category = $request->filter_sub_category;
        $pcf->project_type = $request->filter_type;
        $pcf->start_date_nxt = $request->filterstartDatenxt;
        $pcf->end_date_nxt = $request->filterendDatenxt;
        $pcf->project_priority = $request->filter_priority;
        $pcf->project_status = $request->filter_status;
        $pcf->delayed_by = $request->filter_delayed;
        $pcf->client_id = $request->filter_client;
        $pcf->city = $request->filter_city;
        $pcf->county = $request->filter_county;
        $pcf->state = $request->filter_state;
        $pcf->project_members = $request->filter_members;
        $pcf->sort_order = $request->sort_order;
        $pcf->name=$request->filter_name;
        $pcf->save();
        return Reply::success(__('Filter Updated'));
    }
    public function changestatus($id){
        $projectFilter = ProjectCustomFilter::where('user_id', user()->id)->get();
        foreach ($projectFilter as $filter)
        {
            $filter->status='inactive';
            $filter->save();
        }
        $filter = ProjectCustomFilter::findOrFail($id);
        $filter->status = 'active';
        $filter->save();
        return Reply::success(__('Filter Applied'));
    }
    public function clear($id){

        $filter = ProjectCustomFilter::findOrFail($id);
        $filter->status = 'inactive';
        $filter->save();
        return Reply::success(__('Filter Removed'));
    }
    
}
