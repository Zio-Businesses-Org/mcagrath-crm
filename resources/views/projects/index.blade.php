@extends('layouts.app')

@push('datatable-styles')
    @include('sections.datatable_css')
@endpush

@section('filter-section')
<style>
    .dropdown{
        position :static;  
    } 
    .button-wrapper::-webkit-scrollbar {
        display: none; /* Hides the scrollbar */
    }
</style>   
<x-filters.filter-box class="justify-content-center">
    <div class="task-search d-flex  py-1 px-lg-3 px-0  align-items-center">
        <form class="w-100 mr-1 mr-lg-0 mr-md-1 ml-md-1 ml-0 ml-lg-0">
            <div class="input-group bg-grey rounded">
                <div class="input-group-prepend">
                    <span class="input-group-text border-0 bg-additional-grey">
                        <i class="fa fa-search f-13 text-dark-grey"></i>
                    </span>
                </div>
                <input type="text" class="form-control f-14 p-1 border-additional-grey" id="search-text-field"
                    placeholder="@lang('app.startTyping')">
            </div>
        </form>
    </div>
    <!-- SEARCH BY TASK END -->

    <!-- RESET START -->
    <div class="select-box d-flex py-1 px-lg-2 px-md-2 px-0">
        <x-forms.button-secondary class="btn-xs d-none" id="reset-filters" icon="times-circle">
            @lang('app.clearFilters')
        </x-forms.button-secondary>
    </div> 
</x-filters.filter-box>
<div class="container-fluid d-flex position-relative border-bottom-grey">
        <!-- Left Scroll Button -->
        <button class="btn btn-dark" id="scrollLeftBtn" style="display: none; left: 0;">&#9664;</button>
        <!-- Scrollable Button Wrapper -->
        <div id="buttonWrapper" class="button-wrapper d-flex overflow-auto flex-nowrap my-2">
        @foreach ($projectFilter as $filter)
        <!-- Buttons in a horizontal line -->
            <div class="task_view mx-1">
                
                <div class="taskView text-darkest-grey f-w-500">@if($filter->status=='active')<i class="fa fa-circle mr-2" style="color:#679c0d;"></i>@endif{{$filter->name}}</div>
                <div class="dropdown">
                    <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
                        type="link" id="dropdownMenuLink-{{$filter->id}}" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="icon-options-vertical icons"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" 
                        aria-labelledby="dropdownMenuLink-{{$filter->id}}" tabindex="0" >
                           @if($filter->status=='inactive')
                            <a class="dropdown-item apply-filter" href="javascript:;"
                                data-row-id="{{$filter->id}}">
                                <i class="bi bi-save2 mr-2"></i>
                                @lang('Apply')
                            </a>
                            @endif
                            <a class="dropdown-item edit-filter" href="javascript:;"
                                data-row-id="{{$filter->id}}">
                                <i class="fa fa-edit mr-2"></i>
                                @lang('app.edit')
                            </a>
                            <a class="dropdown-item delete-row" href="javascript:;"
                                data-row-id="{{$filter->id}}">
                                <i class="fa fa-trash mr-2"></i>
                                @lang('app.delete')
                            </a>
                            @if($filter->status=='active')
                            <a class="dropdown-item clear-filter" href="javascript:;"
                                data-row-id="{{$filter->id}}">
                                <i class="bi bi-save2 mr-2"></i>
                                @lang('Clear')
                            </a>
                            @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Right Scroll Button -->
        <button class="btn btn-dark" id="scrollRightBtn" style="display: none; right: 0;">&#9654;</button>
</div>
@endsection

@php
$addProjectPermission = user()->permission('add_projects');
$manageProjectTemplatePermission = user()->permission('manage_project_template');
$viewProjectTemplatePermission = user()->permission('view_project_template');
$deleteProjectPermission = user()->permission('delete_projects');
@endphp

@section('content')
    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-grid d-lg-flex d-md-flex action-bar">
            <div id="table-actions" class="flex-grow-1 align-items-center mb-2 mb-lg-0 mb-md-0">
                @if ($addProjectPermission == 'all' || $addProjectPermission == 'added' || $addProjectPermission == 'both')
                    <x-forms.link-primary :link="route('projects.create')"
                        class="mr-3 openRightModal float-left mb-2 mb-lg-0 mb-md-0" icon="plus">
                        @lang('app.addProject')
                    </x-forms.link-primary>
                @endif
                @if ($viewProjectTemplatePermission == 'all' || in_array($manageProjectTemplatePermission , ['added', 'all']))
                    <x-forms.link-secondary :link="route('project-template.index')"
                        class="mr-3 mb-2 mb-lg-0 mb-md-0 float-left" icon="layer-group">
                        @lang('app.menu.projectTemplate')
                    </x-forms.link-secondary>
                @endif


                @if ($addProjectPermission == 'all' || $addProjectPermission == 'added' || $addProjectPermission == 'both')
                    <x-forms.link-secondary :link="route('projects.import')" class="mr-3 float-left mb-2 mb-lg-0 mb-md-0 d-none d-lg-block" icon="file-upload">
                        @lang('app.importExcel')
                    </x-forms.link-secondary>
                @endif

            </div>

            @if (!in_array('client', user_roles()))
                <x-datatable.actions>
                    <input type="hidden" id="member_type" name="member_type"/>
                    <div class="select-status mr-3 pl-3">
                        <select name="action_type" class="form-control select-picker" id="quick-action-type" disabled>
                            <option value="">@lang('app.selectAction')</option>
                            <option value="change-status">@lang('modules.tasks.changeStatus')</option>
                            <option value="change-project-manager">@lang('Change Project Manager')</option>
                            <option value="change-project-coordinator">@lang('Change Project Coordinator')</option>
                            <option value="change-project-estimator">@lang('Change Project Estimator')</option>
                            <option value="change-accounting-analyst">@lang('Change Accounting Analyst')</option>
                            <option value="change-escalation-manager">@lang('Change Escalation Manager')</option>
                            <option value="change-project-scheduler">@lang('Change Project Scheduler')</option>
                            <option value="change-vendor-recruiter">@lang('Change Vendor Recruiter')</option>
                            <option value="change-follow-up">@lang('Change Next Follow Up Date')</option>
                            <option value="change-follow-up-time">@lang('Change Next Follow Up Time')</option>
                            <option value="archive">@lang('app.archive')</option>
                            <option value="delete">@lang('app.delete')</option>
                        </select>
                    </div>
                    <div class="select-status mr-3 d-none quick-action-field" id="change-status-action">
                        <select name="status" class="form-control select-picker">
                            @foreach ($projectStatus as $status)
                                 <option value="{{ $status->status_name }}">{{ $status->status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="select-status mr-3 d-none quick-action-field" id="change-member-action">
                        <select class="form-control select-picker" name="member"
                                data-live-search="true" data-container="body" data-size="8">
                            @foreach ($allEmployees as $category)
                                <option value="{{ $category->id }}" >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="select-status mr-3 d-none quick-action-field" id="change-follow-up-action">
                        <input type="text" class="form-control custom-bulk-action-date-picker date-picker height-35 f-14"
                        placeholder="Next Follow Up Date" name="nxt_follow_up_action"
                        id="nxt_follow_up_action"/>
                    </div>
                    <div class="select-status mr-3 d-none quick-action-field" id="nxt-follow-up-time">
                        <input type="text" class="form-control height-35 f-14"
                        placeholder="Next Follow Up Time" name="nxt_follow_up_time"
                        id="nxt_follow_up_time"/>
                    </div>
                </x-datatable.actions>
            @endif

            <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary f-14 btn-active projects" data-toggle="tooltip"
                    data-original-title="@lang('app.menu.projects')"><i class="side-icon bi bi-list-ul"></i></a>

                    <a class="btn btn-secondary f-14" data-toggle="tooltip" id="custom-filter"
                    data-original-title="@lang('Custom Filter')"><i class="side-icon bi bi-filter"></i></a>
                    @if ($deleteProjectPermission != 'none')

                        <a href="{{ route('projects.archive') }}" class="btn btn-secondary f-14" data-toggle="tooltip"
                            data-original-title="@lang('app.archive')"><i class="side-icon bi bi-archive"></i></a>
                    @endif
                    <a href="{{ route('project-calendar.index') }}" class="btn btn-secondary f-14" data-toggle="tooltip"
                    data-original-title="@lang('app.menu.calendar')"><i class="side-icon bi bi-calendar"></i></a>

                <a href="javascript:;" class="btn btn-secondary f-14 show-pinned" data-toggle="tooltip"
                    data-original-title="@lang('app.pinned')"><i class="side-icon bi bi-pin-angle"></i></a>
            </div>
        </div>
        <!-- Add Task Export Buttons End -->
        <!-- Task Box Start -->
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white table-responsive">

            {!! $dataTable->table(['class' => 'table table-hover border-0 w-100']) !!}

        </div>
        <!-- Task Box End -->
    </div>
    <!-- CONTENT WRAPPER END -->
    <div class="modal fade" id="CustomFilterModal" aria-hidden="true" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Custom Filter</h4>
                </div>
                <div class="modal-body"> 
                    <x-form id="save-project-filter-form">
                        <input type="hidden" name="user_id" value=" {{user()->id}} ">
                        <input type="hidden" name="startDate" id="startDate">
                        <input type="hidden" name="endDate" id="endDate">
                        <input type="hidden" name="startDatenxt" id="startDatenxt">
                        <input type="hidden" name="endDatenxt" id="endDatenxt">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <x-forms.text :fieldLabel="__('Filter Name')"
                                      fieldName="filter_name" fieldRequired="true" fieldId="filter_name"
                                      :fieldPlaceholder="__('Enter filter name')"/>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('app.dateFilterOn')</label>
                                    <div class="mb-4">
                                        <select class="form-control select-picker pb-1" name="custom_date_filter_on" id="custom_date_filter_on">
                                            <option value="deadline" >@lang('Due Date')</option>
                                            <option value="start_date" >@lang('Project Date')</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mt-3">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('app.duration')</label>
                                    <div class="select-status d-flex">
                                        <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                                        placeholder="@lang('placeholders.dateRange')" id="customRange">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('Next Follow Up Date')</label>
                                    <div class="select-status d-flex">
                                        <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                                        placeholder="@lang('placeholders.dateRange')" id="nxtRange">
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr">@lang('modules.projects.projectCategory')</label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_category_id[]" id="filter_category_id"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" >
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                             
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr">@lang('Project Sub-Category')</label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_sub_category[]" id="filter_sub_category"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        @foreach ($subcategories as $category)
                                            <option value="{{ $category->sub_category }}" >
                                                {{ $category->sub_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr">@lang('Project Type')</label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_type[]" id="filter_type"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        @foreach ($projecttype as $category)
                                            <option value="{{ $category->type }}">
                                                {{ $category->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr">@lang('Project Priority')</label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_priority[]" id="filter_priority"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        @foreach ($projectpriority as $category)
                                            <option value="{{ $category->priority }}">
                                                {{ $category->priority }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                              
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr">@lang('Project Status')</label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_status[]" id="filter_status"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        @foreach ($projectStatus as $category)
                                            <option value="{{ $category->status_name }}">
                                                {{ $category->status_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                  
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr">@lang('Delayed By')</label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_delayed[]" id="filter_delayed"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        @foreach ($delayedby as $category)
                                            <option value="{{ $category->delayed_by }}">
                                                {{ $category->delayed_by }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr">@lang('Client')</label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_client[]" id="filter_client"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        @foreach ($clients as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr">@lang('City')</label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_city[]" id="filter_city"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        @foreach ($city as $category)
                                            <option value="{{ $category }}" >
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr">@lang('County')</label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_county[]" id="filter_county"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        @foreach ($county as $category)
                                            <option value="{{ $category }}" >
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr">@lang('State')</label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_state[]" id="filter_state"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        @foreach ($state as $category)
                                            <option value="{{ $category }}" >
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr">@lang('Members')</label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_members[]" id="filter_members"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        @foreach ($allEmployees as $category)
                                            <option value="{{ $category->id }}" >
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="clear">Reset</button>
                    <button type="button" class="btn btn-secondary" id="close">Close</button>
                    <button type="button" class="btn btn-primary" id="save-filter">Save Filter</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @include('sections.datatable_js')

    <script>
    $(document).ready(function () {
        var startDate = '';
        var endDate = '';
        var startDatenxt = '';
        var endDatenxt = '';
        var firstOpen = true;

        $('#customRange,#nxtRange').daterangepicker({
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
        
        $('#nxtRange').on('apply.daterangepicker', function(ev, picker) {
            // Get start and end dates
            startDatenxt = picker.startDate.format('YYYY-MM-DD');
            document.getElementById('startDatenxt').value=startDatenxt;
            endDatenxt = picker.endDate.format('YYYY-MM-DD');
            document.getElementById('endDatenxt').value=endDatenxt;
            
            $(this).val(picker.startDate.format('{{ company()->moment_date_format }}') + ' - ' + picker.endDate.format('{{ company()->moment_date_format }}'));
            
        });

        $('#customRange').on('apply.daterangepicker', function(ev, picker) {
            // Get start and end dates
            startDate = picker.startDate.format('YYYY-MM-DD');
            document.getElementById('startDate').value=startDate;
            endDate = picker.endDate.format('YYYY-MM-DD');
            document.getElementById('endDate').value=endDate;
            
            $(this).val(picker.startDate.format('{{ company()->moment_date_format }}') + ' - ' + picker.endDate.format('{{ company()->moment_date_format }}'));
            
        });
        $('.custom-bulk-action-date-picker').each(function(ind, el) {
            datepicker(el, {
                position: 'bl',
                ...datepickerConfig
            });
        });
        
        $('#nxt_follow_up_time').datetimepicker({
            @if (company()->time_format == 'H:i')
                showMeridian: false,
            @endif
            useCurrent: false,
            format: "hh:mm A"
            }).on('dp.show', function() {
            if(firstOpen) {
                time = moment().startOf('day');
                firstOpen = false;
            } 
            
        });
        
        $('#save-filter').click(function () {
            if($('#customRange').val()=='')
            {
                document.getElementById('startDate').value='';
                document.getElementById('endDate').value='';
            }
            if($('#nxtRange').val()=='')
            {
                document.getElementById('startDatenxt').value='';
                document.getElementById('endDatenxt').value='';
            }
            var url = "{{ route('project-filter.store') }}";
            $.easyAjax({
                url: url,
                container: '#save-project-filter-form',
                type: "POST",
                blockUI: true,
                disableButton: true,
                buttonSelector: '#save-filter',
                data: $('#save-project-filter-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                        $('#CustomFilterModal').modal('hide');
                    }
                }
            })
         });

         $('#clear').click(function() {
            $('#filter_category_id').val([]).selectpicker('refresh');
            $('#filter_sub_category').val([]).selectpicker('refresh');
            $('#filter_type').val([]).selectpicker('refresh');
            $('#filter_priority').val([]).selectpicker('refresh');
            $('#filter_status').val([]).selectpicker('refresh');
            $('#filter_delayed').val([]).selectpicker('refresh');
            $('#filter_client').val([]).selectpicker('refresh');
            $('#filter_city').val([]).selectpicker('refresh');
            $('#filter_state').val([]).selectpicker('refresh');
            $('#filter_county').val([]).selectpicker('refresh');
            $('#filter_members').val([]).selectpicker('refresh');
            document.getElementById('startDate').value='';
            document.getElementById('endDate').value='';
            document.getElementById('startDatenxt').value='';
            document.getElementById('endDatenxt').value='';
            $('#customRange').val('');
            $('#nxtRange').val('');
            $('#filter_name').val('');
        });

        $('#custom-filter').click(function () {
            $('#CustomFilterModal').modal('show');
         });
         $('#close').click(function () {
            $('#CustomFilterModal').modal('hide');
         });
        const buttonWrapper = document.getElementById('buttonWrapper');
        const scrollLeftBtn = document.getElementById('scrollLeftBtn');
        const scrollRightBtn = document.getElementById('scrollRightBtn');

        function updateScrollButtons() {
            // Check if the content overflows the button wrapper
            if (buttonWrapper.scrollWidth > buttonWrapper.clientWidth) {
                scrollLeftBtn.style.display = 'block';
                scrollRightBtn.style.display = 'block';
            } else {
                scrollLeftBtn.style.display = 'none';
                scrollRightBtn.style.display = 'none';
            }
        }
        updateScrollButtons();

        $('#scrollLeftBtn').click(function() {
            buttonWrapper.scrollBy({
                left: -200, // Adjust as needed
                behavior: 'smooth'
            });
        });

        $('#scrollRightBtn').click(function() {
            buttonWrapper.scrollBy({
                left: 200, // Adjust as needed
                behavior: 'smooth'
            });
        });

        window.addEventListener('resize', updateScrollButtons);

        $('body').on('click', '.edit-filter', function() {
            var id = $(this).data('row-id');

            var url = "{{ route('project-filter.edit', ':id') }}";
            url = url.replace(':id', id);

            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
            
        });

        $('body').on('click', '.delete-row', function() {
            var id = $(this).data('row-id');
            Swal.fire({
                title: "@lang('messages.sweetAlertTitle')",
                text: "@lang('messages.recoverRecord')",
                icon: 'warning',
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "@lang('messages.confirmDelete')",
                cancelButtonText: "@lang('app.cancel')",
                customClass: {
                    confirmButton: 'btn btn-primary mr-3',
                    cancelButton: 'btn btn-secondary'
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('project-filter.destroy', ':id') }}";
                    url = url.replace(':id', id);
                    var token = "{{ csrf_token() }}";
                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: '.content-wrapper',
                        blockUI: true,
                        data: {
                            '_token': token,
                            '_method': 'DELETE'
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                window.location.reload();
                            }
                        }
                    });
                }
            });
        });
        $('body').on('click', '.apply-filter', function() {

            var id = $(this).data('row-id');
            var url = "{{ route('project-filter.change-status',':id') }}";
            url = url.replace(':id', id);
            var token = "{{ csrf_token() }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.content-wrapper',
                blockUI: true,
                data: {
                    '_token': token,
                },
                success: function(response) {
                    if (response.status == "success") {
                        window.location.reload();
                    }
                }
            });
        });
        $('body').on('click', '.clear-filter', function() {
            var id = $(this).data('row-id');
            var url = "{{ route('project-filter.clear',':id') }}";
            url = url.replace(':id', id);
            var token = "{{ csrf_token() }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.content-wrapper',
                blockUI: true,
                data: {
                    '_token': token,
                },
                success: function(response) {
                    if (response.status == "success") {
                        window.location.reload();
                    }
                }
            });
        });
    });
    </script>

    <script>

        $(".select-picker").selectpicker();

        $('#projects-table').on('preXhr.dt', function(e, settings, data) {


            var searchText = $('#search-text-field').val();
      
            data['searchText'] = searchText;
           
        });

        const showTable = () => {
            window.LaravelDataTables["projects-table"].draw(false);
        }

        $('#search-text-field').on('keyup', function() {
            if ($('#search-text-field').val() != "") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            }
        });


        $('#reset-filters,#reset-filters-2').click(function() {
            $('#filter-form')[0].reset();
            $('.filter-box #date_filter_on').val('deadline');
            $('.filter-box .select-picker').selectpicker("refresh");
            $('#reset-filters').addClass('d-none');
            showTable();
        });

        $('#quick-action-type').change(function() {
            const actionValue = $(this).val();
            if (actionValue != '') {
                $('#quick-action-apply').removeAttr('disabled');

                if (actionValue == 'change-status') {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-status-action').removeClass('d-none');
                } 
                else if(actionValue =='change-project-manager')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('project-manager');
                    
                }
                else if(actionValue =='change-project-coordinator')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('project-coordinator');
                    
                }
                else if(actionValue =='change-project-estimator')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('project-estimator');
                    
                }
                else if(actionValue =='change-accounting-analyst')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('accounting-analyst');
                    
                }
                else if(actionValue =='change-escalation-manager')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('escalation-manager');
                    
                }
                else if(actionValue =='change-project-scheduler')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('project-scheduler');
                    
                }
                else if(actionValue =='change-vendor-recruiter')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('vendor-recruiter');
                    
                }
                else if(actionValue =='change-follow-up')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-follow-up-action').removeClass('d-none');
                    
                }
                else if(actionValue =='change-follow-up-time')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#nxt-follow-up-time').removeClass('d-none');
                    
                }
                else {
                    $('.quick-action-field').addClass('d-none');
                }
            } else {
                $('#quick-action-apply').attr('disabled', true);
                $('.quick-action-field').addClass('d-none');
            }
        });

        $('#quick-action-apply').click(function() {
            const actionValue = $('#quick-action-type').val();
            if (actionValue == 'delete') {
                Swal.fire({
                    title: "@lang('messages.sweetAlertTitle')",
                    text: "@lang('messages.recoverRecord')",
                    icon: 'warning',
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: "@lang('messages.confirmDelete')",
                    cancelButtonText: "@lang('app.cancel')",
                    customClass: {
                        confirmButton: 'btn btn-primary mr-3',
                        cancelButton: 'btn btn-secondary'
                    },
                    showClass: {
                        popup: 'swal2-noanimation',
                        backdrop: 'swal2-noanimation'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        applyQuickAction();
                    }
                });

            } else {
                applyQuickAction();
            }
        });

        $('body').on('click', '.delete-table-row', function() {
            var id = $(this).data('user-id');
            Swal.fire({
                title: "@lang('messages.sweetAlertTitle')",
                text: "@lang('messages.recoverRecord')",
                icon: 'warning',
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "@lang('messages.confirmDelete')",
                cancelButtonText: "@lang('app.cancel')",
                customClass: {
                    confirmButton: 'btn btn-primary mr-3',
                    cancelButton: 'btn btn-secondary'
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('projects.destroy', ':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: '.content-wrapper',
                        blockUI: true,
                        data: {
                            '_token': token,
                            '_method': 'DELETE'
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                showTable();
                            }
                        }
                    });
                }
            });
        });

        $('body').on('click', '.archive', function() {
            var id = $(this).data('user-id');
            Swal.fire({
                title: "@lang('messages.sweetAlertTitle')",
                text: "@lang('messages.archiveMessage')",
                icon: 'warning',
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "@lang('messages.confirmArchive')",
                cancelButtonText: "@lang('app.cancel')",
                customClass: {
                    confirmButton: 'btn btn-primary mr-3',
                    cancelButton: 'btn btn-secondary'
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('projects.archive_delete', ':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: '.content-wrapper',
                        blockUI: true,
                        data: {
                            '_token': token,
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                window.LaravelDataTables["projects-table"].draw(false);
                            }
                        }
                    });
                }
            });
        });

        const applyQuickAction = () => {
            var rowdIds = $("#projects-table input:checkbox:checked").map(function() {
                return $(this).val();
            }).get().filter(value => value !== "on");

            var url = "{{ route('projects.apply_quick_action') }}?row_ids=" + rowdIds;
            
            
            $.easyAjax({
                url: url,
                container: '#quick-action-form',
                type: "POST",
                disableButton: true,
                buttonSelector: "#quick-action-apply",
                data: $('#quick-action-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                        resetActionButtons();
                        deSelectAll();
                        $('#quick-action-apply').attr('disabled', 'disabled');
                        $('#change-status-action').addClass('d-none');
                        $('#change-member-action').addClass('d-none');
                        $('#quick-action-form').hide();
                    }
                }
            })
        };


        $('body').on('click', '.duplicateProject', function(){
            var id = $(this).data('project-id');
            var url = "{{ route('projects.duplicate_project', ':id') }}";
            url = url.replace(':id', id);

            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

    </script>
    <script>
        $(document).ready(function () {
            // Select All Checkbox Functionality
            $('body').on("change", "#new-select-all-table", function () {
                $("#projects-table .select-table-row").prop("checked", this.checked);
                if ($(".select-table-row:checked").length > 0){
                    $("#quick-action-form").fadeIn();
                    $("#quick-actions").find("input, textarea, button, select").removeAttr("disabled");
                    $("#quick-actions").find("button").removeClass("disabled");
                   // $(".select-picker").selectpicker("refresh");
                    $("#quick-action-type,#change-member-action,#change-status-action").selectpicker("refresh");
                } else {
                    $("#quick-action-form").fadeOut();
                }
                
            });
            $('body').on("change", ".select-table-row", function () {
                if ($(".select-table-row:checked").length > 0){
                    $("#quick-action-form").fadeIn();
                    $("#quick-actions").find("input, textarea, button, select").removeAttr("disabled");
                    $("#quick-actions").find("button").removeClass("disabled");
                    $("#quick-action-type,#change-member-action,#change-status-action").selectpicker("refresh");
                    //$(".select-picker").selectpicker("refresh");
                } else {
                    $("#quick-action-form").fadeOut();
                }
                 
            });

            // Individual Checkbox Click - Control Select All Checkbox
            // $(document).on("change", ".select-table-row", function () {
            //     let allChecked = $("#project_datatable .select-table-row").length === $("#project_datatable .select-table-row:checked").length;
            //     $("#select-all-checkbox").prop("checked", allChecked);
            // });
        });

    </script>
@endpush
