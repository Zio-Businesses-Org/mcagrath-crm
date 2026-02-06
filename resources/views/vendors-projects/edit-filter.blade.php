<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Edit Filter')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<x-form id="editProjectVendorFilterForm" method="PUT">
<div class="modal-body"> 
    <input type="hidden" name="filterstartDate" id="filterstartDate">
    <input type="hidden" name="filterendDate" id="filterendDate">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <x-forms.text :fieldLabel="__('Filter Name')"
                    fieldName="filter_name" fieldRequired="true" fieldId="filter_name_edit"
                    :fieldPlaceholder="__('Enter filter name')" :fieldValue="$filter->name"/>
            </div>
            
            <div class="col-md-4 mt-3">
                <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('Link Sent Date')</label>
                <div class="select-status d-flex">
                    <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                    placeholder="@lang('placeholders.dateRange')" id="customRangeEdit">
                </div>
            </div>
            @php
            $selectedCategories = $filter->project_category ?? [];
            @endphp
            <div class="col-md-4 mt-3">
                <label class="f-14 text-dark-grey text-capitalize"
                    for="usr">@lang('modules.projects.projectCategory')</label>
                <div class="mt-1">
                <select class="form-control select-picker" name="filter_category_id[]" id="filter_category_id_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"  {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedEmployee = $filter->project_members ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Members')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_members[]" id="filter_members_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($allEmployees as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, $selectedEmployee) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedClient = $filter->client_id ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Client')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_client[]" id="filter_client_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($clients as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, $selectedClient) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedVendor = $filter->vendor_id ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Vendors')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_vendor[]" id="filter_vendor_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($vendor as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, $selectedVendor) ? 'selected' : '' }}>
                            {{ $category->vendor_name }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedLinkStatus = $filter->link_status ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Link Status')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_link_status[]" id="filter_link_status_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                        <option value="Accepted" {{ in_array('Accepted', $selectedLinkStatus) ? 'selected' : '' }}>Accepted</option>
                        <option value="Rejected" {{ in_array('Rejected', $selectedLinkStatus) ? 'selected' : '' }}>Rejected</option>
                        <option value="Sent" {{ in_array('Sent', $selectedLinkStatus) ? 'selected' : '' }}>Sent</option>
                        <option value="Removed" {{ in_array('Removed', $selectedLinkStatus) ? 'selected' : '' }}>Removed</option>
                </select>
                </div>
            </div>
            @php
                $selectedWOStatus = $filter->work_order_status ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('WO Status')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_wo_status[]" id="filter_wo_status_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                        @foreach ($wostatus as $category)
                        <option value="{{ $category->wo_status }}" {{ in_array($category->wo_status, $selectedWOStatus) ? 'selected' : '' }}>
                            {{ $category->wo_status }}
                        </option>
                        @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedProjectStatus = $filter->project_status ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Project Status')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_project_status[]" id="filter_project_status_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($projectStatus as $category)
                        <option value="{{ $category->status_name }}" {{ in_array($category->status_name, $selectedProjectStatus) ? 'selected' : '' }}>
                            {{ $category->status_name }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Status')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_status_oc" id="filter_status_oc"
                    data-container="body">
                    <option value="">--</option>
                    <option value="open" @selected($filter->status_oc == 'open')> Open </option>
                    <option value="close" @selected($filter->status_oc == 'close')> Close </option>
                </select>
                </div>
            </div>
        </div>
    </div>
   
</div>
    <div class="modal-footer">
        <x-forms.button-cancel id="clearedit" class="border-0 mr-3">Reset</x-forms.button-cancel>
        <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.close')</x-forms.button-cancel>
        <x-forms.button-primary id="edit-filter" icon="check">@lang('app.save')</x-forms.button-primary>
    </div>
</x-form>
<script>

$(document).ready(function() {
    var startDate = '{{$filter->start_date}}';
    var endDate = '{{$filter->end_date}}';

    $("#editProjectVendorFilterForm .select-picker").selectpicker();

    $('#customRangeEdit').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });
        
    $('#customRangeEdit').on('apply.daterangepicker', function(ev, picker) {
        // Get start and end dates
        startDate = picker.startDate.format('YYYY-MM-DD');
        document.getElementById('filterstartDate').value=startDate;
        endDate = picker.endDate.format('YYYY-MM-DD');
        document.getElementById('filterendDate').value=endDate;
        $(this).val(picker.startDate.format('{{ company()->moment_date_format }}') + ' - ' + picker.endDate.format('{{ company()->moment_date_format }}'));
        
    });
    
    if(startDate!='' && endDate!=''){
        document.getElementById('filterstartDate').value=startDate;
        document.getElementById('filterendDate').value=endDate;
        
        $('#customRangeEdit').val(
            moment(startDate).format('{{ company()->moment_date_format }}') + ' - ' + moment(endDate).format('{{ company()->moment_date_format }}')
        );
    }

    $('#edit-filter').click(function () {
        if($('#customRangeEdit').val()=='')
        {
            document.getElementById('filterstartDate').value='';
            document.getElementById('filterendDate').value='';
        }
        var url = "{{ route('project-vendor-filter.update',$filter->id) }}";
        $.easyAjax({
            url: url,
            container: '#editProjectVendorFilterForm',
            type: "POST",
            blockUI: true,
            disableButton: true,
            buttonSelector: '#edit-filter',
            data: $('#editProjectVendorFilterForm').serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload();
                    
                }
            }
        })
    });
    
    $('#clearedit').click(function() {
        $('#filter_category_id_edit').val([]).selectpicker('refresh');
        $('#filter_vendor_edit').val([]).selectpicker('refresh');
        $('#filter_link_status_edit').val([]).selectpicker('refresh');
        $('#filter_wo_status_edit').val([]).selectpicker('refresh');
        $('#filter_project_status_edit').val([]).selectpicker('refresh');
        $('#filter_client_edit').val([]).selectpicker('refresh');
        $('#filter_members_edit').val([]).selectpicker('refresh');
        document.getElementById('startDate').value='';
        document.getElementById('endDate').value='';
        $('#customRangeEdit').val('');
        $('#filter_name_edit').val('');
    });
    
});