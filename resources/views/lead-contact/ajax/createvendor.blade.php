<!-- @php
$viewLeadCategoryPermission = user()->permission('view_lead_category');
$viewLeadSourcesPermission = user()->permission('view_lead_sources');
$addLeadSourcesPermission = user()->permission('add_lead_sources');
$addLeadCategoryPermission = user()->permission('add_lead_category');
$addProductPermission = user()->permission('add_product');
@endphp -->

<link rel="stylesheet" href="{{ asset('vendor/css/dropzone.min.css') }}">

<div class="row">
    <div class="col-sm-12">
        <x-form id="save-lead-data-form" >
            <div class="add-client bg-white rounded">
                <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                    @lang('modules.leadContact.vendorDetails')</h4>
                <div class="row p-20">

                    <!-- Company Name -->
                    <div class="col-lg-3 col-md-6">
                        <x-forms.text :fieldLabel="__('Company Name')" fieldName="vendor_name"
                            fieldId="vendor_name" :fieldPlaceholder="__('Company Name')" fieldRequired="true" />
                    </div>

                    <!-- POC -->
                    <div class="col-lg-3 col-md-6">
                        <x-forms.text :fieldLabel="__('POC')" fieldName="poc"
                            fieldId="poc" :fieldPlaceholder="__('Poc')" />
                    </div>

                    <!-- Mobile -->
                    <div class="col-lg-3 col-md-6">
                        <x-forms.tel fieldId="vendor_mobile" :fieldLabel="__('modules.lead.mobile')" fieldName="vendor_mobile"
                           :fieldPlaceholder="__('placeholders.mobile')" fieldRequired="true"></x-forms.tel>
                    </div>

                    <!-- Email -->
                    <div class="col-lg-3 col-md-6">
                        <x-forms.email fieldId="vendor_email" :fieldLabel="__('app.email')"
                            fieldName="vendor_email" :fieldPlaceholder="__('placeholders.email')" :fieldHelp="__('modules.lead.leadEmailInfo')">
                        </x-forms.email>
                    </div>

                    <!-- State -->
                    <div class="col-md-3 col-lg-3">
                        <x-forms.select fieldId="state" :fieldLabel="__('State')" fieldName="state" fieldRequired="true" search="true">
                            <option value="">--</option>
                            @foreach ($location as $type)
                                <option value="{{ $type->state }}">{{ $type->state }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>

                    <!-- County -->
                    <div class="col-md-3 col-lg-3">
                        <x-forms.select fieldId="county" :fieldLabel="__('County')" fieldName="county" fieldRequired="true" search="true">
                            <option value="">--</option>
                        </x-forms.select>
                    </div>

                    <!-- City -->
                    <div class="col-md-3 col-lg-3">
                        <x-forms.select fieldId="city" :fieldLabel="__('City')" fieldName="city" fieldRequired="true" search="true">
                            <option value="">--</option>
                        </x-forms.select>
                    </div>

                    <!-- Contractor Type -->
                    <div class="col-md-3 col-lg-3">
                        <x-forms.select fieldId="contractor_type" :fieldLabel="__('Contractor Type')" fieldName="contractor_type" fieldRequired="true" search="true">
                            <option value="">--</option>
                            @foreach ($contracttype as $type)
                                <option value="{{ $type->contractor_type }}">{{ $type->contractor_type }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>

                    <!-- Lead Source -->
                    <div class="col-md-3 col-lg-3">
                        <x-forms.select fieldId="lead_source" :fieldLabel="__('Lead Source')" fieldName="lead_source" search="true">
                            <option value="">--</option>
                            @foreach ($leadsource as $type)
                                <option value="{{ $type->type }}">{{ $type->type }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>

                    <!-- Website -->
                    <div class="col-md-3 col-lg-3">
                        <x-forms.text fieldId="website" :fieldLabel="__('Website')" fieldName="website" :fieldPlaceholder="__('Website')">
                        </x-forms.text>
                    </div>

                    <!-- Next Follow Up Date -->
                    <div class="col-md-3 col-lg-3">
                        <x-forms.datepicker fieldId="nxt_date" :fieldLabel="__('Next Follow Up Date')" fieldName="nxt_date" :fieldPlaceholder="__('placeholders.date')" />
                    </div>

                    <!-- Status -->
                    <div class="col-lg-3 col-md-3">
                        <x-forms.select fieldId="v_status" :fieldLabel="__('Status')" fieldName="v_status" search="true">
                            <option value="">--</option>
                            @foreach ($vendorStatuses as $status)
                                <option value="{{ $status->status }}">{{ $status->status }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>

                    <!-- Notes Title -->
                    <div class="col-md-3 col-lg-3">
                        <x-forms.select fieldId="notes_title" :fieldLabel="__('Notes Title')" fieldName="notes_title" search="true" fieldRequired="true">
                            <option value="">--</option>
                            @foreach ($notestitle as $type)
                                <option value="{{ $type->notes_title }}">{{ $type->notes_title }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>

                    <!-- Notes -->
                    <div class="col-md-12">
                        <x-forms.textarea class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Notes')" fieldName="notes" fieldId="notes" fieldRequired="true" :fieldPlaceholder="__('Enter notes')">
                        </x-forms.textarea>
                    </div>
                </div>

                <!-- Form Actions -->
                <x-form-actions>
                    <x-forms.button-primary id="save-lead-form" class="mr-3" icon="check">@lang('app.save')</x-forms.button-primary>
                    <x-forms.button-secondary class="mr-3" id="save-email-form" icon="check-double">save and send proposal</x-forms.button-secondary>
                    <x-forms.button-cancel :link="route('lead-contact.index')" class="border-0">@lang('app.cancel')</x-forms.button-cancel>
                </x-form-actions>

            </div>
        </x-form>
    </div>
</div>

<!-- JavaScript Logic -->
<script>
    $(document).ready(function () {
        
    const stateSelect = $('#state');
    const countySelect = $('#county');
    const citySelect = $('#city');
    const contractorTypeSelect = $('#contractor_type');
    // Load stored values from localStorage
    const savedState = localStorage.getItem('selectedState');
    const savedCounty = localStorage.getItem('selectedCounty');
    const savedCity = localStorage.getItem('selectedCity');
    const savedContractorType = localStorage.getItem('selectedContractorType');
    const prePopulateEnabled = localStorage.getItem('prePopulateEnabled');

    if(prePopulateEnabled=='true'){

        if (savedContractorType) {
            contractorTypeSelect.val(savedContractorType); // Pre-fill Contractor Type
        }
        if (savedState) {
            stateSelect.val(savedState).trigger('change');
        }
    }
  

    stateSelect.change(function () {
        const state = $(this).val();
        localStorage.setItem('selectedState', state); // Save to localStorage
        if (state) {
            fetchCounties(state, savedCounty); // Fetch counties based on state and pass savedCounty to pre-select
        }
    });

    countySelect.change(function () {
        const county = $(this).val();
        localStorage.setItem('selectedCounty', county); // Save to localStorage
        if (county) {
            fetchCities(county, savedCity); // Fetch cities based on county and pass savedCity to pre-select
        }
    });

    citySelect.change(function () {
        const city = $(this).val();
        localStorage.setItem('selectedCity', city); // Save to localStorage
    });

    contractorTypeSelect.change(function () {
        const contractorType = $(this).val();
        localStorage.setItem('selectedContractorType', contractorType); // Save to localStorage
    });

    // Fetch counties based on state selection
    function fetchCounties(state, savedCounty = null) {
        var url = "{{ route('locations.counties', ':state') }}";
        url = url.replace(':state', state);
        $.easyAjax({
            url: url,
            container: '#save-lead-data-form',
            method: 'GET',
            blockUI: true,
            success: function (data) {
                countySelect.empty().append('<option value="">--</option>');
                data.counties.forEach(county => {
                    countySelect.append(`<option value="${county.county}">${county.county}</option>`);
                });
                if (savedCounty) {
                    countySelect.val(savedCounty).trigger('change'); // Pre-fill saved county and trigger change event to load cities
                }
                countySelect.selectpicker('refresh');
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    // Fetch cities based on county selection
    function fetchCities(county, savedCity = null) {
        var url = "{{ route('locations.cities', ':county') }}";
        url = url.replace(':county', county);
        $.easyAjax({
            url: url,
            container: '#save-lead-data-form',
            method: 'GET',
            blockUI: true,
            success: function (data) {
                citySelect.empty().append('<option value="">--</option>');
                data.cities.forEach(city => {
                    citySelect.append(`<option value="${city.city}">${city.city}</option>`);
                });
                if (savedCity) {
                    citySelect.val(savedCity); // Pre-fill saved city
                }
                citySelect.selectpicker('refresh');
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    // Trigger the state change manually to start the cascade if there's a saved state
    if(prePopulateEnabled=='true'){
    if (savedState) {
        stateSelect.trigger('change');
    }
    }
    $('#vendor_mobile').on('input', function () {
        let value = $(this).val().replace(/[^0-9]/g, '');  // Remove non-digit characters
        if (value.length > 10) {
            value = value.slice(0, 10);  // Limit to 10 digits
        }
        $(this).val(value);
        
        if (value.length === 10) {
            $('#save-lead-form').prop('disabled', false);
            $('#save-email-form').prop('disabled', false);
        } 
        else if (value.length===0)
        {
            $('#save-lead-form').prop('disabled', false);
            $('#save-email-form').prop('disabled', false);
        }
        else {
            $('#save-lead-form').prop('disabled', true);
            $('#save-email-form').prop('disabled', true);
        }

    });
    

    $("#save-lead-data-form .select-picker").selectpicker();

    const dp1 = datepicker('#nxt_date', {
        position: 'bl',
        ...datepickerConfig
    });

    $('#save-email-form').click(function () {
        var i=1;
        const url = "{{ route('vendor-crud.store') }}";
        var data = $('#save-lead-data-form').serialize();
        saveLead(data, url, "#save-email-form",i);
    });

    $('#save-lead-form').click(function() {
        var i=0;
        const url = "{{ route('vendor-crud.store') }}";
        var data = $('#save-lead-data-form').serialize();
        saveLead(data, url, "#save-lead-form",i);

    });

    function saveLead(data, url, buttonSelector,i) {
        $.easyAjax({
            url: url,
            container: '#save-lead-data-form',
            type: "POST",
            file: true,
            disableButton: true,
            blockUI: true,
            buttonSelector: buttonSelector,
            data: [data,i],
            success: function(response) {
                if( typeof response.redirectUrl !== 'undefined'){
                window.location.href = response.redirectUrl;
                }
                else{
                    window.location.reload();
                }
            }
        });

    }

});

</script>
