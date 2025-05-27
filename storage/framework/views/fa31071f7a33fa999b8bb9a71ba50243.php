
<div class="modal-header">
    <h5 class="modal-title" id="modelHeading"><?php echo app('translator')->get('Change Notification History'); ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<div class="modal-body" id="change-notification-history">
    <div class="row py-5">
        
        <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
            
            <?php if (isset($component)) { $__componentOriginal7d9f6e0b9001f5841f72577781b2d17f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f = $attributes; } ?>
<?php $component = App\View\Components\Table::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Table::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'border-0 pb-3 admin-dash-table table-hover']); ?>

                 <?php $__env->slot('thead', null, []); ?> 
                    <th class="pl-20">#</th>
                    <th><?php echo app('translator')->get('Project Type'); ?></th>
                    <th><?php echo app('translator')->get('Project Amount'); ?></th>
                    <th><?php echo app('translator')->get('Link Status'); ?></th>
                    <th><?php echo app('translator')->get('Link Sent By'); ?></th>
                    <th><?php echo app('translator')->get('Added Date'); ?></th>
                    <th class="text-right pr-20"><?php echo app('translator')->get('app.action'); ?></th>
                 <?php $__env->endSlot(); ?>

                <?php $__empty_1 = true; $__currentLoopData = $projectvendor->changenotification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr id="row-<?php echo e($item->id); ?>" <?php if($item->link_status == 'Removed'): ?> style="background-color: rgba(220, 53, 70, 0.76);" <?php endif; ?>>
                        <td class="pl-20">Change Order - <?php echo e($key+1); ?></td>
                        <td>
                            <a href="javascript:;" class="sow-detail text-darkest-grey f-w-500"
                                data-sow-id="<?php echo e($item->id); ?>"><?php echo e($item->project_type); ?></a>
                        </td>
                        <td>
                            <?php echo e($item->project_amount??''); ?>

                        </td>
                        <td>
                            <?php echo e($item->link_status??''); ?>

                        </td>
                        <td>
                            <?php echo e($item->added->name??''); ?>

                        </td>
                        <td>
                            <?php echo e($item->created_at->translatedFormat(company()->date_format)); ?>

                        </td>
                        <td class="text-right pr-20">
                            <div class="task_view">
                                <a href="javascript:;" data-row-id="<?php echo e($item->id); ?>"
                                    class="toggle-showmore px-2 text-darkest-grey f-w-500"> <i class="fa fa-chevron-down"></i></a>
                            </div>
                            <div class="task_view">
                                <a href="javascript:;" data-link-id="<?php echo e($item->id); ?>"
                                    class="px-2 text-darkest-grey f-w-500 relink-change"> <i class="fa fa-paper-plane"></i></a>
                            </div>
                            <?php if($item->link_status != 'Removed'): ?>
                            <div class="task_view">
                                <a href="javascript:;" data-remove-id="<?php echo e($item->id); ?>"
                                    class="px-2 text-darkest-grey f-w-500 remove-link"> <i class="fa fa-times"></i></a>
                            </div>
                            <?php endif; ?>
                            <?php if(in_array('admin', user_roles())): ?>
                            <div class="task_view">
                                <a href="javascript:;" data-delete-id="<?php echo e($item->id); ?>"
                                    class="px-2 text-darkest-grey f-w-500 delete-link"> <i class="fa fa-trash"></i></a>
                            </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr id="showmore-<?php echo e($item->id); ?>" class="d-none">
                        <td colspan="7"> 
                            <?php if (isset($component)) { $__componentOriginalbc9540fa671f26a0f8028a5a8d8f93e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc9540fa671f26a0f8028a5a8d8f93e9 = $attributes; } ?>
<?php $component = App\View\Components\Cards\Data::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\Data::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <?php $__currentLoopData = $item->sow_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <h5 class="f-13 font-weight-bold mb-4">Scope Of Work:</h5>
                                    <?php if (isset($component)) { $__componentOriginalfc012cd47eee5094db538668bc6edefd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc012cd47eee5094db538668bc6edefd = $attributes; } ?>
<?php $component = App\View\Components\Cards\DataRow::resolve(['label' => __('Sow Title'),'value' => $item->sow($sow)->sow_title,'html' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.data-row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\DataRow::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfc012cd47eee5094db538668bc6edefd)): ?>
<?php $attributes = $__attributesOriginalfc012cd47eee5094db538668bc6edefd; ?>
<?php unset($__attributesOriginalfc012cd47eee5094db538668bc6edefd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfc012cd47eee5094db538668bc6edefd)): ?>
<?php $component = $__componentOriginalfc012cd47eee5094db538668bc6edefd; ?>
<?php unset($__componentOriginalfc012cd47eee5094db538668bc6edefd); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalfc012cd47eee5094db538668bc6edefd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc012cd47eee5094db538668bc6edefd = $attributes; } ?>
<?php $component = App\View\Components\Cards\DataRow::resolve(['label' => __('Sow Description'),'value' => $item->sow($sow)->description,'html' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.data-row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\DataRow::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfc012cd47eee5094db538668bc6edefd)): ?>
<?php $attributes = $__attributesOriginalfc012cd47eee5094db538668bc6edefd; ?>
<?php unset($__attributesOriginalfc012cd47eee5094db538668bc6edefd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfc012cd47eee5094db538668bc6edefd)): ?>
<?php $component = $__componentOriginalfc012cd47eee5094db538668bc6edefd; ?>
<?php unset($__componentOriginalfc012cd47eee5094db538668bc6edefd); ?>
<?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (isset($component)) { $__componentOriginalfc012cd47eee5094db538668bc6edefd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc012cd47eee5094db538668bc6edefd = $attributes; } ?>
<?php $component = App\View\Components\Cards\DataRow::resolve(['label' => __('Additional notes'),'value' => $item->add_notes,'html' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.data-row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\DataRow::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfc012cd47eee5094db538668bc6edefd)): ?>
<?php $attributes = $__attributesOriginalfc012cd47eee5094db538668bc6edefd; ?>
<?php unset($__attributesOriginalfc012cd47eee5094db538668bc6edefd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfc012cd47eee5094db538668bc6edefd)): ?>
<?php $component = $__componentOriginalfc012cd47eee5094db538668bc6edefd; ?>
<?php unset($__componentOriginalfc012cd47eee5094db538668bc6edefd); ?>
<?php endif; ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc9540fa671f26a0f8028a5a8d8f93e9)): ?>
<?php $attributes = $__attributesOriginalbc9540fa671f26a0f8028a5a8d8f93e9; ?>
<?php unset($__attributesOriginalbc9540fa671f26a0f8028a5a8d8f93e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc9540fa671f26a0f8028a5a8d8f93e9)): ?>
<?php $component = $__componentOriginalbc9540fa671f26a0f8028a5a8d8f93e9; ?>
<?php unset($__componentOriginalbc9540fa671f26a0f8028a5a8d8f93e9); ?>
<?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php if (isset($component)) { $__componentOriginal1cadea97ad834515c6e69c0ef44e7014 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1cadea97ad834515c6e69c0ef44e7014 = $attributes; } ?>
<?php $component = App\View\Components\Cards\NoRecordFoundList::resolve(['colspan' => '7'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.no-record-found-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\NoRecordFoundList::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1cadea97ad834515c6e69c0ef44e7014)): ?>
<?php $attributes = $__attributesOriginal1cadea97ad834515c6e69c0ef44e7014; ?>
<?php unset($__attributesOriginal1cadea97ad834515c6e69c0ef44e7014); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1cadea97ad834515c6e69c0ef44e7014)): ?>
<?php $component = $__componentOriginal1cadea97ad834515c6e69c0ef44e7014; ?>
<?php unset($__componentOriginal1cadea97ad834515c6e69c0ef44e7014); ?>
<?php endif; ?>
                <?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f)): ?>
<?php $attributes = $__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f; ?>
<?php unset($__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d9f6e0b9001f5841f72577781b2d17f)): ?>
<?php $component = $__componentOriginal7d9f6e0b9001f5841f72577781b2d17f; ?>
<?php unset($__componentOriginal7d9f6e0b9001f5841f72577781b2d17f); ?>
<?php endif; ?>

        </div>

    </div>
</div>
<script>
    $(document).ready(function() {
    $('.toggle-showmore').click(function () {
            var id = $(this).data('row-id');
            $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-up');
            $('#showmore-'+id).toggleClass('d-none');
    });
    $('body').on('click', '.relink-change', function() {
        var id = $(this).data('link-id');
        var url="<?php echo e(route('projectvendorschangenotify.resentlink',':id')); ?>";
        url = url.replace(':id', id);
        $.easyAjax({
                url: url,
                type: 'POST',
                container:'#change-notification-history',
                blockUI: true,
                disableButton: true,
                buttonSelector: '.relink-change',
                data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
    });
    $('body').on('click', '.remove-link', function() {
        var id = $(this).data('remove-id');
        var url="<?php echo e(route('projectvendorschangenotify.removelink',':id')); ?>";
        url = url.replace(':id', id);
        $.easyAjax({
                url: url,
                type: 'POST',
                container:'#change-notification-history',
                blockUI: true,
                disableButton: true,
                buttonSelector: '.remove-link',
                data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
    });

    $('body').on('click', '.delete-link', function() {
        var id = $(this).data('delete-id');
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
                var url = "<?php echo e(route('change-notification.destroy', ':id')); ?>";
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
});
</script>

<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/projects/vendors/changenotificationhistory.blade.php ENDPATH**/ ?>