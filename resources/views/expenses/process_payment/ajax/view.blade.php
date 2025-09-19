<div class="row">
    <x-forms.button-primary icon="plus" id="addExpensePaymentStore" class="type-btn mb-3 ml-3">
                @lang('Add Payment Info')
    </x-forms.button-primary>
    <div class="col-sm-12">    
        <x-table class="border-0 pb-3 admin-dash-table table-hover expense-payment">

            <x-slot name="thead">
                <th class="pl-20">Id</th>
                <th>@lang('Pay Date')</th>
                <th>@lang('Price')</th>
                <th>@lang('Payment Method')</th>
                <th>@lang('Additional Fee')</th>
                <th>@lang('Added By')</th>
                <th>@lang('Added Date')</th>
                <th class="text-right pr-20">@lang('app.action')</th>
            </x-slot>
            
            @forelse($expense->processPayment as $key=>$item)
                @include('expenses.process_payment.table_partials', ['item' => $item])
            @empty
                <x-cards.no-record-found-list colspan="8"/>
            @endforelse
        </x-table>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('body').on('click', '.edit-exppay', function() {

            var id = $(this).data('row-id');

            var url = "{{ route('expensePayment.edit', ':id') }}";
            url = url.replace(':id', id);

            $(MODAL_XL + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);

        });

        $('#addExpensePaymentStore').click(function() {

            const url = "{{ route('expensePayment.create') }}" + "?id={{ $expense->id }}";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);

        });

        $('.delete-row-payment').click(function() {

            var id = $(this).data('row-id');
            var url = "{{ route('expensePayment.destroy', ':id') }}";
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
                                
                            }
                        }
                    });
                }
            });

        });
    });
</script>
