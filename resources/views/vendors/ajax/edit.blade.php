

<div class="row">
    <div class="col-sm-12">
        <x-form id="save-data-form " method="PUT">
            <div class="add-client bg-white rounded">
                <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                    @lang('modules.employees.accountDetails')</h4>

                    <div class="row p-20">
                        <div class="col-lg-12">
                            <div class="row">
                            
                        
                                <div class="col-lg-4 col-md-6">
                                    <x-forms.text :fieldLabel="__('app.name')" fieldName="vendor_name"
                                                fieldId="vendor_name" :fieldPlaceholder="__('placeholders.name')" fieldRequired="true" :fieldValue="$vendor->vendor_name"/>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <x-forms.email fieldId="vendor_email" :fieldLabel="__('app.email')"
                                                fieldName="vendor_email" :fieldPlaceholder="__('placeholders.email')" fieldRequired="true" :fieldValue="$vendor->vendor_email">
                                    </x-forms.email>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <x-forms.tel fieldId="vendor_mobile" :fieldLabel="__('modules.lead.mobile')" fieldName="vendor_mobile"
                                                :fieldPlaceholder="__('placeholders.mobile')" fieldRequired="true" :fieldValue="$vendor->cell">
                                    </x-forms.tel>
                                </div>


                                <div class="col-lg-4 col-md-6">
                                    <x-forms.text :fieldLabel="__('app.company_name')" fieldName="company_name"
                                    fieldId="company_name"  fieldRequired="true" :fieldValue="$vendor->company_name"/>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <x-forms.text :fieldLabel="__('app.street_address')" fieldName="street_address"
                                    fieldId="street_address"  fieldRequired="true" :fieldValue="$vendor->street_address"/>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <x-forms.text :fieldLabel="__('app.city')" fieldName="city"
                                    fieldId="city"  fieldRequired="true" :fieldValue="$vendor->city"/>
                                </div>
                            </div>
                         </div>

                        <div class="col-lg-4 col-md-6">
                        <x-forms.text :fieldLabel="__('app.state')" fieldName="state"
                        fieldId="state"  fieldRequired="true" :fieldValue="$vendor->state"/>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <x-forms.text :fieldLabel="__('app.zipcode')" fieldName="zipcode"
                            fieldId="zipcode"  fieldRequired="true" :fieldValue="$vendor->zip_code"/>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <x-forms.text :fieldLabel="__('County')" fieldName="county" fieldId="county" :fieldValue="$vendor->county" fieldRequired="true"/>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <x-forms.text :fieldLabel="__('app.office')" fieldName="office"
                            fieldId="office"  fieldRequired="true" :fieldValue="$vendor->office"/>
                        </div>

                        <div class="col-lg-4 col-md-6">
                        <x-forms.text :fieldLabel="__('app.website')" fieldName="website"
                        fieldId="website"  :fieldValue="$vendor->website"/>
                        </div>
                        <div class="col-lg-4 col-md-6 upload-image">
                            <x-forms.file allowedFileExtensions="png jpg jpeg svg bmp" class="mr-0 mr-lg-2 mr-md-2"
                                                    :fieldLabel="__('modules.contracts.companyLogo')" fieldName="company_logo"
                                                    :fieldValue=" ($vendor->company_logo ? $vendor->image_url : null)" fieldId="company_logo" :popover="__('messages.fileFormat.ImageFile')"/>                
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group my-3">
                                <label class="f-14 text-dark-grey mb-12 w-100 "
                                    for="usr">@lang('app.licensed')</label>
                                <div class="d-flex">
                                    <x-forms.radio fieldId="lic-yes" :fieldLabel="__('app.yes')" fieldName="licensed"
                                        fieldValue="yes" :checked="($vendor->licensed=='yes') ? 'checked' : ''">
                                    </x-forms.radio>
                                    <x-forms.radio fieldId="lic-no" :fieldLabel="__('app.no')" fieldValue="no"
                                        fieldName="licensed" :checked="($vendor->licensed=='no') ? 'checked' : ''"></x-forms.radio>
                                    <x-forms.radio fieldId="lic-na" :fieldLabel="__('app.not_applicable')" fieldValue="not_applicable"
                                        fieldName="licensed" :checked="($vendor->licensed=='not_applicable') ? 'checked' : ''"></x-forms.radio>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <x-forms.text :fieldLabel="__('app.license')" fieldName="license"
                                fieldId="license"  :fieldValue="$vendor->license"/>
                        </div>
                        <div class="col-lg-4 col-md-6">
                        <x-forms.datepicker custom="true" fieldId="license_exp" 
                                :fieldLabel="__('app.license_expiry_date')" fieldName="license_exp"
                                :fieldPlaceholder="__('placeholders.date')" :fieldValue="$vendor->license_expiry_date"/>
                        </div> 
                    </div>
                    <div class="row p-20">
                        <div class="col-lg-4 col-md-6 my-1">
                            <div class="form-group my-3">
                                    <label class="f-14 text-dark-grey mb-12 w-100"
                                        for="usr">@lang('app.insured')</label>
                                    <div class="d-flex">
                                        <x-forms.radio fieldId="in-yes" :fieldLabel="__('app.yes')" fieldName="insured"
                                            fieldValue="yes" :checked="($vendor->insured=='yes') ? 'checked' : ''">
                                        </x-forms.radio>
                                        <x-forms.radio fieldId="in-no" :fieldLabel="__('app.no')" fieldValue="no"
                                            fieldName="insured" :checked="($vendor->insured=='no') ? 'checked' : ''"></x-forms.radio>
                                        <x-forms.radio fieldId="in-na" :fieldLabel="__('app.not_applicable')" fieldValue="not_applicable"
                                            fieldName="insured" :checked="($vendor->insured=='not_applicable') ? 'checked' : ''"></x-forms.radio>
                                    </div>
                            </div>
                        </div>


               
               
                    <div class="col-lg-4 col-md-6">
                       <x-forms.datepicker custom="true" fieldId="gl_ins_exp" 
                            :fieldLabel="__('app.GL_Insurance_Expiry_Date')" fieldName="gl_ins_exp"
                            :fieldPlaceholder="__('placeholders.date')" :fieldValue="$vendor->gl_insurance_expiry_date"/>
                    </div>
                    <div class="col-lg-4 col-md-6">
                    <x-forms.text :fieldLabel="__('GL Insurance Policy Number')" fieldName="gl_ins_pn" fieldId="gl_ins_pn" :fieldValue="$vendor->gl_insurance_policy_number"/>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <x-forms.text :fieldLabel="__('app.GL_Insurance_Carrier_Name')" fieldName="gl_ins_cn"
                            fieldId="gl_ins_cn"   :fieldValue="$vendor->gl_insurance_carrier_name"/>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <x-forms.text :fieldLabel="__('app.GL_Insurance_Carrier_Phone')" fieldName="gl_ins_cp"
                            fieldId="gl_ins_cp"   :fieldValue="$vendor->gl_insurance_carrier_phone"/>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <x-forms.email fieldId="gl_ins_em" :fieldLabel="__('app.GL_Insurance_Carrier_Email_Address')"
                            fieldName="gl_ins_em" :fieldPlaceholder="__('placeholders.email')"  :fieldValue="$vendor->gl_insurance_carrier_email_address">
                        </x-forms.email>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group my-3">
                                <label class="f-14 text-dark-grey mb-12 w-100 "
                                    for="usr">@lang('app.Workers_Comp_Available')</label>
                                <div class="d-flex">
                                    <x-forms.radio fieldId="wc-yes" :fieldLabel="__('app.yes')" fieldName="wca"
                                        fieldValue="yes" :checked="($vendor->Workers_comp_available=='yes') ? 'checked' : ''">
                                    </x-forms.radio>
                                    <x-forms.radio fieldId="wc-no" :fieldLabel="__('app.no')" fieldValue="no"
                                        fieldName="wca" :checked="($vendor->Workers_comp_available=='no') ? 'checked' : ''"></x-forms.radio>
                                    <x-forms.radio fieldId="wc-na" :fieldLabel="__('app.not_applicable')" fieldValue="not_applicable"
                                        fieldName="wca" :checked="($vendor->Workers_comp_available=='not_applicable') ? 'checked' : ''"></x-forms.radio>
                                    <x-forms.radio fieldId="wc-ex" :fieldLabel="__('Exempted')" fieldValue="exempted"
                                        fieldName="wca" :checked="($vendor->Workers_comp_available=='exempted') ? 'checked' : ''"></x-forms.radio>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                       <x-forms.datepicker custom="true" fieldId="wc_ins_exp" 
                            :fieldLabel="__('app.WC_Insurance_Expiry_Date')" fieldName="wc_ins_exp"
                            :fieldPlaceholder="__('placeholders.date')" :fieldValue="$vendor->wc_insurance_expiry_date"/>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <x-forms.text :fieldLabel="__('WC Insurance Policy Number')" fieldName="wc_ins_pn" fieldId="wc_ins_pn" :fieldValue="$vendor->wc_insurance_policy_number"/>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <x-forms.text :fieldLabel="__('app.WC_Insurance_Carrier_Name')" fieldName="wc_ins_cn"
                            fieldId="wc_ins_cn"   :fieldValue="$vendor->wc_insurance_carrier_name"/>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <x-forms.text :fieldLabel="__('app.WC_Insurance_Carrier_Phone')" fieldName="wc_ins_cp"
                            fieldId="wc_ins_cp"   :fieldValue="$vendor->wc_insurance_carrier_phone"/>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <x-forms.email fieldId="wc_ins_em" :fieldLabel="__('app.WC_Insurance_Carrier_Email_Address')"
                            fieldName="wc_ins_em" :fieldPlaceholder="__('placeholders.email')"  :fieldValue="$vendor->wc_insurance_carrier_email_address">
                        </x-forms.email>
                    </div>
                    <div class="col-lg-12 col-md-12 ntfcn-tab-content-left" style="border: 1px solid lightgrey; border-radius: 10px;">
                        <label class="f-14 font-weight-bold text-dark-grey float-left"
                        for="usr" style="position: absolute; top: -11px; left: 11px; background-color: white; padding: 2px 5px;">@lang('Wc Waiver Form')</label>
                        <x-forms.button-primary id="send-wc-form" class="mr-3 my-2 float-right" icon="check" data-vendor-id="{{ $vendor->id }}">@lang('Send Waiver Form')
                        </x-forms.button-primary>
                        <div class="table-responsive">
                            <x-table class="table-bordered">
                                <x-slot name="thead">
                                    <th width="35%">@lang('Form Status')</th>
                                    <th width="35%">@lang('Last Form Sent Date')</th>
                                    <th width="35%">@lang('Signed Date')</th>
                                </x-slot>
                                @if($vendor->waiver_form_status||$vendor->form_sent_date)
                                    <tr>
                                        <td>
                                            {{$vendor->waiver_form_status}}
                                        </td>
                                        <td>  
                                            {{$vendor->form_sent_date}}
                                        </td>
                                        <td>  
                                             {{$vendor->waiver_signed_date}}
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="4">
                                            <x-cards.no-record icon="map-marker-alt" :message="__('messages.noRecordFound')"/>
                                        </td>
                                    </tr>
                                @endif
                            </x-table>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 py-3"  style="border: 1px solid lightgrey; border-radius: 10px;">
                        <label class="f-14 font-weight-bold text-dark-grey float-left"
                        for="usr" style="position: absolute; top: -11px; left: 11px; background-color: white; padding: 2px 5px;">@lang('Verified')</label>
                            <div class="form-group d-flex">
                                <div class="mt-2 w-100">
                                    <x-forms.checkbox fieldId="license_check"
                                        :fieldLabel="__('License')" fieldName="license_check" :checked="$vendor->license_check" />
                                </div>
                                <div class="mt-2 w-100">
                                    <x-forms.checkbox fieldId="gl_insurance_check"
                                        :fieldLabel="__('GL Insurance')" fieldName="gl_insurance_check" :checked="$vendor->gl_insurance_check"/>
                                </div>
                                <div class="mt-2 w-100">
                                    <x-forms.checkbox fieldId="wc_check"
                                        :fieldLabel="__('WC')" fieldName="wc_check" :checked="$vendor->wc_check"/>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-2">
                        <x-forms.text :fieldLabel="__('Coverage By County')" fieldName="cc" fieldId="cc" fieldRequired="true" :fieldHelp="__('Type the counties that you cover')" :fieldValue="$vendor->coverage_cities"/>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-2">
                        <x-forms.select fieldId="contracttype" :fieldLabel="__('Contractor Type')" fieldName="contracttype" fieldRequired="true">
                            <option value="">--</option>
                            @foreach ($contracttype as $type)
                                <option value="{{ $type }}" {{ $vendor->contractor_type === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-2">
                        <x-forms.text :fieldLabel="__('Distance Covered')" fieldName="dc" fieldId="dc" fieldRequired="true" :fieldHelp="__('in miles')" :fieldValue="$vendor->distance_covered"/>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-2">
                        <x-forms.label class="my-3" fieldId="status"
                                       :fieldLabel="__('Status')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="status" id="status"
                                    data-live-search="true" @if(!in_array('admin', user_roles()) && $vendor->status=='DNU') disabled @endif>
                                <option value="">--</option>
                                <option @selected($vendor->status == 'Active') value="Active" data-content='<i class="fa fa-circle mr-2" style="color:#00b5ff;"></i>Active'>
                                <option @selected($vendor->status == 'InActive') value="InActive" data-content='<i class="fa fa-circle mr-2" style="color:#800080;"></i>InActive'>
                                <option @selected($vendor->status == 'Compliant') value="Compliant" data-content='<i class="fa fa-circle mr-2" style="color:#679c0d;"></i>Compliant'>
                                <option @selected($vendor->status == 'Snooze') value="Snooze" data-content='<i class="fa fa-circle mr-2" style="color:#FFA500;"></i>Snooze'>
                                <option @selected($vendor->status == 'Non Compliant') value="Non Compliant" data-content='<i class="fa fa-circle mr-2" style="color:#FFFF00;"></i>Non Compliant'>
                                <option @selected($vendor->status == 'DNU') value="DNU" data-content='<i class="fa fa-circle mr-2" style="color:#FF0000;"></i>DNU'>
                                <option @selected($vendor->status == 'On Hold') value="On Hold" data-content='<i class="fa fa-circle mr-2" style="color:#808080;"></i>On Hold'>
                            </select>
                        </x-forms.input-group>
                    </div>
                    <div class="col-lg-12 mt-4">
                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <label class='f-14 text-dark-grey mb-12'>Payment Methods ( Accepted By You )<sup class="f-14 mr-1">*</sup></label><br>
                                    @php
                                         $paymentMethods = json_decode($vendor->payment_methods, true) ?? [];
                                         
                                    @endphp
                                </div>
                                <div class="col-lg-4">
                                    <x-forms.checkbox 
                                    :fieldLabel="__('Credit Card')" 
                                    fieldName="payment_methods[]" 
                                    fieldId="credit_card" 
                                    fieldValue="credit_card"
                                    :checked="in_array('credit card', $paymentMethods) || in_array('credit_card', $paymentMethods)"/>
                                </div>
                                <div class="col-lg-4">
                                    <x-forms.checkbox 
                                        :fieldLabel="__('PayPal')" 
                                        fieldName="payment_methods[]" 
                                        fieldId="paypal" 
                                        fieldValue="paypal"
                                        :checked="in_array('paypal', $paymentMethods)"/>
                                 </div>
                                <div class="col-lg-4">
                                    <x-forms.checkbox 
                                    :fieldLabel="__('ACH')" 
                                    fieldName="payment_methods[]" 
                                    fieldId="ach" 
                                    fieldValue="ach"
                                    :checked="in_array('ach', $paymentMethods)"/>
                                </div>
                                <div class="col-lg-4 mt-2">
                                 <x-forms.checkbox 
                                    :fieldLabel="__('Check')" 
                                    fieldName="payment_methods[]" 
                                    fieldId="check" 
                                    fieldValue="check"
                                    :checked="in_array('check', $paymentMethods)"/>
                                </div>
                                <!-- <div class="col-lg-4 mt-2">
                                 <x-forms.checkbox 
                                    :fieldLabel="__('CashApp')" 
                                    fieldName="payment_methods[]" 
                                    fieldId="cashapp" 
                                    fieldValue="cashapp"
                                    :checked="in_array('cashapp', $paymentMethods)"/>
                                </div> -->
                                <div class="col-lg-4 mt-2">
                                 <x-forms.checkbox 
                                    :fieldLabel="__('Zelle')" 
                                    fieldName="payment_methods[]" 
                                    fieldId="zelle" 
                                    fieldValue="zelle"
                                    :checked="in_array('zelle', $paymentMethods)"/>
                                </div>
                                <div class="col-lg-4 mt-2">
                                 <x-forms.checkbox 
                                    :fieldLabel="__('Venmo')" 
                                    fieldName="payment_methods[]" 
                                    fieldId="venmo" 
                                    fieldValue="venmo"
                                    :checked="in_array('venmo', $paymentMethods)"/>
                                </div>
                            </div>                                     
                        </div>
            </div>

                <x-form-actions>
                    <x-forms.button-primary id="save-form" class="mr-3" icon="check">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-cancel :link="route('vendors.index')" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>

    </div>
</div>

<script>
    $(document).ready(function() {

        $("#save-data-form .select-picker").selectpicker();
        
        $('.custom-date-picker').each(function(ind, el) {
            datepicker(el, {
                position: 'bl',
                ...datepickerConfig
            });
        });
        $('#save-form').click(function() {
            const url = "{{ route('vendors.update', $vendor->id) }}";
            var checkboxes = document.querySelectorAll('input[name="payment_methods[]"]');
            var isChecked = Array.prototype.slice.call(checkboxes).some(x => x.checked);
            if (!isChecked) {
                $('#signature-modal').modal('hide');
                Swal.fire({
                icon: 'error',
                text: '{{ __('Payment Method Required') }}',

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
        
        $('#send-wc-form').click(function() {
            var id = $(this).data('vendor-id');
            var url="{{ route('vendors.sendwcform') }}";
            $.easyAjax({
                    url: url,
                    type: 'POST',
                    container: '#save-data-form',
                    blockUI: true,
                    disableButton: true,
                    buttonSelector: "#send-wc-form",
                    data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                        },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "{{ route('vendors.index') }}";
                        } 
                    },
                });
        });

        init(RIGHT_MODAL);
    });

   
</script>
