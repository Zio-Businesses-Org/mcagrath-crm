<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Add Vendors')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<x-form id="addProjectVendorForm">
    <div class="modal-body">
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <div class="row">
                    <div class="col-md-6">
                        <x-forms.select fieldId="vendor_id"
                            :fieldLabel="__('Select Vendor')" fieldName="vendor_id" search="true" fieldRequired="true">
                                <option value="">--</option>
                                @foreach ($vendor as $category)
                                    @if(!in_array($category->id, $project->projectvendor->pluck('vendor_id')->toArray()))
                                    <option value="{{ $category->id }}" data-content='{{ $category->vendor_name}}<span class="d-none">{{$category->vendor_email}}</span><span class="d-none">{{$category->cell}}</span><span class="badge ml-2 text-gray-400" style="background-color: 
                                    {{ 
                                        $category->status === 'DNU' ? '#FF0000' : 
                                        ($category->status === 'Active' ? '#00b5ff' : 
                                        ($category->status === 'On Hold' ? '#808080' : 
                                        ($category->status === 'Compliant' ? '#679c0d' : 
                                        ($category->status === 'Snooze' ? '#FFA500' : 
                                        ($category->status === 'Non Compliant' ? '#FFFF00' : 
                                        '#000000')))))
                                    }};">{{$category->status}}</span>'>
                                    @endif
                                @endforeach
                        </x-forms.select>
                    </div>
                    <div class="col-md-6">  
                        <x-forms.select fieldId="project_vendor_type"
                            :fieldLabel="__('Project Category')" fieldName="project_vendor_type" search="true">
                                <option value="">--</option>
                                @foreach ($projecttype as $category)
                                    <option @selected($project->type == $category->type) value="{{ $category->type }}">
                                        {{ $category->type }}</option>
                                @endforeach
                        </x-forms.select>              
                    </div>
                    <div class="col-md-6" id="add_members">
                        <x-forms.select fieldId="addsow" :fieldLabel="__('Select Scope Of Works')" fieldName="sow_id[]" search="true" multiple="true" fieldRequired="true">
                            <option value="">--</option>
                            @foreach ($sow as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->sow_title }} - {{$category->category}} - {{$category->sub_category}}
                                </option>
                            @endforeach
                        </x-forms.select>
                    </div>
                    <div class="col-md-6">
                        <x-forms.select fieldId="contract_id"
                            :fieldLabel="__('Select Contract Template')" fieldName="contract_id" search="true" fieldRequired="true">
                                <option value="">--</option>
                                @foreach ($contract as $category)
                                    <option
                                        value="{{ $category->id }}">
                                        {{ $category->subject }} 
                                    </option>
                                @endforeach
                        </x-forms.select>
                    </div>
                    <div class="col-md-6">
                        <x-forms.number class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Project Amount')"
                            fieldName="project_amount" fieldId="project_amount" fieldRequired="true"
                            :fieldPlaceholder="__('Project Amount')" />                  
                    </div>
                    <div class="col-md-6" >
                        <x-forms.datepicker fieldId="due_date" fieldRequired="true"
                            :fieldLabel="__('Due Date')" fieldName="due_date"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    <div class="col-md-12">
                        <x-forms.textarea class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Additional Notes')"
                            fieldName="add_notes" fieldId="add_notes" 
                            :fieldPlaceholder="__('Enter Additional Notes')">
                        </x-forms.textarea>
                    </div>
                    
         </div>
    </div>
    <div class="modal-footer">
        <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.close')</x-forms.button-cancel>
        <x-forms.button-primary id="save-project-vendor" icon="check">@lang('app.save')</x-forms.button-primary>
    </div>

</x-form>

<script>

    $(document).ready(function() {
        $("#addProjectVendorForm .select-picker").selectpicker(); 
        const dp1 = datepicker('#due_date', {
                position: 'bl',
                ...datepickerConfig
            }); 
        
    });
    $('#save-project-vendor').click(function() {
        var url = "{{ route('projectvendors.store') }}";
        $.easyAjax({
            url: url,
            container: '#addProjectVendorForm',
            type: "POST",
            blockUI: true,
            disableButton: true,
            buttonSelector: '#save-project-vendor',
            data: $('#addProjectVendorForm').serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload();
                }
            }
        })
    });
</script>
