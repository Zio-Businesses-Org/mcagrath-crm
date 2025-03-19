@php
    $deleteExpenseCategoryPermission = user()->permission('manage_expense_category');
@endphp

<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Expense Payment Method')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <x-table class="table-bordered" headType="thead-light">
        <x-slot name="thead">
            <th>#</th>
            <th>@lang('Payment Method')</th>
            <th class="text-right">@lang('app.action')</th>
        </x-slot>

        @forelse($paymentMethods ?? [] as $key => $item) 

            <tr id="row-{{ $item->id }}">
                <td>{{ $key + 1 }}</td>
                <td data-row-id="{{ $item->id }}" contenteditable="true">{{ $item->payment_method }}</td>
                <td class="text-right">
                    @if ($deleteExpenseCategoryPermission == 'all' || ($deleteExpenseCategoryPermission == 'added' && $item->added_by == user()->id))
                        <x-forms.button-secondary data-row-id="{{ $item->id }}" icon="trash" class="delete-row-payment">
                            @lang('app.delete')
                        </x-forms.button-secondary>
                    @endif
                </td>
            </tr>
        @empty
            <x-cards.no-record-found-list colspan="4" />
        @endforelse
    </x-table>

    <x-form id="createProjectPayment">
        <div class="row border-top-grey">
            <div class="col-sm-12">
                <x-forms.text fieldId="payment_method" :fieldLabel="__('Payment Method')" fieldName="payment_method"
                    fieldRequired="true" :fieldPlaceholder="__('Enter a payment method')">
                </x-forms.text>
            </div>
        </div>
    </x-form>
</div>
<div class="modal-footer">
    <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.close')</x-forms.button-cancel>
    <x-forms.button-primary id="save-payment" icon="check">@lang('app.save')</x-forms.button-primary>
</div>



<script>

// ✅ Function to refresh the payment method dropdown
function refreshPaymentMethods() {
    $.ajax({
        url: "{{ route('expensePaymentMethod.list') }}", // ✅ Fetch latest data
        type: "GET",
        success: function (response) {
            let paymentMethodDropdown = $('#payment_method_id');
            paymentMethodDropdown.html('<option value="">-- Select Payment Method --</option>');

            response.paymentMethods.forEach(function (method) {
                paymentMethodDropdown.append(
                    `<option value="${method.payment_method}">${method.payment_method}</option>`
                );
            });

            paymentMethodDropdown.selectpicker('refresh'); // ✅ Refresh dropdown
        }
    });
}

// ✅ Refresh dropdown on page load
$(document).ready(function () {
    refreshPaymentMethods();
});

// ✅ Update dropdown after adding a new payment method
$('#save-payment').click(function () {
    let formData = $('#createProjectPayment').serialize();

    $.easyAjax({
        url: "{{ route('expensePaymentMethod.store') }}",
        type: "POST",
        data: formData,
        success: function (response) {
            if (response.status === 'success') {
                refreshPaymentMethods(); // ✅ Refresh dropdown after adding
                $(MODAL_LG).modal('hide'); // ✅ Close modal
            }
        }
    });
});

// ✅ Delete Payment Method and Refresh Dropdown
$('body').off('click', '.delete-row-payment').on('click', '.delete-row', function () {
    var id = $(this).data('row-id');
    var url = "{{ route('expensePaymentMethod.destroy', ':id') }}".replace(':id', id);
    var token = "{{ csrf_token() }}";

    Swal.fire({
        title: "@lang('messages.sweetAlertTitle')",
        text: "@lang('messages.recoverRecord')",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "@lang('messages.confirmDelete')",
        cancelButtonText: "@lang('app.cancel')",
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
                        refreshPaymentMethods(); // ✅ Refresh dropdown after deletion
                    }
                }
            });
        }
    });
});

// ✅ Update Payment Method and Refresh Dropdown
$('body').off('blur', '[contenteditable=true]').on('blur', '[contenteditable=true]', function () {
    let id = $(this).data('row-id');
    let value = $(this).text().trim();
    let url = "{{ route('expensePaymentMethod.update', '') }}/"+id;
    let token = "{{ csrf_token() }}";

    $.easyAjax({
        url: url,
        type: "PUT",
        data: {
            'payment_method': value,
            '_token': token,
            '_method': 'PUT'
        },
        success: function(response) {
            if (response.status == 'success') {
                refreshPaymentMethods(); // ✅ Refresh dropdown after update
            }
        }
    });
});

</script>
