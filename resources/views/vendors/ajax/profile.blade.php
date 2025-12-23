<!-- ROW START -->
<div class="row">
    

    <!--  USER CARDS START -->
    <div class="col-xl-7 col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4 mb-md-0">
        <div class="row">

            <div
                @class([
                    'col-lg-6 col-md-6 mb-4 mb-lg-0',
                    'col-xl-12' => !in_array('projects', user_modules()),
                    'col-xl-7' => in_array('projects', user_modules())
                ])>

                <x-cards.user :image="$vendorDetail->image_url">
                    <div class="row">
                        <div class="col-10">
                            <h4 class="card-title f-15 f-w-500 text-darkest-grey mb-0">
                            {{ $vendorDetail->vendor_name }}
                            </h4>
                        </div>
                        <div class="col-2 text-right">
                            <div class="dropdown">
                                <button class="btn f-14 px-0 py-0 text-dark-grey dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                    aria-labelledby="dropdownMenuLink" tabindex="0">
                                    <a class="dropdown-item openRightModal"
                                        href="{{ route('vendors.edit', $vendorDetail->id) }}">@lang('app.edit')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="f-13 font-weight-normal text-dark-grey mb-0">
                        {{ $vendorDetail->company_name }}
                    </p>
                    <p class="card-text f-12 text-lightest mb-1">@lang('app.lastLogin')</p>
                </x-cards.user>

            </div>
                
                <div class="col-xl-5 col-lg-6 col-md-6">
                    <x-cards.widget :title="__('modules.dashboard.totalProjects')" :value="$vendorDetail->project_vendor_count"
                        icon="layer-group" />
                </div>
        </div>
    </div>

    <!--  USER CARDS END -->

    <!--  WIDGETS START -->
    <div class="col-xl-5 col-lg-12 col-md-12">
        <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-4 mb-lg-0 mb-md-0">
                <x-cards.widget :title="__('modules.dashboard.totalEarnings')"
                    :value="0" icon="coins" />
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <x-cards.widget :title="__('modules.dashboard.totalUnpaidInvoices')"
                    :value="0" icon="file-invoice-dollar" />
            </div>
          
        </div>
    </div>
    <!--  WIDGETS END -->
 </div>
<!-- ROW END -->

<!-- ROW START -->
<div class="row mt-4">
    <div class="col-xl-7 col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
            <x-cards.data :title="__('modules.client.profileInfo')">
            <x-cards.data-row :label="__('status')" :value="$vendorDetail->status" />
            <x-cards.data-row :label="__('modules.employees.fullName')" :value="$vendorDetail->vendor_name" />
            
            <x-cards.data-row :label="__('app.email')" :value="$vendorDetail->vendor_email" />

            <x-cards.data-row :label="__('modules.client.companyName')" :value="$vendorDetail->company_name" />
            <x-cards.data-row :label="__('Website')" :value="$vendorDetail->website" />     
            <x-cards.data-row :label="__('Created At')" :value="$vendorDetail->created_at" />

            <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                    @lang('modules.profile.companyLogo')</p>
                <p class="mb-0 text-dark-grey f-14 w-70">
                        <img data-toggle="tooltip" style="height:50px;"
                    src="{{ $vendorDetail->image_url }}">
                    
                </p>
            </div>

            <x-cards.data-row :label="__('app.mobile')" :value="$vendorDetail->cell" />
            <x-cards.data-row :label="__('office')" :value="$vendorDetail->office" />
            <x-cards.data-row :label="__('contractor type')" :value="$vendorDetail->contractor_type" />

            <x-cards.data-row :label="__('street address')" :value="$vendorDetail->street_address" />
            <x-cards.data-row :label="__('city')" :value="$vendorDetail->city" />
            <x-cards.data-row :label="__('state')" :value="$vendorDetail->state" />
            <x-cards.data-row :label="__('county')" :value="$vendorDetail->county" />
            <x-cards.data-row :label="__('zipcode')" :value="$vendorDetail->zip_code" />
            <x-cards.data-row :label="__('licensed')" :value="$vendorDetail->licensed" />
            <x-cards.data-row :label="__('license expiry date')" :value="$vendorDetail->license_expiry_date" />
            <x-cards.data-row :label="__('insured')" :value="$vendorDetail->insured" />
            
            <x-cards.data-row :label="__('gl insurance carrier name')" :value="$vendorDetail->gl_insurance_carrier_name" />
            <x-cards.data-row :label="__('gl insurance carrier_phone')" :value="$vendorDetail->gl_insurance_carrier_phone" />
            <x-cards.data-row :label="__('gl insurance carrier email address')" :value="$vendorDetail->gl_insurance_carrier_email_address" />
            <x-cards.data-row :label="__('gl insurance expiry date')" :value="$vendorDetail->gl_insurance_expiry_date" />
            <x-cards.data-row :label="__('gl insurance policy number')" :value="$vendorDetail->gl_insurance_policy_number" />
            <x-cards.data-row :label="__('Workers comp available')" :value="$vendorDetail->Workers_comp_available" />
            <x-cards.data-row :label="__('wc insurance carrier name')" :value="$vendorDetail->wc_insurance_carrier_name" />
            <x-cards.data-row :label="__('wc insurance carrier phone')" :value="$vendorDetail->wc_insurance_carrier_phone" />
            <x-cards.data-row :label="__('wc insurance carrier email address')" :value="$vendorDetail->wc_insurance_carrier_email_address" />
            <x-cards.data-row :label="__('wc insurance expiry date')" :value="$vendorDetail->wc_insurance_expiry_date" />
            <x-cards.data-row :label="__('wc insurance policy number')" :value="$vendorDetail->wc_insurance_policy_number" />
            <x-cards.data-row :label="__('Waiver Status')" :value="$vendorDetail->waiver_form_status" />
            <x-cards.data-row :label="__('Waiver Sent Date')" :value="$vendorDetail->form_sent_date" />
            <x-cards.data-row :label="__('Waiver Signed Date')" :value="$vendorDetail->waiver_signed_date" />
            <x-cards.data-row :label="__('coverage by county')" :value="$vendorDetail->coverage_cities" />
            <x-cards.data-row :label="__('distance covered')" :value="$vendorDetail->distance_covered" />
            <x-cards.data-row :label="__('payment method')" :value="$joinedData" />
            <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                    Vendor Sign</p>
                <p class="mb-0 text-dark-grey f-14 w-70">
                    @if ($vendorDetail->contract_sign)
                        <img data-toggle="tooltip" style="height:50px;"
                    src="{{ $vendorDetail->secondary_image_url }}">
                    @else
                    --
                    @endif
                </p>
            </div>
            <x-cards.data-row :label="__('vendor signed date')" :value="$vendorDetail->signed_date" />
            <div class="col-12 px-0 pb-3 d-block d-lg-flex d-md-flex">
                <p class="mb-0 text-lightest f-14 w-30 d-inline-block text-capitalize">
                    Company Sign</p>
                <p class="mb-0 text-dark-grey f-14 w-70">
                    @if (company()->company_sign)
                        <img data-toggle="tooltip" style="height:50px;"
                    src="{{ company()->company_signature }}">
                    @else
                    --
                    @endif
                </p>
            </div>
        </x-cards.data>
    </div>
    <div class="col-xl-5 col-lg-12 col-md-12 ">
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card bg-white border-0 b-shadow-4">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ROW END -->

<script>
    
</script>
