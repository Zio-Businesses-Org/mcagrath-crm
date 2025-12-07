

<div class="row">
    <div class="col-sm-12">
        <x-form id="save-data-form" method="PUT">
            <div class="add-client bg-white rounded">
                <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                    @lang('Vendor Contact Detail')</h4>

                <div class="row p-20">      
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text :fieldLabel="__('Company Name')" fieldName="vendor_name"
                        fieldId="vendor_name" :fieldPlaceholder="__('placeholders.name')" fieldRequired="true" :fieldValue="$vendor->vendor_name"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text :fieldLabel="__('POC')" fieldName="poc"
                            fieldId="poc" :fieldPlaceholder="__('Poc')" :fieldValue="$vendor->poc"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.tel fieldId="vendor_mobile" :fieldLabel="__('modules.lead.mobile')" fieldName="vendor_mobile"
                        :fieldPlaceholder="__('placeholders.mobile')" fieldRequired="true" :fieldValue="$vendor->vendor_number"></x-forms.tel>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.email fieldId="vendor_email" :fieldLabel="__('app.email')"
                        fieldName="vendor_email" :fieldPlaceholder="__('placeholders.email')" :fieldValue="$vendor->vendor_email" >
                        </x-forms.email>
                    </div>
                    
                    <div class="col-md-3 col-lg-3">
                        <x-forms.select fieldId="states" :fieldLabel="__('State')" fieldName="state" fieldRequired="true" search="true">
                        <option value="">--</option>
                        @foreach ($location as $locations)
                            <option @selected($vendor->state == $locations->state) value="{{ $locations->state }}">
                                {{ $locations->state }}</option>
                        @endforeach
                        </x-forms.select>
                    </div>
                    <div class="col-md-3 col-lg-3">
                            <x-forms.select fieldId="counties" :fieldLabel="__('County')" fieldName="county" fieldRequired="true" search="true">
                                <option value="">--</option>
                                @foreach ($counties as $locations)
                                    <option @selected($vendor->county == $locations->county) value="{{ $locations->county }}">
                                        {{ $locations->county }}</option>
                                @endforeach
                            </x-forms.select>
                    </div>
                    <div class="col-md-3 col-lg-3">
                            <x-forms.select fieldId="cities" :fieldLabel="__('City')" fieldName="city" fieldRequired="true" search="true">
                                <option value="">--</option>
                                @foreach ($cities as $locations)
                                    <option @selected($vendor->city == $locations->city) value="{{ $locations->city }}">
                                        {{ $locations->city }}</option>
                                @endforeach
                            </x-forms.select>
                    </div>
                    <div class="col-md-3 col-lg-3">
                            <x-forms.select fieldId="contractor_type" :fieldLabel="__('Contractor Type')" fieldName="contractor_type" fieldRequired="true" search="true">
                                <option value="">--</option>
                                @foreach ($contracttype as $ct)
                                    <option @selected($vendor->contractor_type == $ct->contractor_type) value="{{ $ct->contractor_type }}">
                                        {{ $ct->contractor_type }}</option>
                                @endforeach
                            </x-forms.select>
                    </div>
                    <div class="col-md-3 col-lg-3">
                            <x-forms.select fieldId="lead_source" :fieldLabel="__('Lead Source')" fieldName="lead_source"  search="true">
                                <option value="">--</option>
                                @foreach ($leadsource as $leadsources)
                                    <option @selected($vendor->lead_source == $leadsources->type) value="{{ $leadsources->type }}">
                                    {{ $leadsources->type }}</option>
                                @endforeach
                            </x-forms.select>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <x-forms.text fieldId="website" :fieldLabel="__('Website')"
                                fieldName="website" :fieldPlaceholder="__('Website')" :fieldValue="$vendor->website">
                        </x-forms.text>
                    </div>
                    <div class="col-md-3 col-lg-3">
                            <x-forms.datepicker fieldId="nxt_date"
                            :fieldLabel="__('Next Follow Up Date')" fieldName="nxt_date"
                            :fieldPlaceholder="__('placeholders.date')" :fieldValue="($vendor->nxt_date ? $vendor->nxt_date->format(company()->date_format) : '')"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.select fieldId="v_status" :fieldLabel="__('Status')"
                            fieldName="v_status" >
                            <option value="">--</option>
                            @foreach ($vendorStatuses as $status)
                                <option value="{{ $status->status }}" {{ $vendor->v_status === $status->status ? 'selected' : '' }}>
                                    {{ $status->status }}
                                </option>
                            @endforeach
                        </x-forms.select>
                    </div>       
                </div>
                <x-form-actions>
                    <x-forms.button-primary id="save-form" class="mr-3" icon="check">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-cancel :link="route('vendortrack.index')" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('#vendor_mobile').on('input', function () {
                let value = $(this).val().replace(/[^0-9]/g, '');  // Remove non-digit characters
                if (value.length > 10) {
                    value = value.slice(0, 10);  // Limit to 10 digits
                }
                $(this).val(value);
                
                if (value.length === 10) {
                    $('#save-form').prop('disabled', false);

                } 
                else if (value.length===0)
                {
                    $('#save-form').prop('disabled', false);

                }
                else {
                    $('#save-form').prop('disabled', true);

                }

            });
        $("#save-data-form .select-picker").selectpicker();

        const dp1 = datepicker('#nxt_date', {
                position: 'bl',
                ...datepickerConfig
            });

        $('#states').change( function() {
                var state_id = $(this).val();
                if (state_id) {
                    fetchCounties(state_id);
                    $('#counties').find('option:not(:first)').remove();
                    $('#cities').find('option:not(:first)').remove();
                }
        });

        $('#counties').change( function() {
                var county_id = $(this).val();
                if (county_id) {
                    fetchCities(county_id);
                    $('#cities').find('option:not(:first)').remove();
                }
        });

        function fetchCounties(state) {
            var url = "{{ route('locations.counties', ':state') }}";
            url = url.replace(':state', state);
                $.easyAjax({
                    url: url,
                    container: '#save-data-form',
                    method: 'GET',
                    blockUI: true,
                    success: function(data) {
                        
                        data.counties.forEach(county => {
                            $('#counties').append(`<option value="${county.county}">${county.county}</option>`);
                            $('#counties').selectpicker('refresh');
                            $('#cities').selectpicker('refresh');
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

            function fetchCities(county) {
                var url = "{{ route('locations.cities', ':county') }}";
                url = url.replace(':county', county);
                $.easyAjax({
                    url: url,
                    container: '#save-data-form',
                    method: 'GET',
                    blockUI: true,
                    success: function(data) {
                        data.cities.forEach(cities => {
        
                            $('#cities').append(`<option value="${cities.city}">${cities.city}</option>`);
                            $('#cities').selectpicker('refresh');
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        $('#save-form').click(function() {
            const url = "{{ route('vendortrack.update', $vendor->id) }}";
            $.easyAjax({
                url: url,
                container: '#save-data-form',
                type: "POST",
                disableButton: true,
                blockUI: true,
                file: true,
                buttonSelector: "#save-form",
                data: $('#save-data-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.href = response.redirectUrl;
                    }
                }
            })
        });

        init(RIGHT_MODAL);
    });

   
</script>
