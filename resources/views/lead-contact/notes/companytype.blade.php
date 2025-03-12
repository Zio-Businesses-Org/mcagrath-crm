@php
    $deleteCompanyTypePermission = user()->permission('manage_company_type');
@endphp

<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Company Type')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <!-- Company Type Table -->
    <x-table class="table-bordered" headType="thead-light">
        <x-slot name="thead">
            <th>#</th>
            <th>@lang('Type')</th>
            <th class="text-right">@lang('app.action')</th>
        </x-slot>
        @forelse($companyTypes ?? [] as $key => $item)
            <tr id="row-{{ $item->id }}">
                <td>{{ $key + 1 }}</td>
                <td data-row-id="{{ $item->id }}" contenteditable="true">{{ $item->type }}</td>
                <td class="text-right">
                 
                        <x-forms.button-secondary data-row-id="{{ $item->id }}" icon="trash" class="delete-row">
                            @lang('app.delete')
                        </x-forms.button-secondary>
                   
                </td>
            </tr>
        @empty
            <x-cards.no-record-found-list colspan="3" />
        @endforelse
    </x-table>

    <!-- Add New Company Type -->
 
    <x-form id="createCompanyType">
        <div class="row border-top-grey">
            <div class="col-sm-12">
                <x-forms.text fieldId="type" :fieldLabel="__('Type')" fieldName="type"
                    fieldRequired="true" :fieldPlaceholder="__('Enter a company type')">
                </x-forms.text>
            </div>
        </div>
    </x-form>
   
</div>

<div class="modal-footer">
    <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.close')</x-forms.button-cancel>
        <x-forms.button-primary id="save-company-type" icon="check">@lang('app.save')</x-forms.button-primary>
  
</div>

<script>
    // Function to refresh the company type dropdown
    function refreshCompanyTypes() {
        $.ajax({
            url: "{{ route('companyTypes.list') }}",
            type: "GET",
            success: function (response) {
                let companyTypeDropdown = $('#company_type');
                companyTypeDropdown.html('<option value="">-- Select Company Type --</option>');

                if (response.companyTypes && response.companyTypes.length > 0) {
                    response.companyTypes.forEach(function (companyType) {
                        companyTypeDropdown.append(
                            `<option value="${companyType.type}">${companyType.type}</option>`
                        );
                    });
                }

                companyTypeDropdown.selectpicker('refresh');
            }
        });
    }

    $('#save-company-type').click(function() {
    let formData = $('#createCompanyType').serialize();
    formData += '&company_id={{ $companyId ?? auth()->user()->company_id }}';

    $.easyAjax({
        url: "{{ route('company-types.store') }}",
        type: "POST",
        data: formData,
        success: function(response) {
            if (response.status === 'success') {
                $(MODAL_LG).modal('hide');
                refreshCompanyTypes();
                //window.location.reload(); // Refresh the page to reflect changes
            }
        }
    });
});

    // Delete Company Type
    $('body').on('click', '.delete-row', function() {
        var id = $(this).data('row-id');
        var url = "{{ route('company-types.destroy', ':id') }}".replace(':id', id);
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
                            $('#row-' + id).fadeOut(100, function() {
                                $(this).remove();
                            });
                            refreshCompanyTypes();
                            //window.location.reload(); // Refresh the page to reflect changes
                        }
                    }
                });
            }
        });
    });
    $('body').off('blur', '[contenteditable=true]').on('blur', '[contenteditable=true]', function() {
    let id = $(this).data('row-id');
    let value = $(this).text().trim();
    let url = "{{ route('company-types.update', '') }}/" + id;
    let token = "{{ csrf_token() }}";

    $.easyAjax({
        url: url,
        type: "PUT",
        data: {
            'type': value,
            'company_id': '{{ $companyId ?? auth()->user()->company_id }}',
            '_token': token
        },
        success: function(response) {
            if (response.status == 'success') {
                refreshCompanyTypes();
                //window.location.reload(); // Refresh the page to reflect changes
            }
        }
    });
});

    // // Prevent default form submission
    // $('#createCompanyType').submit(function(event) {
    //     event.preventDefault();
    // });
</script>