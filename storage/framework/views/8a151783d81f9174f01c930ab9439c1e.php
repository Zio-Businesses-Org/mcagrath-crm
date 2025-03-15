

<?php $__env->startPush('datatable-styles'); ?>
    <?php echo $__env->make('sections.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('filter-section'); ?>
<style>
    .dropdown-mod{
        position :static;  
    } 
    .button-wrapper::-webkit-scrollbar {
        display: none; /* Hides the scrollbar */
    }
</style>
<?php if (isset($component)) { $__componentOriginalc460a37d150a16feae9643b9afc5d7a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc460a37d150a16feae9643b9afc5d7a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.filters.filter-box-moded','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filters.filter-box-moded'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- SEARCH BY TASK START -->
    <div class="task-search d-flex  py-1 px-lg-3 px-0 align-items-center ">
        <form class="w-100 mr-1 mr-lg-0 mr-md-1 ml-md-1 ml-0 ml-lg-0">
            <div class="input-group bg-grey rounded">
                <div class="input-group-prepend">
                    <span class="input-group-text border-0 bg-additional-grey">
                        <i class="fa fa-search f-13 text-dark-grey"></i>
                    </span>
                </div>
                <input type="text" class="form-control f-14 p-1 border-additional-grey" id="search-text-field"
                    placeholder="<?php echo app('translator')->get('app.startTyping'); ?>">
            </div>
        </form>
    </div>
    <!-- SEARCH BY TASK END -->
    <div class="select-box d-flex py-1 px-lg-2 px-md-2 px-0">
        <?php if (isset($component)) { $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonSecondary::resolve(['icon' => 'times-circle'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonSecondary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-xs d-none','id' => 'reset-filters']); ?>
            <?php echo app('translator')->get('app.clearFilters'); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $attributes = $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $component = $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc460a37d150a16feae9643b9afc5d7a0)): ?>
<?php $attributes = $__attributesOriginalc460a37d150a16feae9643b9afc5d7a0; ?>
<?php unset($__attributesOriginalc460a37d150a16feae9643b9afc5d7a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc460a37d150a16feae9643b9afc5d7a0)): ?>
<?php $component = $__componentOriginalc460a37d150a16feae9643b9afc5d7a0; ?>
<?php unset($__componentOriginalc460a37d150a16feae9643b9afc5d7a0); ?>
<?php endif; ?>
<div class="container-fluid d-flex position-relative border-bottom-grey">
    <!-- Left Scroll Button -->
    <button class="btn btn-dark" id="scrollLeftBtn" style="display: none; left: 0;">&#9664;</button>
    <!-- Scrollable Button Wrapper -->
    <div id="buttonWrapper" class="button-wrapper d-flex overflow-auto flex-nowrap my-2">
    <?php $__currentLoopData = $vendorFilter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!-- Buttons in a horizontal line -->
        <div class="task_view mx-1">
            
            <div class="taskView text-darkest-grey f-w-500"><?php if($filter->status=='active'): ?><i class="fa fa-circle mr-2" style="color:#679c0d;"></i><?php endif; ?><?php echo e($filter->name); ?></div>
            <div class="dropdown dropdown-mod">
                <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
                    type="link" id="dropdownMenuLink-<?php echo e($filter->id); ?>" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-options-vertical icons"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-mod" 
                    aria-labelledby="dropdownMenuLink-<?php echo e($filter->id); ?>" tabindex="0" >
                    <?php if($filter->status=='inactive'): ?>
                        <a class="dropdown-item apply-filter" href="javascript:;"
                            data-row-id="<?php echo e($filter->id); ?>">
                            <i class="bi bi-save2 mr-2"></i>
                            <?php echo app('translator')->get('Apply'); ?>
                        </a>
                    <?php endif; ?>
                        <a class="dropdown-item edit-filter-vendor" href="javascript:;"
                            data-row-id="<?php echo e($filter->id); ?>">
                            <i class="fa fa-edit mr-2"></i>
                            <?php echo app('translator')->get('app.edit'); ?>
                        </a>
                        <a class="dropdown-item delete-row" href="javascript:;"
                            data-row-id="<?php echo e($filter->id); ?>">
                            <i class="fa fa-trash mr-2"></i>
                            <?php echo app('translator')->get('app.delete'); ?>
                        </a>
                        <?php if($filter->status=='active'): ?>
                            <a class="dropdown-item clear-filter" href="javascript:;"
                                data-row-id="<?php echo e($filter->id); ?>">
                                <i class="bi bi-save2 mr-2"></i>
                                <?php echo app('translator')->get('Clear'); ?>
                            </a>
                        <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <!-- Right Scroll Button -->
    <button class="btn btn-dark" id="scrollRightBtn" style="display: none; right: 0;">&#9654;</button>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-grid d-lg-flex d-md-flex action-bar">
            <div id="table-actions" class="flex-grow-1 align-items-center"></div>
            <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                <a href="<?php echo e(route('vendors.index')); ?>" class="btn btn-secondary f-14 btn-active show-clients" data-toggle="tooltip"
                    data-original-title="<?php echo app('translator')->get('Vendors'); ?>"><i class="side-icon bi bi-list-ul"></i></a>
                <a class="btn btn-secondary f-14" data-toggle="tooltip" id="custom-filter"
                    data-original-title="<?php echo app('translator')->get('Custom Filter'); ?>"><i class="side-icon bi bi-filter"></i></a>
            </div>
        </div>
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white table-responsive">
            <?php echo $dataTable->table(['class' => 'table table-hover border-0 w-100']); ?>

        </div>
        <div class="modal fade" id="CustomFilterModal" aria-hidden="true" >
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading">Custom Filter</h4>
                    </div>
                    <div class="modal-body"> 
                        <?php if (isset($component)) { $__componentOriginal18ad2e0d264f9740dc73fff715357c28 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18ad2e0d264f9740dc73fff715357c28 = $attributes; } ?>
<?php $component = App\View\Components\Form::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'save-vendor-filter-form']); ?>
                            <input type="hidden" name="user_id" value=" <?php echo e(user()->id); ?> ">
                            <input type="hidden" name="startDate" id="startDate">
                            <input type="hidden" name="endDate" id="endDate">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <?php if (isset($component)) { $__componentOriginal4e45e801405ab67097982370a6a83cba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4e45e801405ab67097982370a6a83cba = $attributes; } ?>
<?php $component = App\View\Components\Forms\Text::resolve(['fieldLabel' => __('Filter Name'),'fieldName' => 'filter_name','fieldRequired' => 'true','fieldId' => 'filter_name','fieldPlaceholder' => __('Enter filter name')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                                    <div class="col-md-4 mt-3">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr"><?php echo app('translator')->get('Created Date'); ?></label>
                                        <div class="select-status d-flex">
                                            <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                                            placeholder="<?php echo app('translator')->get('placeholders.dateRange'); ?>" id="customRange">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mt-3">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr"><?php echo app('translator')->get('City'); ?></label>
                                        <div class="">
                                        <select class="form-control select-picker" name="filter_city[]" id="filter_city"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                            <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->city); ?>" >
                                                    <?php echo e($category->city); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr"><?php echo app('translator')->get('County'); ?></label>
                                        <div class="mb-4">
                                        <select class="form-control select-picker" name="filter_county[]" id="filter_county"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                                <?php $__currentLoopData = $county; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->county); ?>" >
                                                    <?php echo e($category->county); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr"><?php echo app('translator')->get('State'); ?></label>
                                        <div class="mb-4">
                                        <select class="form-control select-picker" name="filter_state[]" id="filter_state"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                            <?php $__currentLoopData = $state; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->state); ?>" >
                                                    <?php echo e($category->state); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr"><?php echo app('translator')->get('Contractor Type'); ?></label>
                                        <div class="mb-4">
                                        <select class="form-control select-picker" name="filter_contractor_type[]" id="filter_contractor_type"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                            <?php $__currentLoopData = $contracttype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->contractor_type); ?>" >
                                                    <?php echo e($category->contractor_type); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr"><?php echo app('translator')->get('Created By'); ?></label>
                                        <div class="mb-4">
                                        <select class="form-control select-picker" name="filter_members[]" id="filter_members"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                            <?php $__currentLoopData = $allEmployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->name); ?>" >
                                                    <?php echo e($category->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr"><?php echo app('translator')->get('Status'); ?></label>
                                        <div class="mb-4">
                                        <select class="form-control select-picker" name="filter_status[]" id="filter_status"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                                <option value="Active" data-content='<i class="fa fa-circle mr-2" style="color:#00b5ff;"></i>Active'>
                                                <option  value="Compliant" data-content='<i class="fa fa-circle mr-2" style="color:#679c0d;"></i>Compliant'>
                                                <option  value="Snooze" data-content='<i class="fa fa-circle mr-2" style="color:#FFA500;"></i>Snooze'>
                                                <option  value="Non Compliant" data-content='<i class="fa fa-circle mr-2" style="color:#FFFF00;"></i>Non Compliant'>
                                                <option  value="DNU" data-content='<i class="fa fa-circle mr-2" style="color:#FF0000;"></i>DNU'>
                                                <option  value="On Hold" data-content='<i class="fa fa-circle mr-2" style="color:#808080;"></i>On Hold'>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18ad2e0d264f9740dc73fff715357c28)): ?>
<?php $attributes = $__attributesOriginal18ad2e0d264f9740dc73fff715357c28; ?>
<?php unset($__attributesOriginal18ad2e0d264f9740dc73fff715357c28); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18ad2e0d264f9740dc73fff715357c28)): ?>
<?php $component = $__componentOriginal18ad2e0d264f9740dc73fff715357c28; ?>
<?php unset($__componentOriginal18ad2e0d264f9740dc73fff715357c28); ?>
<?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="clear">Reset</button>
                        <button type="button" class="btn btn-secondary" id="close">Close</button>
                        <button type="button" class="btn btn-primary" id="save-filter">Save Filter</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="signature-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center align-items-center modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modelHeading"><?php echo app('translator')->get('modules.estimates.cpatureAndConfirmation'); ?></h5>
                        <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <?php if (isset($component)) { $__componentOriginal18ad2e0d264f9740dc73fff715357c28 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18ad2e0d264f9740dc73fff715357c28 = $attributes; } ?>
<?php $component = App\View\Components\Form::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'acceptEstimate']); ?>
                            <div class="row">
                                <div class="col-sm-12 bg-grey p-4 signature">
                                    <?php if (isset($component)) { $__componentOriginal89b295b0763c93abe0143426334eb5d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal89b295b0763c93abe0143426334eb5d6 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Label::resolve(['fieldId' => 'signature-pad','fieldRequired' => 'true','fieldLabel' => __('modules.estimates.signature')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Label::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                                    <div class="signature_wrap wrapper border-0 form-control">
                                        <canvas id="signature-pad" class="signature-pad rounded" width=725 height=150></canvas>
                                    </div>
                                </div>
                                <div class="col-sm-12 p-4 d-none upload-image">
                                    <?php if (isset($component)) { $__componentOriginal71f75760ce80416d6aa938be1ae7e8b2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal71f75760ce80416d6aa938be1ae7e8b2 = $attributes; } ?>
<?php $component = App\View\Components\Forms\File::resolve(['allowedFileExtensions' => 'png jpg jpeg svg bmp','fieldLabel' => __('modules.estimates.signature'),'fieldName' => 'image','fieldId' => 'image','popover' => __('messages.fileFormat.ImageFile'),'fieldRequired' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.file'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\File::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mr-0 mr-lg-2 mr-md-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal71f75760ce80416d6aa938be1ae7e8b2)): ?>
<?php $attributes = $__attributesOriginal71f75760ce80416d6aa938be1ae7e8b2; ?>
<?php unset($__attributesOriginal71f75760ce80416d6aa938be1ae7e8b2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71f75760ce80416d6aa938be1ae7e8b2)): ?>
<?php $component = $__componentOriginal71f75760ce80416d6aa938be1ae7e8b2; ?>
<?php unset($__componentOriginal71f75760ce80416d6aa938be1ae7e8b2); ?>
<?php endif; ?>
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <?php if (isset($component)) { $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonSecondary::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonSecondary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'undo-signature','class' => 'signature']); ?><?php echo app('translator')->get('modules.estimates.undo'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $attributes = $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $component = $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonSecondary::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonSecondary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ml-2 signature','id' => 'clear-signature']); ?><?php echo app('translator')->get('modules.estimates.clear'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $attributes = $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $component = $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonSecondary::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonSecondary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ml-2 ','id' => 'toggle-pad-uploader']); ?><?php echo app('translator')->get('modules.estimates.uploadSignature'); ?>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $attributes = $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $component = $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
                                </div>

                            </div>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18ad2e0d264f9740dc73fff715357c28)): ?>
<?php $attributes = $__attributesOriginal18ad2e0d264f9740dc73fff715357c28; ?>
<?php unset($__attributesOriginal18ad2e0d264f9740dc73fff715357c28); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18ad2e0d264f9740dc73fff715357c28)): ?>
<?php $component = $__componentOriginal18ad2e0d264f9740dc73fff715357c28; ?>
<?php unset($__componentOriginal18ad2e0d264f9740dc73fff715357c28); ?>
<?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <?php if (isset($component)) { $__componentOriginalc35c79ed7e812580313ad04118477974 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc35c79ed7e812580313ad04118477974 = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonCancel::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-dismiss' => 'modal','class' => 'border-0 mr-3']); ?><?php echo app('translator')->get('app.cancel'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc35c79ed7e812580313ad04118477974)): ?>
<?php $attributes = $__attributesOriginalc35c79ed7e812580313ad04118477974; ?>
<?php unset($__attributesOriginalc35c79ed7e812580313ad04118477974); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc35c79ed7e812580313ad04118477974)): ?>
<?php $component = $__componentOriginalc35c79ed7e812580313ad04118477974; ?>
<?php unset($__componentOriginalc35c79ed7e812580313ad04118477974); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalcf8d12533ff890e0d6573daf32b7618d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonPrimary::resolve(['icon' => 'check'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'save-signature']); ?><?php echo app('translator')->get('app.sign'); ?> <?php echo $__env->renderComponent(); ?>
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
        </div>
        <!-- Task Box End -->
    </div>
    <!-- CONTENT WRAPPER END -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('sections.datatable_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
    $(document).ready(function () {

        var startDate = '';
        var endDate = '';

        $('#customRange').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
        });
        
        $('#customRange').on('apply.daterangepicker', function(ev, picker) {
            // Get start and end dates
            startDate = picker.startDate.format('YYYY-MM-DD');
            document.getElementById('startDate').value=startDate;
            endDate = picker.endDate.format('YYYY-MM-DD');
            document.getElementById('endDate').value=endDate;
            
            $(this).val(picker.startDate.format('<?php echo e(company()->moment_date_format); ?>') + ' - ' + picker.endDate.format('<?php echo e(company()->moment_date_format); ?>'));
            
        });
        $('#custom-filter').click(function () {
            $('#CustomFilterModal').modal('show');
        });

        $('#close').click(function () {
            $('#CustomFilterModal').modal('hide');
        });

        $('#clear').click(function() {
            $('#filter_state').val([]).selectpicker('refresh');
            $('#filter_city').val([]).selectpicker('refresh');
            $('#filter_county').val([]).selectpicker('refresh');
            $('#filter_members').val([]).selectpicker('refresh');
            $('#filter_contractor_type').val([]).selectpicker('refresh');
            $('#filter_status').val([]).selectpicker('refresh');
            document.getElementById('startDate').value='';
            document.getElementById('endDate').value='';
            $('#customRange').val('');
            $('#filter_name').val('');
        });

        const buttonWrapper = document.getElementById('buttonWrapper');
        const scrollLeftBtn = document.getElementById('scrollLeftBtn');
        const scrollRightBtn = document.getElementById('scrollRightBtn');

        function updateScrollButtons() {
            // Check if the content overflows the button wrapper
            if (buttonWrapper.scrollWidth > buttonWrapper.clientWidth) {
                scrollLeftBtn.style.display = 'block';
                scrollRightBtn.style.display = 'block';
            } else {
                scrollLeftBtn.style.display = 'none';
                scrollRightBtn.style.display = 'none';
            }
        }
        updateScrollButtons();

        $('#scrollLeftBtn').click(function() {
            buttonWrapper.scrollBy({
                left: -200, // Adjust as needed
                behavior: 'smooth'
            });
        });

        $('#scrollRightBtn').click(function() {
            buttonWrapper.scrollBy({
                left: 200, // Adjust as needed
                behavior: 'smooth'
            });
        });

        window.addEventListener('resize', updateScrollButtons);

        $('#save-filter').click(function () {
            if($('#customRange').val()=='')
            {
                document.getElementById('startDate').value='';
                document.getElementById('endDate').value='';
            }
            var url = "<?php echo e(route('vendor-filter.store')); ?>";
            $.easyAjax({
                url: url,
                container: '#save-vendor-filter-form',
                type: "POST",
                blockUI: true,
                disableButton: true,
                buttonSelector: '#save-filter',
                data: $('#save-vendor-filter-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        $('#CustomFilterModal').modal('hide');
                        window.location.reload();
                    }
                }
            })
        });
        $('body').on('click', '.edit-filter-vendor', function() {
            var id = $(this).data('row-id');
            
            var url = "<?php echo e(route('vendor-filter.edit', ':id')); ?>";
            url = url.replace(':id', id);

            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
            
        });

        $('body').on('click', '.delete-row', function() {
            var id = $(this).data('row-id');
            Swal.fire({
                title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                text: "<?php echo app('translator')->get('messages.recoverRecord'); ?>",
                icon: 'warning',
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "<?php echo app('translator')->get('messages.confirmDelete'); ?>",
                cancelButtonText: "<?php echo app('translator')->get('app.cancel'); ?>",
                customClass: {
                    confirmButton: 'btn btn-primary mr-3',
                    cancelButton: 'btn btn-secondary'
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "<?php echo e(route('vendor-filter.destroy', ':id')); ?>";
                    url = url.replace(':id', id);
                    var token = "<?php echo e(csrf_token()); ?>";
                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: '.content-wrapper',
                        blockUI: true,
                        data: {
                            '_token': token,
                            '_method': 'DELETE'
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                window.location.reload();
                            }
                        }
                    });
                }
            });
        });
        $('body').on('click', '.apply-filter', function() {

            var id = $(this).data('row-id');
            var url = "<?php echo e(route('vendor-filter.change-status',':id')); ?>";
            url = url.replace(':id', id);
            var token = "<?php echo e(csrf_token()); ?>";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.content-wrapper',
                blockUI: true,
                data: {
                    '_token': token,
                },
                success: function(response) {
                    if (response.status == "success") {
                        window.location.reload();
                    }
                }
            });
        });
        $('body').on('click', '.clear-filter', function() {
            var id = $(this).data('row-id');
            var url = "<?php echo e(route('vendor-filter.clear',':id')); ?>";
            url = url.replace(':id', id);
            var token = "<?php echo e(csrf_token()); ?>";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.content-wrapper',
                blockUI: true,
                data: {
                    '_token': token,
                },
                success: function(response) {
                    if (response.status == "success") {
                        window.location.reload();
                    }
                }
            });
        });

    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script>
        var row_id;
        $('#vendors-table').on('preXhr.dt', function(e, settings, data) {
            const searchText = $('#search-text-field').val();
            data['searchText'] = searchText;
            const status = $('#status').val();
            data['status'] = status;
        });

        $('#status').on('change keyup', function() {
                if ($('#status').val() !== "") {
                    $('#reset-filters').removeClass('d-none');
                } else {
                    $('#reset-filters').addClass('d-none');
                }
                showTable();
        });

        const showTable = () => {
            window.LaravelDataTables["vendors-table"].draw(false);
        }

        $('#vendors-table').on('change', '.change-vendor-status', function() {
            var id = $(this).data('row-id');
            var value =  $(this).val();
            var url="<?php echo e(route('vendors.changevendorstatus',':id')); ?>";
            url = url.replace(':id', id);
            if (id != "" && value != "") {
            $.easyAjax({
                    url: url,
                    type: 'POST',
                    blockUI: true,
                    data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            value: value
                        },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.reload();
                        } 
                    },
                });
            }
        });

        $('#search-text-field').on('keyup', function() {
            if ($('#search-text-field').val() != "") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            }
        });
       
        $('#reset-filters,#reset-filters-2').click(function() {
            $('#filter-form')[0].reset();
            $('.filter-box .select-picker').selectpicker("refresh");
            $('#reset-filters').addClass('d-none');
            showTable();
        });

       
        $('body').on('click', '.companysign', function() {
            row_id = $(this).data('user-row');
        //    console.log(row_id);
        })

        $('#save-signature').click(function() {
            var token = "<?php echo e(csrf_token()); ?>";
            var url = "<?php echo e(route('vendors.companysign')); ?>";
            var signature = signaturePad.toDataURL('image/png');
            var signature_type = !$('.signature').hasClass('d-none') ? 'signature' : 'upload';
            if (signaturePad.isEmpty() && !$('.signature').hasClass('d-none')) {
                Swal.fire({
                    icon: 'error',
                    text: '<?php echo e(__('messages.signatureRequired')); ?>',

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
                        type: "POST",
                        file: true,
                        container: '#acceptEstimate',
                        disableButton: true,
                        blockUI: true,
                        data:{
                            id:row_id,
                            '_token': token,
                            signature:signature,
                            signature_type:signature_type,
                            details:$('#acceptEstimate').serialize()
                        },
                        success: function(response) {
                            $('#signature-modal').modal('hide');
                            showTable();
                        }
                    });
                                                                                                                                                                                                                                                                                
        });


        $('body').on('click', '.delete-table-row', function() {
            const id = $(this).data('user-id');
            var token = "<?php echo e(csrf_token()); ?>";
            Swal.fire({
                title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                text:   "<?php echo app('translator')->get('messages.recoverRecord'); ?>",
                icon: 'warning',
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "<?php echo app('translator')->get('messages.confirmDelete'); ?>",
                cancelButtonText: "<?php echo app('translator')->get('app.cancel'); ?>",
                customClass: {
                    confirmButton: 'btn btn-primary mr-3',
                    cancelButton: 'btn btn-secondary'
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "<?php echo e(route('vendors.destroy', ':id')); ?>";
                    url = url.replace(':id', id);
                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: {
                            '_token': token,
                            '_method': 'DELETE'
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                showTable();
                            }
                        }
                    });
                }
            });
        });
        
    </script>
    <script>
        var canvas = document.getElementById('signature-pad');

        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
        });

        document.getElementById('clear-signature').addEventListener('click', function (e) {
            e.preventDefault();
            signaturePad.clear();
        });

        document.getElementById('undo-signature').addEventListener('click', function (e) {
            e.preventDefault();
            var data = signaturePad.toData();
            if (data) {
                data.pop(); // remove the last dot or line
                signaturePad.fromData(data);
            }
        });
        $('#toggle-pad-uploader').click(function () {
            var text = $('.signature').hasClass('d-none') ? '<?php echo e(__("modules.estimates.uploadSignature")); ?>' : '<?php echo e(__("app.sign")); ?>';

            $(this).html(text);

            $('.signature').toggleClass('d-none');
            $('.upload-image').toggleClass('d-none');
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/vendors/index.blade.php ENDPATH**/ ?>