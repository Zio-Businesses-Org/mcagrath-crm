<div class='media align-items-center mw-250 <?php if($user->status != 'active'): ?> inactive <?php endif; ?>'>
    <div class='position-relative'><img src='<?php echo e($user->image_url); ?>' class='mr-2 taskEmployeeImg rounded-circle'>
    </div>
    <div class='media-body text-truncate'>
        <h5 class='mb-0 f-13'><?php echo e($user->name_salutation); ?><?php if($user->status!='active'): ?> <i data-toggle='tooltip' data-original-title='<?php echo e(__('app.inactive')); ?>' class='fa fa-circle mr-1 text-red f-10'></i> <?php endif; ?></h5>
        <p class='my-0 f-11 text-dark-grey'><?php echo e($user->email); ?></p>
        <p class='my-0 f-11 text-dark-grey'>
            <?php echo e(!is_null($user->clientDetails) ? $user->clientDetails->company_name : ' '); ?></p>
    </div>
</div>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/client-search-option.blade.php ENDPATH**/ ?>