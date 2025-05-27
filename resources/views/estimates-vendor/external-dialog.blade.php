<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Generate Link')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<x-form id="generateLinkForm">
    <div class="modal-body">
        <div class="row">
                    
            <div class="col-md-6">  
                <x-forms.select fieldId="project_id"
                    :fieldLabel="__('Project Short Code')" fieldName="project_id" search="true" fieldRequired="true">
                        <option value="">--</option>
                        @foreach ($project as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->project_short_code }}</option>
                        @endforeach
                </x-forms.select>              
            </div>
            <div class="col-md-6">
                <x-forms.select fieldId="vendor_id"
                    :fieldLabel="__('Project Vendor')" fieldName="vendor_id" search="true" fieldRequired="true">
                        <option value="">--</option>
                </x-forms.select>
            </div>
                    
         </div>
    </div>
    <div class="modal-footer">
        <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.close')</x-forms.button-cancel>
        <x-forms.button-primary id="generate-link-estimate" icon="share">@lang('Generate')</x-forms.button-primary>
    </div>

</x-form>
<script>

    $(document).ready(function() {
        $("#project_id,#vendor_id").selectpicker();
        $('body').on("change", '#project_id', function() {
            if ($('#project_id').val() != '') {
                var id = $('#project_id').val();
                var url = "{{ route('vendors.vendors_list_expense', ':id') }}";
                url = url.replace(':id', id);
                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    url: url,
                    container: '#save-expense-data-form',
                    type: "POST",
                    blockUI: true,
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#vendor_id').html(response.data);
                            $('#vendor_id').selectpicker('refresh');
                        }
                    }
                });
            }
        });

        $('#generate-link-estimate').click(function() {
            var url="{{ route('vendor-estimates.generateLink') }}";
            if ($('#project_id').val() == ''||$('#vendor_id').val() == '')
            {
                Swal.fire({
                    icon: 'error',
                    text: '{{ __('Select Short Code and Vendor') }}',

                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    showClass: {
                        popup: 'swal2-noanimation',
                        backdrop: 'swal2-noanimation'
                    },
                    buttonsStyling: false
                });
                return false;
            }
            $.easyAjax({
                url: url,
                container: '#save-expense-data-form',
                type: "POST",
                blockUI: true,
                buttonSelector: "#generate-link-estimate",
                data: $('#generateLinkForm').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        navigator.clipboard.writeText(response.url).then(function() {
                            Swal.fire({
                                icon: 'success',
                                text: '{{ __('Link Copied') }}',

                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                },
                                showClass: {
                                    popup: 'swal2-noanimation',
                                    backdrop: 'swal2-noanimation'
                                },
                                buttonsStyling: false
                            });
                        }).catch(function(err) {
                            console.error('Failed to copy text: ', err);
                        });
                    }
                }
            });

        });
    });
</script>