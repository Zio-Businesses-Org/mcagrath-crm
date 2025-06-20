<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/datepicker.min.css') }}">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/css/simple-line-icons.css') }}">

    <!-- Template CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('css/main.css') }}">
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('vendor/css/dropzone.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <title>@lang($pageTitle)</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $company->favicon_url }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ $company->favicon_url }}">
    <meta name="theme-color" content="#ffffff">

    @include('sections.theme_css', ['company' => $company])

    @isset($activeSettingMenu)
        <style>
            .preloader-container {
                margin-left: 510px;
                width: calc(100% - 510px)
            }

        </style>
    @endisset

    @stack('styles')

    <style>
        :root {
            --fc-border-color: #E8EEF3;
            --fc-button-text-color: #99A5B5;
            --fc-button-border-color: #99A5B5;
            --fc-button-bg-color: #ffffff;
            --fc-button-active-bg-color: #171f29;
            --fc-today-bg-color: #f2f4f7;
        }

        .preloader-container {
            height: 100vh;
            width: 100%;
            margin-left: 0;
            margin-top: 0;
        }

        .fc a[data-navlink] {
            color: #99a5b5;
        }

        .light-grey-border-div {
        border: 2px solid lightgrey; 
        }

    </style>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/modernizr.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</head>

<body id="body" class="h-100 bg-additional-grey">

<div class="content-wrapper container">

    <div class="bg-white rounded b-shadow-4 create-inv">
        <!-- HEADING START -->
        <div class="px-lg-4 px-md-4 px-3 py-3">
            <h4 class="mb-0 f-21 font-weight-normal text-capitalize">@lang('Vendor Estimate Details')</h4>
        </div>
        <!-- HEADING END -->
        <hr class="m-0 border-top-grey">
        <!-- FORM START -->
        <x-form class="c-inv-form" id="saveInvoiceForm">
            <!-- INVOICE NUMBER, DATE, DUE DATE, FREQUENCY START -->
            <div class="row px-lg-4 px-md-4 px-3 py-3">
                <!-- INVOICE NUMBER START -->
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-4">
                        <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr">@lang('modules.estimates.estimatesNumber')</label>
                        <div class="input-group">
                            <div class="input-group-prepend  height-35 ">
                                <span class="input-group-text border-grey f-15 bg-additional-grey px-3 text-dark"
                                    id="basic-addon1">{{ $invoiceSetting->estimate_prefix }}{{ $invoiceSetting->estimate_number_separator }}{{ $zero }}</span>
                            </div>
                            <input type="text" name="estimate_number" id="estimate_number"
                                class="form-control height-35 f-15"
                                value="@if (is_null($lastEstimate)) 1 @else{{ $lastEstimate }} @endif"
                                placeholder="0019" aria-label="0019" aria-describedby="basic-addon1" readOnly/>
                        </div>
                    </div>
                </div>
                <!-- INVOICE NUMBER END -->
                <!-- INVOICE DATE START -->
                <div class="col-md-6 col-lg-4">
                    <div class="form-group mb-4">
                        <x-forms.label fieldId="due_date" :fieldLabel="__('modules.estimates.validTill')" fieldRequired="true">
                        </x-forms.label>
                        <div class="input-group">
                            <input type="text" id="valid_till" name="valid_till"
                                class="px-6 position-relative text-dark font-weight-normal form-control height-35 rounded p-0 text-left f-15"
                                placeholder="@lang('placeholders.date')"
                                value="{{ Carbon\Carbon::today()->addDays(30)->format($company->date_format) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-4">
                        <x-forms.label fieldId="project" :fieldLabel="__('Project')" fieldRequired="true">
                        </x-forms.label>
                        <div class="input-group">
                            <input type="hidden" id="project_id" name="project_id" value="{{$project->id}}"/>
                            <input type="text" id="project_short" name="project_short"
                                class="px-6 position-relative text-dark font-weight-normal form-control height-35 rounded p-0 text-left f-15"
                                value="{{ $project->project_short_code }}" readOnly/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-none">
                    <div class="form-group c-inv-select mb-4">
                        <x-forms.label fieldId="currency_id" :fieldLabel="__('modules.invoices.currency')">
                        </x-forms.label>

                        <div class="select-others height-35 rounded">
                            <select class="form-control select-picker" name="currency_id" id="currency_id">
                                @foreach ($currencies as $currency)
                                    <option
                                        @if (isset($estimate)) @selected ($currency->id == $estimate->currency_id)
                                    @else @selected ($currency->id == $company->currency_id)
                                        @selected ($estimateTemplate && $currency->id == $estimateTemplate->currency_id)
                                    @endif
                                        value="{{ $currency->id }}">
                                        {{ $currency->currency_code . ' (' . $currency->currency_symbol . ')' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-4">
                        <x-forms.label fieldId="vendor" :fieldLabel="__('Vendor')" fieldRequired="true">
                        </x-forms.label>
                        <div class="input-group">
                            <input type="hidden" id="vendor_id" name="vendor_id" value="{{$vendor->vendor_id}}"/>
                            <input type="text" id="vendor_name" name="vendor_name"
                                class="px-6 position-relative text-dark font-weight-normal form-control height-35 rounded p-0 text-left f-15"
                                value="{{ $vendor->vendor_name }}" readOnly/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-3 ">
                    <div class="form-group mb-4">
                        <x-forms.label fieldId="property_address" :fieldLabel="__('Full Property Address')" fieldRequired="true">
                        </x-forms.label>
                        <div class="input-group">
                            <input type="text" id="property" name="property"
                                class="px-6 position-relative text-dark font-weight-normal form-control height-35 rounded p-0 text-left f-15"
                                value="{{ $project->propertyDetails->property_address }}" readOnly/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-3 ">
                    <h4 class="mb-0 f-21 font-weight-normal">Estimates/Quotes: NO pricing discussion with Tenants at any cost.
                        ALL quotes MUST have detailed costs for each line item (Should include necessary measurements or counts and labor and material costs). 
                        ALL quotes should be inclusive of additional fees/taxes, if any. 
                        Post Bid approval, additional amount for such fees or taxes will strictly be NOT considered or entertained.</h2>
                </div>

                <!-- CLIENT END -->

                <div class="col-md-12 my-3 d-none">
                    <div class="form-group">
                        <x-forms.label fieldId="description" :fieldLabel="__('app.description')">
                        </x-forms.label>
                        <div id="description">{!! isset($estimate) ? $estimate->description : ($estimateTemplate ? $estimateTemplate->description : '') !!}</div>
                        <textarea name="description" id="description-text" class="d-none"></textarea>
                    </div>
                </div>

            </div>
            <!-- INVOICE NUMBER, DATE, DUE DATE, FREQUENCY END -->

            <hr class="m-0 border-top-grey">

            <div id="sortable">
                    
                <div class="d-flex px-4 py-3 c-inv-desc item-row">

                    <div class="c-inv-desc-table w-100 d-lg-flex d-md-flex d-block">
                        <table width="100%">
                            <tbody>
                                <tr class="text-dark-grey font-weight-bold f-14">
                                    <td width="{{ $invoiceSetting->hsn_sac_code_show ? '40%' : '50%' }}"
                                        class="border-0 inv-desc-mbl btlr">@lang('app.description')</td>
                                    @if ($invoiceSetting->hsn_sac_code_show)
                                        <td width="10%" class="border-0" align="right">@lang('app.hsnSac')</td>
                                    @endif
                                    <td width="10%" class="border-0" align="right">
                                        @lang('modules.invoices.qty')
                                    </td>
                                    <td width="10%" class="border-0" align="right">
                                        @lang('modules.invoices.unitPrice')
                                    </td>
                                    <td width="17%" class="border-0 bblr-mbl" align="right">
                                        @lang('modules.invoices.amount')</td>
                                </tr>
                                <tr>
                                    <td class="border-bottom-0 btrr-mbl btlr">
                                        <input type="text" class="f-14 border-0 w-100 item_name form-control"
                                            name="item_name[]" placeholder="Item Name  (To mention if it is Drywall, Plumbing, Electrical, Etc)">
                                    </td>
                                    <td class="border-bottom-0 d-block d-lg-none d-md-none">
                                        <textarea class="form-control f-14 border-0 w-100 mobile-description" name="item_summary[]"
                                            placeholder="@lang('placeholders.invoices.description')"></textarea>
                                    </td>
                                    @if ($invoiceSetting->hsn_sac_code_show)
                                        <td class="border-bottom-0">
                                            <input type="text" min="1"
                                                class="f-14 border-0 w-100 text-right hsn_sac_code form-control"
                                                value="" name="hsn_sac_code[]">
                                        </td>
                                    @endif
                                    <td class="border-bottom-0">
                                        <input type="number" min="1"
                                            class="form-control f-14 border-0 w-100 text-right quantity mt-3"
                                            value="1" name="quantity[]">
                                            <select class="text-dark-grey float-right border-0 f-12" name="unit_id[]">
                                                @foreach ($units as $unit)
                                                    <option
                                                        @selected ($unit->default == 1)
                                                    value="{{ $unit->id }}">{{ $unit->unit_type }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="product_id[]" value="">
                                    </td>
                                    <td class="border-bottom-0">
                                        <input type="number" min="1"
                                            class="f-14 border-0 w-100 text-right cost_per_item form-control"
                                            placeholder="0.00" value="0" name="cost_per_item[]">
                                    </td>
                                                    
                                    <td rowspan="2" align="right" valign="top" class="bg-amt-grey btrr-bbrr">
                                        <span class="amount-html">0.00</span>
                                        <input type="hidden" class="amount" name="amount[]" value="0">
                                    </td>
                                </tr>
                                <tr class="d-none d-md-table-row d-lg-table-row">
                                    <td colspan="{{ $invoiceSetting->hsn_sac_code_show ? '4' : '3' }}"
                                        class="dash-border-top bblr">
                                        <textarea class="f-14 border-0 w-100 desktop-description form-control" name="item_summary[]"
                                            placeholder="Enter Description (Describe the issue and details of the repair to be completed. If irreparable, reason it cannot be repaired and replacement details.)"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <a href="javascript:;"
                            class="d-flex align-items-center justify-content-center ml-3 remove-item"><i
                                class="fa fa-times-circle f-20 text-lightest"></i></a>
                    </div>
                </div>
                    <!-- DESKTOP DESCRIPTION TABLE END -->
            </div>
            <!--  ADD ITEM START-->
            <div class="row px-lg-4 px-md-4 px-3 pb-3 pt-0 mb-3  mt-2">
                <div class="col-md-12">
                    <a class="f-15 f-w-500" href="javascript:;" id="add-item"><i
                            class="icons icon-plus font-weight-bold mr-1"></i>Add Item ( To add if multiple repairs are applicable)</a>
                </div>
            </div>
            <!--  ADD ITEM END-->

            <hr class="m-0 border-top-grey">

            <!-- TOTAL, DISCOUNT START -->
            <div class="d-flex px-lg-4 px-md-4 px-3 pb-3 c-inv-total">
                <table width="100%" class="text-right f-14 text-capitalize">
                    <tbody>
                        <tr>
                            <td width="50%" class="border-0 d-lg-table d-md-table d-none"></td>
                            <td width="50%" class="p-0 border-0 c-inv-total-right">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" class="border-top-0 text-dark-grey">
                                                @lang('modules.invoices.subTotal')</td>
                                            <td width="30%" class="border-top-0 sub-total">0.00</td>
                                            <input type="hidden" class="sub-total-field" name="sub_total"
                                                value="0">
                                        </tr>
                                        <tr class="d-none">
                                            <td width="20%" class="text-dark-grey">@lang('modules.invoices.discount')
                                            </td>
                                            <td width="40%" style="padding: 5px;">
                                                <table width="100%" class="mw-250">
                                                    <tbody>
                                                        <tr>
                                                            <td width="70%" class="c-inv-sub-padding">
                                                                <input type="number" min="0"
                                                                    name="discount_value"
                                                                    class="form-control f-14 border-0 w-100 text-right discount_value"
                                                                    placeholder="0"
                                                                    {{ isset($estimteTemplate) ? $estimateTemplate->discount : '0' }}
                                                                    </td>
                                                            <td width="30%" align="left" class="c-inv-sub-padding">
                                                                <div
                                                                    class="select-others select-tax height-35 rounded border-0">
                                                                    <select class="form-control select-picker"
                                                                        id="discount_type" name="discount_type">
                                                                        <option
                                                                            @selected(isset($estimateTemplate) && $estimateTemplate->discount_type == 'percent')
                                                                            value="percent">%
                                                                        </option>
                                                                        <option
                                                                            @selected(isset($estimateTemplate) && $estimateTemplate->discount_type == 'fixed')
                                                                            value="fixed">
                                                                            @lang('modules.invoices.amount')</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td><span
                                                    id="discount_amount">@if(isset($estimate)) {{ number_format((float) $estimate->discount, 2, '.', '') }} @else 0.00 @endif </span>
                                            </td>
                                        </tr>
                                        
                                        <tr class="bg-amt-grey f-16 f-w-500">
                                            <td colspan="2">@lang('modules.invoices.total')</td>
                                            <td><span class="total">0.00</span></td>
                                            <input type="hidden" class="total-field" name="total" value="0">
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- TOTAL, DISCOUNT END -->

            <!-- NOTE AND TERMS AND CONDITIONS START -->
            <div class="d-flex flex-wrap px-lg-4 px-md-4 px-3 py-3">
                <!-- <div class="col-md-6 col-sm-12 c-inv-note-terms p-0 mb-lg-0 mb-md-0 mb-3">
                    <x-forms.label fieldId="" class="text-capitalize" :fieldLabel="__('modules.invoices.note')">
                    </x-forms.label>
                    <textarea class="form-control" name="note" id="note" rows="4" placeholder="@lang('placeholders.invoices.note')"></textarea>
                </div> -->
                <div class="col-md-6 col-sm-12 p-0 c-inv-note-terms">
                    <x-forms.label fieldId="" :fieldLabel="__('modules.invoiceSettings.invoiceTerms')">
                    </x-forms.label>
                    <p>
                        Thank you for your business.<br/><br/>
                        {{$vendor->vendor_name}}<br/>
                        Email : {{$vendor->vendor_email_address}}<br/>
                        Phone : {{$vendor->vendor_phone}}
                    </p>
                </div>
            </div>
            <div class="row px-lg-4 px-md-4 px-3 py-3">
                <!-- INVOICE NUMBER START -->
                <div class="col-md-12">
                    <x-forms.file-multiple class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Add Files - (Add Photos, Pdf, etc)')" fieldName="file" fieldId="file-upload-dropzone"/>
                </div>
                <input type="hidden" name="estimateId" id="estimateId">
            </div>
            
            <!-- NOTE AND TERMS AND CONDITIONS END -->

            <!-- CANCEL SAVE SEND START -->
            
            <x-form-actions class="c-inv-btns">
                <div class="d-flex mb-3">
                    <x-forms.button-primary class="border-0 save-form">@lang('app.send')
                    </x-forms.button-primary>
                </div>

            </x-form-actions>
            <!-- CANCEL SAVE SEND END -->

        </x-form>
        
        <!-- FORM END -->
    </div>

</div>
<script>
    const DROPZONE_FILE_ALLOW = "{{ global_setting()->allowed_file_types }}";
    const DROPZONE_MAX_FILESIZE = "{{ global_setting()->allowed_file_size }}";
    const DROPZONE_MAX_FILES = "{{ global_setting()->allow_max_no_of_files }}";

    Dropzone.prototype.defaultOptions.dictFallbackMessage = "{{ __('modules.projectTemplate.dropFallbackMessage') }}";
    Dropzone.prototype.defaultOptions.dictFallbackText = "{{ __('modules.projectTemplate.dropFallbackText') }}";
    Dropzone.prototype.defaultOptions.dictFileTooBig = "{{ __('modules.projectTemplate.dropFileTooBig') }}";
    Dropzone.prototype.defaultOptions.dictInvalidFileType = "{{ __('modules.projectTemplate.dropInvalidFileType') }}";
    Dropzone.prototype.defaultOptions.dictResponseError = "{{ __('modules.projectTemplate.dropResponseError') }}";
    Dropzone.prototype.defaultOptions.dictCancelUpload = "{{ __('modules.projectTemplate.dropCancelUpload') }}";
    Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "{{ __('modules.projectTemplate.dropCancelUploadConfirmation') }}";
    Dropzone.prototype.defaultOptions.dictRemoveFile = "{{ __('modules.projectTemplate.dropRemoveFile') }}";
    Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "{{ __('modules.projectTemplate.dropMaxFilesExceeded') }}";
    Dropzone.prototype.defaultOptions.dictDefaultMessage = "{{ __('modules.projectTemplate.dropFile') }}";
    Dropzone.prototype.defaultOptions.timeout = 0;
    const datepickerConfig = {
        formatter: (input, date, instance) => {
            input.value = moment(date).format('{{ $company->moment_format }}')
        },
        showAllDates: true,
        customDays: {!!  json_encode(\App\Models\GlobalSetting::getDaysOfWeek())!!},
        customMonths: {!!  json_encode(\App\Models\GlobalSetting::getMonthsOfYear())!!},
        customOverlayMonths: {!!  json_encode(\App\Models\GlobalSetting::getMonthsOfYear())!!},
        overlayButton: "@lang('app.submit')",
        overlayPlaceholder: "@lang('app.enterYear')",
        startDay: parseInt("{{ attendance_setting()->week_start_from }}")
    };
    
</script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
  const quill = new Quill('#description', {
    theme: 'snow',
  });
</script>
<script>
    $(document).ready(function() {
        
        let defaultImage = '';
        let lastIndex = 0;
        var projectID=$('#project_id').val();
        Dropzone.autoDiscover = false;
        //Dropzone class
        invoiceDropzone = new Dropzone("div#file-upload-dropzone", {
            dictDefaultMessage: "{{ __('app.dragDrop') }}",
            url: "{{ route('vendor-estimates.storeext.file') }}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            paramName: "file",
            maxFilesize: DROPZONE_MAX_FILESIZE,
            maxFiles: DROPZONE_MAX_FILES,
            autoProcessQueue: false,
            uploadMultiple: true,
            addRemoveLinks: true,
            parallelUploads: DROPZONE_MAX_FILES,
            acceptedFiles: DROPZONE_FILE_ALLOW,
            init: function () {
                invoiceDropzone = this;
            }
        });
        invoiceDropzone.on('sending', function (file, xhr, formData) {
            const estimateId = $('#estimateId').val();
            formData.append('estimates_id', estimateId);
            formData.append('default_image', defaultImage);
            $.easyBlockUI();
        });
        invoiceDropzone.on('uploadprogress', function () {
            $.easyBlockUI();
        });
        
        invoiceDropzone.on('queuecomplete', function () {
            $.easyUnblockUI(); // stop spinner/block UI
            $(".save-form").prop("disabled", true); 
            showalert();
            
        });
        invoiceDropzone.on('removedfile', function () {
            var grp = $('div#file-upload-dropzone').closest(".form-group");
            var label = $('div#file-upload-box').siblings("label");
            $(grp).removeClass("has-error");
            $(label).removeClass("is-invalid");
        });
        invoiceDropzone.on('error', function (file, message) {
            invoiceDropzone.removeFile(file);
            var grp = $('div#file-upload-dropzone').closest(".form-group");
            var label = $('div#file-upload-box').siblings("label");
            $(grp).find(".help-block").remove();
            var helpBlockContainer = $(grp);

            if (helpBlockContainer.length == 0) {
                helpBlockContainer = $(grp);
            }

            helpBlockContainer.append('<div class="help-block invalid-feedback">' + message + '</div>');
            $(grp).addClass("has-error");
            $(label).addClass("is-invalid");

        });
        invoiceDropzone.on('addedfile', function (file) {
            lastIndex++;

            const div = document.createElement('div');
            div.className = 'form-check-inline custom-control custom-radio mt-2 mr-3';
            const input = document.createElement('input');
            input.className = 'custom-control-input';
            input.type = 'radio';
            input.name = 'default_image';
            input.id = 'default-image-' + lastIndex;
            input.value = file.name;
            if (lastIndex == 1) {
                input.checked = true;
            }
            div.appendChild(input);

            var label = document.createElement('label');
            label.className = 'custom-control-label pt-1 cursor-pointer';
            label.innerHTML = "@lang('modules.makeDefaultImage')";
            label.htmlFor = 'default-image-' + lastIndex;
            div.appendChild(label);

            file.previewTemplate.appendChild(div);
        });


        const hsn_status = "{{ $invoiceSetting->hsn_sac_code_show }}";
        const defaultClient = "{{ request('default_client') }}";

        $('.custom-date-picker').each(function(ind, el) {
            datepicker(el, {
                position: 'bl',
                ...datepickerConfig
            });
        });

        const dp1 = datepicker('#valid_till', {
            position: 'bl',
            dateSelected: new Date("{{ str_replace('-', '/', today()->addDays(30)) }}"),
            ...datepickerConfig
        });


        $(document).on('click', '#add-item', function() {

            var i = $(document).find('.item_name').length;
            var item = ' <div class="d-flex px-4 py-3 c-inv-desc item-row">' +
                '<div class="c-inv-desc-table w-100 d-lg-flex d-md-flex d-block">' +
                '<table width="100%">' +
                '<tbody>' +
                '<tr class="text-dark-grey font-weight-bold f-14">' +
                '<td width="{{ $invoiceSetting->hsn_sac_code_show ? '40%' : '50%' }}" class="border-0 inv-desc-mbl btlr">@lang('app.description')</td>';

            if (hsn_status == 1) {
                item += '<td width="10%" class="border-0" align="right">@lang('app.hsnSac')</td>';
            }

            item +=
                `<td width="10%" class="border-0" align="right">@lang("modules.invoices.qty")</td>
                <td width="10%" class="border-0" align="right">@lang('modules.invoices.unitPrice')</td>
                
                <td width="17%" class="border-0 bblr-mbl" align="right">@lang('modules.invoices.amount')</td>
                </tr>` +
                '<tr>' +
                '<td class="border-bottom-0 btrr-mbl btlr">' +
                `<input type="text" class="f-14 border-0 w-100 item_name form-control" name="item_name[]" placeholder="Item Name (To mention if it is Drywall, Plumbing, Electrical, Etc)">` +
                '</td>' +
                '<td class="border-bottom-0 d-block d-lg-none d-md-none">' +
                `<textarea class="f-14 border-0 w-100 mobile-description form-control" name="item_summary[]" placeholder="@lang('placeholders.invoices.description')"></textarea>` +
                '</td>';

            if (hsn_status == 1) {
                item += '<td class="border-bottom-0">' +
                    '<input type="text" min="1" class="f-14 border-0 w-100 text-right hsn_sac_code form-control" value="" name="hsn_sac_code[]">' +
                    '</td>';
            }

            item += '<td class="border-bottom-0">' +
                '<input type="number" min="1" class="form-control f-14 border-0 w-100 text-right quantity mt-3" value="1" name="quantity[]">' +
                `<select class="text-dark-grey float-right border-0 f-12" name="unit_id[]">
                    @foreach ($units as $unit)
                        <option
                        @selected($unit->default == 1)
                        value="{{ $unit->id }}">{{ $unit->unit_type }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="product_id[]" value="">`+
                '</td>' +
                '<td class="border-bottom-0">' +
                '<input type="number" min="1" class="f-14 border-0 w-100 text-right cost_per_item" placeholder="0.00" value="0" name="cost_per_item[]">' +
                '</td>' +
            '<td rowspan="2" align="right" valign="top" class="bg-amt-grey btrr-bbrr">' +
            '<span class="amount-html">0.00</span>' +
            '<input type="hidden" class="amount" name="amount[]" value="0">' +
            '</td>' +
            '</tr>' +
            '<tr class="d-none d-md-table-row d-lg-table-row">' +
            '<td colspan="{{ $invoiceSetting->hsn_sac_code_show ? 4 : 3 }}" class="dash-border-top bblr">' +
            '<textarea class="f-14 border-0 w-100 desktop-description form-control" name="item_summary[]" placeholder="Description (Describe the issue and details of the repair to be completed. If irreparable, reason it cannot be repaired and replacement details.)"></textarea>' +
            '</td>' +
            
                '</tr>' +
                '</tbody>' +
                '</table>' +
                '</div>' +
                '<a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 remove-item"><i class="fa fa-times-circle f-20 text-lightest"></i></a>' +
                '</div>';
            $(item).hide().appendTo("#sortable").fadeIn(500);
            $('#multiselect' + i).selectpicker();
        });

        $('#saveInvoiceForm').on('click', '.remove-item', function() {
            $(this).closest('.item-row').fadeOut(300, function() {
                $(this).remove();
                $('select.customSequence').each(function(index) {
                    $(this).attr('name', 'taxes[' + index + '][]');
                    $(this).attr('id', 'multiselect' + index + '');
                });
                calculateTotal();
            });
        });

        $('.save-form').click(function() {
            let note = document.getElementById('description').children[0].innerHTML;
            document.getElementById('description-text').value = note;

            var type = $(this).data('type');

            if (KTUtil.isMobileDevice()) {
                $('.desktop-description').remove();
            } else {
                $('.mobile-description').remove();
            }

            calculateTotal();

            var discount = $('#discount_amount').html();
            var total = $('.sub-total-field').val();

            if (parseFloat(discount) > parseFloat(total)) {
                Swal.fire({
                    icon: 'error',
                    text: "{{ __('messages.discountExceed') }}",

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
                url: "{{ route('vendor-estimates.storeext') }}",
                container: '#saveInvoiceForm',
                type: "POST",
                blockUI: true,
                file: true,
                data: $('#saveInvoiceForm').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        $(".save-form").prop("disabled", true);
                        if(invoiceDropzone.getQueuedFiles().length == 0)
                        {
                            showalert();
                        }
                        if (typeof invoiceDropzone !== 'undefined' && invoiceDropzone.getQueuedFiles().length > 0) {
                            estimateId = response.estimateId;
                            $('#estimateId').val(response.estimateId);
                            invoiceDropzone.processQueue();
                        }
                    }
                }
            })
        });
        function showalert()
        {
            Swal.fire({
                icon: 'success',
                text: '{{ __('Your Response Has Been Noted!') }}',

                customClass: {
                    confirmButton: 'btn btn-primary d-none',
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                buttonsStyling: false,
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        }

        $('#saveInvoiceForm').on('click', '.remove-item', function() {
            $(this).closest('.item-row').fadeOut(300, function() {
                $(this).remove();
                $('select.customSequence').each(function(index) {
                    $(this).attr('name', 'taxes[' + index + '][]');
                    $(this).attr('id', 'multiselect' + index + '');
                });
                calculateTotal();
            });
        });

        $('#saveInvoiceForm').on('keyup', '.quantity,.cost_per_item,.item_name, .discount_value', function() {
            var quantity = $(this).closest('.item-row').find('.quantity').val();
            var perItemCost = $(this).closest('.item-row').find('.cost_per_item').val();
            var amount = (quantity * perItemCost);

            $(this).closest('.item-row').find('.amount').val(decimalupto2(amount));
            $(this).closest('.item-row').find('.amount-html').html(decimalupto2(amount));

            calculateTotal();
        });

        $('#saveInvoiceForm').on('change', '.type, #discount_type, #calculate_tax', function() {
            var quantity = $(this).closest('.item-row').find('.quantity').val();
            var perItemCost = $(this).closest('.item-row').find('.cost_per_item').val();
            var amount = (quantity * perItemCost);

            $(this).closest('.item-row').find('.amount').val(decimalupto2(amount));
            $(this).closest('.item-row').find('.amount-html').html(decimalupto2(amount));

            calculateTotal();
        });

        $('#saveInvoiceForm').on('input', '.quantity', function() {
            var quantity = $(this).closest('.item-row').find('.quantity').val();
            var perItemCost = $(this).closest('.item-row').find('.cost_per_item').val();
            var amount = (quantity * perItemCost);

            $(this).closest('.item-row').find('.amount').val(decimalupto2(amount));
            $(this).closest('.item-row').find('.amount-html').html(decimalupto2(amount));

            calculateTotal();
        });

        calculateTotal();
    });


</script>


</body>

</html>
