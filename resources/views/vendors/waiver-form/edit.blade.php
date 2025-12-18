<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Edit File')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<x-form id="exp_date" method="PUT">
    <div class="modal-body"> 
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <x-forms.datepicker custom="true" fieldId="expiry_date" 
                        :fieldLabel="__('Expiry Date')" fieldName="expiry_date"
                        :fieldPlaceholder="__('placeholders.date')" :fieldValue="$expiry_date->expiry_date  ? $expiry_date->expiry_date->format(company()->date_format) : ''"/>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.close')</x-forms.button-cancel>
        <x-forms.button-primary id="save" icon="check">@lang('app.save')</x-forms.button-primary>
    </div>
</x-form>
<script>
    $('#save').click(function() {
        var url = "{{ route('vendor-waiver.update', $expiry_date->id) }}";
        $.easyAjax({
            url: url,
            container: '#exp_date',
            type: "POST",
            blockUI: true,
            disableButton: true,
            buttonSelector: '#save',
            data: $('#exp_date').serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload();
                }
            }
        })
    });
    $('.custom-date-picker').each(function(ind, el) {
        datepicker(el, {
            position: 'bl',
            ...datepickerConfig
        });
    });
</script>