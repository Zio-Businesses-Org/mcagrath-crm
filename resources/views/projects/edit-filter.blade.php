<!-- <style>
    .dropdown-menu{
        top: 0px !important;
    }
</style>   -->
<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Edit Filter')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<x-form id="editProjectFilterForm" method="PUT">
    <div class="modal-body">
    <input type="hidden" name="filterstartDate" id="filterstartDate">
    <input type="hidden" name="filterendDate" id="filterendDate">
    <input type="hidden" name="filterstartDatenxt" id="filterstartDatenxt">
    <input type="hidden" name="filterendDatenxt" id="filterendDatenxt">
        <div class="row">
            <div class="col-md-4">
                <x-forms.text :fieldLabel="__('Filter Name')"
                    fieldName="filter_name" fieldRequired="true" fieldId="filter_name_edit"
                    :fieldPlaceholder="__('Enter filter name')" :fieldValue="$filter->name"/>
            </div>
            <div class="col-md-4 mt-3">
                <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('app.dateFilterOn')</label>
                <div class="mb-4">
                    <select class="form-control select-picker pb-1" name="custom_date_filter_on" id="custom_date_filter_on">
                        <option value="deadline" @selected($filter->filter_on == 'deadline') >@lang('Due Date')</option>
                        <option value="start_date" @selected($filter->filter_on == 'start_date')>@lang('Project Date')</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('app.duration')</label>
                <div class="select-status d-flex">
                    <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                    placeholder="@lang('placeholders.dateRange')" id="customRangeEdit">
                </div>
            </div>       
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('Next Follow Up Date')</label>
                <div class="select-status d-flex">
                    <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                    placeholder="@lang('placeholders.dateRange')" id="nxtRangeEdit">
                </div>
            </div>
            @php
            $selectedCategories = $filter->project_category ?? [];
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('modules.projects.projectCategory')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_category_id[]" id="filter_category_id_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                        {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedSubCategories = $filter->project_sub_category ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Project Sub-Category')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_sub_category[]" id="filter_sub_category_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($subcategories as $category)
                        <option value="{{ $category->sub_category }}" 
                                {{ in_array($category->sub_category, $selectedSubCategories) ? 'selected' : '' }}>
                            {{ $category->sub_category }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedType = $filter->project_type ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Project Type')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_type[]" id="filter_type_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($projecttype as $category)
                        <option value="{{ $category->type }}" 
                                {{ in_array($category->type, $selectedType) ? 'selected' : '' }}>
                            {{ $category->type }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedPriority = $filter->project_priority ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Project Priority')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_priority[]" id="filter_priority_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($projectpriority as $category)
                        <option value="{{ $category->priority }}" 
                                {{ in_array($category->priority, $selectedPriority) ? 'selected' : '' }}>
                            {{ $category->priority }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedStatus = $filter->project_status ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Project Status')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_status[]" id="filter_status_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($projectStatus as $category)
                        <option value="{{ $category->status_name }}" 
                                {{ in_array($category->status_name, $selectedStatus) ? 'selected' : '' }}>
                            {{ $category->status_name }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedDelayed = $filter->delayed_by ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('Delayed By')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_delayed[]" id="filter_delayed_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($delayedby as $category)
                        <option value="{{ $category->delayed_by }}" 
                                {{ in_array($category->delayed_by, $selectedDelayed) ? 'selected' : '' }}>
                            {{ $category->delayed_by }}
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
                        <option value="{{ $category->id }}" 
                                {{ in_array($category->id, $selectedClient) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedCity = $filter->city ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('City')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_city[]" id="filter_city_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($city as $category)
                        <option value="{{ $category }}" 
                                {{ in_array($category, $selectedCity) ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedCounty = $filter->county ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('County')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_county[]" id="filter_county_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($county as $category)
                        <option value="{{ $category }}" 
                                {{ in_array($category, $selectedCounty) ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            @php
                $selectedState = $filter->state ?? [];  // Assuming this is the array of selected category names
            @endphp
            <div class="col-md-4">
                <label class="f-14 text-dark-grey mb-12 text-capitalize"
                    for="usr">@lang('State')</label>
                <div class="mb-4">
                <select class="form-control select-picker" name="filter_state[]" id="filter_state_edit"
                        data-live-search="true" data-container="body" data-size="8" multiple>
                    @foreach ($state as $category)
                        <option value="{{ $category }}" 
                                {{ in_array($category, $selectedState) ? 'selected' : '' }}>
                            {{ $category }}
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
                        <option value="{{ $category->id }}" 
                                {{ in_array($category->id, $selectedEmployee) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
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
    var startDatenxt = '{{$filter->start_date_nxt}}';
    var endDatenxt = '{{$filter->end_date_nxt}}';

    $('#customRangeEdit,#nxtRangeEdit').daterangepicker({
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
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Today Onwards': [moment(), moment().add(10, 'years')],
            'Tomorrow Onwards': [moment().add(1, 'day'), moment().add(10, 'years')],
            'Past': [moment().subtract(50, 'years'), moment().subtract(1, 'day')],
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

        $('#nxtRangeEdit').on('apply.daterangepicker', function(ev, picker) {
            // Get start and end dates
            startDatenxt = picker.startDate.format('YYYY-MM-DD');
            document.getElementById('filterstartDatenxt').value=startDatenxt;
            endDatenxt = picker.endDate.format('YYYY-MM-DD');
            document.getElementById('filterendDatenxt').value=endDatenxt;
            
            $(this).val(picker.startDate.format('{{ company()->moment_date_format }}') + ' - ' + picker.endDate.format('{{ company()->moment_date_format }}'));
            
        });

        if(startDatenxt!='' && endDatenxt!=''){
            document.getElementById('filterstartDatenxt').value=startDatenxt;
            document.getElementById('filterendDatenxt').value=endDatenxt;
            $('#nxtRangeEdit').val(
                moment(startDatenxt).format('{{ company()->moment_date_format }}') + ' - ' + moment(endDatenxt).format('{{ company()->moment_date_format }}')
            );
        }

        $('#edit-filter').click(function () {
            if($('#customRangeEdit').val()=='')
            {
                document.getElementById('filterstartDate').value='';
                document.getElementById('filterendDate').value='';
            }
            if($('#nxtRangeEdit').val()=='')
            {
                document.getElementById('filterstartDatenxt').value='';
                document.getElementById('filterendDatenxt').value='';
            }
            var url = "{{ route('project-filter.update',$filter->id) }}";
            $.easyAjax({
                url: url,
                container: '#editProjectFilterForm',
                type: "POST",
                blockUI: true,
                disableButton: true,
                buttonSelector: '#edit-filter',
                data: $('#editProjectFilterForm').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                        
                    }
                }
            })
         });

        $("#editProjectFilterForm .select-picker").selectpicker();

        $('#clearedit').click(function() {
            $('#filter_category_id_edit').val([]).selectpicker('refresh');
            $('#filter_sub_category_edit').val([]).selectpicker('refresh');
            $('#filter_type_edit').val([]).selectpicker('refresh');
            $('#filter_priority_edit').val([]).selectpicker('refresh');
            $('#filter_status_edit').val([]).selectpicker('refresh');
            $('#filter_delayed_edit').val([]).selectpicker('refresh');
            $('#filter_client_edit').val([]).selectpicker('refresh');
            $('#filter_city_edit').val([]).selectpicker('refresh');
            $('#filter_state_edit').val([]).selectpicker('refresh');
            $('#filter_county_edit').val([]).selectpicker('refresh');
            $('#filter_members_edit').val([]).selectpicker('refresh');
            document.getElementById('filterstartDate').value='';
            document.getElementById('filterendDate').value='';
            document.getElementById('filterstartDatenxt').value='';
            document.getElementById('filterendDatenxt').value='';
            $('#customRangeEdit').val('');
            $('#nxtRangeEdit').val('');
            $('#filter_name_edit').val('');
        });

});


</script>
