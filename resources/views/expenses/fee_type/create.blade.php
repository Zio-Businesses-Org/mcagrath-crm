@php
    $deleteExpenseCategoryPermission = user()->permission('manage_expense_category');
@endphp

<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Expense Additional Fee Type')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>

<div class="modal-body">
    <!-- Additional Fee Method Table -->
    <x-table class="table-bordered" headType="thead-light">
        <x-slot name="thead">
            <th>#</th>
            <th>@lang('Fee Type')</th>
            <th class="text-right">@lang('app.action')</th>
        </x-slot>

        @forelse($feeMethods ?? [] as $key => $item) 
            <tr id="row-{{ $item->id }}">
                <td>{{ $key + 1 }}</td>
                <td data-row-id="{{ $item->id }}" contenteditable="true">{{ $item->fee_method }}</td>
                <td class="text-right">
                    @if ($deleteExpenseCategoryPermission == 'all' || ($deleteExpenseCategoryPermission == 'added' && $item->added_by == user()->id))
                        <x-forms.button-secondary data-row-id="{{ $item->id }}" icon="trash" class="delete-row">
                            @lang('app.delete')
                        </x-forms.button-secondary>
                    @endif
                </td>
            </tr>
        @empty
            <x-cards.no-record-found-list colspan="3" />
        @endforelse
    </x-table>

    <!-- Add New Fee Method -->
    <x-form id="createFeeMethod">
        <div class="row border-top-grey">
            <div class="col-sm-12">
                <x-forms.text fieldId="fee_method" :fieldLabel="__('Fee Method')" fieldName="fee_method"
                    fieldRequired="true" :fieldPlaceholder="__('Enter a fee method')">
                </x-forms.text>
            </div>
        </div>
    </x-form>
</div>

<div class="modal-footer">
    <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.close')</x-forms.button-cancel>
    <x-forms.button-primary id="save-fee-method" icon="check">@lang('app.save')</x-forms.button-primary>
</div>

<script>

// ✅ Function to refresh the fee method dropdown
function refreshFeeMethods() {
    $.ajax({
        url: "{{ route('expenseAdditionalFee.list') }}", // ✅ Fetch latest data
        type: "GET",
        success: function (response) {
            let feeMethodDropdown = $('#fee_method_id');
            feeMethodDropdown.html('<option value="">-- Select Fee Method --</option>');

            response.feeMethods.forEach(function (method) {
                feeMethodDropdown.append(
                    `<option value="${method.fee_method}">${method.fee_method}</option>`
                );
            });

            feeMethodDropdown.selectpicker('refresh'); // ✅ Refresh dropdown
        }
    });
}

// ✅ Refresh dropdown on page load
$(document).ready(function () {
    refreshFeeMethods();
});

// ✅ Update dropdown after adding a new fee method
$('#save-fee-method').click(function () {
    let formData = $('#createFeeMethod').serialize();

    $.easyAjax({
        url: "{{ route('expenseAdditionalFee.store') }}",
        type: "POST",
        data: formData,
        success: function (response) {
            if (response.status === 'success') {
                refreshFeeMethods(); // ✅ Refresh dropdown after adding
                $(MODAL_LG).modal('hide'); // ✅ Close modal
            }
        }
    });
});

// ✅ Delete Fee Method and Refresh Dropdown
$('body').off('click', '.delete-row').on('click', '.delete-row', function () {
    var id = $(this).data('row-id');
    var url = "{{ route('expenseAdditionalFee.destroy', ':id') }}".replace(':id', id);
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
                        refreshFeeMethods(); // ✅ Refresh dropdown after deletion
                    }
                }
            });
        }
    });
});

// ✅ Update Fee Method and Refresh Dropdown
$('body').off('blur', '[contenteditable=true]').on('blur', '[contenteditable=true]', function () {
    let id = $(this).data('row-id');
    let value = $(this).text().trim();
    //this is changed
    let url = "{{ route('expenseAdditionalFee.update', '') }}/" + id;

    let token = "{{ csrf_token() }}";

    $.easyAjax({
        url: url,
        type: "PUT",
        data: {
            'fee_method': value,
            '_token': token,
            '_method': 'PUT'
        },
        success: function(response) {
            if (response.status == 'success') {
                refreshFeeMethods(); // ✅ Refresh dropdown after update
            }
        }
    });
});

</script>
