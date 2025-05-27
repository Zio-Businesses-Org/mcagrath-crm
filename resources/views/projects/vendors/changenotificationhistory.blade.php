
<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Change Notification History')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<div class="modal-body" id="change-notification-history">
    <div class="row py-5">
        
        <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
            
            <x-table class="border-0 pb-3 admin-dash-table table-hover">

                <x-slot name="thead">
                    <th class="pl-20">#</th>
                    <th>@lang('Project Type')</th>
                    <th>@lang('Project Amount')</th>
                    <th>@lang('Link Status')</th>
                    <th>@lang('Link Sent By')</th>
                    <th>@lang('Added Date')</th>
                    <th class="text-right pr-20">@lang('app.action')</th>
                </x-slot>

                @forelse($projectvendor->changenotification as $key=>$item)
                    <tr id="row-{{ $item->id }}" @if($item->link_status == 'Removed') style="background-color: rgba(220, 53, 70, 0.76);" @endif>
                        <td class="pl-20">Change Order - {{$key+1}}</td>
                        <td>
                            <a href="javascript:;" class="sow-detail text-darkest-grey f-w-500"
                                data-sow-id="{{ $item->id }}">{{ $item->project_type }}</a>
                        </td>
                        <td>
                            {{$item->project_amount??''}}
                        </td>
                        <td>
                            {{$item->link_status??''}}
                        </td>
                        <td>
                            {{$item->added->name??''}}
                        </td>
                        <td>
                            {{$item->created_at->translatedFormat(company()->date_format)}}
                        </td>
                        <td class="text-right pr-20">
                            <div class="task_view">
                                <a href="javascript:;" data-row-id="{{ $item->id }}"
                                    class="toggle-showmore px-2 text-darkest-grey f-w-500"> <i class="fa fa-chevron-down"></i></a>
                            </div>
                            <div class="task_view">
                                <a href="javascript:;" data-link-id="{{ $item->id }}"
                                    class="px-2 text-darkest-grey f-w-500 relink-change"> <i class="fa fa-paper-plane"></i></a>
                            </div>
                            @if($item->link_status != 'Removed')
                            <div class="task_view">
                                <a href="javascript:;" data-remove-id="{{ $item->id }}"
                                    class="px-2 text-darkest-grey f-w-500 remove-link"> <i class="fa fa-times"></i></a>
                            </div>
                            @endif
                            @if(in_array('admin', user_roles()))
                            <div class="task_view">
                                <a href="javascript:;" data-delete-id="{{ $item->id }}"
                                    class="px-2 text-darkest-grey f-w-500 delete-link"> <i class="fa fa-trash"></i></a>
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr id="showmore-{{ $item->id }}" class="d-none">
                        <td colspan="7"> 
                            <x-cards.data>
                                @foreach($item->sow_id as $sow)
                                    <h5 class="f-13 font-weight-bold mb-4">Scope Of Work:</h5>
                                    <x-cards.data-row :label="__('Sow Title')" :value="$item->sow($sow)->sow_title" html="true" />
                                    <x-cards.data-row :label="__('Sow Description')" :value="$item->sow($sow)->description" html="true" />
                                @endforeach
                                    <x-cards.data-row :label="__('Additional notes')" :value="$item->add_notes" html="true" />
                            </x-cards.data>
                        </td>
                    </tr>
                @empty
                    <x-cards.no-record-found-list colspan="7"/>
                @endforelse
            </x-table>

        </div>

    </div>
</div>
<script>
    $(document).ready(function() {
    $('.toggle-showmore').click(function () {
            var id = $(this).data('row-id');
            $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-up');
            $('#showmore-'+id).toggleClass('d-none');
    });
    $('body').on('click', '.relink-change', function() {
        var id = $(this).data('link-id');
        var url="{{ route('projectvendorschangenotify.resentlink',':id') }}";
        url = url.replace(':id', id);
        $.easyAjax({
                url: url,
                type: 'POST',
                container:'#change-notification-history',
                blockUI: true,
                disableButton: true,
                buttonSelector: '.relink-change',
                data: {
                        _token: '{{ csrf_token() }}',
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
    });
    $('body').on('click', '.remove-link', function() {
        var id = $(this).data('remove-id');
        var url="{{ route('projectvendorschangenotify.removelink',':id') }}";
        url = url.replace(':id', id);
        $.easyAjax({
                url: url,
                type: 'POST',
                container:'#change-notification-history',
                blockUI: true,
                disableButton: true,
                buttonSelector: '.remove-link',
                data: {
                        _token: '{{ csrf_token() }}',
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
    });

    $('body').on('click', '.delete-link', function() {
        var id = $(this).data('delete-id');
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
                var url = "{{ route('change-notification.destroy', ':id') }}";
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
});
</script>

