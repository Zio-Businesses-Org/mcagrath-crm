<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/css/all.min.css') }}">

    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/css/simple-line-icons.css') }}">

    <!-- Template CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('css/main.css') }}">
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('vendor/css/dropzone.min.css') }}">
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
</head>

<body id="body" class="h-100 bg-additional-grey">

<div class="content-wrapper container">
    <div class="card border-0 invoice">
        <div class="card-body">
            <h2 class="mb-0 pr-3 text-dark f-18 font-weight-bold d-flex align-items-center">{{$projectData->project_short_code}} - {{$projectData->propertyDetails->property_address}}</h2>
            
            <div class="col-md-12">
                <x-forms.file-multiple class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('app.menu.addFile')" fieldName="file" fieldId="file-upload-dropzone"/>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <x-forms.label class="mb-12 mt-3" fieldId="file_type"
                                :fieldLabel="__('File Type')" fieldRequired="true">
                    </x-forms.label>
                    <x-forms.input-group>
                        <select class="form-control" name="file_type" id="file_type"
                                data-live-search="true">
                            <option value="">--</option>
                            @foreach ($filetype as $type)
                                <option
                                    value="{{ $type->file_type}}">
                                    {{ $type->file_type }}
                                </option>
                            @endforeach
                        </select>
                    </x-forms.input-group>
                </div>
                <div class="col-lg-3 col-md-6">
                    <x-forms.text :fieldLabel="__('File Name')" fieldName="tag_name"
                        fieldId="tag_name" :fieldPlaceholder="__('File Name')" fieldRequired="true"/>
                </div>
                <div class="col-lg-3 col-md-6">
                    <x-forms.text :fieldLabel="__('Name')" fieldName="name"
                        fieldId="name" :fieldPlaceholder="__('placeholders.name')" fieldRequired="true"/>
                </div>
                <div class="col-lg-3 col-md-6">
                    <x-forms.email fieldId="email" :fieldLabel="__('app.email')"
                                fieldName="email" :fieldPlaceholder="__('placeholders.email')" >
                    </x-forms.email>
                </div>
                <div class="col-lg-3 col-md-6">
                    <x-forms.text fieldId="phone" :fieldLabel="__('modules.lead.mobile')" fieldName="phone"
                                :fieldPlaceholder="__('placeholders.mobile')" fieldRequired="true">
                    </x-forms.text>
                </div>
            </div>
            <x-forms.button-primary icon="upload" id="save-file" class="type-btn mb-3 float-right">
                @lang('Upload')
            </x-forms.button-primary>
        </div>
    </div>
</div>
<script src="{{ asset('js/main.js') }}"></script>
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
</script>
<script>
$(document).ready(function() {
    let lastIndex = 0;
    var projectID=$('#project_id').val();
    Dropzone.autoDiscover = false;
    //Dropzone class
    invoiceDropzone = new Dropzone("div#file-upload-dropzone", {
        dictDefaultMessage: "{{ __('app.dragDrop') }}",
        url: "{{ route('external-file-upload.store') }}",
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
        const projectid = "{{$projectid}}";
        const name = $('#name').val();
        const phone = $('#phone').val();
        const email = $('#email').val();
        const tag_name = $('#tag_name').val();
        const file_type = $('#file_type').val();
        formData.append('projectid', projectid);
        formData.append('name', name);
        formData.append('email', email);
        formData.append('phone', phone);
        formData.append('tag_name',tag_name);
        formData.append('file_type',file_type);
        $.easyBlockUI();
    });
    invoiceDropzone.on('uploadprogress', function () {
        $.easyBlockUI();
    });
    invoiceDropzone.on('queuecomplete', function () {
        $.easyUnblockUI();
        Swal.fire({
                icon: 'success',
                text: '{{ __('File Uploaded') }}',

                customClass: {
                    confirmButton: 'btn btn-primary',
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });   
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
    $('#save-file').click(function() {
        if($('#name').val()!=''&&$('#phone').val()!=''&&$('#tag_name').val()!=''&&$('#file_type').val()!='')
        {
            invoiceDropzone.processQueue();
        }
        else{
            Swal.fire({
                icon: 'error',
                text: '{{ __('Empty Required Fields') }}',

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
        // console.log($('#phone').val());
    });
    $("#file_type").selectpicker();
});
</script>


</body>

</html>
