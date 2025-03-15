<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Edit Filter')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<x-form id="editClientLeadFilterForm" method="PUT">
    <div class="modal-body">
        <input type="hidden" name="filterstartDateNext" id="filterstartDateNext">
        <input type="hidden" name="filterendDateNext" id="filterendDateNext">
        <input type="hidden" name="filterstartDateLast" id="filterstartDateLast">
        <input type="hidden" name="filterendDateLast" id="filterendDateLast">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <x-forms.text :fieldLabel="__('Filter Name')"
                    fieldName="client_name" fieldRequired="true" fieldId="client_name_edit"
                    :fieldPlaceholder="__('Enter filter name')" :fieldValue="$filter->name"/>
                </div>
                @php
                $selectedLeadStatus = $filter->client_lead_status ?? [];
                @endphp
                <div class="col-md-4 mt-3">
                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                        for="usr">@lang('Status')</label>
                    <div class="">
                    <select class="form-control select-picker" name="client_status[]" id="client_status_edit"
                            data-live-search="true" data-container="body" data-size="8" multiple>
                        @foreach ($statusLeads as $status)
                            <option value="{{ $status->status }}" {{ in_array($status->status, $selectedLeadStatus) ? 'selected' : '' }}>
                                {{ $status->status }}
                            </option>
                        @endforeach
                    </select>
                    </div>
                </div>
                @php
                $selectedCompanyType = $filter->company_type ?? [];
                @endphp
                <div class="col-md-4 mt-3">
                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                        for="usr">@lang('Company Type')</label>
                    <div class="">
                    <select class="form-control select-picker" name="client_types[]" id="client_types_edit"
                            data-live-search="true" data-container="body" data-size="8" multiple>
                        @foreach ($companyTypes as $types)
                            <option value="{{ $types->type }}" {{ in_array($types->type, $selectedCompanyType) ? 'selected' : '' }}>
                                {{ $types->type }}
                            </option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('Next Follow Up Date')</label>
                    <div class="select-status d-flex">
                        <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                        placeholder="@lang('placeholders.dateRange')" id="customRangeEdit">
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('Last Called Date')</label>
                    <div class="select-status d-flex">
                        <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                        placeholder="@lang('placeholders.dateRange')" id="customRange1Edit">
                    </div>
                </div>
                @php
                 $selectedAddedBy = $filter->added_by ?? [];
                @endphp
                <div class="col-md-4 mt-3">
                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                        for="usr">@lang('Created By')</label>
                    <div class="mb-4">
                    <select class="form-control select-picker" name="client_members[]" id="client_members_edit"
                            data-live-search="true" data-container="body" data-size="8" multiple>
                            @foreach ($allEmployees as $category)
                            <option value="{{ $category->id }}" {{ in_array($category->id, $selectedAddedBy) ? 'selected' : '' }}>
                                {{ $category->name }}
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
    var startDateNext = '{{$filter->next_follow_start_date}}';
    var endDateNext = '{{$filter->next_follow_end_date}}';
    var startDateLast = '{{$filter->last_called_start_date}}';
    var endDateLast = '{{$filter->last_called_end_date}}';

    $("#editClientLeadFilterForm .select-picker").selectpicker();

    $('#customRangeEdit,#customRange1Edit').daterangepicker({
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
        startDateNext = picker.startDate.format('YYYY-MM-DD');
        document.getElementById('filterstartDateNext').value=startDateNext;
        endDateNext = picker.endDate.format('YYYY-MM-DD');
        document.getElementById('filterendDateNext').value=endDateNext;
        
        $(this).val(picker.startDate.format('{{ company()->moment_date_format }}') + ' - ' + picker.endDate.format('{{ company()->moment_date_format }}'));
        
    });
    $('#customRange1Edit').on('apply.daterangepicker', function(ev, picker) {
        // Get start and end dates
        startDateLast = picker.startDate.format('YYYY-MM-DD');
        document.getElementById('filterstartDateLast').value=startDateLast;
        endDateLast = picker.endDate.format('YYYY-MM-DD');
        document.getElementById('filterendDateLast').value=endDateLast;
        
        $(this).val(picker.startDate.format('{{ company()->moment_date_format }}') + ' - ' + picker.endDate.format('{{ company()->moment_date_format }}'));
        
    });

    if(startDateNext!='' && endDateNext!=''){
        document.getElementById('filterstartDateNext').value=startDateNext;
        document.getElementById('filterendDateNext').value=endDateNext;
        
        $('#customRangeEdit').val(
            moment(startDateNext).format('{{ company()->moment_date_format }}') + ' - ' + moment(endDateNext).format('{{ company()->moment_date_format }}')
        );
    }
    if(startDateLast!='' && endDateLast!=''){
        document.getElementById('filterstartDateLast').value=startDateLast;
        document.getElementById('filterendDateLast').value=endDateLast;
        
        $('#customRange1Edit').val(
            moment(startDateLast).format('{{ company()->moment_date_format }}') + ' - ' + moment(endDateLast).format('{{ company()->moment_date_format }}')
        );
    }

    $('#edit-filter').click(function () {
        if($('#customRangeEdit').val()=='')
        {
            document.getElementById('filterstartDateNext').value='';
            document.getElementById('filterendDateNext').value='';
        }
        if($('#customRange1Edit').val()=='')
        {
            document.getElementById('filterstartDateLast').value='';
            document.getElementById('filterendDateLast').value='';
        }
        var url = "{{ route('lead-client-filter.update',$filter->id) }}";
        $.easyAjax({
            url: url,
            container: '#editClientLeadFilterForm',
            type: "POST",
            blockUI: true,
            disableButton: true,
            buttonSelector: '#edit-filter',
            data: $('#editClientLeadFilterForm').serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload();
                    
                }
            }
        })
    });

    $('#clearedit').click(function() {
        $('#client_members_edit').val([]).selectpicker('refresh');
        $('#client_types_edit').val([]).selectpicker('refresh');
        $('#client_status_edit').val([]).selectpicker('refresh');
        document.getElementById('filterstartDateNext').value='';
        document.getElementById('filterendDateNext').value='';
        document.getElementById('filterstartDateLast').value='';
        document.getElementById('filterendDateLast').value='';
        $('#customRange1Edit').val('');
        $('#customRangeEdit').val('');
        $('#client_name_edit').val('');
    });

});
</script>