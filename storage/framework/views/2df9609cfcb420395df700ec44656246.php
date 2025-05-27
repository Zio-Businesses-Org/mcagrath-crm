<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['userName' => null]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['userName' => null]); ?>
<?php foreach (array_filter((['userName' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
 <div <?php echo e($attributes->merge(['class' => 'card bg-white border-grey file-card mr-3 mb-3'])); ?> >
     <div class="card-horizontal">
         <div class="card-img mr-0">
             <?php echo e($slot); ?>

         </div>
         <div class="card-body pr-2">
             <div class="d-flex flex-grow-1">
                 <h4 class="card-title f-12 text-dark-grey mr-3 text-truncate"  data-toggle="tooltip" data-original-title="<?php echo e($fileName); ?>"><?php echo e($fileName); ?></h4>
                 <?php if(isset($action)): ?>
                     <?php echo $action; ?>

                 <?php endif; ?>
             </div>
             <div class="card-date f-11 text-lightest">
                 <?php echo e($dateAdded); ?>

             </div>
             <div class="card-date f-11 text-lightest">
                 <?php echo e($userName ?? ''); ?>

             </div>
         </div>
     </div>
 </div>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/cards/file-card.blade.php ENDPATH**/ ?>