<div <?php echo e($attributes->merge(['class' => 'card bg-white border-0 b-shadow-4'])); ?>>
    <?php if($title): ?>
        <?php if (isset($component)) { $__componentOriginal0c73ff97aa079a7141aada4278327d8b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0c73ff97aa079a7141aada4278327d8b = $attributes; } ?>
<?php $component = App\View\Components\Cards\CardHeader::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\CardHeader::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <?php echo $title; ?>


             <?php $__env->slot('action', null, []); ?> 
                <?php echo $action; ?>

             <?php $__env->endSlot(); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0c73ff97aa079a7141aada4278327d8b)): ?>
<?php $attributes = $__attributesOriginal0c73ff97aa079a7141aada4278327d8b; ?>
<?php unset($__attributesOriginal0c73ff97aa079a7141aada4278327d8b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0c73ff97aa079a7141aada4278327d8b)): ?>
<?php $component = $__componentOriginal0c73ff97aa079a7141aada4278327d8b; ?>
<?php unset($__componentOriginal0c73ff97aa079a7141aada4278327d8b); ?>
<?php endif; ?>
    <?php endif; ?>

    <?php if($padding === 'false'): ?>
        <div class="card-body p-0 <?php echo e($otherClasses); ?>">
            <?php echo e($slot); ?>

        </div>
    <?php else: ?>
        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'card-body', 'pt-2' => ($title),
            $otherClasses
        ]); ?>">
            <?php echo e($slot); ?>

        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/cards/data.blade.php ENDPATH**/ ?>