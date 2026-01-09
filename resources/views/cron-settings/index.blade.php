@extends('layouts.app')

@section('content')

    <!-- SETTINGS START -->
    <div class="w-100 d-flex ">

        @include('sections.setting-sidebar')

        <x-setting-card>

            <x-slot name="buttons">
                <div class="row" >
                    <div class="col-md-12 mb-3">
                        <x-forms.button-primary icon="plus" id="addCron" class="mb-2 mb-lg-0 mb-md-0">
                            @lang('Add Cron')
                        </x-forms.button-primary>
                    </div>
                </div>
            </x-slot>

            <x-slot name="header">
                <div class="s-b-n-header" id="tabs">
                    <h2 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                        @lang($pageTitle)</h2>
                </div>
                
            </x-slot>

            <div class="col-lg-12 col-md-12 ntfcn-tab-content-left w-100 p-4 ">
                <x-table class="border-0 pb-3 admin-dash-table table-hover">

                    <x-slot name="thead">
                        <th class="pl-20">#</th>
                        <th>@lang('Queue')</th>
                        <th>@lang('Queue Command')</th>
                        <th>@lang('Queue Description')</th>
                        <th>@lang('Remaining Jobs')</th>
                        <th>@lang('Failed Jobs')</th>
                        <th class="text-right pr-20">@lang('app.action')</th>
                    </x-slot>
                    @forelse($cron as $key => $crons)
                        <tr id="crons-{{ $crons->id }}">
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td> {{ $crons->queue }} </td>
                            <td> {{ $crons->queue_command }} </td>
                            <td> {{ $crons->queue_description }} </td>
                            <td>{{ $crons->jobs_count }}</td>
                            <td> {{ $crons->failed_jobs_count }} </td>
                            <td class="text-right">
                                <div class="task_view">
                                    <a href="javascript:;" data-category-id="{{ $crons->id }}"
                                    class="editCron task_view_more d-flex align-items-center justify-content-center">
                                        <i class="fa fa-edit icons mr-1"></i> @lang('app.edit')
                                    </a>
                                </div>
                                <div class="task_view mt-1 mt-lg-0 mt-md-0 ml-1">
                                    <a href="javascript:;" data-category-id="{{ $crons->id }}"
                                    class="delete-cron task_view_more d-flex align-items-center justify-content-center">
                                        <i class="fa fa-trash icons mr-1"></i> @lang('app.delete')
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <x-cards.no-record icon="map-marker-alt" :message="__('messages.noRecordFound')"/>
                            </td>
                        </tr>
                    @endforelse
                </x-table>
            </div>

        </x-setting-card>

    </div>
    <!-- SETTINGS END -->
@endsection

@push('scripts')
    <script>
    $('#addCron').click(function () {
        var url = "{{ route('cron-settings.create') }}";
        $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_LG, url);
    });
    $('.editCron').click(function () {

        var id = $(this).data('category-id');

        var url = "{{ route('cron-settings.edit', ':id') }}";
        url = url.replace(':id', id);

        $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_LG, url);
    });

    $('body').on('click', '.delete-cron', function () {

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
                
                var url = "{{ route('cron-settings.destroy', ':id') }}";
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
@endpush
