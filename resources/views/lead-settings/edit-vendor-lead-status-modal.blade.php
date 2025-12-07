<div class="modal-header">
    <h5 class="modal-title">@lang('Edit Vendor Lead Status')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<x-form id="editVendorLead" method="POST" class="ajax-form">
    <div class="modal-body">
        <div class="portlet-body">
            <div class="row">

                <div class="col-sm-12">
                    <x-forms.text fieldId="status" :fieldLabel="__('Vendor Lead Status')"
                        fieldName="status" fieldRequired="true" :fieldPlaceholder="__('Enter Vendor Lead Status Name')" :fieldValue="$vls->status">
                    </x-forms.text>
                </div>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.cancel')</x-forms.button-cancel>
        <x-forms.button-primary id="edit-vendorlead" icon="check">@lang('app.save')</x-forms.button-primary>
    </div>
</x-form>


<script>
    $('#edit-vendorlead').click(function () {
        $.easyAjax({
            container: '#editVendorLead',
            type: "PUT",
            disableButton: true,
            blockUI: true,
            buttonSelector: "#edit-vendorlead",
            url: "{{ route('VendorLeadStatus.update', $vls->id) }}",
            data: $('#editVendorLead').serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    window.location.reload();
                }
            }
        })
    });
</script>
