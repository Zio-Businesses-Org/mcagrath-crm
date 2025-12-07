<div class="modal-header">
    <h5 class="modal-title">@lang('Add Vendor Lead Status')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<x-form id="createVendorLeadStatus" method="POST" class="ajax-form">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <x-forms.text fieldId="status" :fieldLabel="__('Vendor Lead Status')"
                    fieldName="status" fieldRequired="true" :fieldPlaceholder="__('Enter Vendor Lead Status Name')">
                </x-forms.text>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.cancel')</x-forms.button-cancel>
        <x-forms.button-primary id="save-sow-title" icon="check">@lang('app.save')</x-forms.button-primary>
    </div>
</x-form>


<script>
    $('#save-sow-title').click(function () {
        $.easyAjax({
            container: '#createVendorLeadStatus',
            type: "POST",
            disableButton: true,
            blockUI: true,
            buttonSelector: "#save-sow-title",
            url: "{{ route('VendorLeadStatus.store') }}",
            data: $('#createVendorLeadStatus').serialize(),
            success: function (response) {
                if (response.status === 'success') {
                    window.location.reload();
                }
            }
        })
    });
</script>
