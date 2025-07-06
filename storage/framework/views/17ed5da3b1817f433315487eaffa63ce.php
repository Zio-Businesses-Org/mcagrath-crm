

<?php $__env->startPush('datatable-styles'); ?>
    <?php echo $__env->make('sections.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('filter-section'); ?>
<style>
    .dropdown{
        position :static;  
    } 
    .button-wrapper::-webkit-scrollbar {
        display: none; /* Hides the scrollbar */
    }
</style>   
<?php if (isset($component)) { $__componentOriginald1a72e1108842d163a80559e15f530b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald1a72e1108842d163a80559e15f530b4 = $attributes; } ?>
<?php $component = App\View\Components\Filters\FilterBox::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filters.filter-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Filters\FilterBox::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'justify-content-center']); ?>
    <div class="task-search d-flex  py-1 px-lg-3 px-0  align-items-center">
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

    <!-- RESET START -->
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
<?php if (isset($__attributesOriginald1a72e1108842d163a80559e15f530b4)): ?>
<?php $attributes = $__attributesOriginald1a72e1108842d163a80559e15f530b4; ?>
<?php unset($__attributesOriginald1a72e1108842d163a80559e15f530b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald1a72e1108842d163a80559e15f530b4)): ?>
<?php $component = $__componentOriginald1a72e1108842d163a80559e15f530b4; ?>
<?php unset($__componentOriginald1a72e1108842d163a80559e15f530b4); ?>
<?php endif; ?>
<div class="container-fluid d-flex position-relative border-bottom-grey">
        <!-- Left Scroll Button -->
        <button class="btn btn-dark" id="scrollLeftBtn" style="display: none; left: 0;">&#9664;</button>
        <!-- Scrollable Button Wrapper -->
        <div id="buttonWrapper" class="button-wrapper d-flex overflow-auto flex-nowrap my-2">
        <?php $__currentLoopData = $projectFilter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- Buttons in a horizontal line -->
            <div class="task_view mx-1">
                
                <div class="taskView text-darkest-grey f-w-500"><?php if($filter->status=='active'): ?><i class="fa fa-circle mr-2" style="color:#679c0d;"></i><?php endif; ?><?php echo e($filter->name); ?></div>
                <div class="dropdown">
                    <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
                        type="link" id="dropdownMenuLink-<?php echo e($filter->id); ?>" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="icon-options-vertical icons"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" 
                        aria-labelledby="dropdownMenuLink-<?php echo e($filter->id); ?>" tabindex="0" >
                           <?php if($filter->status=='inactive'): ?>
                            <a class="dropdown-item apply-filter" href="javascript:;"
                                data-row-id="<?php echo e($filter->id); ?>">
                                <i class="bi bi-save2 mr-2"></i>
                                <?php echo app('translator')->get('Apply'); ?>
                            </a>
                            <?php endif; ?>
                            <a class="dropdown-item edit-filter" href="javascript:;"
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

<?php
$addProjectPermission = user()->permission('add_projects');
$manageProjectTemplatePermission = user()->permission('manage_project_template');
$viewProjectTemplatePermission = user()->permission('view_project_template');
$deleteProjectPermission = user()->permission('delete_projects');
?>

<?php $__env->startSection('content'); ?>
    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-grid d-lg-flex d-md-flex action-bar">
            <div id="table-actions" class="flex-grow-1 align-items-center mb-2 mb-lg-0 mb-md-0">
                <?php if($addProjectPermission == 'all' || $addProjectPermission == 'added' || $addProjectPermission == 'both'): ?>
                    <?php if (isset($component)) { $__componentOriginaldbb84df4c3a5cbdd95fb35d18ba6410f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbb84df4c3a5cbdd95fb35d18ba6410f = $attributes; } ?>
<?php $component = App\View\Components\Forms\LinkPrimary::resolve(['link' => route('projects.create'),'icon' => 'plus'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.link-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\LinkPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mr-3 openRightModal float-left mb-2 mb-lg-0 mb-md-0']); ?>
                        <?php echo app('translator')->get('app.addProject'); ?>
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
                <?php endif; ?>
                <?php if($viewProjectTemplatePermission == 'all' || in_array($manageProjectTemplatePermission , ['added', 'all'])): ?>
                    <?php if (isset($component)) { $__componentOriginal29acd9b76240152ae380821b082bd629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal29acd9b76240152ae380821b082bd629 = $attributes; } ?>
<?php $component = App\View\Components\Forms\LinkSecondary::resolve(['link' => route('project-template.index'),'icon' => 'layer-group'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.link-secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\LinkSecondary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mr-3 mb-2 mb-lg-0 mb-md-0 float-left']); ?>
                        <?php echo app('translator')->get('app.menu.projectTemplate'); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal29acd9b76240152ae380821b082bd629)): ?>
<?php $attributes = $__attributesOriginal29acd9b76240152ae380821b082bd629; ?>
<?php unset($__attributesOriginal29acd9b76240152ae380821b082bd629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal29acd9b76240152ae380821b082bd629)): ?>
<?php $component = $__componentOriginal29acd9b76240152ae380821b082bd629; ?>
<?php unset($__componentOriginal29acd9b76240152ae380821b082bd629); ?>
<?php endif; ?>
                <?php endif; ?>


                <?php if($addProjectPermission == 'all' || $addProjectPermission == 'added' || $addProjectPermission == 'both'): ?>
                    <?php if (isset($component)) { $__componentOriginal29acd9b76240152ae380821b082bd629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal29acd9b76240152ae380821b082bd629 = $attributes; } ?>
<?php $component = App\View\Components\Forms\LinkSecondary::resolve(['link' => route('projects.import'),'icon' => 'file-upload'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.link-secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\LinkSecondary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mr-3 float-left mb-2 mb-lg-0 mb-md-0 d-none d-lg-block']); ?>
                        <?php echo app('translator')->get('app.importExcel'); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal29acd9b76240152ae380821b082bd629)): ?>
<?php $attributes = $__attributesOriginal29acd9b76240152ae380821b082bd629; ?>
<?php unset($__attributesOriginal29acd9b76240152ae380821b082bd629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal29acd9b76240152ae380821b082bd629)): ?>
<?php $component = $__componentOriginal29acd9b76240152ae380821b082bd629; ?>
<?php unset($__componentOriginal29acd9b76240152ae380821b082bd629); ?>
<?php endif; ?>
                <?php endif; ?>

            </div>

            <?php if(!in_array('client', user_roles())): ?>
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
                    <input type="hidden" id="member_type" name="member_type"/>
                    <div class="select-status mr-3 pl-3">
                        <select name="action_type" class="form-control select-picker" id="quick-action-type" disabled>
                            <option value=""><?php echo app('translator')->get('app.selectAction'); ?></option>
                            <option value="change-status"><?php echo app('translator')->get('modules.tasks.changeStatus'); ?></option>
                            <option value="change-project-manager"><?php echo app('translator')->get('Change Project Manager'); ?></option>
                            <option value="change-project-coordinator"><?php echo app('translator')->get('Change Project Coordinator'); ?></option>
                            <option value="change-project-estimator"><?php echo app('translator')->get('Change Project Estimator'); ?></option>
                            <option value="change-accounting-analyst"><?php echo app('translator')->get('Change Accounting Analyst'); ?></option>
                            <option value="change-escalation-manager"><?php echo app('translator')->get('Change Escalation Manager'); ?></option>
                            <option value="change-project-scheduler"><?php echo app('translator')->get('Change Project Scheduler'); ?></option>
                            <option value="change-vendor-recruiter"><?php echo app('translator')->get('Change Vendor Recruiter'); ?></option>
                            <option value="change-follow-up"><?php echo app('translator')->get('Change Next Follow Up Date'); ?></option>
                            <option value="change-follow-up-time"><?php echo app('translator')->get('Change Next Follow Up Time'); ?></option>
                            <option value="archive"><?php echo app('translator')->get('app.archive'); ?></option>
                            <option value="delete"><?php echo app('translator')->get('app.delete'); ?></option>
                        </select>
                    </div>
                    <div class="select-status mr-3 d-none quick-action-field" id="change-status-action">
                        <select name="status" class="form-control select-picker">
                            <?php $__currentLoopData = $projectStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($status->status_name); ?>"><?php echo e($status->status_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="select-status mr-3 d-none quick-action-field" id="change-member-action">
                        <select class="form-control select-picker" name="member"
                                data-live-search="true" data-container="body" data-size="8">
                            <?php $__currentLoopData = $allEmployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" >
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="select-status mr-3 d-none quick-action-field" id="change-follow-up-action">
                        <input type="text" class="form-control custom-bulk-action-date-picker date-picker height-35 f-14"
                        placeholder="Next Follow Up Date" name="nxt_follow_up_action"
                        id="nxt_follow_up_action"/>
                    </div>
                    <div class="select-status mr-3 d-none quick-action-field" id="nxt-follow-up-time">
                        <input type="text" class="form-control height-35 f-14"
                        placeholder="Next Follow Up Time" name="nxt_follow_up_time"
                        id="nxt_follow_up_time"/>
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
            <?php endif; ?>

            <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                <a href="<?php echo e(route('projects.index')); ?>" class="btn btn-secondary f-14 btn-active projects" data-toggle="tooltip"
                    data-original-title="<?php echo app('translator')->get('app.menu.projects'); ?>"><i class="side-icon bi bi-list-ul"></i></a>

                    <a class="btn btn-secondary f-14" data-toggle="tooltip" id="custom-filter"
                    data-original-title="<?php echo app('translator')->get('Custom Filter'); ?>"><i class="side-icon bi bi-filter"></i></a>
                    <?php if($deleteProjectPermission != 'none'): ?>

                        <a href="<?php echo e(route('projects.archive')); ?>" class="btn btn-secondary f-14" data-toggle="tooltip"
                            data-original-title="<?php echo app('translator')->get('app.archive'); ?>"><i class="side-icon bi bi-archive"></i></a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('project-calendar.index')); ?>" class="btn btn-secondary f-14" data-toggle="tooltip"
                    data-original-title="<?php echo app('translator')->get('app.menu.calendar'); ?>"><i class="side-icon bi bi-calendar"></i></a>

                <a href="javascript:;" class="btn btn-secondary f-14 show-pinned" data-toggle="tooltip"
                    data-original-title="<?php echo app('translator')->get('app.pinned'); ?>"><i class="side-icon bi bi-pin-angle"></i></a>
            </div>
        </div>
        <!-- Add Task Export Buttons End -->
        <!-- Task Box Start -->
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white table-responsive">

            <?php echo $dataTable->table(['class' => 'table table-hover border-0 w-100']); ?>


        </div>
        <!-- Task Box End -->
    </div>
    <!-- CONTENT WRAPPER END -->
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
<?php $component->withAttributes(['id' => 'save-project-filter-form']); ?>
                        <input type="hidden" name="user_id" value=" <?php echo e(user()->id); ?> ">
                        <input type="hidden" name="startDate" id="startDate">
                        <input type="hidden" name="endDate" id="endDate">
                        <input type="hidden" name="startDatenxt" id="startDatenxt">
                        <input type="hidden" name="endDatenxt" id="endDatenxt">
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
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr"><?php echo app('translator')->get('app.dateFilterOn'); ?></label>
                                    <div class="mb-4">
                                        <select class="form-control select-picker pb-1" name="custom_date_filter_on" id="custom_date_filter_on">
                                            <option value="deadline" ><?php echo app('translator')->get('Due Date'); ?></option>
                                            <option value="start_date" ><?php echo app('translator')->get('Project Date'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mt-3">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr"><?php echo app('translator')->get('app.duration'); ?></label>
                                    <div class="select-status d-flex">
                                        <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                                        placeholder="<?php echo app('translator')->get('placeholders.dateRange'); ?>" id="customRange">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr"><?php echo app('translator')->get('Next Follow Up Date'); ?></label>
                                    <div class="select-status d-flex">
                                        <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                                        placeholder="<?php echo app('translator')->get('placeholders.dateRange'); ?>" id="nxtRange">
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr"><?php echo app('translator')->get('modules.projects.projectCategory'); ?></label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_category_id[]" id="filter_category_id"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>" >
                                                <?php echo e($category->category_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </div>
                                </div>
                             
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr"><?php echo app('translator')->get('Project Sub-Category'); ?></label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_sub_category[]" id="filter_sub_category"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->sub_category); ?>" >
                                                <?php echo e($category->sub_category); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr"><?php echo app('translator')->get('Project Type'); ?></label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_type[]" id="filter_type"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        <?php $__currentLoopData = $projecttype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->type); ?>">
                                                <?php echo e($category->type); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr"><?php echo app('translator')->get('Project Priority'); ?></label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_priority[]" id="filter_priority"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        <?php $__currentLoopData = $projectpriority; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->priority); ?>">
                                                <?php echo e($category->priority); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </div>
                                </div>
                              
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr"><?php echo app('translator')->get('Project Status'); ?></label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_status[]" id="filter_status"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        <?php $__currentLoopData = $projectStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->status_name); ?>">
                                                <?php echo e($category->status_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </div>
                                </div>
                  
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr"><?php echo app('translator')->get('Delayed By'); ?></label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_delayed[]" id="filter_delayed"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        <?php $__currentLoopData = $delayedby; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->delayed_by); ?>">
                                                <?php echo e($category->delayed_by); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr"><?php echo app('translator')->get('Client'); ?></label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_client[]" id="filter_client"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>">
                                                <?php echo e($category->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr"><?php echo app('translator')->get('City'); ?></label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_city[]" id="filter_city"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category); ?>" >
                                                <?php echo e($category); ?>

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
                                            <option value="<?php echo e($category); ?>" >
                                                <?php echo e($category); ?>

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
                                            <option value="<?php echo e($category); ?>" >
                                                <?php echo e($category); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                                        for="usr"><?php echo app('translator')->get('Members'); ?></label>
                                    <div class="mb-4">
                                    <select class="form-control select-picker" name="filter_members[]" id="filter_members"
                                            data-live-search="true" data-container="body" data-size="8" multiple>
                                        <?php $__currentLoopData = $allEmployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>" >
                                                <?php echo e($category->name); ?>

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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('sections.datatable_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
    $(document).ready(function () {
        var startDate = '';
        var endDate = '';
        var startDatenxt = '';
        var endDatenxt = '';
        var firstOpen = true;

        $('#customRange,#nxtRange').daterangepicker({
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
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                // 'Today Onwards': [moment(), moment().add(10, 'years')],
                // 'Tomorrow Onwards': [moment().add(1, 'day'), moment().add(10, 'years')],
                // 'Past': [moment().subtract(50, 'years'), moment().subtract(1, 'day')],
           }
        });
        
        $('#nxtRange').on('apply.daterangepicker', function(ev, picker) {
            // Get start and end dates
            if(picker.endDate == 'Future')
            {
                console.log(picker.endDate);
            }
            startDatenxt = picker.startDate.format('YYYY-MM-DD');
            document.getElementById('startDatenxt').value=startDatenxt;
            endDatenxt = picker.endDate.format('YYYY-MM-DD');
            document.getElementById('endDatenxt').value=endDatenxt;
            
            $(this).val(picker.startDate.format('<?php echo e(company()->moment_date_format); ?>') + ' - ' + picker.endDate.format('<?php echo e(company()->moment_date_format); ?>'));
            
        });

        $('#customRange').on('apply.daterangepicker', function(ev, picker) {
            // Get start and end dates
            startDate = picker.startDate.format('YYYY-MM-DD');
            document.getElementById('startDate').value=startDate;
            endDate = picker.endDate.format('YYYY-MM-DD');
            document.getElementById('endDate').value=endDate;
            
            $(this).val(picker.startDate.format('<?php echo e(company()->moment_date_format); ?>') + ' - ' + picker.endDate.format('<?php echo e(company()->moment_date_format); ?>'));
            
        });
        $('.custom-bulk-action-date-picker').each(function(ind, el) {
            datepicker(el, {
                position: 'bl',
                ...datepickerConfig
            });
        });
        
        $('#nxt_follow_up_time').datetimepicker({
            <?php if(company()->time_format == 'H:i'): ?>
                showMeridian: false,
            <?php endif; ?>
            useCurrent: false,
            format: "hh:mm A"
            }).on('dp.show', function() {
            if(firstOpen) {
                time = moment().startOf('day');
                firstOpen = false;
            } 
            
        });
        
        $('#save-filter').click(function () {
            if($('#customRange').val()=='')
            {
                document.getElementById('startDate').value='';
                document.getElementById('endDate').value='';
            }
            if($('#nxtRange').val()=='')
            {
                document.getElementById('startDatenxt').value='';
                document.getElementById('endDatenxt').value='';
            }
            var url = "<?php echo e(route('project-filter.store')); ?>";
            $.easyAjax({
                url: url,
                container: '#save-project-filter-form',
                type: "POST",
                blockUI: true,
                disableButton: true,
                buttonSelector: '#save-filter',
                data: $('#save-project-filter-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                        $('#CustomFilterModal').modal('hide');
                    }
                }
            })
         });

         $('#clear').click(function() {
            $('#filter_category_id').val([]).selectpicker('refresh');
            $('#filter_sub_category').val([]).selectpicker('refresh');
            $('#filter_type').val([]).selectpicker('refresh');
            $('#filter_priority').val([]).selectpicker('refresh');
            $('#filter_status').val([]).selectpicker('refresh');
            $('#filter_delayed').val([]).selectpicker('refresh');
            $('#filter_client').val([]).selectpicker('refresh');
            $('#filter_city').val([]).selectpicker('refresh');
            $('#filter_state').val([]).selectpicker('refresh');
            $('#filter_county').val([]).selectpicker('refresh');
            $('#filter_members').val([]).selectpicker('refresh');
            document.getElementById('startDate').value='';
            document.getElementById('endDate').value='';
            document.getElementById('startDatenxt').value='';
            document.getElementById('endDatenxt').value='';
            $('#customRange').val('');
            $('#nxtRange').val('');
            $('#filter_name').val('');
        });

        $('#custom-filter').click(function () {
            $('#CustomFilterModal').modal('show');
         });
         $('#close').click(function () {
            $('#CustomFilterModal').modal('hide');
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

        $('body').on('click', '.edit-filter', function() {
            var id = $(this).data('row-id');

            var url = "<?php echo e(route('project-filter.edit', ':id')); ?>";
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
                    var url = "<?php echo e(route('project-filter.destroy', ':id')); ?>";
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
            var url = "<?php echo e(route('project-filter.change-status',':id')); ?>";
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
            var url = "<?php echo e(route('project-filter.clear',':id')); ?>";
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

    <script>

        $(".select-picker").selectpicker();

        $('#projects-table').on('preXhr.dt', function(e, settings, data) {


            var searchText = $('#search-text-field').val();
      
            data['searchText'] = searchText;
           
        });

        const showTable = () => {
            window.LaravelDataTables["projects-table"].draw(false);
        }

        $('#search-text-field').on('keyup', function() {
            if ($('#search-text-field').val() != "") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            }
        });


        $('#reset-filters,#reset-filters-2').click(function() {
            $('#filter-form')[0].reset();
            $('.filter-box #date_filter_on').val('deadline');
            $('.filter-box .select-picker').selectpicker("refresh");
            $('#reset-filters').addClass('d-none');
            showTable();
        });

        $('#quick-action-type').change(function() {
            const actionValue = $(this).val();
            if (actionValue != '') {
                $('#quick-action-apply').removeAttr('disabled');

                if (actionValue == 'change-status') {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-status-action').removeClass('d-none');
                } 
                else if(actionValue =='change-project-manager')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('project-manager');
                    
                }
                else if(actionValue =='change-project-coordinator')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('project-coordinator');
                    
                }
                else if(actionValue =='change-project-estimator')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('project-estimator');
                    
                }
                else if(actionValue =='change-accounting-analyst')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('accounting-analyst');
                    
                }
                else if(actionValue =='change-escalation-manager')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('escalation-manager');
                    
                }
                else if(actionValue =='change-project-scheduler')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('project-scheduler');
                    
                }
                else if(actionValue =='change-vendor-recruiter')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-member-action').removeClass('d-none');
                    $('#member_type').val('vendor-recruiter');
                    
                }
                else if(actionValue =='change-follow-up')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-follow-up-action').removeClass('d-none');
                    
                }
                else if(actionValue =='change-follow-up-time')
                {
                    $('.quick-action-field').addClass('d-none');
                    $('#nxt-follow-up-time').removeClass('d-none');
                    
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

        $('body').on('click', '.delete-table-row', function() {
            var id = $(this).data('user-id');
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
                    var url = "<?php echo e(route('projects.destroy', ':id')); ?>";
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
                                showTable();
                            }
                        }
                    });
                }
            });
        });

        $('body').on('click', '.archive', function() {
            var id = $(this).data('user-id');
            Swal.fire({
                title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                text: "<?php echo app('translator')->get('messages.archiveMessage'); ?>",
                icon: 'warning',
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "<?php echo app('translator')->get('messages.confirmArchive'); ?>",
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
                    var url = "<?php echo e(route('projects.archive_delete', ':id')); ?>";
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
                                window.LaravelDataTables["projects-table"].draw(false);
                            }
                        }
                    });
                }
            });
        });

        const applyQuickAction = () => {
            var rowdIds = $("#projects-table input:checkbox:checked").map(function() {
                return $(this).val();
            }).get().filter(value => value !== "on");

            var url = "<?php echo e(route('projects.apply_quick_action')); ?>?row_ids=" + rowdIds;
            
            
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


        $('body').on('click', '.duplicateProject', function(){
            var id = $(this).data('project-id');
            var url = "<?php echo e(route('projects.duplicate_project', ':id')); ?>";
            url = url.replace(':id', id);

            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

    </script>
    <script>
        $(document).ready(function () {
            // Select All Checkbox Functionality
            $('body').on("change", "#new-select-all-table", function () {
                $("#projects-table .select-table-row").prop("checked", this.checked);
                if ($(".select-table-row:checked").length > 0){
                    $("#quick-action-form").fadeIn();
                    $("#quick-actions").find("input, textarea, button, select").removeAttr("disabled");
                    $("#quick-actions").find("button").removeClass("disabled");
                   // $(".select-picker").selectpicker("refresh");
                    $("#quick-action-type,#change-member-action,#change-status-action").selectpicker("refresh");
                } else {
                    $("#quick-action-form").fadeOut();
                }
                
            });
            $('body').on("change", ".select-table-row", function () {
                if ($(".select-table-row:checked").length > 0){
                    $("#quick-action-form").fadeIn();
                    $("#quick-actions").find("input, textarea, button, select").removeAttr("disabled");
                    $("#quick-actions").find("button").removeClass("disabled");
                    $("#quick-action-type,#change-member-action,#change-status-action").selectpicker("refresh");
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/projects/index.blade.php ENDPATH**/ ?>