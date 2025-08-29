<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Partial Pay Info')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>

<div class="modal-body">
    <x-forms.link-primary class="mr-3 openRightModal float-left mb-3" icon="plus"
                :link="route('partial-pay.create', [$expense->id, $expense->project?->id, $expense->projectvendor?->id])" id="addPartialPay">
                @lang('Add Partial Pay')
    </x-forms.link-primary>
    <x-table class="border-0 pb-3 admin-dash-table table-hover">

        <x-slot name="thead">
            <th class="pl-20">id</th>
            <th>@lang('Pay Date')</th>
            <th>@lang('Price')</th>
            <th>@lang('Payment Method')</th>
            <th>@lang('Additional Fee')</th>
            <th>@lang('Added By')</th>
            <th>@lang('Added Date')</th>
            <th class="text-right pr-20">@lang('app.action')</th>
        </x-slot>

        @forelse($expense->processPayment as $key=>$item)
            <tr id="row-{{ $item->id }}">
                <td class="pl-20">{{ $item->id }}</td>
                <td>
                    <a href="javascript:;" class="sow-detail text-darkest-grey f-w-500"
                        data-sow-id="{{ $item->id }}">{{ $item->payment_date->translatedFormat(company()->date_format) ?? ''}}</a>
                </td>
                <td>
                    {{$item->price??''}}
                </td>
                <td>
                    {{$item->payment_method??''}}
                </td>
                <td>
                    {{$item->additional_fee??''}}
                </td>
                <td>
                    {{$item->user->name ?? ''}}
                </td>
                <td>
                    {{$item->created_at->translatedFormat(company()->date_format)}}
                </td>
                <td class="text-right pr-20">
                    <div class="task_view">
                        @if($item->bill)
                        <a class="taskView sow-detail text-darkest-grey f-w-500"
                            target="_blank" href="{{ $item->bill_url }}">@lang('view bill')</a>
                        @endif
                        <div class="dropdown">
                            <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
                                type="link" id="dropdownMenuLink-{{ $item->id }}" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-options-vertical icons"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="dropdownMenuLink-{{ $item->id }}" tabindex="0">

                                <a class="dropdown-item edit-ppay" href="javascript:;"
                                    data-row-id="{{ $item->id }}">
                                    <i class="fa fa-edit mr-2"></i>
                                    @lang('app.edit')
                                </a>
                                
                                <a class="dropdown-item delete-row-partial" href="javascript:;"
                                    data-row-id="{{ $item->id }}">
                                    <i class="fa fa-trash mr-2"></i>
                                    @lang('app.delete')
                                </a>
                                
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
        @empty
            <x-cards.no-record-found-list colspan="5"/>
        @endforelse
    </x-table>
</div>

<!-- ROW END -->

<script>

    $('body').on('click', '.edit-ppay', function() {
        var id = $(this).data('row-id');

        var url = "{{ route('partial-pay.edit', ':id') }}";
        url = url.replace(':id', id);

        $(MODAL_XL + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_XL, url);

    });
    $('#addPartialPay').click(function() {
         $('.modal.show').modal('hide');
    });

    $('.delete-row-partial').click(function() {

        var id = $(this).data('row-id');
        var url = "{{ route('partial-pay.destroy', ':id') }}";
        url = url.replace(':id', id);

        var token = "{{ csrf_token() }}";

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
                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {
                        '_token': token,
                        '_method': 'DELETE'
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            $('#row-' + id).fadeOut();
                            window.location.reload();
                        }
                    }
                });
            }
        });

    });

</script>
