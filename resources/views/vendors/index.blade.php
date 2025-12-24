@extends('layouts.app')

@push('datatable-styles')
    @include('sections.datatable_css')
@endpush

@section('filter-section')
<style>
    .dropdown-mod{
        position :static;  
    } 
    .button-wrapper::-webkit-scrollbar {
        display: none; /* Hides the scrollbar */
    }
</style>
<x-filters.filter-box-moded>
    <!-- SEARCH BY TASK START -->
    <div class="task-search d-flex  py-1 px-lg-3 px-0 align-items-center ">
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
    <div class="select-box d-flex py-1 px-lg-2 px-md-2 px-0">
        <x-forms.button-secondary class="btn-xs d-none" id="reset-filters" icon="times-circle">
            @lang('app.clearFilters')
        </x-forms.button-secondary>
    </div>
</x-filters.filter-box-moded>
<div class="container-fluid d-flex position-relative border-bottom-grey">
    <!-- Left Scroll Button -->
    <button class="btn btn-dark" id="scrollLeftBtn" style="display: none; left: 0;">&#9664;</button>
    <!-- Scrollable Button Wrapper -->
    <div id="buttonWrapper" class="button-wrapper d-flex overflow-auto flex-nowrap my-2">
    @foreach ($vendorFilter as $filter)
    <!-- Buttons in a horizontal line -->
        <div class="task_view mx-1">
            
            <div class="taskView text-darkest-grey f-w-500">@if($filter->status=='active')<i class="fa fa-circle mr-2" style="color:#679c0d;"></i>@endif{{$filter->name}}</div>
            <div class="dropdown dropdown-mod">
                <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
                    type="link" id="dropdownMenuLink-{{$filter->id}}" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-options-vertical icons"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-mod" 
                    aria-labelledby="dropdownMenuLink-{{$filter->id}}" tabindex="0" >
                    @if($filter->status=='inactive')
                        <a class="dropdown-item apply-filter" href="javascript:;"
                            data-row-id="{{$filter->id}}">
                            <i class="bi bi-save2 mr-2"></i>
                            @lang('Apply')
                        </a>
                    @endif
                        <a class="dropdown-item edit-filter-vendor" href="javascript:;"
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

@section('content')

    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-grid d-lg-flex d-md-flex action-bar">
            <div id="table-actions" class="flex-grow-1 align-items-center"></div>
            <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                <a href="{{ route('vendors.index') }}" class="btn btn-secondary f-14 btn-active show-clients" data-toggle="tooltip"
                    data-original-title="@lang('Vendors')"><i class="side-icon bi bi-list-ul"></i></a>
                <a class="btn btn-secondary f-14" data-toggle="tooltip" id="custom-filter"
                    data-original-title="@lang('Custom Filter')"><i class="side-icon bi bi-filter"></i></a>
            </div>
        </div>
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white table-responsive">
            {!! $dataTable->table(['class' => 'table table-hover border-0 w-100']) !!}
        </div>
        <div class="modal fade" id="CustomFilterModal" aria-hidden="true" >
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading">Custom Filter</h4>
                    </div>
                    <div class="modal-body"> 
                        <x-form id="save-vendor-filter-form">
                            <input type="hidden" name="user_id" value=" {{user()->id}} ">
                            <input type="hidden" name="startDate" id="startDate">
                            <input type="hidden" name="endDate" id="endDate">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <x-forms.text :fieldLabel="__('Filter Name')"
                                        fieldName="filter_name" fieldRequired="true" fieldId="filter_name"
                                        :fieldPlaceholder="__('Enter filter name')"/>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('Created Date')</label>
                                        <div class="select-status d-flex">
                                            <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                                            placeholder="@lang('placeholders.dateRange')" id="customRange">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mt-3">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr">@lang('City')</label>
                                        <div class="">
                                        <select class="form-control select-picker" name="filter_city[]" id="filter_city"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                            @foreach ($city as $category)
                                                <option value="{{ $category->city }}" >
                                                    {{ $category->city }}
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
                                                <option value="{{ $category->county }}" >
                                                    {{ $category->county }}
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
                                                <option value="{{ $category->state }}" >
                                                    {{ $category->state }}
                                                </option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr">@lang('Contractor Type')</label>
                                        <div class="mb-4">
                                        <select class="form-control select-picker" name="filter_contractor_type[]" id="filter_contractor_type"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                            @foreach ($contracttype as $category)
                                                <option value="{{ $category->contractor_type }}" >
                                                    {{ $category->contractor_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr">@lang('Created By')</label>
                                        <div class="mb-4">
                                        <select class="form-control select-picker" name="filter_members[]" id="filter_members"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                            @foreach ($allEmployees as $category)
                                                <option value="{{ $category->name }}" >
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr">@lang('Status')</label>
                                        <div class="mb-4">
                                        <select class="form-control select-picker" name="filter_status[]" id="filter_status"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                                <option value="Active" data-content='<i class="fa fa-circle mr-2" style="color:#00b5ff;"></i>Active'>
                                                <option  value="Compliant" data-content='<i class="fa fa-circle mr-2" style="color:#679c0d;"></i>Compliant'>
                                                <option  value="Snooze" data-content='<i class="fa fa-circle mr-2" style="color:#FFA500;"></i>Snooze'>
                                                <option  value="Non Compliant" data-content='<i class="fa fa-circle mr-2" style="color:#FFFF00;"></i>Non Compliant'>
                                                <option  value="DNU" data-content='<i class="fa fa-circle mr-2" style="color:#FF0000;"></i>DNU'>
                                                <option  value="On Hold" data-content='<i class="fa fa-circle mr-2" style="color:#808080;"></i>On Hold'>
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
        <div id="signature-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center align-items-center modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modelHeading">@lang('modules.estimates.cpatureAndConfirmation')</h5>
                        <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <x-form id="acceptEstimate">
                            <div class="row">
                                <div class="col-sm-12 bg-grey p-4 signature">
                                    <x-forms.label fieldId="signature-pad" fieldRequired="true" :fieldLabel="__('modules.estimates.signature')" />
                                    <div class="signature_wrap wrapper border-0 form-control">
                                        <canvas id="signature-pad" class="signature-pad rounded" width=725 height=150></canvas>
                                    </div>
                                </div>
                                <div class="col-sm-12 p-4 d-none upload-image">
                                    <x-forms.file allowedFileExtensions="png jpg jpeg svg bmp" class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('modules.estimates.signature')" fieldName="image"
                                        fieldId="image" :popover="__('messages.fileFormat.ImageFile')" fieldRequired="true" />
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <x-forms.button-secondary id="undo-signature" class="signature">@lang('modules.estimates.undo')</x-forms.button-secondary>
                                    <x-forms.button-secondary class="ml-2 signature" id="clear-signature">@lang('modules.estimates.clear')</x-forms.button-secondary>
                                    <x-forms.button-secondary class="ml-2 " id="toggle-pad-uploader">@lang('modules.estimates.uploadSignature')
                                    </x-forms.button-secondary>
                                </div>

                            </div>
                        </x-form>
                    </div>
                    <div class="modal-footer">
                        <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.cancel')</x-forms.button-cancel>
                        <x-forms.button-primary id="save-signature" icon="check">@lang('app.sign')</x-forms.button-primary>
                    </div>
                </div>
            </div>
        </div>
        <!-- Task Box End -->
    </div>
    <!-- CONTENT WRAPPER END -->

@endsection

@push('scripts')
    @include('sections.datatable_js')
    <script>
    $(document).ready(function () {

        var startDate = '';
        var endDate = '';

        $('#customRange').daterangepicker({
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
            startDate = picker.startDate.format('YYYY-MM-DD');
            document.getElementById('startDate').value=startDate;
            endDate = picker.endDate.format('YYYY-MM-DD');
            document.getElementById('endDate').value=endDate;
            
            $(this).val(picker.startDate.format('{{ company()->moment_date_format }}') + ' - ' + picker.endDate.format('{{ company()->moment_date_format }}'));
            
        });
        $('#custom-filter').click(function () {
            $('#CustomFilterModal').modal('show');
        });

        $('#close').click(function () {
            $('#CustomFilterModal').modal('hide');
        });

        $('#clear').click(function() {
            $('#filter_state').val([]).selectpicker('refresh');
            $('#filter_city').val([]).selectpicker('refresh');
            $('#filter_county').val([]).selectpicker('refresh');
            $('#filter_members').val([]).selectpicker('refresh');
            $('#filter_contractor_type').val([]).selectpicker('refresh');
            $('#filter_status').val([]).selectpicker('refresh');
            document.getElementById('startDate').value='';
            document.getElementById('endDate').value='';
            $('#customRange').val('');
            $('#filter_name').val('');
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

        $('#save-filter').click(function () {
            if($('#customRange').val()=='')
            {
                document.getElementById('startDate').value='';
                document.getElementById('endDate').value='';
            }
            var url = "{{ route('vendor-filter.store') }}";
            $.easyAjax({
                url: url,
                container: '#save-vendor-filter-form',
                type: "POST",
                blockUI: true,
                disableButton: true,
                buttonSelector: '#save-filter',
                data: $('#save-vendor-filter-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        $('#CustomFilterModal').modal('hide');
                        window.location.reload();
                    }
                }
            })
        });
        $('body').on('click', '.edit-filter-vendor', function() {
            var id = $(this).data('row-id');
            
            var url = "{{ route('vendor-filter.edit', ':id') }}";
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
                    var url = "{{ route('vendor-filter.destroy', ':id') }}";
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
            var url = "{{ route('vendor-filter.change-status',':id') }}";
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
            var url = "{{ route('vendor-filter.clear',':id') }}";
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
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script>
        var row_id;
        $('#vendors-table').on('preXhr.dt', function(e, settings, data) {
            const searchText = $('#search-text-field').val();
            data['searchText'] = searchText;
            const status = $('#status').val();
            data['status'] = status;
        });

        $('#status').on('change keyup', function() {
                if ($('#status').val() !== "") {
                    $('#reset-filters').removeClass('d-none');
                } else {
                    $('#reset-filters').addClass('d-none');
                }
                showTable();
        });

        const showTable = () => {
            window.LaravelDataTables["vendors-table"].draw(false);
        }

        $('#vendors-table').on('change', '.change-vendor-status', function() {
            var id = $(this).data('row-id');
            var value =  $(this).val();
            var url="{{ route('vendors.changevendorstatus',':id') }}";
            url = url.replace(':id', id);
            if (id != "" && value != "") {
            $.easyAjax({
                    url: url,
                    type: 'POST',
                    blockUI: true,
                    data: {
                            _token: '{{ csrf_token() }}',
                            value: value
                        },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.reload();
                        } 
                    },
                });
            }
        });

        $('#search-text-field').on('keyup', function() {
            if ($('#search-text-field').val() != "") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            }
        });
       
        $('#reset-filters,#reset-filters-2').click(function() {
            $('#filter-form')[0].reset();
            $('.filter-box .select-picker').selectpicker("refresh");
            $('#reset-filters').addClass('d-none');
            showTable();
        });

       
        $('body').on('click', '.companysign', function() {
            row_id = $(this).data('user-row');
        //    console.log(row_id);
        })

        $('#save-signature').click(function() {
            var token = "{{ csrf_token() }}";
            var url = "{{route('vendors.companysign')}}";
            var signature = signaturePad.toDataURL('image/png');
            var signature_type = !$('.signature').hasClass('d-none') ? 'signature' : 'upload';
            if (signaturePad.isEmpty() && !$('.signature').hasClass('d-none')) {
                Swal.fire({
                    icon: 'error',
                    text: '{{ __('messages.signatureRequired') }}',

                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    showClass: {
                        popup: 'swal2-noanimation',
                        backdrop: 'swal2-noanimation'
                    },
                    buttonsStyling: false
                });
                return false;
            }
            $.easyAjax({
                        url: url,
                        type: "POST",
                        file: true,
                        container: '#acceptEstimate',
                        disableButton: true,
                        blockUI: true,
                        data:{
                            id:row_id,
                            '_token': token,
                            signature:signature,
                            signature_type:signature_type,
                            details:$('#acceptEstimate').serialize()
                        },
                        success: function(response) {
                            $('#signature-modal').modal('hide');
                            showTable();
                        }
                    });
                                                                                                                                                                                                                                                                                
        });


        $('body').on('click', '.delete-table-row', function() {
            const id = $(this).data('user-id');
            var token = "{{ csrf_token() }}";
            Swal.fire({
                title: "@lang('messages.sweetAlertTitle')",
                text:   "@lang('messages.recoverRecord')",
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
                    var url = "{{ route('vendors.destroy', ':id') }}";
                    url = url.replace(':id', id);
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
        
    </script>
    <script>
        var canvas = document.getElementById('signature-pad');

        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
        });

        document.getElementById('clear-signature').addEventListener('click', function (e) {
            e.preventDefault();
            signaturePad.clear();
        });

        document.getElementById('undo-signature').addEventListener('click', function (e) {
            e.preventDefault();
            var data = signaturePad.toData();
            if (data) {
                data.pop(); // remove the last dot or line
                signaturePad.fromData(data);
            }
        });
        $('#toggle-pad-uploader').click(function () {
            var text = $('.signature').hasClass('d-none') ? '{{ __("modules.estimates.uploadSignature") }}' : '{{ __("app.sign") }}';

            $(this).html(text);

            $('.signature').toggleClass('d-none');
            $('.upload-image').toggleClass('d-none');
        });
    </script>
    <script>
    $(document).ready(function() {
        var table = $('#vendors-table').DataTable(); // Ensure you're selecting the correct table ID

        // Enable horizontal scrolling and disable automatic width
        table.settings()[0].oFeatures.bAutoWidth = true; // Disable auto width
        table.settings()[0].oScroll.sX = "100%"; // Enable horizontal scroll

    });
    </script>
@endpush
