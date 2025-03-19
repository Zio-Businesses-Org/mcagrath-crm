@extends('layouts.app')

@push('datatable-styles')
    @include('sections.datatable_css')
@endpush

@section('filter-section')

    @include('lead-contact.filters')

@endsection

@php
$addLeadPermission = user()->permission('add_lead');
$addLeadCustomFormPermission = user()->permission('manage_lead_custom_forms');
@endphp

@section('content')
    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        
        <!-- Add Task Export Buttons Start -->
        <div class="d-grid d-lg-flex d-md-flex action-bar">
            <div id="table-actions" class="flex-grow-1 align-items-center">
                @if ($addLeadPermission == 'all' || $addLeadPermission == 'added')
                <x-forms.link-primary class="mr-3 openRightModal float-left mb-2 mb-lg-0 mb-md-0" icon="plus" :link="route('lead-contact.create')" id="add-lead-contact">
                 @lang('modules.leadContact.addLeadContact')
                </x-forms.link-primary>
                @endif
                @if ($addLeadCustomFormPermission == 'all')
                    <x-forms.button-secondary icon="pencil-alt" class="mr-3 float-left mb-2 mb-lg-0 mb-md-0" id="add-lead">
                        @lang('modules.lead.leadForm')
                    </x-forms.button-secondary>
                @endif

                <!-- @if ($addLeadPermission == 'all' || $addLeadPermission == 'added')
                    <x-forms.link-secondary :link="route('lead-contact.import')" class="mr-3 openRightModal float-left mb-2 mb-lg-0 mb-md-0 d-none d-lg-block" icon="file-upload">
                        @lang('app.importExcel')
                    </x-forms.link-secondary>
                @endif -->
                <!-- <x-forms.button-secondary class="mr-3 float-left mb-2 mb-lg-0 mb-md-0 d-sm-bloc d-none d-lg-block" icon="file-upload" id="importLeads">
                        @lang('app.importExcel')
                </x-forms.button-secondary>  -->
            </div>
            <!-- <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                    <a class="btn btn-secondary f-14" data-toggle="tooltip" id="custom-filter"
                        data-original-title="@lang('Custom Filter')"><i class="side-icon bi bi-filter"></i></a>
            </div> -->
            <x-datatable.actions>
                <div class="select-status mr-3 pl-3">
                    <select name="action_type" class="form-control select-picker" id="quick-action-type" disabled>
                        <option value="">@lang('app.selectAction')</option>
                        <option value="delete">@lang('app.delete')</option>
                    </select>
                </div>
            </x-datatable.actions>
        </div>
        <!-- Add Task Export Buttons End -->
        <!-- Task Box Start -->
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white table-responsive">

            {!! $dataTable->table(['class' => 'table table-hover border-0 w-100']) !!}

        </div>

        <div class="modal fade" id="CustomFilterModalClient" aria-hidden="true" >
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading">Custom Filter</h4>
                    </div>
                    <div class="modal-body"> 
                        <x-form id="save-client-filter-form">
                            <input type="hidden" name="user_id" value=" {{user()->id}} ">
                            <input type="hidden" name="startDateNext" id="startDateNext">
                            <input type="hidden" name="endDateNext" id="endDateNext">
                            <input type="hidden" name="startDateLast" id="startDateLast">
                            <input type="hidden" name="endDateLast" id="endDateLast">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <x-forms.text :fieldLabel="__('Filter Name')"
                                        fieldName="client_name" fieldRequired="true" fieldId="client_name"
                                        :fieldPlaceholder="__('Enter filter name')"/>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr">@lang('Status')</label>
                                        <div class="">
                                        <select class="form-control select-picker" name="client_status[]" id="client_status"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                            @foreach ($statusLeads as $status)
                                                <option value="{{ $status->status }}" >
                                                    {{ $status->status }}
                                                </option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr">@lang('Company Type')</label>
                                        <div class="">
                                        <select class="form-control select-picker" name="client_types[]" id="client_types"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                            @foreach ($companyTypes as $types)
                                                <option value="{{ $types->type }}" >
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
                                            placeholder="@lang('placeholders.dateRange')" id="customRange">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('Last Called Date')</label>
                                        <div class="select-status d-flex">
                                            <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                                            placeholder="@lang('placeholders.dateRange')" id="customRange1">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr">@lang('Created By')</label>
                                        <div class="mb-4">
                                        <select class="form-control select-picker" name="client_members[]" id="client_members"
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
                        <button type="button" class="btn btn-secondary" id="clear-client">Reset</button>
                        <button type="button" class="btn btn-secondary" id="close-client">Close</button>
                        <button type="button" class="btn btn-primary" id="save-filter-client">Save Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT WRAPPER END -->

@endsection

@push('scripts')
    @include('sections.datatable_js')
    <script>
    $(document).ready(function () {

        var startDateNext = '';
        var endDateNext = '';
        var startDateLast = '';
        var endDateLast = '';

        $('#customRange,#customRange1').daterangepicker({
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
        
        $('#customRange').on('apply.daterangepicker', function(ev, picker) {
            // Get start and end dates
            startDateNext = picker.startDate.format('YYYY-MM-DD');
            document.getElementById('startDateNext').value=startDateNext;
            endDateNext = picker.endDate.format('YYYY-MM-DD');
            document.getElementById('endDateNext').value=endDateNext;
            
            $(this).val(picker.startDate.format('{{ company()->moment_date_format }}') + ' - ' + picker.endDate.format('{{ company()->moment_date_format }}'));
            
        });
        $('#customRange1').on('apply.daterangepicker', function(ev, picker) {
            // Get start and end dates
            startDateLast = picker.startDate.format('YYYY-MM-DD');
            document.getElementById('startDateLast').value=startDateLast;
            endDateLast = picker.endDate.format('YYYY-MM-DD');
            document.getElementById('endDateLast').value=endDateLast;
            
            $(this).val(picker.startDate.format('{{ company()->moment_date_format }}') + ' - ' + picker.endDate.format('{{ company()->moment_date_format }}'));
            
        });
        $('#custom-filter').click(function () {
            $('#CustomFilterModalClient').modal('show');
        });

        $('#close-client').click(function () {
            $('#CustomFilterModalClient').modal('hide');
        });

        $('#clear-client').click(function() {
            $('#client_members').val([]).selectpicker('refresh');
            $('#client_types').val([]).selectpicker('refresh');
            $('#client_status').val([]).selectpicker('refresh');
            document.getElementById('startDateNext').value='';
            document.getElementById('endDateNext').value='';
            document.getElementById('startDateLast').value='';
            document.getElementById('endDateLast').value='';
            $('#customRange1').val('');
            $('#customRange').val('');
            $('#client_name').val('');
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

        $('#save-filter-client').click(function () {
            if($('#customRange').val()=='')
            {
                document.getElementById('startDateNext').value='';
                document.getElementById('endDateNext').value='';
            }
            if($('#customRange1').val()=='')
            {
                document.getElementById('startDateLast').value='';
                document.getElementById('endDateLast').value='';
            }
            var url = "{{ route('lead-client-filter.store') }}";
            $.easyAjax({
                url: url,
                container: '#save-client-filter-form',
                type: "POST",
                blockUI: true,
                disableButton: true,
                buttonSelector: '#save-filter-client',
                data: $('#save-client-filter-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        $('#CustomFilterModalClient').modal('hide');
                        window.location.reload();
                    }
                }
            })
        });
        $('body').on('click', '.edit-filter-client', function() {
            var id = $(this).data('row-id');
            
            var url = "{{ route('lead-client-filter.edit', ':id') }}";
            url = url.replace(':id', id);

            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
            
        });

        $('body').on('click', '.delete-row-client', function() {
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
                    var url = "{{ route('lead-client-filter.destroy', ':id') }}";
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
        $('body').on('click', '.apply-filter-client', function() {

            var id = $(this).data('row-id');
            var url = "{{ route('lead-client-filter.change-status',':id') }}";
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
            var url = "{{ route('lead-client-filter.clear',':id') }}";
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
         
        $('#lead-contact-table').on('preXhr.dt', function(e, settings, data) {
            var searchText = $('#search-text-field').val();
            data['searchText'] = searchText;
        });

        const showTable = () => {
            window.LaravelDataTables["lead-contact-table"].draw(false);
        }

        $('#quick-action-type').change(function() {
            const actionValue = $(this).val();
            if (actionValue != '') {
                $('#quick-action-apply').removeAttr('disabled');

                if (actionValue == 'change-agent') {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-agent-action').removeClass('d-none');
                } else {
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
            var id = $(this).data('id');
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
                    var url = "{{ route('lead-contact.destroy', ':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'POST',
                        url: url,
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

        const applyQuickAction = () => {
            var rowdIds = $("#lead-contact-table input:checkbox:checked").map(function() {
                return $(this).val();
            }).get();

            var url = "{{ route('lead-contact.apply_quick_action') }}?row_ids=" + rowdIds;

            $.easyAjax({
                url: url,
                container: '#quick-action-form',
                type: "POST",
                disableButton: true,
                buttonSelector: "#quick-action-apply",
                data: $('#quick-action-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        showTable();
                        resetActionButtons();
                        deSelectAll();
                        $('#quick-action-form').hide();
                    }
                }
            })
        };

        $('body').on('click', '#add-lead', function() {
            window.location.href = "{{ route('lead-form.index') }}";
        });

        // $( document ).ready(function() {
        //     @if (!is_null(request('start')) && !is_null(request('end')))
        //     $('#datatableRange').val('{{ request('start') }}' +
        //     ' @lang("app.to") ' + '{{ request('end') }}');
        //     $('#datatableRange').data('daterangepicker').setStartDate("{{ request('start') }}");
        //     $('#datatableRange').data('daterangepicker').setEndDate("{{ request('end') }}");
        //         showTable();
        //     @endif
        // });
        $('#importLeads').click(function () {
                var url = "{{ route('lead-contact.import') }}";
                $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
                $.ajaxModal(MODAL_LG, url);
        });

    </script>
@endpush
