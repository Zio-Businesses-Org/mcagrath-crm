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
    <div class="task-search d-flex  py-1 px-lg-3 px-0 align-items-center">
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
<div class="container-fluid d-flex position-relative border-bottom-grey mt-1">
    <!-- Left Scroll Button -->
    <button class="btn btn-dark" id="scrollLeftBtn" style="display: none; left: 0;">&#9664;</button>
    <!-- Scrollable Button Wrapper -->
    <div id="buttonWrapper" class="button-wrapper d-flex overflow-auto flex-nowrap my-2">
    <?php $__currentLoopData = $clientFilter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <a class="dropdown-item apply-filter-client" href="javascript:;"
                            data-row-id="<?php echo e($filter->id); ?>">
                            <i class="bi bi-save2 mr-2"></i>
                            <?php echo app('translator')->get('Apply'); ?>
                        </a>
                         <?php endif; ?>
                        <a class="dropdown-item edit-filter-client" href="javascript:;"
                            data-row-id="<?php echo e($filter->id); ?>">
                            <i class="fa fa-edit mr-2"></i>
                            <?php echo app('translator')->get('app.edit'); ?>
                        </a>
                        <a class="dropdown-item delete-row-client" href="javascript:;"
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

<?php $__env->startPush('scripts'); ?>
    <script>

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

    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/lead-contact/filters.blade.php ENDPATH**/ ?>