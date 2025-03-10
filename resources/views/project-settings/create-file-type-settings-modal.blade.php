<div class="modal-header">
    <h5 class="modal-title">@lang('Add External File Type')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<x-form id="createFileType" method="POST" class="ajax-form">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <x-forms.text fieldId="file_type" :fieldLabel="__('External File Type')"
                    fieldName="file_type" fieldRequired="true" :fieldPlaceholder="__('Enter file type')">
                </x-forms.text>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.cancel')</x-forms.button-cancel>
        <x-forms.button-primary id="save-file-type" icon="check">@lang('app.save')</x-forms.button-primary>
    </div>
</x-form>


<script>

    $('#save-file-type').click(function () {
        $.easyAjax({
            container: '#createFileType',
            type: "POST",
            disableButton: true,
            blockUI: true,
            buttonSelector: "#save-file-type",
            url: "{{ route('project-settings.saveFileType') }}",
            data: $('#createFileType').serialize(),
            success: function (response) {
                if (response.status === 'success') {
                    window.location.reload();
                }
            }
        })
    });
</script>
