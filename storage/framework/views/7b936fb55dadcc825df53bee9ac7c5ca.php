<div <?php echo e($attributes->merge(['class' => 'form-group my-3'])); ?>>
    <?php if (isset($component)) { $__componentOriginal89b295b0763c93abe0143426334eb5d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal89b295b0763c93abe0143426334eb5d6 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Label::resolve(['fieldId' => $fieldId,'fieldLabel' => $fieldLabel] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Label::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal89b295b0763c93abe0143426334eb5d6)): ?>
<?php $attributes = $__attributesOriginal89b295b0763c93abe0143426334eb5d6; ?>
<?php unset($__attributesOriginal89b295b0763c93abe0143426334eb5d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal89b295b0763c93abe0143426334eb5d6)): ?>
<?php $component = $__componentOriginal89b295b0763c93abe0143426334eb5d6; ?>
<?php unset($__componentOriginal89b295b0763c93abe0143426334eb5d6); ?>
<?php endif; ?>

    <input type="range" class="form-control-range" <?php if($disabled == 'true'): ?> disabled
    <?php endif; ?> id="<?php echo e($fieldId); ?>" value="<?php echo e($fieldValue); ?>" name="<?php echo e($fieldName); ?>"
    <?php if($max): ?> max="<?php echo e($max); ?>" <?php endif; ?>
    <?php if($min): ?> min="<?php echo e($min); ?>" <?php endif; ?>
    onInput="$('#<?php echo e($fieldId); ?>-val').html($(this).val())">

    <span class="badge badge-light" id="<?php echo e($fieldId); ?>-val"><?php echo e($fieldValue); ?></span>

    <?php if($fieldHelp): ?>
        <small id="<?php echo e($fieldId); ?>Help" class="form-text text-muted"><?php echo e($fieldHelp); ?></small>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/forms/range.blade.php ENDPATH**/ ?>