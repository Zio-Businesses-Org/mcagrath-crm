<div class="col-lg-12 col-md-12 ntfcn-tab-content-left w-100 p-4">

    <div class="table-responsive">
        <x-table class="table-bordered">
            <x-slot name="thead">
                <th>#</th>
                <th width="35%">@lang('Priority Name')</th>
                <th class="text-right">@lang('app.action')</th>
            </x-slot>

            @forelse($projectPriority as $key => $category)
                <tr id="category-{{ $category->id }}">
                    <td>
                        {{ $key + 1 }}
                    </td>
                    <td> {{ $category->priority }} </td>
                    <td class="text-right">
                        <div class="task_view">
                            <a href="javascript:;" data-category-id="{{ $category->id }}"
                               class="editPriority task_view_more d-flex align-items-center justify-content-center">
                                <i class="fa fa-edit icons mr-1"></i> @lang('app.edit')
                            </a>
                        </div>
                        <div class="task_view mt-1 mt-lg-0 mt-md-0 ml-1">
                            <a href="javascript:;" data-category-id="{{ $category->id }}"
                               class="delete-priority task_view_more d-flex align-items-center justify-content-center">
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

    $('#addProjectPriority').click(function () {
        var url = "{{ route('project-settings.createPriority') }}";
        $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_LG, url);
    });
    $('.editPriority').click(function () {

        var id = $(this).data('category-id');

        var url = "{{ route('projectPriority.edit', ':id') }}";
        url = url.replace(':id', id);

        $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_LG, url);
    });

    $('body').on('click', '.delete-priority', function () {

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
                
                var url = "{{ route('projectPriority.destroy', ':id') }}";
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

</script>
