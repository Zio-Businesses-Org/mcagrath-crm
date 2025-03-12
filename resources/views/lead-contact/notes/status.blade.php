@php
    $deleteStatusPermission = user()->permission('manage_lead_status');
@endphp

<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Status Lead')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
     <!-- Status Lead Table -->
     <x-table class="table-bordered" headType="thead-light">
        <x-slot name="thead">
            <th>#</th>
            <th>@lang('Status')</th>
            <th class="text-right">@lang('app.action')</th>
        </x-slot>
        @forelse($statusLeads ?? [] as $key => $item)
        <tr id="row-{{ $item->id }}">
            <td>{{ $key + 1 }}</td>
            <td data-row-id="{{ $item->id }}" contenteditable="true">{{ $item->status }}</td>
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

    <!-- Add New Status Lead -->
    <x-form id="createStatusLead">
        <div class="row border-top-grey">
            <div class="col-sm-12">
                <x-forms.text fieldId="status" :fieldLabel="__('Status')" fieldName="status"
                    fieldRequired="true" :fieldPlaceholder="__('Enter a status')">
                </x-forms.text>
            </div>
        </div>
    </x-form>
</div>

<div class="modal-footer">
    <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.close')</x-forms.button-cancel>
    <x-forms.button-primary id="save-status-lead" icon="check">@lang('app.save')</x-forms.button-primary>
</div>

<script>
    // Function to refresh the status lead dropdown
    function refreshStatusLeads() {
        $.ajax({
            url: "{{ route('statusLeads.list') }}",
            type: "GET",
            success: function (response) {
                let statusLeadDropdown = $('#status_type');
                statusLeadDropdown.html('<option value="">-- Select Status --</option>');

                if (response.statusLeads && response.statusLeads.length > 0) {
                    response.statusLeads.forEach(function (statusLead) {
                        statusLeadDropdown.append(
                            `<option value="${statusLead.status}">${statusLead.status}</option>`
                        );
                    });
                }

                statusLeadDropdown.selectpicker('refresh');
            }
        });
    }

    // Save button click handler
    $('#save-status-lead').click(function() {
        let formData = $('#createStatusLead').serialize();
        formData += '&company_id={{ $companyId ?? auth()->user()->company_id }}';

        $.easyAjax({
            url: "{{ route('status-leads.store') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    $(MODAL_LG).modal('hide');
                    refreshStatusLeads();
                    //window.location.reload(); // Refresh the page to reflect changes
                }
            }
        });
    });

    // Delete Status Lead
    $('body').on('click', '.delete-row', function() {
        var id = $(this).data('row-id');
        var url = "{{ route('status-leads.destroy', ':id') }}".replace(':id', id);
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
                            // console.log(id)
                            $('#row-' + id).fadeOut(100, function() {
                                $(this).remove();
                            });
                            refreshStatusLeads();
                            //window.location.reload(); // Refresh the page to reflect changes
                        }
                    }
                });
            }
        });
    });

    // Update Status Lead
    $('body').off('blur', '[contenteditable=true]').on('blur', '[contenteditable=true]', function() {
        let id = $(this).data('row-id');
        let value = $(this).text().trim();
        let url = "{{ route('status-leads.update', '') }}/" + id;
        let token = "{{ csrf_token() }}";

        $.easyAjax({
            url: url,
            type: "PUT",
            data: {
                'status': value,
                'company_id': '{{ $companyId ?? auth()->user()->company_id }}',
                '_token': token
            },
            success: function(response) {
                if (response.status == 'success') {
                    refreshStatusLeads();
                    //window.location.reload(); // Refresh the page to reflect changes
                }
            }
        });
    });

</script>