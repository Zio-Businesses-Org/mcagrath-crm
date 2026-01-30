<?php

namespace App\Http\Controllers;

use App\Helper\Reply;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectSetting;
use App\Models\ProjectCategory;
use App\Models\ProjectSubCategory;
use App\Models\ProjectStatusSetting;
use App\Models\ProjectType;
use App\Models\ProjectPriority;
use App\Models\PropertyType;
use App\Models\OccupancyStatus;
use App\Models\DelayedBy;
use App\Models\ContractorType;
use App\Models\CancelledReason;
use App\Models\ExternalFileType;
use App\Http\Requests\StoreStatusSettingRequest;
use App\Http\Requests\Project\StoreProjectCategory;
use App\Http\Requests\Project\StoreProjectSubCategory;
use App\Http\Requests\ProjectSetting\UpdateProjectSetting;
use App\Http\Requests\Project\StoreProjectType;
use App\Http\Requests\Project\StoreProjectPriority;
use App\Http\Requests\Project\StorePropertyType;
use App\Http\Requests\Project\StoreOccupancyStatus;
use App\Http\Requests\Project\StoreDelayedBy;
use App\Http\Requests\Project\StoreCancelledReason;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Project\StoreContractorType;
use App\Http\Requests\Project\StoreFileType;

class ProjectSettingController extends AccountBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.projectSettings';
        $this->activeSettingMenu = 'project_settings';
        $this->middleware(function ($request, $next) {
            abort_403(!(user()->permission('manage_project_setting') == 'all' && in_array('projects', user_modules())));

            return $next($request);
        });
    }

    public function index()
    {

        $tab = request('tab');
        
        switch ($tab) {
        case 'status':
            $this->projectStatusSetting = ProjectStatusSetting::all();
            $this->view = 'project-settings.ajax.status';
            break;
        case 'category':
            $this->projectCategory = ProjectCategory::all();
            $this->view = 'project-settings.ajax.category';
            break;
        case 'sub-category':
            $this->projectSubCategory = ProjectSubCategory::all();
            $this->view = 'project-settings.ajax.sub-category';
            break;
        case 'type':
            $this->projectType = ProjectType::all();
            $this->view = 'project-settings.ajax.type';
            break;
        case 'priority':
            $this->projectPriority = ProjectPriority::all();
            $this->view = 'project-settings.ajax.priority';
            break;  
        case 'propertytype':
                $this->propertyType = PropertyType::all();
                $this->view = 'project-settings.ajax.propertytype';
                break;    
         case 'occupancystatus':
                $this->occupancyStatus = OccupancyStatus::all();
                $this->view = 'project-settings.ajax.occupancystatus';
                break; 
        case 'delayedby':
                $this->delayedBy = DelayedBy::all();
                $this->view = 'project-settings.ajax.delayedby';
                break; 
        case 'contractortype':
                $this->contractortype = ContractorType::all();
                $this->view = 'project-settings.ajax.contractortype';
                break;
        case 'cancelledreason':
                $this->cancelledreason = CancelledReason::all();
                $this->view = 'project-settings.ajax.cancelledreason';
                break;
        case 'filetype':
            $this->filetype = ExternalFileType::all();
            $this->view = 'project-settings.ajax.filetype';
            break;
        default:
            $this->projectSetting = ProjectSetting::first();
            $this->view = 'project-settings.ajax.sendReminder';
            break;
        }

        $this->activeTab = $tab ?: 'sendReminder';

        if (request()->ajax()) {
            $html = view($this->view, $this->data)->render();

            return Reply::dataOnly(['status' => 'success', 'html' => $html, 'title' => $this->pageTitle, 'activeTab' => $this->activeTab]);
        }

        return view('project-settings.index', $this->data);
    }

    public function create()
    {
        return view('project-settings.create-project-status-settings-modal', $this->data);
    }

    public function store(StoreStatusSettingRequest $request)
    {
        $projectStatusSetting = new ProjectStatusSetting();
        $projectStatusSetting->status_name = $request->name;
        $projectStatusSetting->color = $request->status_color;
        $projectStatusSetting->status = $request->status;
        $projectStatusSetting->default_status = ProjectStatusSetting::INACTIVE;
        $projectStatusSetting->save();

        return Reply::success(__('messages.recordSaved'));
    }

    public function edit($id)
    {
        $this->projectStatusSetting = ProjectStatusSetting::findOrfail($id);

        return view('project-settings.edit', $this->data);
    }

    public function statusUpdate(StoreStatusSettingRequest $request, $id)
    {
        $projectStatusSetting = ProjectStatusSetting::findOrFail($id);

        $projectStatusSetting->status_name = $request->name;
        $projectStatusSetting->color = $request->status_color;
        $projectStatusSetting->status = $request->status;

        $projectStatusSetting->update();

        return Reply::success(__('messages.updateSuccess'));
    }

    public function changeStatus($id)
    {
        $projectStatusSetting = ProjectStatusSetting::findOrFail($id);

        $projectStatusSetting->status = request()->status;

        $projectStatusSetting->update();

        return Reply::success(__('messages.recordSaved'));
    }

    public function changeFilterOn($id)
    {
        $projectStatusSetting = ProjectStatusSetting::findOrFail($id);

        $projectStatusSetting->filter_on = request()->filter_on;

        $projectStatusSetting->save();

        return Reply::success(__('messages.recordSaved'));
    }

    public function setDefault()
    {

        ProjectStatusSetting::where('id', request()->id)->update(['default_status' => ProjectStatusSetting::ACTIVE]);
        ProjectStatusSetting::where('id', '<>', request()->id)->update(['default_status' => ProjectStatusSetting::INACTIVE]);

        return Reply::success(__('messages.updateSuccess'));
    }

    public function update(UpdateProjectSetting $request, $id)
    {
        $projectSetting = ProjectSetting::findOrFail($id);

        $projectSetting->send_reminder = $request->send_reminder ? 'yes' : 'no';
        $projectSetting->remind_time = $request->remind_time;
        $projectSetting->remind_type = $request->remind_type;

        $remindTo = [];

        if ($request->remind_to == 'all') {
            $remindTo = [ProjectSetting::REMIND_TO_MEMBERS, ProjectSetting::REMIND_TO_ADMINS];
        }

        if ($request->remind_to == 'members') {
            $remindTo = [ProjectSetting::REMIND_TO_MEMBERS];
        }

        if ($request->remind_to == 'admins') {
            $remindTo = [ProjectSetting::REMIND_TO_ADMINS];
        }


        $projectSetting->remind_to = $remindTo;
        $projectSetting->save();

        return Reply::success(__('messages.updateSuccess'));
    }

    public function destroy($id)
    {
        $projectStatusSetting = ProjectStatusSetting::findOrFail($id);
        $default = ProjectStatusSetting::where('default_status', ProjectStatusSetting::ACTIVE)->first();

        Project::where('status', $projectStatusSetting->status_name)->update(['status' => $default->status_name]);

        ProjectStatusSetting::destroy($id);

        return Reply::success(__('messages.deleteSuccess'));
    }

    public function createCategory()
    {
        $this->addPermission = user()->permission('manage_project_category');
        abort_403(!in_array($this->addPermission, ['all', 'added']));

        return view('project-settings.create-project-category-settings-modal', $this->data);
    }
    public function createSubCategory()
    {
        return view('project-settings.create-project-sub-category-settings-modal', $this->data);
    }
    public function importSubCategory()
    {
        return view('project-settings.import-project-sub-category-settings-modal', $this->data);
    }
    public function createType()
    {
        return view('project-settings.create-project-type-settings-modal', $this->data);
    }
    public function createPriority()
    {
        return view('project-settings.create-project-priority-settings-modal', $this->data);
    }
    public function createPropertyType()
    {
        return view('project-settings.create-property-type-settings-modal', $this->data);
    }
    public function createOccupancyStatus()
    {
        return view('project-settings.create-occupancy-status-settings-modal', $this->data);
    }
    public function createDelayedBy()
    {
        return view('project-settings.create-delayed-by-settings-modal', $this->data);
    }
    public function createContractorType()
    {
        return view('project-settings.create-contractor-type-settings-modal', $this->data);
    }
    public function createCancelledReason()
    {
        return view('project-settings.create-cancelled-reason-settings-modal', $this->data);
    }
    public function createFileType()
    {
        return view('project-settings.create-file-type-settings-modal', $this->data);
    }
    
    public function saveProjectCategory(StoreProjectCategory $request)
    {
        $this->addPermission = user()->permission('manage_project_category');
        abort_403(!in_array($this->addPermission, ['all', 'added']));

        $category = new ProjectCategory();
        $category->category_name = $request->category_name;
        $category->save();

        return Reply::success(__('messages.recordSaved'));
    }
    
    public function saveProjectSubCategory(StoreProjectSubCategory $request)
    {
       
        $subcategory = new ProjectSubCategory();
        $subcategory->sub_category = $request->sub_category;
        $subcategory->save();
        return Reply::success(__('messages.recordSaved'));
    }

    public function saveProjectType(StoreProjectType $request)
    {
       
        $type = new ProjectType();
        $type->type = $request->type;
        $type->save();
        return Reply::success(__('messages.recordSaved'));
    }
    public function saveProjectPriority(StoreProjectPriority $request)
    {
       
        $priority = new ProjectPriority();
        $priority->priority = $request->priority;
        $priority->save();
        return Reply::success(__('messages.recordSaved'));
    }
    public function savePropertyType(StorePropertyType $request)
    {
       
        $pt = new PropertyType();
        $pt->property_type = $request->property_type;
        $pt->save();
        return Reply::success(__('messages.recordSaved'));
    }
    public function saveOccupancyStatus(StoreOccupancyStatus $request)
    {
       
        $os = new OccupancyStatus();
        $os->occupancy_status = $request->occupancy_status;
        $os->save();
        return Reply::success(__('messages.recordSaved'));
    }

    public function saveDelayedBy(StoreDelayedBy $request)
    {
        $dy = new DelayedBy();
        $dy->delayed_by = $request->delayed_by;
        $dy->save();
        return Reply::success(__('messages.recordSaved'));
    }

    public function saveContractorType(StoreContractorType $request)
    {
        $ct = new ContractorType();
        $ct->contractor_type = $request->contractor_type;
        $ct->save();
        return Reply::success(__('messages.recordSaved'));
    }

    public function saveCancelledReason(StoreCancelledReason $request)
    {
        $cr = new CancelledReason();
        $cr->cancelled_reason = $request->cancelled_reason;
        $cr->save();
        return Reply::success(__('messages.recordSaved'));
    }
    public function saveFileType(StoreFileType $request){

        $ft = new ExternalFileType();
        $ft->file_type = $request->file_type;
        $ft->save();
        return Reply::success(__('messages.recordSaved'));
    }
}
