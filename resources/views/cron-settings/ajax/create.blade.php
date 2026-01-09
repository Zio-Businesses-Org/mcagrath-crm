<div class="modal-header">
    <h5 class="modal-title">@lang('Add Cron')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<x-form id="createCron" method="POST" class="ajax-form">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <x-forms.text fieldId="queue" :fieldLabel="__('Queue Name')"
                    fieldName="queue" fieldRequired="true" :fieldPlaceholder="__('Enter queue name')">
                </x-forms.text>
            </div>
            <div class="col-sm-12">
                <x-forms.text fieldId="queue_command" :fieldLabel="__('Queue Command')"
                    fieldName="queue_command" fieldRequired="true" :fieldPlaceholder="__('Enter queue command')">
                </x-forms.text>
            </div>
            <div class="col-sm-12">
                <x-forms.text fieldId="queue_description" :fieldLabel="__('Queue Description')"
                    fieldName="queue_description" fieldRequired="true" :fieldPlaceholder="__('Enter queue description')">
                </x-forms.text>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.cancel')</x-forms.button-cancel>
        <x-forms.button-primary id="save-cron" icon="check">@lang('app.save')</x-forms.button-primary>
    </div>
</x-form>


<script>
    $('#save-cron').click(function () {
        $.easyAjax({
            container: '#createCron',
            type: "POST",
            disableButton: true,
            blockUI: true,
            buttonSelector: "#save-cron",
            url: "{{ route('cron-settings.store') }}",
            data: $('#createCron').serialize(),
            success: function (response) {
                if (response.status === 'success') {
                    window.location.reload();
                }
            }
        })
    });
</script>
