<button type="button" 
    <?php echo e($attributes->merge(['class' => 'btn-success rounded f-14 p-2'])); ?>>
    <?php if(!is_null($icon)): ?>
        <i class="fa fa-<?php echo e($icon); ?> mr-1"></i>
    <?php endif; ?>
    <?php echo e($slot); ?>

</button><?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/forms/button-success.blade.php ENDPATH**/ ?>