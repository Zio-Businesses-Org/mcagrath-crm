<div <?php echo e($attributes->merge(['class' => 'alert alert-' . (!is_null($type) ? $type : 'default')])); ?>>
    <?php if(isset($icon)): ?>
    <i class="fa fa-<?php echo e($icon); ?>"></i>
    <?php endif; ?>
    <?php echo e($slot); ?>

</div>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/alert.blade.php ENDPATH**/ ?>