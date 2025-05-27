<?php
$addFilePermission = user()->permission('add_project_files');
$viewFilePermission = user()->permission('view_project_files');
$deleteFilePermission = user()->permission('delete_project_files');
?>

<?php $__empty_1 = true; $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php if (isset($component)) { $__componentOriginalcc3eadf431dc104666da55af50a04915 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcc3eadf431dc104666da55af50a04915 = $attributes; } ?>
<?php $component = App\View\Components\FileCard::resolve(['fileName' => $file->filename,'dateAdded' => $file->created_at->diffForHumans()] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('file-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\FileCard::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['userName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($file->user?->name)]); ?>
        <?php if($file->icon == 'images'): ?>
            <img src="<?php echo e($file->file_url); ?>">
        <?php else: ?>
            <i class="fa <?php echo e($file->icon); ?> text-lightest"></i>
        <?php endif; ?>

        <?php if($viewFilePermission == 'all' || ($viewFilePermission == 'added' && $file->added_by == user()->id)): ?>
             <?php $__env->slot('action', null, []); ?> 
                <div class="dropdown ml-auto file-action">
                    <button class="btn btn-lg f-14 p-0 text-lightest text-capitalize rounded  dropdown-toggle" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                        aria-labelledby="dropdownMenuLink" tabindex="0">
                        <?php if($viewFilePermission == 'all' || ($viewFilePermission == 'added' && $file->added_by == user()->id)): ?>
                            <a class="cursor-pointer d-block text-dark-grey f-13 pt-3 px-3 " target="_blank"
                                    href="<?php echo e($file->file_url); ?>"><?php echo app('translator')->get('app.view'); ?></a>
                            <a class="cursor-pointer d-block text-dark-grey f-13 py-3 px-3 "
                                href="<?php echo e(route('files.download', md5($file->id))); ?>"><?php echo app('translator')->get('app.download'); ?></a>
                        <?php endif; ?>

                        <?php if($deleteFilePermission == 'all' || ($deleteFilePermission == 'added' && $file->added_by == user()->id)): ?>
                            <a class="cursor-pointer d-block text-dark-grey f-13 pb-3 px-3 delete-file"
                                data-row-id="<?php echo e($file->id); ?>" href="javascript:;"><?php echo app('translator')->get('app.delete'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
             <?php $__env->endSlot(); ?>
        <?php endif; ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcc3eadf431dc104666da55af50a04915)): ?>
<?php $attributes = $__attributesOriginalcc3eadf431dc104666da55af50a04915; ?>
<?php unset($__attributesOriginalcc3eadf431dc104666da55af50a04915); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcc3eadf431dc104666da55af50a04915)): ?>
<?php $component = $__componentOriginalcc3eadf431dc104666da55af50a04915; ?>
<?php unset($__componentOriginalcc3eadf431dc104666da55af50a04915); ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="align-items-center d-flex flex-column text-lightest p-20 w-100">
        <i class="fa fa-file-excel f-21 w-100"></i>

        <div class="f-15 mt-4">
            - <?php echo app('translator')->get('messages.noFileUploaded'); ?> -
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/projects/files/show.blade.php ENDPATH**/ ?>