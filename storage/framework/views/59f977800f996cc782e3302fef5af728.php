<style>
    .card-body-extra{
        width: 340px !important;
    }
</style>
<div <?php echo e($attributes->merge(['class' => 'card bg-white border-grey file-card mr-3 mb-3'])); ?> >
     <div class="card-horizontal">
         <div class="card-img mr-0">
             <?php echo e($slot); ?>

         </div>
         <div class="card-body pr-2 card-body-extra">
             <div class="d-flex flex-grow-1">
                 <h4 class="card-title f-12 text-dark-grey mr-3 text-truncate"  data-toggle="tooltip" data-original-title="<?php echo e($fileName); ?>"><?php echo e($fileName); ?></h4>
                 <?php if(isset($action)): ?>
                     <?php echo $action; ?>

                 <?php endif; ?>
             </div>
             <div class="d-flex flex-grow-1">
                <h4 class="card-title f-12 text-dark-grey mr-3 text-truncate">File Type :</h4>
                <?php echo e($filetype); ?>

             </div>
             <div class="d-flex flex-grow-1">
                <h4 class="card-title f-12 text-dark-grey mr-3 text-truncate">Tag Name :</h4>
                <?php echo e($tagname); ?>

             </div>
             <div class="d-flex flex-grow-1">
                <h4 class="card-title f-12 text-dark-grey mr-3 text-truncate">Name :</h4>
                <?php echo e($name); ?>

             </div>
             <div class="d-flex flex-grow-1">
                <h4 class="card-title f-12 text-dark-grey mr-3 text-truncate">Phone :</h4>
                <?php echo e($phone); ?>

             </div>
             <div class="d-flex flex-grow-1">
                <h4 class="card-title f-12 text-dark-grey mr-3 text-truncate">Email :</h4>
                <?php echo e($email); ?>

             </div>
             <div class="card-date f-11 text-lightest">
                 <?php echo e($dateAdded); ?>

             </div>
         </div>
     </div>
 </div>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/cards/external-card.blade.php ENDPATH**/ ?>