<?php
    $addClientPermission = user()->permission('add_clients');
?>

<?php if (isset($component)) { $__componentOriginal89b295b0763c93abe0143426334eb5d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal89b295b0763c93abe0143426334eb5d6 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Label::resolve(['fieldId' => 'client_id','fieldLabel' => __('app.client'),'fieldRequired' => $fieldRequired] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

<?php if (isset($component)) { $__componentOriginalcbf9105fd4879d5d6ef9e1f6fe271af7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbf9105fd4879d5d6ef9e1f6fe271af7 = $attributes; } ?>
<?php $component = App\View\Components\Forms\InputGroup::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\InputGroup::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <select class="form-control select-picker" data-live-search="true" data-size="8" name="client_id"
            id="client_list_id">
        <option value="">--</option>
        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clientOpt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php if(!is_null($selected) && $selected == $clientOpt->id): echo 'selected'; endif; ?>
                    data-content="<?php if (isset($component)) { $__componentOriginalf1ffc6b119c1d62eb520e36466d6f5ca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf1ffc6b119c1d62eb520e36466d6f5ca = $attributes; } ?>
<?php $component = App\View\Components\ClientSearchOption::resolve(['user' => $clientOpt] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('client-search-option'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ClientSearchOption::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf1ffc6b119c1d62eb520e36466d6f5ca)): ?>
<?php $attributes = $__attributesOriginalf1ffc6b119c1d62eb520e36466d6f5ca; ?>
<?php unset($__attributesOriginalf1ffc6b119c1d62eb520e36466d6f5ca); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf1ffc6b119c1d62eb520e36466d6f5ca)): ?>
<?php $component = $__componentOriginalf1ffc6b119c1d62eb520e36466d6f5ca; ?>
<?php unset($__componentOriginalf1ffc6b119c1d62eb520e36466d6f5ca); ?>
<?php endif; ?>"
                    value="<?php echo e($clientOpt->id); ?>"><?php echo e($clientOpt->name); ?> </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <?php if($addClientPermission == 'all' || $addClientPermission == 'added'): ?>
         <?php $__env->slot('append', null, []); ?> 
            <a href="javascript:;" id="quick-create-client"
               data-toggle="tooltip" data-original-title="<?php echo e(__('modules.client.addNewClient')); ?>"
               class="btn btn-outline-secondary border-grey"
               data-redirect-url="<?php echo e(url()->full()); ?>"><?php echo app('translator')->get('app.add'); ?></a>
         <?php $__env->endSlot(); ?>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbf9105fd4879d5d6ef9e1f6fe271af7)): ?>
<?php $attributes = $__attributesOriginalcbf9105fd4879d5d6ef9e1f6fe271af7; ?>
<?php unset($__attributesOriginalcbf9105fd4879d5d6ef9e1f6fe271af7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbf9105fd4879d5d6ef9e1f6fe271af7)): ?>
<?php $component = $__componentOriginalcbf9105fd4879d5d6ef9e1f6fe271af7; ?>
<?php unset($__componentOriginalcbf9105fd4879d5d6ef9e1f6fe271af7); ?>
<?php endif; ?>

<script>
    $('#quick-create-client').click(function () {
        const url = "<?php echo e(route('clients.create') . '?quick-form=1'); ?>";
        $(MODAL_DEFAULT + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_DEFAULT, url);
    });
</script>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/client-selection-dropdown.blade.php ENDPATH**/ ?>