<div class="col-lg-12 col-md-12 ntfcn-tab-content-left w-100 p-4">

    <div class="table-responsive">
        <x-table class="table-bordered">
            <x-slot name="thead">
                <th>#</th>
                <th width="40%">@lang('Work Order Status')</th>
                <th style="width: 15%;">@lang('Filter On')</th>
                <th class="text-right">@lang('app.action')</th>
            </x-slot>

            @forelse($wostatus as $key => $category)
                <tr id="category-{{ $category->id }}">
                    <td>
                        {{ $key + 1 }}
                    </td>
                    <td> {{ $category->wo_status }} </td>
                    <td>
                        <select class="form-control select-picker filter-on-vendor" name="filter_on" id="filter_on_{{ $category->id }}" data-category-id="{{ $category->id }}">
                            <option value="">--</option>
                            <option value="open" @selected($category->filter_on == 'open')> Open </option>
                            <option value="close" @selected($category->filter_on == 'close')>Close</option>
                        </select>
                    </td>
                    <td class="text-right">
                        <div class="task_view">
                            <a href="javascript:;" data-category-id="{{ $category->id }}"
                               class="editWorkOrderStatus task_view_more d-flex align-items-center justify-content-center">
                                <i class="fa fa-edit icons mr-1"></i> @lang('app.edit')
                            </a>
                        </div>
                        <div class="task_view mt-1 mt-lg-0 mt-md-0 ml-1">
                            <a href="javascript:;" data-category-id="{{ $category->id }}"
                               class="delete-work-order-status task_view_more d-flex align-items-center justify-content-center">
                                <i class="fa fa-trash icons mr-1"></i> @lang('app.delete')
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <x-cards.no-record icon="map-marker-alt" :message="__('messages.noRecordFound')"/>
                    </td>
                </tr>
            @endforelse
        </x-table>
    </div>

</div>

<script>

    $('#addWorkOrderStatus').click(function () {
        var url = "{{ route('vendor-settings.createWorkOrderStatus') }}";
        $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_LG, url);
    });
    
    $('.editWorkOrderStatus').click(function () {

        var id = $(this).data('category-id');

        var url = "{{ route('WorkOrderStatus.edit', ':id') }}";
        url = url.replace(':id', id);

        $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_LG, url);
    });

    $('body').on('click', '.delete-work-order-status', function () {

        var id = $(this).data('category-id');

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
                
                var url = "{{ route('WorkOrderStatus.destroy', ':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";
                $.easyAjax({
                    type: 'POST',
                    url: url,
                    blockUI: true,
                    data: {
                        '_token': token,
                        '_method': 'DELETE'
                    },
                    success: function (response) {
                        if (response.status == "success") {
                            $('#category-' + id).fadeOut();
                        }
                    }
                });
            }
        });
    });
     $('.filter-on-vendor').change(function () {
        var id = $(this).data('category-id');
        var select = $(this).val();
        var url = "{{route('vendor-settings.changeFilterOn', ':id')}}";
        url = url.replace(':id', id);
        $.easyAjax({
            url: url,
            type: "POST",
            blockUI: true,
            data: {'id':id, 'filter_on': select, '_method': 'PUT', '_token': '{{ csrf_token() }}'},
            success: function (response) {
                if (response.status == "success") {
                    window.location.reload();
                }
            }
        })
    });

</script>
