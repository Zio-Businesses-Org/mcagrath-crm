<?php if(!$html): ?>
    <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
        <p class="mb-0 text-lightest f-14 w-30 text-capitalize"><?php echo e($label); ?></p>
        <p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?php echo $value; ?></p>
    </div>
<?php else: ?>
    <div class="col-12 px-0 pb-3 d-lg-flex d-md-flex d-block">
        <p class="mb-0 text-lightest f-14 w-30 text-capitalize"><?php echo e($label); ?></p>
        <div class="mb-0 text-dark-grey f-14 w-70 text-wrap ql-editor p-0"><?php echo nl2br($value); ?></div>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/cards/data-row.blade.php ENDPATH**/ ?>