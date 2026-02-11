<?php

namespace App\DataTables;

use App\Helper\Common;
use Carbon\Carbon;
use App\Models\Project;
use App\Models\CustomField;
use App\Models\CustomFieldGroup;
use App\DataTables\BaseDataTable;
use App\Models\GlobalSetting;
use App\Models\ProjectStatusSetting;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\ProjectCustomFilter;

class ProjectsDataTable extends BaseDataTable
{

    private $addProjectPermission;
    private $editProjectsPermission;
    private $deleteProjectPermission;
    private $viewProjectPermission;
    private $viewGanttPermission;
    private $addProjectMemberPermission;

    public function __construct()
    {
        parent::__construct();
        $this->addProjectPermission = user()->permission('add_projects');
        $this->editProjectsPermission = user()->permission('edit_projects');
        $this->deleteProjectPermission = user()->permission('delete_projects');
        $this->viewProjectPermission = user()->permission('view_projects');
        $this->viewGanttPermission = user()->permission('view_project_gantt_chart');
        $this->addProjectMemberPermission = user()->permission('add_project_members');

    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $projectStatus = ProjectStatusSetting::get();
        $datatables = datatables()->eloquent($query);
        $datatables->addIndexColumn();

        $datatables->addColumn('check', fn($row) => $this->checkBoxProject($row));
        $datatables->addColumn('action', function ($row) {
            $memberIds = $row->members->pluck('user_id')->toArray();

            $action = '<div class="task_view">

                <div class="dropdown">
                    <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle" type="link"
                        id="dropdownMenuLink-' . $row->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-options-vertical icons"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink-' . $row->id . '" tabindex="0">';

            $action .= '<a href="' . route('projects.show', [$row->id]) . '" class="dropdown-item"><i class="fa fa-eye mr-2"></i>' . __('app.view') . '</a>';

            if ($this->editProjectsPermission == 'all'
                || ($this->editProjectsPermission == 'added' && user()->id == $row->added_by)
                || ($this->editProjectsPermission == 'owned' && user()->id == $row->client_id && in_array('client', user_roles()))
                || ($this->editProjectsPermission == 'owned' && in_array(user()->id, $memberIds) && in_array('employee', user_roles()))
                || ($this->editProjectsPermission == 'both' && (user()->id == $row->client_id || user()->id == $row->added_by))
                || ($this->editProjectsPermission == 'both' && in_array(user()->id, $memberIds) && in_array('employee', user_roles()))
            ) {
                $action .= '<a class="dropdown-item openRightModal" href="' . route('projects.edit', [$row->id]) . '">
                            <i class="fa fa-edit mr-2"></i>
                            ' . trans('app.edit') . '
                        </a>';
            }

            if ($this->addProjectPermission == 'all' || $this->addProjectPermission == 'added' || $this->addProjectPermission == 'both') {
                $action .= '<a class="dropdown-item duplicateProject" href="javascript:;" data-project-id="' . $row->id . '">
                            <i class="fa fa-clone"></i>
                            ' . trans('app.duplicate') . '
                        </a>';
            }

            if ($this->viewGanttPermission == 'all' || ($this->viewGanttPermission == 'added' && user()->id == $row->added_by) || ($this->viewGanttPermission == 'owned' && user()->id == $row->client_id)) {
                $action .= '<a class="dropdown-item" href="' . route('projects.show', $row->id) . '?tab=gantt' . '">
                            <i class="fa fa-project-diagram mr-2"></i>
                            ' . trans('modules.projects.viewGanttChart') . '
                        </a>';
            }

            $action .= '<a class="dropdown-item" target="_blank" href="' . url()->temporarySignedRoute('front.gantt', now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY), $row->hash) . '">
                    <i class="fa fa-share-square mr-2"></i>
                    ' . trans('modules.projects.viewPublicGanttChart') . '
                </a>';

            $action .= '<a class="dropdown-item" target="_blank" href="' . url()->temporarySignedRoute('front.taskboard', now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY), $row->hash) . '">
                    <i class="fa fa-share-square mr-2"></i>
                    ' . trans('app.public') . ' ' . __('modules.tasks.taskBoard') . '
                </a>';

            if ($this->deleteProjectPermission == 'all'
                || ($this->deleteProjectPermission == 'added' && user()->id == $row->added_by)
                || ($this->deleteProjectPermission == 'owned' && user()->id == $row->client_id && in_array('client', user_roles()))
                || ($this->deleteProjectPermission == 'owned' && in_array(user()->id, $memberIds) && in_array('employee', user_roles()))
                || ($this->deleteProjectPermission == 'both' && (user()->id == $row->client_id || user()->id == $row->added_by))
                || ($this->deleteProjectPermission == 'both' && in_array(user()->id, $memberIds) && in_array('employee', user_roles()))
            ) {
                $action .= '<a class="dropdown-item archive" href="javascript:;" data-user-id="' . $row->id . '">
                            <i class="fa fa-archive mr-2"></i>
                            ' . trans('app.archive') . '
                        </a>';
                $action .= '<a class="dropdown-item delete-table-row" href="javascript:;" data-user-id="' . $row->id . '">
                            <i class="fa fa-trash mr-2"></i>
                            ' . trans('app.delete') . '
                        </a>';
            }

            $action .= '</div>
                </div>
            </div>';

            return $action;
        }
        );
        $datatables->addColumn('members', function ($row) {
            if ($row->public) {
                return '--';
            }
            $allMembers = collect()
            ->merge($row->est_users)
            ->merge($row->acct_users)
            ->merge($row->emanager_users);
            
            $roleMembers = [
                0 => $row->project_coordinator,
                1 => $row->project_scheduler,
                2 => $row->vendor_recruiter
            ];            

            $members = '<div class="position-relative">';
            if (count($row->members) > 0) {
                foreach ($row->members as $key => $member) {
                    if ($key < 4) {
                        $img = '<img data-toggle="tooltip" height="25" width="25" data-original-title="' . $member->user->name . '" src="' . $member->user->image_url . '">';

                        $position = $key > 0 ? 'position-absolute' : '';
                        $members .= '<div class="taskEmployeeImg rounded-circle ' . $position . '" style="left:  ' . ($key * 13) . 'px"><a href="' . route('employees.show', $member->user->id) . '">' . $img . '</a></div> ';
                    }

                }
            }
            
            if ($allMembers->count() > 0) {
                foreach ($allMembers as $key => $member) {
                    if ($key+=1 < 4) {
                        $img = '<img data-toggle="tooltip" height="25" width="25" data-original-title="' . $member->name . '" src="' . $member->image_url . '">';

                        $position = $key > 0 ? 'position-absolute' : '';
                        $members .= '<div class="taskEmployeeImg rounded-circle ' . $position . '" style="left:  ' . ($key * 13) . 'px">
                                        <a href="' . route('employees.show', $member->id) . '">' . $img . '</a>
                                    </div>';
                    }
                }
            }
            // $members .= '<br/>';
            foreach ($roleMembers as $key => $member) {
                if ($member) {
                    $img = '<img data-toggle="tooltip" height="25" width="25" data-original-title="' . $member->name . '" src="' . $member->image_url . '">';
                    $position = $key > 0 ? 'position-absolute' : '';
                    $members .= '<div class="taskEmployeeImg rounded-circle ' . $position . '" style="left: ' . ($key * 13) . 'px">
                                    <a href="' . route('employees.show', $member->id) . '">' . $img . '</a>
                                 </div>';
                }
            }

            if (count($row->members) > 4) {
                $members .= '<div class="taskEmployeeImg more-user-count text-center rounded-circle bg-amt-grey position-absolute" style="left:  52px"><a href="' . route('projects.show', $row->id) . '?tab=members" class="text-dark f-10">+' . (count($row->members) - 4) . '</a></div> ';
            }

            $members .= '</div>';

            return $members;
        }
        );

        $datatables->addColumn('vendors', function ($row) {
         
            $members = '<div class="position-relative">';
            if (count($row->projectvendortable) > 0) {
                foreach ($row->projectvendortable as $key => $member) {
                    if ($key < 4) {
                        $img = '<img data-toggle="tooltip" height="25" width="25" data-original-title="' . $member->vendor_name . '" src="https://www.w3schools.com/howto/img_avatar.png">';

                        $position = $key > 0 ? 'position-absolute' : '';
                        $members .= '<div class="taskEmployeeImg rounded-circle ' . $position . '" style="left:  ' . ($key * 13) . 'px"><a href="' . route('vendors.show', $member->vendor_id??'') . '">' . $img . '</a></div> ';
                    }

                }
            }
            else {

                $members .= '--';
            }

            if (count($row->members) > 4) {
                $members .= '<div class="taskEmployeeImg more-user-count text-center rounded-circle bg-amt-grey position-absolute" style="left:  52px"><a href="' . route('vendors.show', $member->vendor_id??'') . '?tab=members" class="text-dark f-10">+' . (count($row->members) - 4) . '</a></div> ';
            }

            $members .= '</div>';

            return $members;
        }
        );
        $datatables->addColumn('vendors_name', function ($row) {
            $members = [];

            if (count($row->projectvendortable) > 0) {

                foreach ($row->projectvendortable as $member) {
                    $members[] = $member->vendor_name;
                }

                return implode(',', $members);
            }
        }
        );
        $datatables->addColumn('name', function ($row) {
            $members = [];

            if (count($row->members) > 0) {

                foreach ($row->members as $member) {
                    $members[] = $member->user->name;
                }

                return implode(',', $members);
            }
        });
        $datatables->addColumn('coordinator', function ($row) {

            if($row->project_coordinator_id)
            {
                return $row->project_coordinator->name;
            }
        });
        $datatables->addColumn('estimator', function ($row) {
            $members = [];

            if (count($row->est_users) > 0) {

                foreach ($row->est_users as $member) {
                    $members[] = $member->name;
                }

                return implode(',', $members);
            }
        });
        $datatables->addColumn('acc_analyst', function ($row) {
            $members = [];

            if (count($row->acct_users) > 0) {

                foreach ($row->acct_users as $member) {
                    $members[] = $member->name;
                }

                return implode(',', $members);
            }
        });
        $datatables->addColumn('esc_manager', function ($row) {
            $members = [];

            if (count($row->emanager_users) > 0) {

                foreach ($row->emanager_users as $member) {
                    $members[] = $member->name;
                }

                return implode(',', $members);
            }
        });
        $datatables->addColumn('recruiter', function ($row) {

            if($row->vendor_recruiter_id)
            {
                return $row->vendor_recruiter->name;
            }
        });
        $datatables->addColumn('scheduler', function ($row) {

            if($row->project_scheduler_id)
            {
                return $row->project_scheduler->name;
            }
        });
        $datatables->addColumn('project', function ($row) {
            return $row->project_name;
        });

        $datatables->editColumn('project_name', function ($row) {
            $pin = '';
            if (($row->pinned_project)) {
                $pin .= '<span class="badge badge-secondary"><i class="fa fa-thumbtack"></i> ' . __('app.pinned') . '</span>';
            }

            if (($row->public)) {
                $pin = '<span class="badge badge-primary"><i class="fa fa-globe"></i> ' . __('app.public') . '</span>';
            }

            return '<div class="media align-items-center">
                        <div class="media-body">
                    <h5 class="mb-0 f-13 text-darkest-grey"><a href="' . route('projects.show', [$row->id]) . '">' . $row->project_name . '</a></h5>
                    <p class="mb-0">' . $pin . '</p>
                    </div>
                </div>';
        });
        $datatables->editColumn('start_date', fn($row) => $row->start_date?->translatedFormat($this->company->date_format));
        $datatables->editColumn('invoiced_date', fn($row) => $row->latestInvoice?->issue_date->translatedFormat($this->company->date_format));
        $datatables->editColumn('deadline', fn($row) => Common::dateColor($row->deadline));
        $datatables->editColumn('bsdate', fn($row) => $row->bid_submitted?->translatedFormat($this->company->date_format));
        $datatables->editColumn('cpaydate', fn($row) => $row->latestPayment?->paid_on->translatedFormat($this->company->date_format));
        $datatables->editColumn('brdate', fn($row) => $row->bid_rejected?->translatedFormat($this->company->date_format));
        $datatables->editColumn('badate', fn($row) => $row->bid_approval?->translatedFormat($this->company->date_format));
        $datatables->editColumn('wcd', fn($row) => $row->work_completion_date?->translatedFormat($this->company->date_format));
        $datatables->editColumn('cancelled_date', fn($row) => $row->cancelled_date?->translatedFormat($this->company->date_format));
        $datatables->addColumn('client_name', fn($row) => $row->client?->name_salutation ?? '-');
        $datatables->addColumn('client_email', fn($row) => $row->client?->email ?? '-');
        $datatables->addColumn('project_status', fn($row) => __('app' . $row->status));
        $datatables->editColumn('client_id', fn($row) => $row->client_id ? view('components.client', ['user' => $row->client]) : '');
        $datatables->editColumn('inspectiondt', function ($row){
            return '
                    <div class="media align-items-center justify-content-center mr-3">
                    <td> '. $row->inspection_date?->translatedFormat($this->company->date_format) . '</td> 
                    <td> '. ($row->inspection_time ? Carbon::createFromFormat('H:i:s', $row->inspection_time)->format($this->company->time_format) : null) . '</td>
                    </div>
                      ';
        });
        $datatables->editColumn('quick_notes_disp', function ($row){
           if($row->quick_notes){ 

            return '<span data-toggle="tooltip" title="' . e($row->quick_notes) . '">
            <i class="fa fa-sticky-note" aria-hidden="true"></i>
            </span>' ;

            }
            else{ 
                return 'N/A';
            }
        });
         $datatables->editColumn('total', function ($row){
            
            return currency_format($row->invoices_sum_total ?? 0, $row->currency_id);
        });
        $datatables->editColumn('cpayamt', function ($row){
            
            return currency_format($row->payments_sum_amount ?? 0, $row->currency_id);
        });
         $datatables->editColumn('vendor_amt', function ($row){
            
            return currency_format($row->total_vendor_amt ?? 0, $row->currency_id);
        });
        $datatables->editColumn('rinspectiondt', function ($row){
            return '
                    <div class="media align-items-center justify-content-center mr-3">
                    <td> '. $row->re_inspection_date?->translatedFormat($this->company->date_format) . '</td> 
                    <td> '. ($row->re_inspection_time ? Carbon::createFromFormat('H:i:s', $row->re_inspection_time)->format($this->company->time_format) : null) . '</td>
                    </div>
                      ';
        });
        $datatables->editColumn('nxtfollowdt', function ($row){
            return '
                    <div class="media align-items-center justify-content-center mr-3">
                    <td> '. $row->nxt_follow_up_date?->translatedFormat($this->company->date_format) . '</td> 
                    <td> '. ($row->nxt_follow_up_time ? Carbon::createFromFormat('H:i:s', $row->nxt_follow_up_time)->format($this->company->time_format) : null) . '</td>
                    </div>
                      ';
        });
        $datatables->orderColumn('nxtfollowdt', function ($query, $order) {
            $query->orderBy('nxt_follow_up_date', $order)
                  ->orderBy('nxt_follow_up_time', $order);
        });        
        $datatables->editColumn('wsdt', function ($row){
            return '
                    <div class="media align-items-center justify-content-center mr-3">
                    <td> '. $row->work_schedule_date?->translatedFormat($this->company->date_format) . '</td> 
                    <td> '. ($row->work_schedule_time ? Carbon::createFromFormat('H:i:s', $row->work_schedule_time)->format($this->company->time_format) : null) . '</td>
                    </div>
                      ';
        });
        $datatables->editColumn('wrsdt', function ($row){
            return '
                    <div class="media align-items-center justify-content-center mr-3">
                    <td> '. $row->work_schedule_re_date?->translatedFormat($this->company->date_format) . '</td> 
                    <td> '. ($row->work_schedule_re_time ? Carbon::createFromFormat('H:i:s', $row->work_schedule_re_time)->format($this->company->time_format) : null) . '</td>
                    </div>
                      ';
        });
        $datatables->addColumn('status', function ($row) use ($projectStatus) {
            $projectUsers = $row->members->pluck('user_id')->toArray();

            if ($row->completion_percent < 50) {
                $statusColor = 'danger';
            }
            elseif ($row->completion_percent < 75) {
                $statusColor = 'warning';
            }
            else {
                $statusColor = 'success';
            }

            $status = '';

            if ($this->editProjectsPermission == 'all'
                || ($this->editProjectsPermission == 'added' && user()->id == $row->added_by)
                || ($this->editProjectsPermission == 'owned' && user()->id == $row->client_id && in_array('client', user_roles()))
                || ($this->editProjectsPermission == 'owned' && in_array(user()->id, $projectUsers) && in_array('employee', user_roles()))
                || ($this->editProjectsPermission == 'both' && (user()->id == $row->client_id || user()->id == $row->added_by))
                || ($this->editProjectsPermission == 'both' && in_array(user()->id, $projectUsers) && in_array('employee', user_roles()))
            ) {
                $status .= '<select class="form-control select-picker change-status" disabled data-project-id="' . $row->id . '">';

                foreach ($projectStatus as $item) {
                    $status .= '<option ';

                    if ($item->status_name == $row->status) {
                        $status .= 'selected';
                    }

                    $status .= '  data-content="<i class=\'fa fa-circle mr-2\' style=\'color: ' . $item->color . '\'></i> ' . $item->status_name . '" value="' . $item->status_name . '" >' . $item->status_name . '</option>';
                }

                $status .= '</select>';

                return $status;
            }
            else {
                foreach ($projectStatus as $item) {
                    if ($row->status == $item->status_name) {
                        return '<i class="fa fa-circle mr-1 text-yellow"
                            style="color: ' . $item->color . '"></i>' . $item->status_name;
                    }
                }
            }

        });
        $datatables->editColumn('completion_percent', function ($row) {
            $completionPercent = $row->completion_percent;
            $statusColor = $completionPercent < 50 ? 'danger' : ($completionPercent < 75 ? 'warning' : 'success');

            return '<div class="progress" style="height: 15px;">
                        <div class="progress-bar f-12 bg-' . $statusColor . '" role="progressbar" style="width: ' . $completionPercent . '%;" aria-valuenow="' . $completionPercent . '" aria-valuemin="0" aria-valuemax="100">' . $completionPercent . '%</div>
                     </div>';
        });
        $datatables->addColumn('completion_export', function ($row) {
            return $row->completion_percent . '% ' . __('app.complete');
        });
        $datatables->setRowId(fn($row) => 'row-' . $row->id);
        $datatables->editColumn('project_short_code', function ($row) {
            return '<a href="' . route('projects.show', [$row->id]) . '" class="text-darkest-grey">' . $row->project_short_code . '</a>';
        });
        $datatables->orderColumn('status', 'status $1');
        $datatables->removeColumn('project_summary');
        $datatables->removeColumn('notes');
        $datatables->removeColumn('category_id');
        $datatables->removeColumn('feedback');
        $datatables->setRowClass(
            function ($row) {
                return $row->pinned_project ? 'alert-primary' : '';
            }
        );

        // Custom Fields For export
        $customFieldColumns = CustomField::customFieldData($datatables, Project::CUSTOM_FIELD_MODEL);

        $datatables->rawColumns(array_merge(['project_name', 'action', 'completion_percent', 'members', 'status', 'client_id', 'check', 'project_short_code', 'deadline','rinspectiondt','inspectiondt','wsdt','wrsdt','vendors','nxtfollowdt','quick_notes_disp'], $customFieldColumns));

        return $datatables;
    }


    public function query(Project $model)
    {
        $request = $this->request();
        $startFilterDate = null;
        $endFilterDate = null;

        if ($request->startFilterDate !== null && $request->startFilterDate != 'null' && $request->startFilterDate != '') {
            $startFilterDate = companyToDateString($request->startFilterDate);
        
        }

        if ($request->endFilterDate !== null && $request->endFilterDate != 'null' && $request->endFilterDate != '') {
            $endFilterDate = companyToDateString($request->endFilterDate);
        
        }

        $model = $model
            ->with('members', 'members.user', 'client', 'client.clientDetails', 'currency', 'client.session', 'mentionUser','projectvendortable','acct_users','emanager_users','est_users','vendor_recruiter','project_scheduler','project_coordinator')
            ->leftJoin('project_members', 'project_members.project_id', 'projects.id')
            ->leftJoin('users', 'project_members.user_id', 'users.id')
            ->leftJoin('project_estimators', 'project_estimators.project_id', 'projects.id')
            ->leftJoin('users as estimators', 'project_estimators.user_id', 'estimators.id')
            ->leftJoin('project_accountings', 'project_accountings.project_id', 'projects.id')
            ->leftJoin('users as accountants', 'project_accountings.user_id', 'accountants.id')
            ->leftJoin('project_emanagers', 'project_emanagers.project_id', 'projects.id')
            ->leftJoin('users as emanagers', 'project_emanagers.user_id', 'emanagers.id')
            ->leftJoin('users as client', 'projects.client_id', 'users.id')
            ->leftJoin('mention_users', 'mention_users.project_id', 'projects.id')
            ->leftJoin('property_details', 'projects.property_details_id', 'property_details.id')
            ->leftJoin('project_category', 'projects.category_id', 'project_category.id')
            ->leftJoin('project_vendors', 'project_vendors.project_id', 'projects.id')
            ->leftJoin('project_status_settings', 'projects.status', 'project_status_settings.status_name')
            ->selectRaw(
                'projects.id, projects.project_short_code, projects.hash, projects.added_by, projects.project_name, projects.start_date, projects.deadline, projects.client_id,
              projects.completion_percent, projects.project_budget, projects.currency_id,projects.type,projects.priority,projects.sub_category,projects.nte,projects.bid_submitted_amount,projects.bid_approved_amount,projects.delayed_by,projects.cancelled_date,projects.cancelled_reason,projects.project_coordinator_id,projects.project_scheduler_id,projects.vendor_recruiter_id,
              projects.inspection_date,projects.inspection_time,projects.re_inspection_date,projects.re_inspection_time,projects.bid_submitted,projects.bid_rejected,projects.bid_approval,projects.work_schedule_date,projects.work_schedule_time,projects.nxt_follow_up_time,projects.nxt_follow_up_date,projects.quick_notes,
              property_details.state,property_details.city,property_details.zipcode,property_details.street_address,property_details.county,
              projects.work_schedule_re_date,projects.work_schedule_re_time,projects.work_completion_date,project_category.category_name,
              projects.status, users.salutation, users.name, client.name as client_name, client.email as client_email, projects.public, mention_users.user_id as mention_user,
            ( select count("id") from pinned where pinned.project_id = projects.id and pinned.user_id = ' . user()->id . ') as pinned_project,
            (
                select coalesce(sum(expense_process_payments.price), 0)
                from expenses
                inner join expense_process_payments on expenses.id = expense_process_payments.expense_id
                where expenses.project_id = projects.id
            ) as total_vendor_amt'
            );

        $model = $model->withSum(['invoices' => function ($query) {
            $query->whereIn('status', ['paid', 'unpaid']);
        }], 'total');

        $model = $model->withSum('payments', 'amount');
        
        if ($request->pinned == 'pinned') {
            $model->join('pinned', 'pinned.project_id', 'projects.id');
            $model->where('pinned.user_id', user()->id);
        }
        if ($request->searchText == ''){
            $model = self::customFilter($model);
        }

        if (!is_null($request->status) && $request->status != 'all') {

            if ($request->status == 'overdue') {
                $model->where('projects.completion_percent', '!=', 100);

                if ($request->deadLineStartDate == '' && $request->deadLineEndDate == '') {
                    $model->whereDate('projects.deadline', '<', now(company()->timezone)->toDateString());
                }
            }
            else {
                $model->where('projects.status', $request->status);
            }
        }

        if ($request->progress) {
            $model->where(
                function ($q) use ($request) {
                    foreach ($request->progress as $progress) {
                        $completionPercent = explode('-', $progress);
                        $q->orWhereBetween('projects.completion_percent', [$completionPercent[0], $completionPercent[1]]);
                    }
                }
            );
        }

        if ($request->deadLineStartDate != '' && $request->deadLineEndDate != '') {
            $startDate = companyToDateString($request->deadLineStartDate);
            $endDate = companyToDateString($request->deadLineEndDate);
            $model->whereRaw('Date(projects.deadline) >= ?', [$startDate])->whereRaw('Date(projects.deadline) <= ?', [$endDate]);
        }

        if (!is_null($request->client_id) && $request->client_id != 'all') {
            $model->where('projects.client_id', $request->client_id);
        }

        if (!is_null($request->vendor_id) && $request->vendor_id != 'all') {
            $model->where('project_vendors.vendor_id', $request->vendor_id);
        }

        if (!is_null($request->team_id) && $request->team_id != 'all') {
            $model->where('team_id', $request->team_id);
        }

        if (!is_null($request->category_id) && $request->category_id != 'all') {
            $model->where('category_id', $request->category_id);
        }

        if (!is_null($request->public) && $request->public != 'all') {
            $model->where('public', $request->public);
        }

        if (!is_null($request->employee_id) && $request->employee_id != 'all') {
            $model->where(
                function ($query) {
                    return $query->where('project_members.user_id', request()->employee_id)
                        ->orWhere('mention_users.user_id', user()->id)
                        ->orWhere('projects.public', 1);
                }
            );
        }
        
        if ($this->viewProjectPermission == 'added') {
            $model->where(
                function ($query) {

                    return $query->where('projects.added_by', user()->id)
                        ->orWhere('mention_users.user_id', user()->id)
                        ->orWhere('projects.public', 1);
                }
            );
        }

        if ($this->viewProjectPermission == 'owned' && in_array('employee', user_roles())) {
            $model->where(
                function ($query) {
                    return $query->where('project_members.user_id', user()->id)
                        ->orWhere('mention_users.user_id', user()->id)
                        ->orWhere('projects.public', 1);
                }
            );
        }

        if ($this->viewProjectPermission == 'both' && in_array('employee', user_roles())) {
            $model->where(
                function ($query) {
                    return $query->where('projects.added_by', user()->id)
                        ->orWhere('project_members.user_id', user()->id)
                        ->orWhere('mention_users.user_id', user()->id)
                        ->orWhere('projects.public', 1);
                }
            );
        }

        if ($startFilterDate !== null && $endFilterDate !== null) {
            $model->where(function ($query) use ($startFilterDate, $endFilterDate) {
                if (request()->date_filter_on == 'start_date') {
                    $query->whereBetween(DB::raw('DATE(projects.`start_date`)'), [$startFilterDate, $endFilterDate]);

                }
                elseif (request()->date_filter_on == 'deadline') {
                    $query->whereBetween(DB::raw('DATE(projects.`deadline`)'), [$startFilterDate, $endFilterDate]);

                }

            });
        }

        if ($request->searchText != '') {
            $model->where(
                function ($query) {
                    $query->where('projects.project_name', 'like', '%' . request('searchText') . '%')
                        ->orWhere('users.name', 'like', '%' . request('searchText') . '%')
                        ->orWhere('property_details.street_address', 'like', '%' . request('searchText') . '%')
                        ->orWhere('projects.project_short_code', 'like', '%' . request('searchText') . '%'); // project short code
                }
            );
        }

        if ($request->startDate && $request->endDate) {
            $startDate = companyToDateString($request->startDate);
            $endDate = companyToDateString($request->endDate);
            $model->whereBetween(DB::raw('DATE(projects.`created_at`)'), [$startDate, $endDate]);
        }

        $model->groupBy('projects.id');
        // $model->orderbyRaw('pinned_project desc');

        // Apply persistent custom sorting
        $activeFilter = ProjectCustomFilter::where('user_id', user()->id)->where('status', 'active')->first();
        if ($activeFilter && $activeFilter->sort_order && isset($activeFilter->sort_order['column'])) {
            foreach ($activeFilter->sort_order['column'] as $index => $column) {
                $direction = $activeFilter->sort_order['direction'][$index] ?? 'asc';
                if ($column != '') {
                    $columnMapping = [
                        'category_name' => 'project_category.category_name',
                        'client_id' => 'client.name',
                        'city' => 'property_details.city',
                        'state' => 'property_details.state',
                        'county' => 'property_details.county',
                        'zipcode' => 'property_details.zipcode',
                        'street_address' => 'property_details.street_address',
                    ];
                    
                    $orderByColumn = $columnMapping[$column] ?? $column;
                    
                    // Prefix with projects if it's a projects table column to avoid ambiguity
                    $projectsColumns = [
                        'project_name', 'status', 'priority', 'type', 'start_date', 'deadline', 'id', 'project_short_code',
                        'inspection_date', 'work_schedule_date', 'work_completion_date', 'nxt_follow_up_date',
                        'project_coordinator_id', 'project_scheduler_id', 'vendor_recruiter_id'
                    ];
                    if (in_array($column, $projectsColumns)) {
                        $orderByColumn = 'projects.' . $column;
                    }
                    
                    $model->orderBy($orderByColumn, $direction);
                }
            }
        }

        return $model;
    }

    public function customFilter($model)
    {
        try{
            $customfilter = ProjectCustomFilter::where('user_id', user()->id)->where('status', 'active')->first();

            if($customfilter->start_date!=''&& $customfilter->end_date!='')
            {
                $model->whereBetween(DB::raw("DATE(projects.`{$customfilter->filter_on}`)"), [$customfilter->start_date, $customfilter->end_date]);
            }
            if($customfilter->start_date_nxt!=''&& $customfilter->end_date_nxt!='')
            {
                $model->whereBetween(DB::raw("DATE(projects.`nxt_follow_up_date`)"), [$customfilter->start_date_nxt, $customfilter->end_date_nxt]);
            }
            if($customfilter->project_category!='')
            {
                $model->whereIn('projects.category_id', $customfilter->project_category)->get();
            }
            if($customfilter->project_sub_category!='')
            {
                $model->whereIn('projects.sub_category', $customfilter->project_sub_category)->get();
            }
            if($customfilter->project_type!='')
            {
                $model->whereIn('projects.type', $customfilter->project_type)->get();
            }
            if($customfilter->project_priority!='')
            {
                $model->whereIn('projects.priority', $customfilter->project_priority)->get();
            }
            if($customfilter->project_status!='')
            {
                $model->whereIn('projects.status', $customfilter->project_status)->get();
            }
            if($customfilter->delayed_by!='')
            {
                $model->whereIn('projects.delayed_by', $customfilter->delayed_by)->get();
            }
            if($customfilter->client_id!='')
            {
                $model->whereIn('projects.client_id', $customfilter->client_id)->get();
            }
            if($customfilter->state!='')
            {
                $model->whereIn('property_details.state', $customfilter->state)->get();
            }
            if($customfilter->city!='')
            {
                $model->whereIn('property_details.city', $customfilter->city)->get();
            }
            if($customfilter->county!='')
            {
                $model->whereIn('property_details.county', $customfilter->county)->get();
            }
            if($customfilter->project_members!='')
            {
               $model->where(function ($query) use ($customfilter) {
                    $query->whereIn('project_members.user_id', $customfilter->project_members)
                        ->orWhereIn('project_estimators.user_id', $customfilter->project_members)
                        ->orWhereIn('project_accountings.user_id', $customfilter->project_members)
                        ->orWhereIn('project_emanagers.user_id', $customfilter->project_members)
                        ->orWhereIn('projects.project_coordinator_id', $customfilter->project_members)
                        ->orWhereIn('projects.project_scheduler_id', $customfilter->project_members)
                        ->orWhereIn('projects.vendor_recruiter_id', $customfilter->project_members);
                });
                
            }
        }
        catch (Exception){}
        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $dataTable = $this->setBuilder('projects-table', 2)
        
            ->parameters(
                [
                    'initComplete' => 'function () {
                    window.LaravelDataTables["projects-table"].buttons().container()
                     .appendTo( "#table-actions")
                 }',
                    'fnDrawCallback' => 'function( oSettings ) {
                    $("#projects-table .select-picker").selectpicker();

                    $("body").tooltip({
                        selector: \'[data-toggle="tooltip"]\'
                    })
                }',
                ]
            );

        if (canDataTableExport()) {
            $dataTable->buttons(Button::make(['extend' => 'excel', 'text' => '<i class="fa fa-file-export"></i> ' . trans('app.exportExcel')]));
        }

        return $dataTable;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $data = [
            'check' => [
                'title' => '<input type="checkbox" name="new_select_all_table" id="new-select-all-table"/>',
                'exportable' => false,
                'orderable' => false,
                'searchable' => false,
                'visible' => !in_array('client', user_roles())
            ],
            'action' => [
                'title' => __('app.action'),
                'data' => 'action', // Specify the data source for actions
                'exportable' => false,
                'orderable' => false,
                'searchable' => false,
                'class' => 'text-right pr-20'
            ],
            '#' => ['data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'visible' => false, 'title' => '#'],
            __('Next F/U Details') => ['data' => 'nxtfollowdt', 'name' => 'nxtfollowdt', 'title' => __('Next F/U Details'), 'width' => '12%'],
            __('app.completion') => ['data' => 'completion_export', 'name' => 'completion_export', 'visible' => false, 'title' => __('app.completion')],
            __('app.status') => ['data' => 'status', 'name' => 'status', 'width' => '16%', 'exportable' => false, 'title' => __('app.status')],
            __('app.project') . ' ' . __('app.status') => ['data' => 'project_status', 'name' => 'status', 'visible' => false, 'title' => __('app.project') . ' ' . __('app.status')],
            __('modules.projects.members') => ['data' => 'members', 'name' => 'members', 'exportable' => false, 'width' => '15%', 'title' => __('modules.projects.members')],
           
            __('app.wno') => ['data' => 'project_short_code', 'name' => 'project_short_code', 'title' => __('app.wno')],
            __('app.client') => ['data' => 'client_id', 'name' => 'client_id', 'width' => '15%', 'exportable' => false, 'title' => __('app.client'), 'visible' => !in_array('client', user_roles())],
            __('app.customers') => ['data' => 'client_name', 'name' => 'client_id', 'visible' => false, 'title' => __('app.customers')],
            __('app.client') . ' ' . __('app.email') => ['data' => 'client_email', 'name' => 'client_id', 'visible' => false, 'title' => __('app.client') . ' ' . __('app.email')],
            __('Project Manager') => ['data' => 'name', 'name' => 'name', 'visible' => false, 'title' => __('Project Manager')],
            __('Project Coordinator') => ['data' => 'coordinator', 'name' => 'coordinator', 'visible' => false, 'title' => __('Project Coordinator')],
            __('Project Estimator') => ['data' => 'estimator', 'name' => 'estimator', 'visible' => false, 'title' => __('Project Estimator')],
            __('Project Accounting Analyst') => ['data' => 'acc_analyst', 'name' => 'acc_analyst', 'visible' => false, 'title' => __('Project Accounting Analyst')],
            __('Project Escalation Manager') => ['data' => 'esc_manager', 'name' => 'esc_manager', 'visible' => false, 'title' => __('Project Escalation Manager')],
            __('Vendor Recruiter') => ['data' => 'recruiter', 'name' => 'recruiter', 'visible' => false, 'title' => __('Vendor Recruiter')],
            __('Project Scheduler') => ['data' => 'scheduler', 'name' => 'scheduler', 'visible' => false, 'title' => __('Project Scheduler')],
            __('app.ptype') => ['data' => 'type', 'name' => 'type', 'title' => __('app.ptype')],
            __('app.priority') => ['data' => 'priority', 'name' => 'priority', 'title' => __('app.priority')],
            __('app.pcategory') => ['data' => 'category_name', 'name' => 'category_name', 'title' => __('app.pcategory')],
            __('app.psubcategory') => ['data' => 'sub_category', 'name' => 'sub_category', 'title' => __('app.psubcategory')],
            __('app.streetaddress') => ['data' => 'street_address', 'name' => 'street_address', 'title' => __('app.streetaddress')],
            __('app.city') => ['data' => 'city', 'name' => 'city', 'title' => __('app.city')],
            __('app.state') => ['data' => 'state', 'name' => 'state', 'title' => __('app.state')],
            __('app.zipcode') => ['data' => 'zipcode', 'name' => 'zipcode', 'title' => __('app.zipcode')],
            __('app.county') => ['data' => 'county', 'name' => 'county', 'title' => __('app.county')],
            __('app.menu.vendors') => ['data' => 'vendors', 'name' => 'vendors', 'exportable' => false, 'width' => '15%', 'title' => __('app.menu.vendors')],
            __('Vendor') => ['data' => 'vendors_name', 'name' => 'vendors_name', 'visible' => false, 'title' => __('Vendor')],
            __('app.pdate') => ['data' => 'start_date', 'name' => 'start_date', 'title' => __('app.pdate'), 'width' => '12%'],
            __('app.due') => ['data' => 'deadline', 'name' => 'deadline', 'title' => __('app.due'), 'width' => '12%'],
            
            __('app.inspectiondt') => ['data' => 'inspectiondt', 'name' => 'inspectiondt', 'title' => __('app.inspectiondt'), 'width' => '12%'],
            __('app.rinspectiondt') => ['data' => 'rinspectiondt', 'name' => 'rinspectiondt', 'title' => __('app.rinspectiondt'), 'width' => '12%'],
            __('app.bsdate') => ['data' => 'bsdate', 'name' => 'bsdate', 'title' => __('app.bsdate'), 'width' => '12%'],
            __('app.brdate') => ['data' => 'brdate', 'name' => 'brdate', 'title' => __('app.brdate'), 'width' => '12%'],
            __('app.badate') => ['data' => 'badate', 'name' => 'badate', 'title' => __('app.badate'), 'width' => '12%'],
            __('app.wsdt') => ['data' => 'wsdt', 'name' => 'wsdt', 'title' => __('app.wsdt'), 'width' => '12%'],
            __('app.wrsdt') => ['data' => 'wrsdt', 'name' => 'wrsdt', 'title' => __('app.wrsdt'), 'width' => '12%'],
            __('app.wcd') => ['data' => 'wcd', 'name' => 'wcd', 'title' => __('app.wcd')],
            __('app.nte') => ['data' => 'nte', 'name' => 'nte', 'title' => __('app.nte')],
            __('app.bsa') => ['data' => 'bid_submitted_amount', 'name' => 'bid_submitted_amount', 'title' => __('app.bsa')],
            __('app.baa') => ['data' => 'bid_approved_amount', 'name' => 'bid_approved_amount', 'title' => __('app.baa')],
            __('Invoiced Date') => ['data' => 'invoiced_date', 'name' => 'invoiced_date', 'title' => __('Invoiced Date')],
            __('Invoiced Amount') => ['data' => 'total', 'name' => 'total', 'title' => __('Invoiced Amount')],
            __('Vendor Amount') => ['data' => 'vendor_amt', 'name' => 'vendor_amt', 'title' => __('Vendor Amount')],
            __('Cancelled Date') => ['data' => 'cancelled_date', 'name' => 'cancelled_date', 'title' => __('Cancelled Date')],
            __('Cancelled Reason') => ['data' => 'cancelled_reason', 'name' => 'cancelled_reason', 'title' => __('Cancelled Reason')],
            __('app.delayedby') => ['data' => 'delayed_by', 'name' => 'delayed_by', 'title' => __('app.delayedby')],
            __('Client Paid Date') => ['data' => 'cpaydate', 'name' => 'cpaydate', 'title' => __('Client Paid Date')],
            __('Client Paid Amount') => ['data' => 'cpayamt', 'name' => 'cpayamt', 'title' => __('Client Paid Amount')],
            __('Quick Note') => ['data' => 'quick_notes_disp', 'name' => 'quick_notes_disp', 'exportable' => false, 'title' => __('Quick Note')],
             __('Note') => ['data' => 'quick_notes', 'name' => 'quick_notes', 'visible' => false, 'title' => __('Note')],
            // Hide __('app.progress') => ['data' => 'completion_percent', 'name' => 'completion_percent', 'exportable' => false, 'title' => __('app.progress')],
            
        ];

        // $action = [
        //     Column::computed('action', __('app.action'))
        //         ->exportable(false)
        //         ->printable(false)
        //         ->orderable(false)
        //         ->searchable(false)
        //         ->addClass('text-right pr-20')
        // ];
        

        return array_merge($data, CustomFieldGroup::customFieldsDataMerge(new Project()));
    }

}
