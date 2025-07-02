@php
$addInvoicePermission = user()->permission('add_invoices');
@endphp

<!-- ROW START -->
<div class="row py-3 py-lg-5 py-md-5">

        <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
            <!-- Add Task Export Buttons Start -->
            <div class="d-flex" id="table-actions">
                @if (($addInvoicePermission == 'all' || $addInvoicePermission == 'added') && !$project->trashed())
                        <x-forms.link-primary
                            :link="route('vendor-estimates.create').'?project_id='.$project->id"
                            class="mr-3 openRightModal" icon="plus" data-redirect-url="{{ url()->full() }}">
                            @lang('Create Estimates')
                        </x-forms.link-primary>

                @endif
            </div>
            <!-- Add Task Export Buttons End -->
            <div class="col-md-4 d-flex align-items-center my-3 border-grey p-2">
                <h4 class="f-21 font-weight-normal text-capitalize mb-0 me-2">
                    Total Vendor Estimate:
                </h4>
                <span class="ml-2">
                    {{ currency_format($project->total_vendor_estimate ?? 0, $project->currency_id) }}
                </span>
            </div>

            <form action="" id="filter-form">
                <div class="d-block d-lg-flex d-md-flex my-3">
                
                    <div class="select-box py-2 px-lg-2 px-md-2 px-0 mr-3">
                        <x-forms.label fieldId="status" />
                        <div class="input-group bg-grey rounded">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-additional-grey">
                                    <i class="fa fa-search f-13 text-dark-grey"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control f-14 p-1 height-35 border" id="search-text-field"
                                placeholder="@lang('app.startTyping')">
                        </div>
                    </div>
                    <!-- SEARCH BY TASK END -->

                    <!-- RESET START -->
                    <div class="select-box d-flex py-2 px-lg-2 px-md-2 px-0 mt-4">
                        <x-forms.button-secondary class="btn-xs d-none height-35" id="reset-filters"
                            icon="times-circle">
                            @lang('app.clearFilters')
                        </x-forms.button-secondary>
                    </div>
                    <!-- RESET END -->
                </div>
            </form>

            <!-- Task Box Start -->
            <div class="d-flex flex-column w-tables rounded mt-3 bg-white">

                {!! $dataTable->table(['class' => 'table table-hover border-0 w-100']) !!}

            </div>
            <!-- Task Box End -->

        </div>


</div>
<!-- ROW END -->
@include('sections.datatable_js')

<script>
    $('#vendor-estimates-table').on('preXhr.dt', function(e, settings, data) {

        var projectID = "{{ $project->id }}";
        var status = $('#status').val();
        var searchText = $('#search-text-field').val();
        data['projectID'] = projectID;
        data['status'] = status;
        data['searchText'] = searchText;
    });
    const showTable = () => {
        window.LaravelDataTables["vendor-estimates-table"].draw(false);
    }

    $('#clientID, #project_id, #status')
        .on('change keyup',
            function() {
                if ($('#project_id').val() != "all") {
                    $('#reset-filters').removeClass('d-none');
                    showTable();
                } else if ($('#status').val() != "all") {
                    $('#reset-filters').removeClass('d-none');
                    showTable();
                } else if ($('#clientID').val() != "all") {
                    $('#reset-filters').removeClass('d-none');
                    showTable();
                } else {
                    $('#reset-filters').addClass('d-none');
                    showTable();
                }
            });

    $('#search-text-field').on('keyup', function() {
        if ($('#search-text-field').val() != "") {
            $('#reset-filters').removeClass('d-none');
            showTable();
        }
    });

    $('#reset-filters').click(function() {
        $('#filter-form')[0].reset();

        $('.filter-box .select-picker').selectpicker("refresh");
        $('#reset-filters').addClass('d-none');
        showTable();
    });



    $('body').on('click', '.delete-table-row', function() {
        var id = $(this).data('estimate-id');
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
                var url = "{{ route('vendor-estimates.destroy', ':id') }}";
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
    $('#vendor-estimates-table').on('change', '.change-cbid', function() {
            var id = $(this).data('row-id');
            var value =  $(this).val();
            var url="{{ route('vendors.changecbid',':id') }}";
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

</script>
