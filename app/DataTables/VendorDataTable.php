<?php

namespace App\DataTables;

use App\Helper\Common;
use App\Scopes\ActiveScope;
use Carbon\Carbon;
use App\Models\VendorContract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Exception;
use App\Models\VendorCustomFilter;

class VendorDataTable extends BaseDataTable
{


    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        $datatables = datatables()->eloquent($query);
        $datatables->addIndexColumn();
        $datatables->addColumn('check', fn($row) => $this->checkBox($row));
        $datatables->addColumn('action', function ($row) {

            $action = '<div class="task_view">

                    <div class="dropdown">
                        <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle" type="link"
                            id="dropdownMenuLink-' . $row->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-options-vertical icons"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink-' . $row->id . '" tabindex="0">';

            $action .= '<a href="' . route('vendors.show', [$row->id]) . '" class="dropdown-item"><i class="fa fa-eye mr-2"></i>' . __('app.view') . '</a>';

            // if (in_array('admin', user_roles()) && !$row->admin_approval) {
            //     $action .= '<a href="javascript:;" class="dropdown-item verify-user" data-user-id="' . $row->id . '"><i class="fa fa-check mr-2"></i>' . __('app.approve') . '</a>';
            // }

          //  if ($this->editClientPermission == 'all' || ($this->editClientPermission == 'added' && user()->id == $row->added_by) || ($this->editClientPermission == 'both' && user()->id == $row->added_by)) {
                $action .= '<a class="dropdown-item openRightModal" href="' . route('vendors.edit', [$row->id]) . '">
                                <i class="fa fa-edit mr-2"></i>
                                ' . trans('app.edit') . '
                            </a>';
           // }

            // if ($this->deleteClientPermission == 'all' || ($this->deleteClientPermission == 'added' && user()->id == $row->added_by) || ($this->deleteClientPermission == 'both' && user()->id == $row->added_by)) {
                $action .= '<a class="dropdown-item delete-table-row" href="javascript:;" data-user-id="' . $row->id . '">
                                <i class="fa fa-trash mr-2"></i>
                                ' . trans('app.delete') . '
                            </a>';
            // }

            //   if (!$row->company_sign) {
            //     $action .= '<a class="dropdown-item companysign" href="javascript:;" data-user-row="' . $row->id . '" data-toggle="modal" data-target="#signature-modal">
            //                     <i class="fa fa-edit mr-2"></i>
            //                     ' . trans('app.companysign') . '
            //                 </a>';
            //  }
                $action .= '<a class="dropdown-item" href="' . route('vendors.download', $row->id) . '">
                                <i class="fa fa-download mr-2"></i>
                                ' . trans('app.download') . '
                            </a>';
                if($row->waiver_signed_date){
                $action .= '<a class="dropdown-item" href="' . route('vendorswaiverform.download', $row->id) . '">
                                <i class="fa fa-download mr-2"></i>
                                ' . trans('Download Vendor Waiver Form') . '
                            </a>';
                }
            $action .= '</div>
                    </div>
                </div>';

            return $action;
        });
        // $datatables->addColumn('client_name', fn($row) => $row->vendor_name);
        // $datatables->addColumn('added_by', fn($row) => optional($row->clientDetails)->addedBy ? $row->clientDetails->addedBy->name : '--');
        $datatables->editColumn('name', function ($row) {
            $signed = '';
            $companysign='';
            if ($row->contract_sign) {
                $signed = '<span class="badge badge-secondary"><i class="fa fa-signature"></i> ' . __('app.signed') . '</span>';
            }
            if($this->company->company_sign)
            {
                $companysign = '<span class="badge badge-secondary"><i class="fa fa-signature"></i> ' . __('Company Signed') . '</span>';
            }

            return '<div class="media align-items-center">
                    <div class="media-body">
                <h5 class="mb-0 f-13 text-darkest-grey"><a href="' . route('vendors.show', [$row->id]) . '">' . $row->vendor_name . '</a></h5>
                <p class="mb-0">' . $signed . '</p>
                <p class="mb-0">' . $companysign . '</p>
                </div>
              </div>';
        });
        $datatables->editColumn('id', fn($row) => $row->id);
        $datatables->editColumn('created_at', fn($row) => Carbon::parse($row->created_at)->translatedFormat($this->company->date_format));
        $datatables->editColumn('email', fn($row) => $row->vendor_email);
        $datatables->editColumn('company_name', fn($row) => $row->company_name);
        $datatables->editColumn('created_by', fn($row) => $row->created_by);
        
        $datatables->editColumn('v_status', function ($row)
        {
            return '
            <div class="media align-items-center" style="width: 150px;">
                <select class="form-control select-picker change-vendor-status" data-size="5" data-row-id="' . $row->id . '" ' . ((!in_array("admin", user_roles()) && $row->status == "DNU") ? 'disabled' : '') . '>
                    <option value="">--</option>
                    <option value="Active" ' . ($row->status === "Active" ? "selected" : "") . ' data-content="<i class=\'fa fa-circle mr-2\' style=\'color:#00b5ff;\'></i>Active">
                    <option value="InActive" ' . ($row->status === "InActive" ? "selected" : "") . ' data-content="<i class=\'fa fa-circle mr-2\' style=\'color:#800080;\'></i>InActive">
                    <option value="Compliant" ' . ($row->status === "Compliant" ? "selected" : "") . ' data-content="<i class=\'fa fa-circle mr-2\' style=\'color:#679c0d;\'></i>Compliant">
                    <option value="Snooze" ' . ($row->status === "Snooze" ? "selected" : "") . ' data-content="<i class=\'fa fa-circle mr-2\' style=\'color:#FFA500;\'></i>Snooze">
                    <option value="Non Compliant" ' . ($row->status === "Non Compliant" ? "selected" : "") . ' data-content="<i class=\'fa fa-circle mr-2\' style=\'color:#FFFF00;\'></i>Non Compliant">
                    <option value="DNU" ' . ($row->status === "DNU" ? "selected" : "") . ' data-content="<i class=\'fa fa-circle mr-2\' style=\'color:#FF0000;\'></i>DNU">
                    <option value="On Hold" ' . ($row->status === "On Hold" ? "selected" : "") . ' data-content="<i class=\'fa fa-circle mr-2\' style=\'color:#808080;\'></i>On Hold">
                </select>
            </div>';
        
        });
        $datatables->addIndexColumn();
        $datatables->smart(false);
        $datatables->setRowId(fn($row) => 'row-' . $row->id);
        // Add Custom Field to datatable

        $datatables->rawColumns(array_merge(['name', 'action', 'v_status', 'check']));

        return $datatables;
    }

    /**
     * @param User $model
     * @return User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query(VendorContract $model)
    {
        $request = $this->request();
        $users = VendorContract::query();
        if ($request->searchText != '') {
            $users = $users->where(function ($query) {
                $query->where('vendor_name', 'like', '%' . request('searchText') . '%')
                    ->orWhere('vendor_email', 'like', '%' . request('searchText') . '%')
                    ->orWhere('cell', 'like', '%' . request('searchText') . '%')
                    ->orWhere('company_name', 'like', '%' . request('searchText') . '%')
                    ->orWhere('contractor_type', 'like', '%' . request('searchText') . '%')
                    ->orWhere('status', 'like', '%' . request('searchText') . '%')
                    ->orWhere('created_by', 'like', '%' . request('searchText') . '%');
            });
        }
        
        if ($request->searchText == ''){
         $users = self::customFilter($users);
        }

        if ($request->status != '') {
            $users = $users->where('status', $request->status);
        }

        return $users;
    }

    public function customFilter($users)
    {
        try{
            $customfilter = VendorCustomFilter::where('user_id', user()->id)->where('status', 'active')->first();

            if($customfilter->start_date!=''&& $customfilter->end_date!='')
            {
                $users->whereBetween(DB::raw('DATE(vendor_contracts.`created_at`)'), [$customfilter->start_date, $customfilter->end_date]);
            }
            if($customfilter->state!='')
            {
                $users->whereIn('vendor_contracts.state', $customfilter->state)->get();
            }
            if($customfilter->city!='')
            {
                $users->whereIn('vendor_contracts.city', $customfilter->city)->get();
            }
            if($customfilter->county!='')
            {
                $users->whereIn('vendor_contracts.county', $customfilter->county)->get();
            }
            if($customfilter->contractor_type!='')
            {
                $users->whereIn('vendor_contracts.contractor_type', $customfilter->contractor_type)->get();
            }
            if($customfilter->created_by!='')
            {
                $users->whereIn('vendor_contracts.created_by', $customfilter->created_by)->get();
            }
            if($customfilter->vendor_status!='')
            {
                $users->whereIn('vendor_contracts.status', $customfilter->vendor_status)->get();
            }
        }
        catch (Exception){}
        return $users;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $dataTable = $this->setBuilder('vendors-table', 3)
            ->parameters([
                'initComplete' => 'function () {
                   window.LaravelDataTables["vendors-table"].buttons().container()
                    .appendTo("#table-actions")
                }',
                'fnDrawCallback' => 'function( oSettings ) {
                  $("#vendors-table .select-picker").selectpicker();
                }',
            ]);

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
                'title' => '<input type="checkbox" name="select_alField as $customField) {
                    $data[] = [$customField->name => l_table" id="select-all-table" onclick="selectAllTable(this)">',
                'exportable' => false,
                'orderable' => false,
                'searchable' => false
            ],
            'action' => [
                'title' => __('app.action'),
                'data' => 'action', // Specify the data source for actions
                'exportable' => false,
                'orderable' => false,
                'searchable' => false,
                'class' => 'text-right pr-20'
            ],
            '#' => ['data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'visible' => !showId(), 'title' => '#'],
            __('app.id') => ['data' => 'id', 'name' => 'id', 'title' => __('app.id'), 'visible' => showId()],
            __('app.name') => ['data' => 'name', 'name' => 'vendor_name', 'exportable' => false, 'title' => __('app.name')],
            __('app.company_name') => ['data' => 'company_name', 'name' => 'company_name', 'title' => __('app.company_name')],
            __('app.email') => ['data' => 'email', 'name' => 'vendor_email', 'title' => __('app.email')],
            __('Office (Call) #') => ['data' => 'office', 'name' => 'office', 'title' => __('Office (Call) #')],
            __('Mobile (Text) #') => ['data' => 'cell', 'name' => 'cell', 'title' => __('Mobile (Text) #')],
            __('app.county') => ['data' => 'county', 'name' => 'county', 'title' => __('app.county')],
            __('app.state') => ['data' => 'state', 'name' => 'state', 'title' => __('app.state')],
            __('app.city') => ['data' => 'city', 'name' => 'city', 'title' => __('app.city')],
            __('app.contractor_type') => ['data' => 'contractor_type', 'name' => 'contractor_type', 'title' => __('app.contractor_type')],
            __('app.createdby') => ['data' => 'created_by', 'name' => 'created_by', 'title' => __('app.createdby')],
            __('app.createdAt') => ['data' => 'created_at', 'name' => 'created_at', 'title' => __('app.createdAt')],
            __('app.status') => ['data' => 'v_status', 'name' => 'v_status', 'exportable' => false, 'title' => __('app.status')],
            __('Vendor Status') => ['data' => 'status', 'name' => 'status', 'visible' => false, 'title' => __('Vendor Status')],
        ];

        // $action = [
        //     Column::computed('action', __('app.action'))
        //         ->exportable(false)
        //         ->printable(false)
        //         ->orderable(false)
        //         ->searchable(false)
        //         ->addClass('text-right pr-20')
        // ];

        return array_merge($data);
    }

}
