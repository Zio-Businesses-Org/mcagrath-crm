<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Edit Filter')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<x-form id="editLeadVendorFilterForm" method="PUT">
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
                <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('Next Follow Up Date')</label>
                <div class="select-status d-flex">
                    <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                    placeholder="@lang('placeholders.dateRange')" id="customRangeEdit">
                </div>
            </div>
            @php
            $selectedCity = $filter->city ?? [];
            @endphp
            <div class="col-md-4 mt-3">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('City')</label>
                <div class="mb-4">
                    <select class="form-control select-picker" name="filter_city[]" id="filter_city_edit"
                            data-live-search="true" data-container="body" data-size="8" multiple>
                        @foreach ($city as $category)
                            <option value="{{ $category->city }}" {{ in_array($category->city, $selectedCity) ? 'selected' : '' }}>
                                {{ $category->city }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @php
                $selectedCounty = $filter->county ?? [];
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('County')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_county[]" id="filter_county_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($county as $category)
                        <option value="{{ $category->county }}" {{ in_array($category->county, $selectedCounty) ? 'selected' : '' }}>
                            {{ $category->county }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedState = $filter->state ?? [];
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('State')</label>
                <div class="mb-4">
                    <select class="form-control select-picker" name="filter_state[]" id="filter_state_edit"
                            data-live-search="true" data-container="body" data-size="8" multiple>
                        @foreach ($state as $category)
                            <option value="{{ $category->state }}" {{ in_array($category->state, $selectedState) ? 'selected' : '' }}>
                                {{ $category->state }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @php
                $selectedContractorType = $filter->contractor_type ?? [];
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Contractor Type')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_contractor_type[]" id="filter_contractor_type_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($contracttype as $category)
                        <option value="{{ $category->contractor_type }}" {{ in_array($category->contractor_type, $selectedContractorType) ? 'selected' : '' }}>
                            {{ $category->contractor_type }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedCreatedBy = $filter->created_by ?? [];
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Created By')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_members[]" id="filter_members_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($allEmployees as $category)
                        <option value="{{ $category->name }}" {{ in_array($category->name, $selectedCreatedBy) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedLeadSource = $filter->lead_source?? [];
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Lead Source')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_lead_source[]" id="filter_lead_source_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($leadsource as $category)
                        <option value="{{ $category->type }}" {{ in_array($category->type, $selectedLeadSource) ? 'selected' : '' }}>
                            {{ $category->type }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedLeadVendorStatus = $filter->lead_vendor_status?? [];
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Status')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_status[]" id="filter_status"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                        @foreach ($vendorStatuses as $category)
                            <option value="{{ $category->status }}" {{ in_array($category->status, $selectedLeadVendorStatus) ? 'selected' : '' }}>
                                {{ $category->status }}
                            </option>
                        @endforeach
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

    $("#editLeadVendorFilterForm .select-picker").selectpicker();

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
        var url = "{{ route('lead-vendor-filter.update',$filter->id) }}";
        $.easyAjax({
            url: url,
            container: '#editLeadVendorFilterForm',
            type: "POST",
            blockUI: true,
            disableButton: true,
            buttonSelector: '#edit-filter',
            data: $('#editLeadVendorFilterForm').serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload();
                    
                }
            }
        })
    });
    
    $('#clearedit').click(function() {
        $('#filter_state_edit').val([]).selectpicker('refresh');
        $('#filter_city_edit').val([]).selectpicker('refresh');
        $('#filter_county_edit').val([]).selectpicker('refresh');
        $('#filter_members_edit').val([]).selectpicker('refresh');
        $('#filter_contractor_type_edit').val([]).selectpicker('refresh');
        $('#filter_lead_source_edit').val([]).selectpicker('refresh');
        document.getElementById('startDate').value='';
        document.getElementById('endDate').value='';
        $('#customRangeEdit').val('');
        $('#filter_name_edit').val('');
    });
    
});