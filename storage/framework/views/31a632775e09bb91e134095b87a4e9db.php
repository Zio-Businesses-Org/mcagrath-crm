
<style>
.modal{
    z-index: 1055; /* Ensures the modal is above other elements */
}
.modal-backdrop {
    z-index: 0; /* Ensures the backdrop is below the modal but above other elements */
}

</style>
<div class="row">
    <div class="col-sm-12">
        <div class="col-lg-12" style="margin-bottom:4rem;">
            <?php if (isset($component)) { $__componentOriginalcf8d12533ff890e0d6573daf32b7618d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonPrimary::resolve(['icon' => 'plus'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'add-notes','class' => 'float-right']); ?><?php echo app('translator')->get('Add Notes'); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcf8d12533ff890e0d6573daf32b7618d)): ?>
<?php $attributes = $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d; ?>
<?php unset($__attributesOriginalcf8d12533ff890e0d6573daf32b7618d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf8d12533ff890e0d6573daf32b7618d)): ?>
<?php $component = $__componentOriginalcf8d12533ff890e0d6573daf32b7618d; ?>
<?php unset($__componentOriginalcf8d12533ff890e0d6573daf32b7618d); ?>
<?php endif; ?>
        </div>
        <div class="mt-5 row">

            <?php $__currentLoopData = $note; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-2 col-md-2 mt-2 ml-2 rounded" style="background-color: white;">
                <h4 class="mb-0 p-2 f-21 font-weight-normal text-capitalize border-bottom-grey"><?php echo e($notes->notes_title); ?></h4>
                <p class="mt-3 px-2 pt-2 border-bottom-grey">
                    <span class="note-preview ">
                        <?php echo e(Str::limit($notes->notes_content, 10, '...')); ?>

                    </span>
                </p>
                <a href="javascript:;"  class="show-more float-right"  data-fullnote="<?php echo e($notes->notes_content); ?>" data-createdby="<?php echo e($notes->created_by); ?>" data-createdat="<?php echo e($notes->created_at->format(company()->date_format)); ?>" data-title="<?php echo e($notes->notes_title); ?>">
                    <i class="fa fa-ellipsis-h"></i>
                </a>
            </div>   
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
            <?php if($vendor->notes_title): ?>
                <div class="col-lg-2 col-md-2 mt-2 ml-2 rounded" style="background-color: white;">
                    <h4 class="mb-0 p-2 f-21 font-weight-normal text-capitalize border-bottom-grey"><?php echo e($vendor->notes_title); ?></h4>
                    <p class="mt-3 px-2 pt-2 border-bottom-grey">
                        <span class="note-preview ">
                            <?php echo e(Str::limit($vendor->notes, 10, '...')); ?>

                        </span>
                    </p>
                    <a href="javascript:;"  class="show-more float-right"  data-fullnote="<?php echo e($vendor->notes); ?>" data-createdby="<?php echo e($vendor->created_by); ?>" data-createdat="<?php echo e($vendor->created_at->format(company()->date_format)); ?>" data-title="<?php echo e($vendor->notes_title); ?>">
                        <i class="fa fa-ellipsis-h"></i>
                    </a>
                </div>   
            <?php endif; ?>    
        </div>
    </div>
</div>
<div class="modal modal-note fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="noteModalLabel"></h5>
                <button type="button" class="btn-close bg-white" id="modal-close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p id="fullNoteText" class=" border-bottom-grey pb-2"></p>
                <p id="createdbyname"></p>
                <p id="createdat"></p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        init(RIGHT_MODAL);
        var showMoreLinks = document.querySelectorAll('.show-more');

        showMoreLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                var fullNote = this.getAttribute('data-fullnote');
                var createdby = this.getAttribute('data-createdby');
                var createdat = this.getAttribute('data-createdat');
                var title = this.getAttribute('data-title');
                document.getElementById('fullNoteText').textContent = fullNote;
                document.getElementById('createdbyname').textContent = createdby;
                document.getElementById('createdat').textContent = createdat;
                document.getElementById('noteModalLabel').textContent = title;
                $('#noteModal').modal('show');
            });
        });
    });

    $('#add-notes').click(function () {
        var url = "<?php echo e(route('vendortrack.notescreate', ':id')); ?>";
        url = url.replace(':id', "<?php echo e($vendor->id); ?>");
        $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_LG, url);
    });

    $('#modal-close').click(function (){
        $('#noteModal').modal('hide');
    })
    
</script>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/vendortrack/ajax/notes.blade.php ENDPATH**/ ?>