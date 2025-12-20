
<div class="col-lg-12 col-md-12 ntfcn-tab-content-left w-100 p-4 d-flex">
    <div class="row">
        <div class="col-md-3 col-lg-4">
            <x-forms.select fieldId="contract_id"
                :fieldLabel="__('Select WC Waiver Form Template')" fieldName="contract_id" search="true" fieldRequired="true">
                    <option value="">--</option>
                    @foreach ($contract as $category)
                        <option value="{{ $category->id }}" @if($wform){{ $wform->waiver_template === $category->contract_detail ? 'selected' : '' }}@endif>
                            {{ $category->subject }} 
                        </option>
                    @endforeach
            </x-forms.select>
        </div>
        @php
            $selectedVendorStatus = $vendor_status->vendor_status ?? [];
        @endphp
        
        <div class="col-md-3 col-lg-4">
            <x-forms.select fieldId="vendor_status"
                :fieldLabel="__('Select Vendor Status For Work Order')" fieldName="vendor_status[]" search="true" fieldRequired="true" multiple>
                    <option value="">--</option>
                    <option value="Active" {{ in_array('Active', $selectedVendorStatus) ? 'selected' : '' }} data-content='<i class="fa fa-circle mr-2" style="color:#00b5ff;"></i>Active'>
                    <option  value="Compliant" {{ in_array('Compliant', $selectedVendorStatus) ? 'selected' : '' }} data-content='<i class="fa fa-circle mr-2" style="color:#679c0d;"></i>Compliant'>
                    <option  value="Snooze" {{ in_array('Snooze', $selectedVendorStatus) ? 'selected' : '' }} data-content='<i class="fa fa-circle mr-2" style="color:#FFA500;"></i>Snooze'>
                    <option  value="Non Compliant" {{ in_array('Non Compliant', $selectedVendorStatus) ? 'selected' : '' }} data-content='<i class="fa fa-circle mr-2" style="color:#FFFF00;"></i>Non Compliant'>
                    <option  value="DNU" {{ in_array('DNU', $selectedVendorStatus) ? 'selected' : '' }} data-content='<i class="fa fa-circle mr-2" style="color:#FF0000;"></i>DNU'>
                    <option  value="On Hold" {{ in_array('On Hold', $selectedVendorStatus) ? 'selected' : '' }} data-content='<i class="fa fa-circle mr-2" style="color:#808080;"></i>On Hold'>
            </x-forms.select>
        </div>
        <div class="col-md-3 col-lg-4">
            <x-forms.label class="mt-3" fieldId="category_id"
                            :fieldLabel="__('External Estimate Notification Email')" fieldRequired="true">
            </x-forms.label>
            <x-forms.input-group>
                <input type="email" id="selfnotifymail" name="selfnotifymail" class="form-control" placeholder="e.g. johndoe@example.com" aria-label="Email Address" value="{{ $vendor_general_settings->selfnotifymail ?? '' }}">
                <x-slot name="append">
                    <button id="saveselfnotifymail" type="button"
                            class="btn btn-outline-secondary border-grey"
                            data-toggle="tooltip" data-original-title="{{__('Save Email Address') }}">@lang('Save')</button>
                </x-slot>
            </x-forms.input-group>
        </div>
        <div class="col-md-3 col-lg-4">
            <x-forms.label class="mt-3" fieldId="waiver_id"
                            :fieldLabel="__('Waiver Form Acknowledgment Email')" fieldRequired="true" :popover="__('If not specified. Default company email address will be taken')">
            </x-forms.label>
            <x-forms.input-group>
                <input type="email" id="selfwaivernotificationmail" name="selfwaivernotificationmail" class="form-control" 
                placeholder="e.g. johndoe@example.com" aria-label="Email Address" 
                value="{{ $vendor_general_settings->selfwaivernotificationmail ?? '' }}">
                <x-slot name="append">
                <button id="saveselfwaivernotificationmail" type="button"
                        class="btn btn-outline-secondary border-grey"
                        data-toggle="tooltip" data-original-title="{{__('Save Email Address') }}">@lang('Save')</button>
                </x-slot>
            </x-forms.input-group>
        </div>
        <!-- <div class="col-md-3 col-lg-4">
            <x-forms.toggle-switch class="mr-0 mr-lg-2 mr-md-2" :checked="$vendor_general_settings->duplicate_entry_check"
                :fieldLabel="__('Vendor Lead Duplicate Entry Check')" fieldName="duplicate_entry" fieldId="duplicate_entry" />
        </div> -->
    </div>
</div>

<script>
 $(document).ready(function() {
    $('#contract_id').change(function() {
        var select = $(this).val();
        var url="{{ route('vendor-settings.store') }}";
        $.easyAjax({
                url: url,
                type: 'POST',
                blockUI: true,
                data: {
                        _token: '{{ csrf_token() }}',
                        value: select,
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
    });
    $('#vendor_status').change(function() {
        var select = $(this).val();
        var url="{{ route('vendor-work-status.store') }}";
        $.easyAjax({
                url: url,
                type: 'POST',
                blockUI: true,
                data: {
                        _token: '{{ csrf_token() }}',
                        value: select,
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
    });
    $('#saveselfnotifymail').click(function() {
        var mail = $('#selfnotifymail').val();
        var url="{{ route('vendor-settings.saveSelfNotifyMail') }}";
        $.easyAjax({
                url: url,
                type: 'POST',
                blockUI: true,
                data: {
                        _token: '{{ csrf_token() }}',
                        value: mail,
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
    });
    $('#saveselfwaivernotificationmail').click(function() {
        var mail = $('#selfwaivernotificationmail').val();
        var url="{{ route('vendor-settings.selfWaiverNotificationMail') }}";
        $.easyAjax({
                url: url,
                type: 'POST',
                blockUI: true,
                data: {
                        _token: '{{ csrf_token() }}',
                        value: mail,
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
    });
    $('#duplicate_entry').change(function() {
        let value = $(this).is(':checked') ? 1 : 0;
        var url="{{ route('vendor-settings.toggleDuplicateEntry') }}";
        $.easyAjax({
                url: url,
                type: 'POST',
                blockUI: true,
                data: {
                        _token: '{{ csrf_token() }}',
                        value: value,
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
    });
});
</script>

