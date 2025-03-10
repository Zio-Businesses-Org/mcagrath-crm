<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/css/all.min.css')); ?>">

    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/css/simple-line-icons.css')); ?>">

    <!-- Template CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo e(asset('css/main.css')); ?>">
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo e(asset('vendor/css/dropzone.min.css')); ?>">
    <title><?php echo app('translator')->get($pageTitle); ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($company->favicon_url); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo e($company->favicon_url); ?>">
    <meta name="theme-color" content="#ffffff">

    <?php echo $__env->make('sections.theme_css', ['company' => $company], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(isset($activeSettingMenu)): ?>
        <style>
            .preloader-container {
                margin-left: 510px;
                width: calc(100% - 510px)
            }

        </style>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('styles'); ?>

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
    <script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/jquery/modernizr.min.js')); ?>"></script>
</head>

<body id="body" class="h-100 bg-additional-grey">

<div class="content-wrapper container">
    <div class="card border-0 invoice">
        <div class="card-body">
            <h2 class="mb-0 pr-3 text-dark f-18 font-weight-bold d-flex align-items-center"><?php echo e($projectData->project_short_code); ?> - <?php echo e($projectData->propertyDetails->property_address); ?></h2>
            
            <div class="col-md-12">
                <?php if (isset($component)) { $__componentOriginal22e84ee8172e1045de536542f4ffc9a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22e84ee8172e1045de536542f4ffc9a0 = $attributes; } ?>
<?php $component = App\View\Components\Forms\FileMultiple::resolve(['fieldLabel' => __('app.menu.addFile'),'fieldName' => 'file','fieldId' => 'file-upload-dropzone'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.file-multiple'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\FileMultiple::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mr-0 mr-lg-2 mr-md-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22e84ee8172e1045de536542f4ffc9a0)): ?>
<?php $attributes = $__attributesOriginal22e84ee8172e1045de536542f4ffc9a0; ?>
<?php unset($__attributesOriginal22e84ee8172e1045de536542f4ffc9a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22e84ee8172e1045de536542f4ffc9a0)): ?>
<?php $component = $__componentOriginal22e84ee8172e1045de536542f4ffc9a0; ?>
<?php unset($__componentOriginal22e84ee8172e1045de536542f4ffc9a0); ?>
<?php endif; ?>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <?php if (isset($component)) { $__componentOriginal89b295b0763c93abe0143426334eb5d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal89b295b0763c93abe0143426334eb5d6 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Label::resolve(['fieldId' => 'file_type','fieldLabel' => __('File Type'),'fieldRequired' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Label::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-12 mt-3']); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal89b295b0763c93abe0143426334eb5d6)): ?>
<?php $attributes = $__attributesOriginal89b295b0763c93abe0143426334eb5d6; ?>
<?php unset($__attributesOriginal89b295b0763c93abe0143426334eb5d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal89b295b0763c93abe0143426334eb5d6)): ?>
<?php $component = $__componentOriginal89b295b0763c93abe0143426334eb5d6; ?>
<?php unset($__componentOriginal89b295b0763c93abe0143426334eb5d6); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalcbf9105fd4879d5d6ef9e1f6fe271af7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbf9105fd4879d5d6ef9e1f6fe271af7 = $attributes; } ?>
<?php $component = App\View\Components\Forms\InputGroup::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\InputGroup::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <select class="form-control" name="file_type" id="file_type"
                                data-live-search="true">
                            <option value="">--</option>
                            <?php $__currentLoopData = $filetype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($type->file_type); ?>">
                                    <?php echo e($type->file_type); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbf9105fd4879d5d6ef9e1f6fe271af7)): ?>
<?php $attributes = $__attributesOriginalcbf9105fd4879d5d6ef9e1f6fe271af7; ?>
<?php unset($__attributesOriginalcbf9105fd4879d5d6ef9e1f6fe271af7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbf9105fd4879d5d6ef9e1f6fe271af7)): ?>
<?php $component = $__componentOriginalcbf9105fd4879d5d6ef9e1f6fe271af7; ?>
<?php unset($__componentOriginalcbf9105fd4879d5d6ef9e1f6fe271af7); ?>
<?php endif; ?>
                </div>
                <div class="col-lg-3 col-md-6">
                    <?php if (isset($component)) { $__componentOriginal4e45e801405ab67097982370a6a83cba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4e45e801405ab67097982370a6a83cba = $attributes; } ?>
<?php $component = App\View\Components\Forms\Text::resolve(['fieldLabel' => __('File Name'),'fieldName' => 'tag_name','fieldId' => 'tag_name','fieldPlaceholder' => __('File Name'),'fieldRequired' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Text::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4e45e801405ab67097982370a6a83cba)): ?>
<?php $attributes = $__attributesOriginal4e45e801405ab67097982370a6a83cba; ?>
<?php unset($__attributesOriginal4e45e801405ab67097982370a6a83cba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4e45e801405ab67097982370a6a83cba)): ?>
<?php $component = $__componentOriginal4e45e801405ab67097982370a6a83cba; ?>
<?php unset($__componentOriginal4e45e801405ab67097982370a6a83cba); ?>
<?php endif; ?>
                </div>
                <div class="col-lg-3 col-md-6">
                    <?php if (isset($component)) { $__componentOriginal4e45e801405ab67097982370a6a83cba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4e45e801405ab67097982370a6a83cba = $attributes; } ?>
<?php $component = App\View\Components\Forms\Text::resolve(['fieldLabel' => __('Name'),'fieldName' => 'name','fieldId' => 'name','fieldPlaceholder' => __('placeholders.name'),'fieldRequired' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Text::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4e45e801405ab67097982370a6a83cba)): ?>
<?php $attributes = $__attributesOriginal4e45e801405ab67097982370a6a83cba; ?>
<?php unset($__attributesOriginal4e45e801405ab67097982370a6a83cba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4e45e801405ab67097982370a6a83cba)): ?>
<?php $component = $__componentOriginal4e45e801405ab67097982370a6a83cba; ?>
<?php unset($__componentOriginal4e45e801405ab67097982370a6a83cba); ?>
<?php endif; ?>
                </div>
                <div class="col-lg-3 col-md-6">
                    <?php if (isset($component)) { $__componentOriginal4cff4ad89fa6d28d8e2b88246e322241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4cff4ad89fa6d28d8e2b88246e322241 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Email::resolve(['fieldId' => 'email','fieldLabel' => __('app.email'),'fieldName' => 'email','fieldPlaceholder' => __('placeholders.email')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.email'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Email::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4cff4ad89fa6d28d8e2b88246e322241)): ?>
<?php $attributes = $__attributesOriginal4cff4ad89fa6d28d8e2b88246e322241; ?>
<?php unset($__attributesOriginal4cff4ad89fa6d28d8e2b88246e322241); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4cff4ad89fa6d28d8e2b88246e322241)): ?>
<?php $component = $__componentOriginal4cff4ad89fa6d28d8e2b88246e322241; ?>
<?php unset($__componentOriginal4cff4ad89fa6d28d8e2b88246e322241); ?>
<?php endif; ?>
                </div>
                <div class="col-lg-3 col-md-6">
                    <?php if (isset($component)) { $__componentOriginal4e45e801405ab67097982370a6a83cba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4e45e801405ab67097982370a6a83cba = $attributes; } ?>
<?php $component = App\View\Components\Forms\Text::resolve(['fieldId' => 'phone','fieldLabel' => __('modules.lead.mobile'),'fieldName' => 'phone','fieldPlaceholder' => __('placeholders.mobile'),'fieldRequired' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Text::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4e45e801405ab67097982370a6a83cba)): ?>
<?php $attributes = $__attributesOriginal4e45e801405ab67097982370a6a83cba; ?>
<?php unset($__attributesOriginal4e45e801405ab67097982370a6a83cba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4e45e801405ab67097982370a6a83cba)): ?>
<?php $component = $__componentOriginal4e45e801405ab67097982370a6a83cba; ?>
<?php unset($__componentOriginal4e45e801405ab67097982370a6a83cba); ?>
<?php endif; ?>
                </div>
            </div>
            <?php if (isset($component)) { $__componentOriginalcf8d12533ff890e0d6573daf32b7618d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonPrimary::resolve(['icon' => 'upload'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'save-file','class' => 'type-btn mb-3 float-right']); ?>
                <?php echo app('translator')->get('Upload'); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcf8d12533ff890e0d6573daf32b7618d)): ?>
<?php $attributes = $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d; ?>
<?php unset($__attributesOriginalcf8d12533ff890e0d6573daf32b7618d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf8d12533ff890e0d6573daf32b7618d)): ?>
<?php $component = $__componentOriginalcf8d12533ff890e0d6573daf32b7618d; ?>
<?php unset($__componentOriginalcf8d12533ff890e0d6573daf32b7618d); ?>
<?php endif; ?>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
<script>
    const DROPZONE_FILE_ALLOW = "<?php echo e(global_setting()->allowed_file_types); ?>";
    const DROPZONE_MAX_FILESIZE = "<?php echo e(global_setting()->allowed_file_size); ?>";
    const DROPZONE_MAX_FILES = "<?php echo e(global_setting()->allow_max_no_of_files); ?>";

    Dropzone.prototype.defaultOptions.dictFallbackMessage = "<?php echo e(__('modules.projectTemplate.dropFallbackMessage')); ?>";
    Dropzone.prototype.defaultOptions.dictFallbackText = "<?php echo e(__('modules.projectTemplate.dropFallbackText')); ?>";
    Dropzone.prototype.defaultOptions.dictFileTooBig = "<?php echo e(__('modules.projectTemplate.dropFileTooBig')); ?>";
    Dropzone.prototype.defaultOptions.dictInvalidFileType = "<?php echo e(__('modules.projectTemplate.dropInvalidFileType')); ?>";
    Dropzone.prototype.defaultOptions.dictResponseError = "<?php echo e(__('modules.projectTemplate.dropResponseError')); ?>";
    Dropzone.prototype.defaultOptions.dictCancelUpload = "<?php echo e(__('modules.projectTemplate.dropCancelUpload')); ?>";
    Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "<?php echo e(__('modules.projectTemplate.dropCancelUploadConfirmation')); ?>";
    Dropzone.prototype.defaultOptions.dictRemoveFile = "<?php echo e(__('modules.projectTemplate.dropRemoveFile')); ?>";
    Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "<?php echo e(__('modules.projectTemplate.dropMaxFilesExceeded')); ?>";
    Dropzone.prototype.defaultOptions.dictDefaultMessage = "<?php echo e(__('modules.projectTemplate.dropFile')); ?>";
    Dropzone.prototype.defaultOptions.timeout = 0;
</script>
<script>
$(document).ready(function() {
    let lastIndex = 0;
    var projectID=$('#project_id').val();
    Dropzone.autoDiscover = false;
    //Dropzone class
    invoiceDropzone = new Dropzone("div#file-upload-dropzone", {
        dictDefaultMessage: "<?php echo e(__('app.dragDrop')); ?>",
        url: "<?php echo e(route('external-file-upload.store')); ?>",
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
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
        const projectid = "<?php echo e($projectid); ?>";
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
                text: '<?php echo e(__('File Uploaded')); ?>',

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
        label.innerHTML = "<?php echo app('translator')->get('modules.makeDefaultImage'); ?>";
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
                text: '<?php echo e(__('Empty Required Fields')); ?>',

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
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/external-file.blade.php ENDPATH**/ ?>