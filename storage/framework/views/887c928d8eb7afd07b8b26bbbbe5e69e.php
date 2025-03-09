<div class="form-check">
    <input <?php echo e($attributes->merge(['class' => 'form-check-input'])); ?> type="checkbox" <?php if(isset($fieldValue)): ?>
        value="<?php echo e($fieldValue); ?>" <?php endif; ?> name="<?php echo e($fieldName); ?>" <?php if($checked): ?> checked <?php endif; ?>
        id="<?php echo e($fieldId); ?>" <?php if($fieldPermission): ?> disabled <?php endif; ?> >
    <?php if($fieldLabel != ''): ?>
        <label
            class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-1 text-wrap text-break"
            for="<?php echo e($fieldId); ?>">
            <?php echo e($fieldLabel); ?>

            <?php if(!is_null($popover)): ?>
                &nbsp;<i class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-html="true"
                    data-content="<?php echo e($popover); ?>" data-trigger="hover"></i>
            <?php endif; ?>
        </label>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/forms/checkbox.blade.php ENDPATH**/ ?>