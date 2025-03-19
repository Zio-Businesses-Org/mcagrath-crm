@php
    $deleteExpenseCategoryPermission = user()->permission('manage_expense_category');
@endphp

<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Expense Status')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <x-table class="table-bordered" headType="thead-light">
        <x-slot name="thead">
            <th>#</th>
            <th>@lang('Statuss')</th>
            <th class="text-right">@lang('app.action')</th>
        </x-slot>

        @forelse($status ?? [] as $key => $item) 

            <tr id="row-{{ $item->id }}">
                <td>{{ $key + 1 }}</td>
                <td data-row-id="{{ $item->id }}" contenteditable="true">{{ $item->status }}</td>
                <td class="text-right">
                   
                    <x-forms.button-secondary data-row-id="{{ $item->id }}" icon="trash" class="delete-row-exp-status">
                        @lang('app.delete')
                    </x-forms.button-secondary>
                </td>
            </tr>
        @empty
            <x-cards.no-record-found-list colspan="4" />
        @endforelse
    </x-table>

    <x-form id="createExpenseStatus">
        <div class="row border-top-grey">
            <div class="col-sm-12">
                <x-forms.text fieldId="status" :fieldLabel="__('Status')" fieldName="status"
                    fieldRequired="true" :fieldPlaceholder="__('Enter a Status Name')">
                </x-forms.text>
            </div>
        </div>
    </x-form>
</div>
<div class="modal-footer">
    <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.close')</x-forms.button-cancel>
    <x-forms.button-primary id="save-status" icon="check">@lang('app.save')</x-forms.button-primary>
</div>



<script>

// ✅ Function to refresh the payment method dropdown
function refreshStatus() {
    $.ajax({
        url: "{{ route('expenseStatus.list') }}", // ✅ Fetch latest data
        type: "GET",
        success: function (response) {
            let StatusDropdown = $('#status_id');
            StatusDropdown.html('<option value="">--</option>');

            response.statusDrop.forEach(function (method) {
                StatusDropdown.append(
                    `<option value="${method.status}">${method.status}</option>`
                );
            });

            StatusDropdown.selectpicker('refresh'); // ✅ Refresh dropdown
        }
    });
}

// // ✅ Refresh dropdown on page load
// $(document).ready(function () {
//     refreshStatus();
// });

// ✅ Update dropdown after adding a new payment method
$('#save-status').click(function () {
    let formData = $('#createExpenseStatus').serialize();

    $.easyAjax({
        url: "{{ route('expenseStatus.store') }}",
        type: "POST",
        data: formData,
        success: function (response) {
            if (response.status === 'success') {
                refreshStatus(); // ✅ Refresh dropdown after adding
                $(MODAL_LG).modal('hide'); // ✅ Close modal
            }
        }
    });
});

// ✅ Delete Payment Method and Refresh Dropdown
$('body').on('click', '.delete-row-exp-status', function () {
    var id = $(this).data('row-id');
    var url = "{{ route('expenseStatus.destroy', ':id') }}".replace(':id', id);
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
                        refreshStatus(); // ✅ Refresh dropdown after deletion
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
    let url = "{{ route('expenseStatus.update', '') }}/"+id;
    let token = "{{ csrf_token() }}";

    $.easyAjax({
        url: url,
        type: "PUT",
        data: {
            'status': value,
            '_token': token,
            '_method': 'PUT'
        },
        success: function(response) {
            if (response.status == 'success') {
                refreshStatus(); // ✅ Refresh dropdown after update
            }
        }
    });
});

</script>
