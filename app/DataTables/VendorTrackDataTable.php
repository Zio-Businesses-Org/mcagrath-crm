<?php

namespace App\DataTables;

use App\Helper\Common;
use App\Scopes\ActiveScope;
use Carbon\Carbon;
use App\Models\Vendor;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\LeadVendorCustomFilter;
use Exception;

class VendorTrackDataTable extends BaseDataTable
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
         $datatables->addColumn('check', fn($row) => $this->checkBoxProject($row));
        $datatables->addColumn('action', function ($row) {

            $action = '<div class="task_view">

                    <div class="dropdown">
                        <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle" type="link"
                            id="dropdownMenuLink-' . $row->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-options-vertical icons"></i>
                        </a>            
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink-' . $row->id . '" tabindex="0">';
                   
                        $action .= '<a class="dropdown-item send-proposal" href="javascript:;" data-user-send="' . $row->id . '">
                        <i class="fa fa-paper-plane mr-2"></i>
                        ' . trans('app.send_proposal') . '
                        </a>';

                        $action .= '<a class="dropdown-item view-notes openRightModal" href="' . route('vendortrack.notes', [$row->id]) . '">
                        <i class="fa fa-file mr-2"></i>
                        ' . trans('View Notes') . '
                        </a>';
                    
            // if (in_array('admin', user_roles()) && !$row->admin_approval) {
            //     $action .= '<a href="javascript:;" class="dropdown-item verify-user" data-user-id="' . $row->id . '"><i class="fa fa-check mr-2"></i>' . __('app.approve') . '</a>';
            // }

          //  if ($this->editClientPermission == 'all' || ($this->editClientPermission == 'added' && user()->id == $row->added_by) || ($this->editClientPermission == 'both' && user()->id == $row->added_by)) {
                $action .= '<a class="dropdown-item openRightModal" href="' . route('vendortrack.edit', [$row->id]) . '">
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

            $action .= '</div>
                    </div>
                </div>';

            return $action;
        });
      
        $datatables->editColumn('id', fn($row) => $row->id);

        $datatables->editColumn('vendor_name', fn($row) => $row->vendor_name);
        $datatables->editColumn('vendor_email', fn($row) => $row->vendor_email);
        $datatables->editColumn('vendor_number', fn($row) => $row->vendor_number);
        $datatables->editColumn('created_at', fn($row) => Carbon::parse($row->created_at)->translatedFormat($this->company->date_format));
        $datatables->editColumn('nxt_date', fn($row) => $row->nxt_date?Carbon::parse($row->nxt_date)->translatedFormat($this->company->date_format):'');
        $datatables->editColumn('updated_at', fn($row) => Carbon::parse($row->updated_at)->translatedFormat($this->company->date_format));
        $datatables->editColumn('created_by', function($row){ 
            return '<div class="media align-items-center" style="width: 150px;">
                            <div class="media-body">
                            <td> '. $row->created_by . '</td>
                        </div>
                    </div>';
            
        });
        $datatables->editColumn('v_status', function($row){
            if($row->v_status=='Declined by Vendor'&&$row->reason){

                return '<div class="media align-items-center" style="width: 125px;">
                        <div class="media-body">
                        <td> ' .   $row->v_status . '</a> </td>
                        <td> ' .   $row->reason . '</a> </td>
                    </div>
                </div>';
            }
            else{

                return '<div class="media align-items-center" style="width: 125px;">
                        <div class="media-body">
                        <td> '.   $row->v_status . ' </td>
                    </div>
                </div>';
            }
        });
        $datatables->editColumn('edited_by', function($row){ 
            return '<div class="media align-items-center" style="width: 150px;">
                            <div class="media-body">
                            <td> '. $row->edited_by . '</td>
                        </div>
                    </div>';
            
        });
        $datatables->editColumn('latest_note', function($row){
                if($row->latestNote && $row->latestNote->notes_content){
                return '<div class="media align-items-center">
                        <div class="media-body">
                        <td> <a href data-toggle="tooltip" style="color:#1d82f5;" data-placement="bottom" title="' . $row->latestNote->notes_content .'">'. Carbon::parse($row->latestNote->created_at)->translatedFormat($this->company->date_format) . '</a> 
                    </div>
                </div>';
                }
                else {
                    // If there is no latestNote, return a default message or empty string.
                    return '<div class="media align-items-center">
                                <div class="media-body">
                                    N/A
                                </div>
                            </div>';
                }
            
                
        });
        $datatables->editColumn('website', function($row){
                if($row->website){
                return '<div class="media align-items-center">
                        <div class="media-body">
                        <td> <a href="' . $row->website .'" data-toggle="tooltip" style="color:#1d82f5;" data-placement="bottom" title="' . $row->website .'">Link</a> 
                    </div>
                </div>';
                }
                else {
                    // If there is no latestNote, return a default message or empty string.
                    return '<div class="media align-items-center">
                                <div class="media-body">
                                    --
                                </div>
                            </div>';
                }
            
                
        });
        
        $datatables->addIndexColumn();
        $datatables->smart(false);
        $datatables->setRowId(fn($row) => 'row-' . $row->id);
        // Add Custom Field to datatable

        $datatables->rawColumns(array_merge(['name', 'action', 'v_status', 'check','latest_note','created_by','edited_by','website']));

        return $datatables;
    }

    /**
     * @param User $model
     * @return User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query(Vendor $model)
    {
        $request = $this->request();
        $users = Vendor::query();
       
        if ($request->searchText != '') {
            $users = $users->where(function ($query) {
                $query->where('vendor_name', 'like', '%' . request('searchText') . '%')
                    ->orWhere('vendor_email', 'like', '%' . request('searchText') . '%')
                    ->orWhere('vendor_number', 'like', '%' . request('searchText') . '%')
                    ->orWhere('v_status', 'like', '%' . request('searchText') . '%')
                    ->orWhere('created_by', 'like', '%' . request('searchText') . '%');
            });
        }
        if ($request->searchText == ''){
        $users = self::customFilter($users);
        }
    
        return $users;
    }

    public function customFilter($users)
    {
        try{
            $customfilter = LeadVendorCustomFilter::where('user_id', user()->id)->where('status', 'active')->first();

            if($customfilter->start_date!=''&& $customfilter->end_date!='')
            {
                $users->whereBetween(DB::raw('DATE(vendors.`nxt_date`)'), [$customfilter->start_date, $customfilter->end_date]);
            }
            if($customfilter->state!='')
            {
                $users->whereIn('vendors.state', $customfilter->state)->get();
            }
            if($customfilter->city!='')
            {
                $users->whereIn('vendors.city', $customfilter->city)->get();
            }
            if($customfilter->county!='')
            {
                $users->whereIn('vendors.county', $customfilter->county)->get();
            }
            if($customfilter->contractor_type!='')
            {
                $users->whereIn('vendors.contractor_type', $customfilter->contractor_type)->get();
            }
            if($customfilter->created_by!='')
            {
                $users->whereIn('vendors.created_by', $customfilter->created_by)->get();
            }
            if($customfilter->lead_vendor_status!='')
            {
                $users->whereIn('vendors.v_status', $customfilter->lead_vendor_status)->get();
            }
            if($customfilter->lead_source!='')
            {
                $users->whereIn('vendors.lead_source', $customfilter->lead_source)->get();
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
        $dataTable = $this->setBuilder('vendorstrack-table', 3)
            ->parameters([
                'initComplete' => 'function () {
                   window.LaravelDataTables["vendorstrack-table"].buttons().container()
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
            __('app.createdAt') => ['data' => 'created_at', 'name' => 'created_at', 'title' => __('app.createdAt')],
            __('app.createdby') => ['data' => 'created_by', 'name' => 'created_by', 'title' => __('app.createdby'),'width' => '100px'],
            __('app.status') => ['data' => 'v_status', 'name' => 'v_status', 'title' => __('app.status')],
            __('app.ct_type') => ['data' => 'contractor_type', 'name' => 'contractor_type', 'title' => __('app.ct_type')],
            __('app.state') => ['data' => 'state', 'name' => 'state', 'title' => __('app.state')],
            __('app.county') => ['data' => 'county', 'name' => 'county', 'title' => __('app.county')],
            __('app.city') => ['data' => 'city', 'name' => 'city', 'title' => __('app.city')],
            
            __('app.c_name') => ['data' => 'vendor_name', 'name' => 'vendor_name', 'title' => __('app.c_name')],
            __('app.poc') => ['data' => 'poc', 'name' => 'poc', 'title' => __('app.poc')],
            __('app.cell') => ['data' => 'vendor_number', 'name' => 'vendor_number', 'title' => __('app.cell')],
            __('app.email') => ['data' => 'vendor_email', 'name' => 'vendor_email', 'title' => __('app.email')],
            __('app.menu.leadSource') => ['data' => 'lead_source', 'name' => 'lead_source', 'title' => __('app.menu.leadSource')],
            __('app.website') => ['data' => 'website', 'name' => 'website', 'title' => __('app.website')],
            __('app.nxt_date') => ['data' => 'nxt_date', 'name' => 'nxt_date', 'title' => __('app.nxt_date')],
            __('app.updatedat') => ['data' => 'updated_at', 'name' => 'updated_at', 'title' => __('app.updatedat')],
            __('app.edby') => ['data' => 'edited_by', 'name' => 'edited_by', 'title' => __('app.edby')],
            __('app.ltnote') => ['data' => 'latest_note', 'name' => 'latest_note', 'title' => __('app.ltnote')],
            
                 
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
