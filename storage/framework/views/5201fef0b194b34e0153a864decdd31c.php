<div <?php echo e($attributes->merge(['class' => 'form-group my-3'])); ?>>
    <?php if (isset($component)) { $__componentOriginal89b295b0763c93abe0143426334eb5d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal89b295b0763c93abe0143426334eb5d6 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Label::resolve(['fieldId' => $fieldId,'fieldLabel' => $fieldLabel,'fieldRequired' => $fieldRequired,'popover' => $popover] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Label::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal89b295b0763c93abe0143426334eb5d6)): ?>
<?php $attributes = $__attributesOriginal89b295b0763c93abe0143426334eb5d6; ?>
<?php unset($__attributesOriginal89b295b0763c93abe0143426334eb5d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal89b295b0763c93abe0143426334eb5d6)): ?>
<?php $component = $__componentOriginal89b295b0763c93abe0143426334eb5d6; ?>
<?php unset($__componentOriginal89b295b0763c93abe0143426334eb5d6); ?>
<?php endif; ?>

    <input type="number" class="form-control height-35 f-14" placeholder="<?php echo e($fieldPlaceholder); ?>"
           value="<?php echo e($fieldValue); ?>" name="<?php echo e($fieldName); ?>" id="<?php echo e($fieldId); ?>" min="<?php echo e($minValue); ?>"
            <?php if($maxValue): ?>
            max="<?php echo e($maxValue); ?>"
            <?php endif; ?>
            <?php if($fieldReadOnly == 'true'): ?> readonly <?php endif; ?>>

    <?php if($fieldHelp): ?>
        <small id="<?php echo e($fieldId); ?>Help" class="form-text text-muted"><?php echo e($fieldHelp); ?></small>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/forms/number.blade.php ENDPATH**/ ?>