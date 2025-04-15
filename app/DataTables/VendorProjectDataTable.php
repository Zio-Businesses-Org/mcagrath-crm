<?php

namespace App\DataTables;

use App\Helper\Common;
use App\Scopes\ActiveScope;
use Carbon\Carbon;
use App\Models\ProjectVendor;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\ProjectStatusSetting;
use App\Models\ProjectVendorCustomFilter;
use Exception;

class VendorProjectDataTable extends BaseDataTable
{


    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $sow_name=[];
        $datatables = datatables()->eloquent($query);
        $datatables->addIndexColumn();
        $datatables->addColumn('check', fn($row) => $this->checkBoxProject($row));
        
        $datatables->editColumn('id', fn($row) => $row->id);
        $datatables->editColumn('client_id', fn($row) => $row->client?->id ? view('components.client', ['user' => $row->client]) : '');
        $datatables->editColumn('client_name', fn($row) => $row->client?->id ? $row->client->name_salutation : '');
        $datatables->editColumn('vendor_id', fn($row) => $row?->vendors ? view('components.vendor', ['vendor' => $row->vendors]) : '');
        $datatables->editColumn('vendor_status', fn($row) => $row?->vendors ? $row->vendors->status : '');
        $datatables->editColumn('property_address', fn($row) => $row->project->propertyDetails?$row->project->propertyDetails->property_address:'N/A');
        $datatables->editColumn('project_status', fn($row) => $row->project->status);
        $datatables->editColumn('created_at', fn($row) => $row->created_at?Carbon::parse($row->created_at)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('updated_at', fn($row) => $row->updated_at?Carbon::parse($row->updated_at)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('inspection_date', fn($row) => $row->inspection_date?Carbon::parse($row->inspection_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('inspection_time', fn($row) => $row->inspection_time?Carbon::parse($row->inspection_time)->translatedFormat($this->company->time_format):'N/A');
        $datatables->editColumn('re_inspection_date', fn($row) => $row->re_inspection_date?Carbon::parse($row->re_inspection_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('re_inspection_time', fn($row) => $row->re_inspection_time?Carbon::parse($row->re_inspection_time)->translatedFormat($this->company->time_format):'N/A');
        $datatables->editColumn('bid_ecd', fn($row) => $row->bid_ecd?Carbon::parse($row->bid_ecd)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('bid_submitted_date', fn($row) => $row->bid_submitted_date?Carbon::parse($row->bid_submitted_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('bid_rejected_date', fn($row) => $row->bid_rejected_date?Carbon::parse($row->bid_rejected_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('bid_approval_date', fn($row) => $row->bid_approval_date?Carbon::parse($row->bid_approval_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('work_schedule_date', fn($row) => $row->work_schedule_date?Carbon::parse($row->work_schedule_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('work_schedule_time', fn($row) => $row->work_schedule_time?Carbon::parse($row->work_schedule_time)->translatedFormat($this->company->time_format):'N/A');
        $datatables->editColumn('work_schedule_re_date', fn($row) => $row->work_schedule_re_date?Carbon::parse($row->work_schedule_re_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('work_schedule_re_time', fn($row) => $row->work_schedule_re_time?Carbon::parse($row->work_schedule_re_time)->translatedFormat($this->company->time_format):'N/A');
        $datatables->editColumn('work_completion_date', fn($row) => $row->work_completion_date?Carbon::parse($row->work_completion_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('work_ecd', fn($row) => $row->work_ecd?Carbon::parse($row->work_ecd)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('due_date', fn($row) => $row->due_date?Carbon::parse($row->due_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('cancelled_date', fn($row) => $row->cancelled_date?Carbon::parse($row->cancelled_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('invoiced_date', fn($row) => $row->invoiced_date?Carbon::parse($row->invoiced_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('paid_date', fn($row) => $row->paid_date?Carbon::parse($row->paid_date)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('nte', fn($row) => $row->project->nte?$row->project->nte:'N/A');
        $datatables->editColumn('bid_submitted_amount', fn($row) => $row->project->bid_submitted_amount?$row->project->bid_submitted_amount:'N/A');
        $datatables->editColumn('p_bid_approved_amount', fn($row) => $row->project->bid_approved_amount?$row->project->bid_approved_amount:'N/A');
        $datatables->editColumn('project', function ($row) {
            if($row->project_id){
            return '<a href="' . route('projects.show', $row->project_id) . '" style="color:black;">' . $row->project->project_short_code . '</a>';
            }
            else{
                return null;
            }
        });
        $datatables->addColumn('members', function ($row) {
            if ($row->public) {
                return '--';
            }

            $members = '<div class="position-relative">';
            if (count($row->project?->members) > 0) {
                foreach ($row->project?->members as $key => $member) {
                    if ($key < 4) {
                        $img = '<img data-toggle="tooltip" height="25" width="25" data-original-title="' . $member->user->name . '" src="' . $member->user->image_url . '">';

                        $position = $key > 0 ? 'position-absolute' : '';
                        $members .= '<div class="taskEmployeeImg rounded-circle ' . $position . '" style="left:  ' . ($key * 13) . 'px"><a href="' . route('employees.show', $member->user->id) . '">' . $img . '</a></div> ';
                    }

                }
            }
            if (count($row->project?->est_users) > 0) {
                foreach ($row->project?->est_users as $key => $member) {
                    if ($key < 4) {
                        $img = '<img data-toggle="tooltip" height="25" width="25" data-original-title="' . $member->name . '" src="' . $member->image_url . '">';

                        $position = $key > 0 ? 'position-absolute' : '';
                        $members .= '<div class="taskEmployeeImg rounded-circle ' . $position . '" style="left:  ' . ($key * 13) . 'px"><a href="' . route('employees.show', $member->id) . '">' . $img . '</a></div> ';
                    }

                }
            }
            if (count($row->project?->acct_users) > 0) {
                foreach ($row->project?->acct_users as $key => $member) {
                    if ($key < 4) {
                        $img = '<img data-toggle="tooltip" height="25" width="25" data-original-title="' . $member->name . '" src="' . $member->image_url . '">';

                        $position = $key > 0 ? 'position-absolute' : '';
                        $members .= '<div class="taskEmployeeImg rounded-circle ' . $position . '" style="left:  ' . ($key * 13) . 'px"><a href="' . route('employees.show', $member->id) . '">' . $img . '</a></div> ';
                    }

                }
            }
            if (count($row->project?->emanager_users) > 0) {
                foreach ($row->project?->emanager_users as $key => $member) {
                    if ($key < 4) {
                        $img = '<img data-toggle="tooltip" height="25" width="25" data-original-title="' . $member->name . '" src="' . $member->image_url . '">';

                        $position = $key > 0 ? 'position-absolute' : '';
                        $members .= '<div class="taskEmployeeImg rounded-circle ' . $position . '" style="left:  ' . ($key * 13) . 'px"><a href="' . route('employees.show', $member->id) . '">' . $img . '</a></div> ';
                    }

                }
            }
            if (count($row->project?->members) > 4) {
                $members .= '<div class="taskEmployeeImg more-user-count text-center rounded-circle bg-amt-grey position-absolute" style="left:  52px"><a href="' . route('projects.show', $row->id) . '?tab=members" class="text-dark f-10">+' . (count($row->members) - 4) . '</a></div> ';
            }

            $members .= '</div>';

            return $members;
        }
        );

        // $datatables->editColumn('sow_name', function ($row) {
        //     if($row->sow_id){
        //         foreach($row->sow_id as $sow){
        //             $sowname[]= $row->sowname($sow);
        //         }
        //     }
        //     return $sowname;
        // });
        $datatables->addColumn('name', function ($row) {
            $members = [];

            if (count($row->project?->members) > 0) {

                foreach ($row->project?->members as $member) {
                    $members[] = $member->user->name;
                }

                return implode(',', $members);
            }
        });
        $status=ProjectStatusSetting::where('default_status', true)->value('status_name');
        $datatables->editColumn('wo_status', function ($row) use ($status) {
            if($row->wo_status==null){
               return $status;
            }
            else{
                return $row->wo_status;
            }
        });
        
        $datatables->addIndexColumn();
        $datatables->smart(false);
        $datatables->setRowId(fn($row) => 'row-' . $row->id);
       
        $datatables->rawColumns(array_merge(['project','members','check']));
        return $datatables;
    }

    /**
     * @param User $model
     * @return User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query(ProjectVendor $model)
    {
        $request = $this->request();
        $users = ProjectVendor::with(['client', 'project','vendors','project.members'])
        ->leftJoin('projects', 'projects.id', '=', 'project_vendors.project_id')
        ->leftJoin('property_details', 'property_details.id', '=', 'projects.property_details_id') 
        ->leftJoin('project_members', 'project_members.project_id', '=', 'projects.id')// Join projects table
        ->leftJoin('project_estimators', 'project_estimators.project_id', 'projects.id')
        ->leftJoin('project_accountings', 'project_accountings.project_id', 'projects.id')
        ->leftJoin('project_emanagers', 'project_emanagers.project_id', 'projects.id')
        ->leftJoin('project_category', 'projects.category_id', 'project_category.id')
        ->select('project_vendors.*', 'projects.project_short_code','property_details.property_address','project_members.user_id','projects.status','projects.client_id','projects.category_id','project_category.category_name')
        ->groupBy('project_vendors.id');
        $users = $users->orderBy('id', 'desc');
        $users = self::customFilter($users);

        if ($request->searchText != '') {
            $users = $users->where(function ($query) {
                $query->where('projects.project_short_code', 'like', '%' . request('searchText') . '%')
                ->orWhere('vendor_name', 'like', '%' . request('searchText') . '%')
                ->orWhere('vendor_email_address', 'like', '%' . request('searchText') . '%')
                ->orWhere('property_details.property_address', 'like', '%' . request('searchText') . '%')
                ->orWhere('vendor_phone', 'like', '%' . request('searchText') . '%');
            });
        }

        return $users;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $dataTable = $this->setBuilder('vendors-projects-table', 2)
            ->parameters([
                'initComplete' => 'function () {
                   window.LaravelDataTables["vendors-projects-table"].buttons().container()
                    .appendTo("#table-actions")
                }',
                'fnDrawCallback' => 'function( oSettings ) {
                  //
                }',
            ]);

        if (canDataTableExport()) {
            $dataTable->buttons(Button::make(['extend' => 'excel', 'text' => '<i class="fa fa-file-export"></i> ' . trans('app.exportExcel')]));
        }

        return $dataTable;
    }

    public function customFilter($users)
    {
        try{
            $customfilter = ProjectVendorCustomFilter::where('user_id', user()->id)->where('status', 'active')->first();

            if($customfilter->start_date!=''&& $customfilter->end_date!='')
            {
                $users->whereBetween(DB::raw('DATE(project_vendors.`created_at`)'), [$customfilter->start_date, $customfilter->end_date]);
            }
            if($customfilter->project_status!='')
            {
                $users->whereIn('projects.status', $customfilter->project_status)->get();
            }
            if($customfilter->client_id!='')
            {
                $users->whereIn('projects.client_id', $customfilter->client_id)->get();
            }
            if($customfilter->work_order_status!='')
            {
                $users->whereIn('project_vendors.wo_status', $customfilter->work_order_status)->get();
            }
            if($customfilter->project_category!='')
            {
                $users->whereIn('projects.category_id', $customfilter->project_category)->get();
            }
            if($customfilter->vendor_id!='')
            {
                $users->whereIn('project_vendors.vendor_id', $customfilter->vendor_id)->get();
            }
            if($customfilter->link_status!='')
            {
                $users->whereIn('project_vendors.link_status', $customfilter->link_status)->get();
            }
            if($customfilter->project_members!='')
            {
                $users->whereIn('project_members.user_id', $customfilter->project_members)
                ->orWhereIn('project_estimators.user_id', $customfilter->project_members)
                ->orWhereIn('project_accountings.user_id', $customfilter->project_members)
                ->orWhereIn('project_emanagers.user_id', $customfilter->project_members)
                ->get();
                
            }
        }
        catch (Exception){}
        return $users;
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
            '#' => ['data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'visible' => !showId(), 'title' => '#'],
            __('app.id') => ['data' => 'id', 'name' => 'id', 'title' => __('app.id'), 'visible' => showId()],
            __('modules.projects.members') => ['data' => 'members', 'name' => 'members', 'exportable' => false, 'width' => '15%', 'title' => __('modules.projects.members')],
            __('Internal Team') => ['data' => 'name', 'name' => 'name', 'visible'=>false, 'title' => __('Internal Team')],
            __('Work Order #') => ['data' => 'project', 'name' => 'project_id', 'title' => __('Work Order #')],
            __('Vendor') => ['data' => 'vendor_id', 'name' => 'vendor_id', 'width' => '15%', 'exportable' => false, 'title' => __('Vendor')],
            __('Vendor Status') => ['data' => 'vendor_status', 'name' => 'vendor_status', 'width' => '15%', 'title' => __('Vendor status')],
            __('Vendors') => ['data' => 'vendor_name', 'name' => 'vendor_name', 'width' => '15%', 'visible' => false, 'title' => __('Vendors')],
            __('Vendor Ph #') => ['data' => 'vendor_phone', 'name' => 'vendor_phone', 'width' => '15%', 'visible' => false, 'title' => __('Vendor Ph #')],
            __('Vendor Email') => ['data' => 'vendor_email_address', 'name' => 'vendor_email_address', 'width' => '15%', 'visible' => false, 'title' => __('Vendor Email')],
            __('Link Status') => ['data' => 'link_status', 'name' => 'link_status', 'title' => __('Link Status')], 
            __('Wo Status') => ['data' => 'wo_status', 'name' => 'wo_status', 'title' => __('Wo Status')],
            __('Project Status') => ['data' => 'project_status', 'name' => 'project_status', 'title' => __('Project Status')],
            __('Property Address') => ['data' => 'property_address', 'name' => 'property_address', 'title' => __('Property Address')],
            __('app.client') => ['data' => 'client_id', 'name' => 'client_id', 'width' => '15%', 'exportable' => false, 'title' => __('app.client')], 
            __('Clients') => ['data' => 'client_name', 'name' => 'client_name', 'width' => '15%', 'visible' => false, 'title' => __('Clients')],   
            __('Project Category') => ['data' => 'category_name', 'name' => 'category_name', 'title' => __('Project Category')],
            __('Link Sent Date') => ['data' => 'created_at', 'name' => 'created_at', 'title' => __('Link Sent Date')],
            __('Due Date') => ['data' => 'due_date', 'name' => 'due_date', 'title' => __('Due Date')],
            __('Inspection Date') => ['data' => 'inspection_date', 'name' => 'inspection_date', 'title' => __('Inspection Date')],
            __('Inspection Time') => ['data' => 'inspection_time', 'name' => 'inspection_time', 'title' => __('Inspection Time')],
            __('Re Inspection Date') => ['data' => 're_inspection_date', 'name' => 're_inspection_date', 'title' => __('Re Inspection Date')],
            __('Re Inspection Time') => ['data' => 're_inspection_time', 'name' => 're_inspection_time', 'title' => __('Re Inspection Time')],
            __('Bid ECD') => ['data' => 'bid_ecd', 'name' => 'bid_ecd', 'title' => __('Bid ECD')],
            __('Bid Submitted Date') => ['data' => 'bid_submitted_date', 'name' => 'bid_submitted_date', 'title' => __('Bid Submitted Date')],
            __('Bid Rejected Date') => ['data' => 'bid_rejected_date', 'name' => 'bid_rejected_date', 'title' => __('Bid Rejected Date')],
            __('Bid Approval Date') => ['data' => 'bid_approval_date', 'name' => 'bid_approval_date', 'title' => __('Bid Approval Date')],
            __('Work Schedule Date') => ['data' => 'work_schedule_date', 'name' => 'work_schedule_date', 'title' => __('Work Schedule Date')],
            __('Work Schedule Time') => ['data' => 'work_schedule_time', 'name' => 'work_schedule_time', 'title' => __('Work Schedule Time')],
            __('Work Schedule Re Date') => ['data' => 'work_schedule_re_date', 'name' => 'work_schedule_re_date', 'title' => __('Work Schedule Re Date')],
            __('Work Schedule Re Time') => ['data' => 'work_schedule_re_time', 'name' => 'work_schedule_re_time', 'title' => __('Work Schedule Re Time')],
            __('Work Completion Date') => ['data' => 'work_completion_date', 'name' => 'work_completion_date', 'title' => __('Work Completion Date')],
            __('Work ECD') => ['data' => 'work_ecd', 'name' => 'work_ecd', 'title' => __('Work ECD')],
            __('Project Amount') => ['data' => 'project_amount', 'name' => 'project_amount', 'title' => __('Project Amount')],
            __('Vendor Bid Approved Amount') => ['data' => 'bid_approved_amount', 'name' => 'bid_approved_amount', 'title' => __('Vendor Bid Approved Amount')],
            __('Not To Exceed') => ['data' => 'nte', 'name' => 'nte', 'title' => __('Not To Exceed')],
            __('Project Bid Submitted Amount') => ['data' => 'bid_submitted_amount', 'name' => 'bid_submitted_amount', 'title' => __('Project Bid Submitted Amount')],
            __('Project Bid Approved Amount') => ['data' => 'p_bid_approved_amount', 'name' => 'p_bid_approved_amount', 'title' => __('Project Bid Approved Amount')],
            __('Vendor Cancelled Date') => ['data' => 'cancelled_date', 'name' => 'cancelled_date', 'title' => __('Vendor Cancelled Date')],
            __('Vendor Cancelled Reason') => ['data' => 'cancelled_reason', 'name' => 'cancelled_reason', 'title' => __('Vendor Cancelled Reason')],
            __('Vendor Invoiced Date') => ['data' => 'invoiced_date', 'name' => 'invoiced_date', 'title' => __('Vendor Invoiced Date')],
            __('Vendor Invoiced Amount') => ['data' => 'invoiced_amount', 'name' => 'invoiced_amount', 'title' => __('Vendor Invoiced Amount')],
            __('Vendor Paid Date') => ['data' => 'paid_date', 'name' => 'paid_date', 'title' => __('Vendor Paid Date')],
            __('Vendor Paid Amount') => ['data' => 'paid_amount', 'name' => 'paid_amount', 'title' => __('Vendor Paid Amount')],
        ];

        

        return array_merge($data);
    }

}
