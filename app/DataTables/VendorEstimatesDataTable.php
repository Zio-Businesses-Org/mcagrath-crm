<?php

namespace App\DataTables;

use App\Helper\Common;
use App\Scopes\ActiveScope;
use Carbon\Carbon;
use App\Models\vendor_estimates;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\ProjectStatusSetting;

class VendorEstimatesDataTable extends BaseDataTable
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
        $datatables->addColumn('action', function ($row) {

            $action = '<div class="task_view">

                    <div class="dropdown">
                        <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle" type="link"
                            id="dropdownMenuLink-' . $row->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-options-vertical icons"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink-' . $row->id . '" tabindex="0">';

                $action .= '<a href="' . route('vendor-estimates.show', [$row->id]) . '" class="dropdown-item"><i class="fa fa-eye mr-2"></i>' . __('app.view') . '</a>';

                $action .= '<a class="dropdown-item ';

                $action .= request()->projectID ? 'openRightModal' : '';

                $action .= '" href="' . route('vendor-estimates.edit', [$row->id]) . '?projectID=' . request()->projectID . ' ">
                                <i class="fa fa-edit mr-2"></i>
                                ' . trans('app.edit') . '
                            </a>';

                $action .= '<a class="dropdown-item delete-table-row" href="javascript:;" data-estimate-id="' . $row->id . '">
                                <i class="fa fa-trash mr-2"></i>
                                ' . trans('app.delete') . '
                            </a>';

                $action .= '<a class="dropdown-item" href="' . route('vendor-estimates.download', $row->id) . '">
                            <i class="fa fa-download mr-2"></i>
                            ' . trans('app.download') . '
                        </a>';

            $action .= '</div>
                    </div>
                </div>';

            return $action;
        });
      
        $datatables->editColumn('valid_till', fn($row) => $row->valid_till?Carbon::parse($row->valid_till)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('created_at', fn($row) => $row->created_at?Carbon::parse($row->created_at)->translatedFormat($this->company->date_format):'N/A');
        $datatables->editColumn('id', fn($row) => $row->id);
        $datatables->editColumn('vendor_id', fn($row) => $row?->vendors ? view('components.vendor', ['vendor' => $row->vendors]) : '');
        $datatables->editColumn('project', function ($row) {
            if($row->project_id){
            return '<a href="' . route('projects.show', $row->project_id) . '" style="color:black;">' . $row->project->project_short_code . '</a>';
            }
            else{
                return null;
            }
        });
        $datatables->editColumn('total', function ($row) {
            return currency_format($row->total, $row->currencyId);
        });

        $datatables->editColumn('cbid', function ($row)
        {
            return '
            <div class="media align-items-center" style="width: 150px;">
                <select class="form-control select-picker change-cbid" data-size="2" data-row-id="' . $row->id . '" >
                    <option value="yes" ' . ($row->cbid === 1 ? "selected" : "") . ' data-content="YES">
                    <option value="no" ' . ($row->cbid === 0 ? "selected" : "") . ' data-content="NO">
                </select>
            </div>';
        
        });
        $datatables->addColumn('estimate_number', function ($row) {
            return '<a href="' . route('vendor-estimates.show', $row->id) . '" class="text-darkest-grey">' . $row->estimate_number . '</a>';
        });
        $datatables->editColumn(
            'created_by',
            function ($row) {
                return $row->added->name_salutation??'';
            }
        );
        
        $datatables->addIndexColumn();
        $datatables->smart(false);
        $datatables->setRowId(fn($row) => 'row-' . $row->id);
       
        $datatables->rawColumns(array_merge(['project','action','cbid','estimate_number']));
        return $datatables;
    }

    /**
     * @param User $model
     * @return User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query(vendor_estimates $model)
    {
        $request = $this->request();
        $users = vendor_estimates::query()
        ->leftJoin('projects', 'projects.id', '=', 'vendor_estimates.project_id')
        ->leftJoin('vendor_contracts', 'vendor_contracts.id', '=', 'vendor_estimates.vendor_id')
        ->with(['project','vendors','added'])
        ->select('vendor_estimates.*', 'projects.project_short_code','vendor_contracts.vendor_name','vendor_contracts.vendor_email','vendor_contracts.cell');

        if ($request->searchText != '') {
            $users = $users->where(function ($query) {
                $query->where('projects.project_short_code', 'like', '%' . request('searchText') . '%')
                ->orWhere('vendor_contracts.vendor_name', 'like', '%' . request('searchText') . '%')
                ->orWhere('vendor_contracts.vendor_email', 'like', '%' . request('searchText') . '%')
                ->orWhere('vendor_contracts.cell', 'like', '%' . request('searchText') . '%')
                ->orWhere('estimate_number', 'like', '%' . request('searchText') . '%');
            });
        }
        if ($request->projectID != 'all' && !is_null($request->projectID)) {
            $users = $users->where('vendor_estimates.project_id', '=', $request->projectID);
        }
        if ($request->vendor_id != 'all' && !is_null($request->vendor_id)) {
            $users = $users->where('vendor_estimates.vendor_id', '=', $request->vendor_id);
        }

        // if (!is_null($request->employee_id) && $request->employee_id != 'all') {
        //     $users->where(
        //         function ($query) {
        //             return $query->where('project_members.user_id', request()->employee_id);
        //         }
        //     );
        // }

        // if (!is_null($request->client_id) && $request->client_id != 'all') {
        //     $users->where('projects.client_id', $request->client_id);
        // }

        // if (!is_null($request->vendor_id) && $request->vendor_id != '--') {
        //     $users->where('vendor_id', $request->vendor_id);
        // }

        // if (!is_null($request->link_id) && $request->link_id != '--') {
        //     $users->where('link_status', $request->link_id);
        // }

        // if (!is_null($request->wo_status) && $request->wo_status != '--') {
        //     $users->where('wo_status', $request->wo_status);
        // }

        return $users;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $dataTable = $this->setBuilder('vendor-estimates-table', 2)
            ->parameters([
                'initComplete' => 'function () {
                   window.LaravelDataTables["vendor-estimates-table"].buttons().container()
                    .appendTo("#table-actions")
                }',
                'fnDrawCallback' => 'function( oSettings ) {
                  $("#vendor-estimates-table .select-picker").selectpicker();
                }',
            ]);

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
            
            '#' => ['data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'visible' => !showId(), 'title' => '#'],
            __('app.id') => ['data' => 'id', 'name' => 'id', 'title' => __('app.id'), 'visible' => false],
            __('Estimate') => ['data' => 'estimate_number', 'name' => 'estimate_number', 'title' => __('Estimate')],
            __('Vendor') => ['data' => 'vendor_id', 'name' => 'vendor_id', 'width' => '15%', 'exportable' => false, 'title' => __('Vendor')],
            __('Project') => ['data' => 'project', 'name' => 'project_id', 'title' => __('Project')],
            __('Total') => ['data' => 'total', 'name' => 'total', 'title' => __('Total')],
            __('Valid Till') => ['data' => 'valid_till', 'name' => 'valid_till', 'title' => __('Valid Till')],
            __('Created') => ['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created')],
            __('Created By') => ['data' => 'created_by', 'name' => 'created_by', 'title' => __('Created By')],
            __('Considered For Bid') => ['data' => 'cbid', 'name' => 'cbid', 'title' => __('Considered For Bid')],
            __('External') => ['data' => 'external', 'name' => 'external', 'title' => __('External')],
        ];
        $action = [
            Column::computed('action', __('app.action'))
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->addClass('text-right pr-20')
        ];

        return array_merge($data, $action);
    }

}
