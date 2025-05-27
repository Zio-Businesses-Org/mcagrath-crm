<div class="card border-0 b-shadow-4">
    <div class="card-horizontal align-items-center">
        <div class="card-img">
            <img class="" src="<?php echo e($image); ?>" alt="">
        </div>
        <div class="card-body border-0 pl-0">
            <?php echo e($slot); ?>

        </div>
    </div>

    <?php if(isset($footer)): ?>
        <?php echo e($footer); ?>

    <?php endif; ?>

</div>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/cards/user.blade.php ENDPATH**/ ?>