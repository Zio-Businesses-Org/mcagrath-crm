

<?php $__env->startPush('datatable-styles'); ?>
    <?php echo $__env->make('sections.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php
$viewProjectMemberPermission = user()->permission('view_project_members');
$viewProjectMilestonePermission = ($project->project_admin == user()->id) ? 'all' : user()->permission('view_project_milestones');
$viewTasksPermission = ($project->project_admin == user()->id) ? 'all' : user()->permission('view_project_tasks');
$viewGanttPermission = ($project->project_admin == user()->id) ? 'all' : user()->permission('view_project_gantt_chart');
$viewInvoicePermission = user()->permission('view_project_invoices');
$viewDiscussionPermission = user()->permission('view_project_discussions');
$viewNotePermission = user()->permission('view_project_note');
$viewFilesPermission = user()->permission('view_project_files');
$viewRatingPermission = user()->permission('view_project_rating');
$viewOrderPermission = user()->permission('view_project_orders');

$projectArchived = $project->trashed();
?>


<?php $__env->startSection('filter-section'); ?>
    <!-- FILTER START -->
    <!-- PROJECT HEADER START -->
    <?php echo $__env->make('projects.static', ['project' => $project], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="d-flex d-lg-block filter-box project-header bg-white border-top-grey">
        <div class="mobile-close-overlay w-100 h-100" id="close-client-overlay"></div>

        <div class="project-menu" id="mob-client-detail">
            <a class="d-none close-it" href="javascript:;" id="close-client-detail">
                <i class="fa fa-times"></i>
            </a>
            <nav class="tabs">
                <ul class="-primary">
                    <li>
                        <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id),'text' => __('modules.projects.overview')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'overview']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                    </li>

                    <?php if(
                        !$project->public && $viewProjectMemberPermission == 'all'
                    ): ?>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=members','text' => __('modules.projects.members')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'members']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                    <?php endif; ?>

                    <?php if($viewFilesPermission == 'all' || ($viewFilesPermission == 'added' && user()->id == $project->added_by) || ($viewFilesPermission == 'owned' && user()->id == $project->client_id)): ?>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=files','text' => __('modules.projects.files')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'files']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                    <?php endif; ?>

                    <?php if($viewProjectMilestonePermission == 'all' || $viewProjectMilestonePermission == 'added' || ($viewProjectMilestonePermission == 'owned' && user()->id == $project->client_id)): ?>
                        <!--<li>-->
                        <!--    <x-tab :href="route('projects.show', $project->id).'?tab=milestones'"-->
                        <!--    :text="__('modules.projects.milestones')" class="milestones" />-->
                        <!--</li>-->
                    <?php endif; ?>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=sow','text' => __('SOW')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'sow']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=vendors','text' => __('Vendors')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'vendors']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=estimates','text' => __('Client Estimates'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'estimates']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=vendor_estimates','text' => __('Vendor Estimates'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'vendor_estimates']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>

                    <?php if(in_array('tasks', user_modules()) && ($viewTasksPermission == 'all' || ($viewTasksPermission == 'added' && user()->id == $project->added_by) || ($viewTasksPermission == 'owned' && user()->id == $project->client_id))): ?>
                        <!--<li>-->
                        <!--    <x-tab :href="route('projects.show', $project->id).'?tab=tasks'" :text="__('app.menu.tasks')" class="tasks"-->
                        <!--    ajax="false" />-->
                        <!--</li>-->

                        <?php if(!$projectArchived): ?>
                            <!--<li>-->
                            <!--    <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=taskboard','text' => __('modules.tasks.taskBoard'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'taskboard']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>-->
                            <!--</li>-->

                            <?php if($viewGanttPermission == 'all' || ($viewGanttPermission == 'added' && user()->id == $project->added_by) || ($viewGanttPermission == 'owned' && user()->id == $project->client_id)): ?>
                                <!--<li>-->
                                <!--    <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=gantt','text' => __('modules.projects.viewGanttChart')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'gantt']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>-->
                                <!--</li>-->
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(in_array('invoices', user_modules()) && !is_null($project->client_id) && ($viewInvoicePermission == 'all' || ($viewInvoicePermission == 'added' && user()->id == $project->added_by) || ($viewInvoicePermission == 'owned' && user()->id == $project->client_id))): ?>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=invoices','text' => __('app.menu.invoices'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'invoices']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                    <?php endif; ?>

                    <?php if(in_array('orders', user_modules()) && !is_null($project->client_id) && ($viewOrderPermission == 'all' || ($viewOrderPermission == 'added' && user()->id == $project->added_by) || ($viewOrderPermission == 'owned' && user()->id == $project->client_id))): ?>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=orders','text' => __('app.menu.orders'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'orders']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                    <?php endif; ?>

                    <?php if(in_array('timelogs', user_modules()) && ($viewProjectTimelogPermission == 'all' || ($viewProjectTimelogPermission == 'added' && user()->id == $project->added_by) || ($viewProjectTimelogPermission == 'owned' && user()->id == $project->client_id))): ?>
                        <!--<li>-->
                        <!--    <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=timelogs','text' => __('app.menu.timeLogs'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'timelogs']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>-->
                        <!--</li>-->
                    <?php endif; ?>

                    <!-- <?php if(in_array('expenses', user_modules()) && ($viewExpensePermission == 'all' || ($viewExpensePermission == 'added' && user()->id == $project->added_by) || ($viewExpensePermission == 'owned' && user()->id == $project->client_id))): ?> -->
                       
                    <!-- <?php endif; ?> -->
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=expenses','text' => __('app.menu.expenses'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'expenses']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>

                    <?php if($viewMiroboardPermission == 'all' && $project->enable_miroboard &&
                    ((in_array('client', user_roles()) && $project->client_access && $project->client_id == user()->id)
                    || !in_array('client', user_roles()))
                    ): ?>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=miroboard','text' => __('app.menu.miroboard'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'miroboard']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                    <?php endif; ?>

                    <?php if(in_array('payments', user_modules()) && !is_null($project->client_id) && ($viewPaymentPermission == 'all' || ($viewPaymentPermission == 'added' && user()->id == $project->added_by) || ($viewPaymentPermission == 'owned' && user()->id == $project->client_id))): ?>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=payments','text' => __('app.menu.payments'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'payments']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                    <?php endif; ?>

                    <?php if($viewDiscussionPermission == 'all' || ($viewDiscussionPermission == 'added' && user()->id == $project->added_by) || ($viewDiscussionPermission == 'owned' && user()->id == $project->client_id)): ?>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=discussion','text' => __('modules.projects.discussion'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'discussion']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                    <?php endif; ?>

                    <?php if($viewNotePermission != 'none' ): ?>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=notes','text' => __('modules.projects.note'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'notes']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                    <?php endif; ?>

                    <?php if($viewRatingPermission != 'none' && !is_null($project->client_id)): ?>
                        <!--<li>-->
                        <!--    <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=rating','text' => __('modules.projects.rating'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'rating']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>-->
                        <!--</li>-->
                    <?php endif; ?>

                    <?php if($viewBurndownChartPermission != 'none' || $project->project_admin == user()->id): ?>
                        <!--<li>-->
                        <!--    <x-tab :href="route('projects.show', $project->id).'?tab=burndown-chart'"-->
                        <!--        :text="__('modules.projects.burndownChart')" class="burndown-chart" ajax="false" />-->
                        <!--</li>-->
                    <?php endif; ?>

                    <?php if(!in_array('client', user_roles())): ?>
                        <li>
                            <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=activity','text' => __('modules.employees.activity')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'activity']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
                        </li>
                    <?php endif; ?>

                    <?php if($viewNotePermission != 'none' ): ?>
                        <!--<li>-->
                        <!--    <?php if (isset($component)) { $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab = $attributes; } ?>
<?php $component = App\View\Components\Tab::resolve(['href' => route('projects.show', $project->id).'?tab=tickets','text' => __('app.menu.tickets'),'ajax' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tab'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Tab::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'tickets']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $attributes = $__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__attributesOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab)): ?>
<?php $component = $__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab; ?>
<?php unset($__componentOriginal4b0c45ee1a38bb46a01c2a25edd749ab); ?>
<?php endif; ?>-->
                        <!--</li>-->
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <a class="mb-0 d-block d-lg-none text-dark-grey ml-auto mr-2 border-left-grey" onclick="openClientDetailSidebar()"><i class="fa fa-ellipsis-v "></i></a>
    </div>



    <!-- PROJECT HEADER END -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content-wrapper pt-0 border-top-0 client-detail-wrapper">
        <?php echo $__env->make($view, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>
        $("body").on("click", ".project-menu .ajax-tab", function(event) {
            event.preventDefault();

            $('.project-menu .p-sub-menu').removeClass('active');
            $(this).addClass('active');


            const requestUrl = this.href;

            $.easyAjax({
                url: requestUrl,
                blockUI: true,
                container: ".content-wrapper",
                historyPush: true,
                success: function(response) {
                    if (response.status == "success") {
                        $('.content-wrapper').html(response.html);
                        init('.content-wrapper');
                    }
                }
            });
        });

    </script>
    <script>
        const activeTab = "<?php echo e($activeTab); ?>";
        $('.project-menu .' + activeTab).addClass('active');

    </script>
    <script>
        /*******************************************************
                 More btn in projects menu Start
        *******************************************************/

        const container = document.querySelector('.tabs');
        const primary = container.querySelector('.-primary');
        const primaryItems = container.querySelectorAll('.-primary > li:not(.-more)');
        container.classList.add('--jsfied'); // insert "more" button and duplicate the list

        primary.insertAdjacentHTML('beforeend', `
        <li class="-more">
            <button type="button" class="px-4 h-100 bg-grey d-none d-lg-flex align-items-center" aria-haspopup="true" aria-expanded="false">
            <?php echo e(__('app.more')); ?> <span>&darr;</span>
            </button>
            <ul class="-secondary" id="hide-project-menues">
            ${primary.innerHTML}
            </ul>
        </li>
        `);
        const secondary = container.querySelector('.-secondary');
        const secondaryItems = secondary.querySelectorAll('li');
        const allItems = container.querySelectorAll('li');
        const moreLi = primary.querySelector('.-more');
        const moreBtn = moreLi.querySelector('button');
        moreBtn.addEventListener('click', e => {
            e.preventDefault();
            container.classList.toggle('--show-secondary');
            moreBtn.setAttribute('aria-expanded', container.classList.contains('--show-secondary'));
        }); // adapt tabs

        const doAdapt = () => {
            // reveal all items for the calculation
            allItems.forEach(item => {
                item.classList.remove('--hidden');
            }); // hide items that won't fit in the Primary

            let stopWidth = moreBtn.offsetWidth;
            let hiddenItems = [];
            const primaryWidth = primary.offsetWidth;
            primaryItems.forEach((item, i) => {
                if (primaryWidth >= stopWidth + item.offsetWidth) {
                    stopWidth += item.offsetWidth;
                } else {
                    item.classList.add('--hidden');
                    hiddenItems.push(i);
                }
            }); // toggle the visibility of More button and items in Secondary

            if (!hiddenItems.length) {
                moreLi.classList.add('--hidden');
                container.classList.remove('--show-secondary');
                moreBtn.setAttribute('aria-expanded', false);
            } else {
                secondaryItems.forEach((item, i) => {
                    if (!hiddenItems.includes(i)) {
                        item.classList.add('--hidden');
                    }
                });
            }
        };

        doAdapt(); // adapt immediately on load

        window.addEventListener('resize', doAdapt); // adapt on window resize
        // hide Secondary on the outside click

        document.addEventListener('click', e => {
            let el = e.target;

            while (el) {
                if (el === secondary || el === moreBtn) {
                    return;
                }

                el = el.parentNode;
            }

            container.classList.remove('--show-secondary');
            moreBtn.setAttribute('aria-expanded', false);
        });
        /*******************************************************
                 More btn in projects menu End
        *******************************************************/
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/projects/show.blade.php ENDPATH**/ ?>