<div class="modal-header">
    <h5 class="modal-title">@lang('Add External File Type')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<x-form id="editFileType" method="POST" class="ajax-form">
    <div class="modal-body">
        <div class="portlet-body">
            <div class="row">

                <div class="col-sm-12">
                    <x-forms.text :fieldLabel="__('External File Type')"
                        fieldName="file_type"
                        fieldId="file_type"
                        fieldRequired="true"
                        :fieldValue="$file_type->file_type"/>
                </div>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.cancel')</x-forms.button-cancel>
        <x-forms.button-primary id="edit-file-type" icon="check">@lang('app.save')</x-forms.button-primary>
    </div>
</x-form>


<script>
    $('#edit-file-type').click(function () {
        $.easyAjax({
            container: '#editFileType',
            type: "PUT",
            disableButton: true,
            blockUI: true,
            buttonSelector: "#edit-file-type",
            url: "{{ route('FileType.update', $file_type->id) }}",
            data: $('#editFileType').serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    window.location.reload();
                }
            }
        })
    });
</script>
