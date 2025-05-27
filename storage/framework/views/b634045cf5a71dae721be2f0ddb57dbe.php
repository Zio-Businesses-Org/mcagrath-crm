

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
<!-- PRE POPULATION SWITCH START -->
<div class="mr-3 d-flex align-items-center border-right-grey border-left-grey pl-2" style="min-width: 150px;">
    <div class="custom-control custom-switch" style="cursor: pointer;">
        <input type="checkbox" class="custom-control-input" id="customSwitch1" style="cursor: pointer;">
        <label class="custom-control-label mb-0" for="customSwitch1" style="cursor: pointer;">Pre Population</label>
    </div>
</div>
<!-- PRE POPULATION SWITCH END -->
    <!-- SEARCH BY TASK START -->
    <div class="task-search d-flex py-1 px-lg-3 px-0 border-right-grey align-items-center">
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
<?php $__currentLoopData = $leadVendorFilter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <a class="dropdown-item edit-filter-lead-vendor" href="javascript:;"
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
            <div id="table-actions" class="flex-grow-1 align-items-center">     
                <?php if (isset($component)) { $__componentOriginaldbb84df4c3a5cbdd95fb35d18ba6410f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbb84df4c3a5cbdd95fb35d18ba6410f = $attributes; } ?>
<?php $component = App\View\Components\Forms\LinkPrimary::resolve(['icon' => 'plus','link' => route('lead-vendor.handle')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.link-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\LinkPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mr-3 openRightModal float-left mb-2 mb-lg-0 mb-md-0','id' => 'addVendorLead']); ?>
                <?php echo app('translator')->get('Add Vendor Lead'); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldbb84df4c3a5cbdd95fb35d18ba6410f)): ?>
<?php $attributes = $__attributesOriginaldbb84df4c3a5cbdd95fb35d18ba6410f; ?>
<?php unset($__attributesOriginaldbb84df4c3a5cbdd95fb35d18ba6410f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldbb84df4c3a5cbdd95fb35d18ba6410f)): ?>
<?php $component = $__componentOriginaldbb84df4c3a5cbdd95fb35d18ba6410f; ?>
<?php unset($__componentOriginaldbb84df4c3a5cbdd95fb35d18ba6410f); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonSecondary::resolve(['icon' => 'file-upload'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonSecondary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mr-3 float-left mb-2 mb-lg-0 mb-md-0 d-sm-bloc d-none d-lg-block','id' => 'importLeadVendor']); ?>
                    <?php echo app('translator')->get('app.importExcel'); ?>
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
            <?php if (isset($component)) { $__componentOriginald48019b35c4ccf364e5d37d92848414c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald48019b35c4ccf364e5d37d92848414c = $attributes; } ?>
<?php $component = App\View\Components\Datatable\Actions::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Datatable\Actions::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <div class="select-status mr-3 pl-3">
                    <select name="action_type" class="form-control select-picker" id="quick-action-type" disabled>
                        <option value=""><?php echo app('translator')->get('app.selectAction'); ?></option>
                        <option value="change-created-by"><?php echo app('translator')->get('Change Created By'); ?></option>
                        <option value="change-follow-up"><?php echo app('translator')->get('Change Next Follow Up Date'); ?></option>
                        <option value="delete"><?php echo app('translator')->get('app.delete'); ?></option>
                    </select>
                </div>
                <div class="select-status mr-3 d-none quick-action-field" id="change-created-by-action">
                        <select class="form-control select-picker" name="member"
                                data-live-search="true" data-container="body" data-size="8">
                            <?php $__currentLoopData = $allEmployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->name); ?>" >
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                </div>
                <div class="select-status mr-3 d-none quick-action-field" id="change-follow-up-action">
                    <input type="text" class="form-control custom-date-picker date-picker height-35 f-14"
                    placeholder="Next Follow Up Date" name="nxt_follow_up_action"
                    id="nxt_follow_up_action"/>
                </div>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald48019b35c4ccf364e5d37d92848414c)): ?>
<?php $attributes = $__attributesOriginald48019b35c4ccf364e5d37d92848414c; ?>
<?php unset($__attributesOriginald48019b35c4ccf364e5d37d92848414c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald48019b35c4ccf364e5d37d92848414c)): ?>
<?php $component = $__componentOriginald48019b35c4ccf364e5d37d92848414c; ?>
<?php unset($__componentOriginald48019b35c4ccf364e5d37d92848414c); ?>
<?php endif; ?>
            <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                <a href="<?php echo e(route('vendors.index')); ?>" class="btn btn-secondary f-14 btn-active" data-toggle="tooltip"
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
<?php $component->withAttributes(['id' => 'save-lead-vendor-filter-form']); ?>
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
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr"><?php echo app('translator')->get('Next Follow Up Date'); ?></label>
                                        <div class="select-status d-flex">
                                            <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                                            placeholder="<?php echo app('translator')->get('placeholders.dateRange'); ?>" id="customRange">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                            for="usr"><?php echo app('translator')->get('City'); ?></label>
                                        <div class="mb-4">
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
                                            for="usr"><?php echo app('translator')->get('Lead Source'); ?></label>
                                        <div class="mb-4">
                                        <select class="form-control select-picker" name="filter_lead_source[]" id="filter_lead_source"
                                                data-live-search="true" data-container="body" data-size="8" multiple>
                                            <?php $__currentLoopData = $leadsource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->type); ?>" >
                                                    <?php echo e($category->type); ?>

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
                                                <option value="Accepted" >
                                                    Accepted
                                                </option>
                                            <?php $__currentLoopData = $vendorStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category); ?>" >
                                                    <?php echo e($category); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                               
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
      const switchCheckbox = $('#customSwitch1');
        // Check if the setting is already in localStorage and set the checkbox state accordingly
        const prePopulateEnabled = localStorage.getItem('prePopulateEnabled') === 'true';
        switchCheckbox.prop('checked', prePopulateEnabled);
        // Toggle localStorage when the switch is clicked
        switchCheckbox.change(function () {
            if ($(this).is(':checked')) {
                localStorage.setItem('prePopulateEnabled', 'true'); // Set to true
            } else {
                localStorage.setItem('prePopulateEnabled', 'false'); // Set to false
            }
        });
    $(document).ready(function () {
    var startDate = '';
    var endDate = '';

    $('.custom-date-picker').each(function(ind, el) {
        datepicker(el, {
            position: 'bl',
            ...datepickerConfig
        });
    });

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
    $('#filter_category_id').val([]).selectpicker('refresh');
    $('#filter_vendor').val([]).selectpicker('refresh');
    $('#filter_link_status').val([]).selectpicker('refresh');
    $('#filter_wo_status').val([]).selectpicker('refresh');
    $('#filter_project_status').val([]).selectpicker('refresh');
    $('#filter_client').val([]).selectpicker('refresh');
    $('#filter_members').val([]).selectpicker('refresh');
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
            var url = "<?php echo e(route('lead-vendor-filter.store')); ?>";
            $.easyAjax({
                url: url,
                container: '#save-lead-vendor-filter-form',
                type: "POST",
                blockUI: true,
                disableButton: true,
                buttonSelector: '#save-filter',
                data: $('#save-lead-vendor-filter-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        $('#CustomFilterModal').modal('hide');
                        window.location.reload();
                    }
                }
            })
        });

        $('body').on('click', '.edit-filter-lead-vendor', function() {
            var id = $(this).data('row-id');

            var url = "<?php echo e(route('lead-vendor-filter.edit', ':id')); ?>";
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
                    var url = "<?php echo e(route('lead-vendor-filter.destroy', ':id')); ?>";
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
            var url = "<?php echo e(route('lead-vendor-filter.change-status',':id')); ?>";
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
            var url = "<?php echo e(route('lead-vendor-filter.clear',':id')); ?>";
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

        
         $("#file").dropify({
            messages: dropifyMessages
        });
        var row_id;
       
        $('#vendorstrack-table').on('preXhr.dt', function(e, settings, data) {

            const searchText = $('#search-text-field').val();
            data['searchText'] = searchText;
        });
        
        const showTable = () => {
            window.LaravelDataTables["vendorstrack-table"].draw(false);
        }

        $('#search-text-field').on('keyup', function() {
            if ($('#search-text-field').val() != "") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            }
        });
        $('#importLeadVendor').click(function () {
                var url = "<?php echo e(route('vendortrack.importLeadVendor')); ?>";
                $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
                $.ajaxModal(MODAL_LG, url);
            });
        $('#reset-filters,#reset-filters-2').click(function() {
            $('#filter-form')[0].reset();
            $('.filter-box .select-picker').selectpicker("refresh");
            $('#reset-filters').addClass('d-none');
            showTable();
        });    
        $('#quick-action-type').change(function() {
            const actionValue = $(this).val();
            if (actionValue != '') {
                $('#quick-action-apply').removeAttr('disabled');

                if (actionValue == 'change-follow-up') {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-follow-up-action').removeClass('d-none');
                } 
                else if(actionValue =='change-created-by')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-created-by-action').removeClass('d-none');
                    
                }
                else {
                    $('.quick-action-field').addClass('d-none');
                }
            } else {
                $('#quick-action-apply').attr('disabled', true);
                $('.quick-action-field').addClass('d-none');
            }
        });

        $('#quick-action-apply').click(function() {
            const actionValue = $('#quick-action-type').val();
            if (actionValue == 'delete') {
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
                        applyQuickAction();
                    }
                });

            } else {
                applyQuickAction();
            }
        });
        const applyQuickAction = () => {
            var rowdIds = $("#vendorstrack-table input:checkbox:checked").map(function() {
                return $(this).val();
            }).get().filter(value => value !== "on");

            var url = "<?php echo e(route('leads.apply_quick_action')); ?>?row_ids=" + rowdIds;
            
            
            $.easyAjax({
                url: url,
                container: '#quick-action-form',
                type: "POST",
                disableButton: true,
                buttonSelector: "#quick-action-apply",
                data: $('#quick-action-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                        resetActionButtons();
                        deSelectAll();
                        $('#quick-action-apply').attr('disabled', 'disabled');
                        $('#change-status-action').addClass('d-none');
                        $('#change-member-action').addClass('d-none');
                        $('#quick-action-form').hide();
                    }
                }
            })
        };
        
        $('body').on('click', '.send-proposal', function() {
            const id = $(this).data('user-send');
            var token = "<?php echo e(csrf_token()); ?>";
            var buttonSelector=".send-proposal";
            var url = "<?php echo e(route('vendortrack.proposal', ':id')); ?>";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                disableButton: true,
                blockUI: true,
                buttonSelector: buttonSelector,
                data: {
                    '_token': token,
                },
                success: function(response) {
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
                    var url = "<?php echo e(route('vendortrack.destroy', ':id')); ?>";
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

        $( document ).ready(function() {
            <?php if(!is_null(request('start')) && !is_null(request('end'))): ?>
            $('#datatableRange').val('<?php echo e(request('start')); ?>' +
            ' <?php echo app('translator')->get("app.to"); ?> ' + '<?php echo e(request('end')); ?>');
            $('#datatableRange').data('daterangepicker').setStartDate("<?php echo e(request('start')); ?>");
            $('#datatableRange').data('daterangepicker').setEndDate("<?php echo e(request('end')); ?>");
                showTable();
            <?php endif; ?>
        });

    </script>
    <script>
        $(document).ready(function () {
            // Select All Checkbox Functionality
            $('body').on("change", "#new-select-all-table", function () {
                $("#vendorstrack-table .select-table-row").prop("checked", this.checked);
                if ($(".select-table-row:checked").length > 0){
                    $("#quick-action-form").fadeIn();
                    $("#quick-actions").find("input, textarea, button, select").removeAttr("disabled");
                    $("#quick-actions").find("button").removeClass("disabled");
                   // $(".select-picker").selectpicker("refresh");
                    $("#quick-action-type,#change-created-by-action").selectpicker("refresh");
                } else {
                    $("#quick-action-form").fadeOut();
                }
                
            });
            $('body').on("change", ".select-table-row", function () {
                if ($(".select-table-row:checked").length > 0){
                    $("#quick-action-form").fadeIn();
                    $("#quick-actions").find("input, textarea, button, select").removeAttr("disabled");
                    $("#quick-actions").find("button").removeClass("disabled");
                    $("#quick-action-type,#change-created-by-action").selectpicker("refresh");
                    //$(".select-picker").selectpicker("refresh");
                } else {
                    $("#quick-action-form").fadeOut();
                }
                 
            });

            // Individual Checkbox Click - Control Select All Checkbox
            // $(document).on("change", ".select-table-row", function () {
            //     let allChecked = $("#project_datatable .select-table-row").length === $("#project_datatable .select-table-row:checked").length;
            //     $("#select-all-checkbox").prop("checked", allChecked);
            // });
        });

    </script>
   
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/vendortrack/index.blade.php ENDPATH**/ ?>