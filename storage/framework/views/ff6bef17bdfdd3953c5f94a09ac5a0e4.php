<div class="modal-header">
    <h5 class="modal-title" id="modelHeading"><?php echo app('translator')->get('Edit Filter'); ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<?php if (isset($component)) { $__componentOriginal18ad2e0d264f9740dc73fff715357c28 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18ad2e0d264f9740dc73fff715357c28 = $attributes; } ?>
<?php $component = App\View\Components\Form::resolve(['method' => 'PUT'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'editClientLeadFilterForm']); ?>
    <div class="modal-body">
        <input type="hidden" name="filterstartDateNext" id="filterstartDateNext">
        <input type="hidden" name="filterendDateNext" id="filterendDateNext">
        <input type="hidden" name="filterstartDateLast" id="filterstartDateLast">
        <input type="hidden" name="filterendDateLast" id="filterendDateLast">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <?php if (isset($component)) { $__componentOriginal4e45e801405ab67097982370a6a83cba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4e45e801405ab67097982370a6a83cba = $attributes; } ?>
<?php $component = App\View\Components\Forms\Text::resolve(['fieldLabel' => __('Filter Name'),'fieldName' => 'client_name','fieldRequired' => 'true','fieldId' => 'client_name_edit','fieldPlaceholder' => __('Enter filter name'),'fieldValue' => $filter->name] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Text::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4e45e801405ab67097982370a6a83cba)): ?>
<?php $attributes = $__attributesOriginal4e45e801405ab67097982370a6a83cba; ?>
<?php unset($__attributesOriginal4e45e801405ab67097982370a6a83cba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4e45e801405ab67097982370a6a83cba)): ?>
<?php $component = $__componentOriginal4e45e801405ab67097982370a6a83cba; ?>
<?php unset($__componentOriginal4e45e801405ab67097982370a6a83cba); ?>
<?php endif; ?>
                </div>
                <?php
                $selectedLeadStatus = $filter->client_lead_status ?? [];
                ?>
                <div class="col-md-4 mt-3">
                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                        for="usr"><?php echo app('translator')->get('Status'); ?></label>
                    <div class="">
                    <select class="form-control select-picker" name="client_status[]" id="client_status_edit"
                            data-live-search="true" data-container="body" data-size="8" multiple>
                        <?php $__currentLoopData = $statusLeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status->status); ?>" <?php echo e(in_array($status->status, $selectedLeadStatus) ? 'selected' : ''); ?>>
                                <?php echo e($status->status); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </div>
                <?php
                $selectedCompanyType = $filter->company_type ?? [];
                ?>
                <div class="col-md-4 mt-3">
                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                        for="usr"><?php echo app('translator')->get('Company Type'); ?></label>
                    <div class="">
                    <select class="form-control select-picker" name="client_types[]" id="client_types_edit"
                            data-live-search="true" data-container="body" data-size="8" multiple>
                        <?php $__currentLoopData = $companyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($types->type); ?>" <?php echo e(in_array($types->type, $selectedCompanyType) ? 'selected' : ''); ?>>
                                <?php echo e($types->type); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr"><?php echo app('translator')->get('Next Follow Up Date'); ?></label>
                    <div class="select-status d-flex">
                        <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                        placeholder="<?php echo app('translator')->get('placeholders.dateRange'); ?>" id="customRangeEdit">
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <label class="f-14 text-dark-grey mb-12 text-capitalize" for="usr"><?php echo app('translator')->get('Last Called Date'); ?></label>
                    <div class="select-status d-flex">
                        <input type="text" class="position-relative  form-control p-2 text-left border-additional-grey"
                        placeholder="<?php echo app('translator')->get('placeholders.dateRange'); ?>" id="customRange1Edit">
                    </div>
                </div>
                <?php
                 $selectedAddedBy = $filter->added_by ?? [];
                ?>
                <div class="col-md-4 mt-3">
                    <label class="f-14 text-dark-grey mb-12 text-capitalize"
                        for="usr"><?php echo app('translator')->get('Created By'); ?></label>
                    <div class="mb-4">
                    <select class="form-control select-picker" name="client_members[]" id="client_members_edit"
                            data-live-search="true" data-container="body" data-size="8" multiple>
                            <?php $__currentLoopData = $allEmployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(in_array($category->id, $selectedAddedBy) ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="modal-footer">
        <?php if (isset($component)) { $__componentOriginalc35c79ed7e812580313ad04118477974 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc35c79ed7e812580313ad04118477974 = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonCancel::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'clearedit','class' => 'border-0 mr-3']); ?>Reset <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc35c79ed7e812580313ad04118477974)): ?>
<?php $attributes = $__attributesOriginalc35c79ed7e812580313ad04118477974; ?>
<?php unset($__attributesOriginalc35c79ed7e812580313ad04118477974); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc35c79ed7e812580313ad04118477974)): ?>
<?php $component = $__componentOriginalc35c79ed7e812580313ad04118477974; ?>
<?php unset($__componentOriginalc35c79ed7e812580313ad04118477974); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalc35c79ed7e812580313ad04118477974 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc35c79ed7e812580313ad04118477974 = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonCancel::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-dismiss' => 'modal','class' => 'border-0 mr-3']); ?><?php echo app('translator')->get('app.close'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc35c79ed7e812580313ad04118477974)): ?>
<?php $attributes = $__attributesOriginalc35c79ed7e812580313ad04118477974; ?>
<?php unset($__attributesOriginalc35c79ed7e812580313ad04118477974); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc35c79ed7e812580313ad04118477974)): ?>
<?php $component = $__componentOriginalc35c79ed7e812580313ad04118477974; ?>
<?php unset($__componentOriginalc35c79ed7e812580313ad04118477974); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalcf8d12533ff890e0d6573daf32b7618d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonPrimary::resolve(['icon' => 'check'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'edit-filter']); ?><?php echo app('translator')->get('app.save'); ?> <?php echo $__env->renderComponent(); ?>
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18ad2e0d264f9740dc73fff715357c28)): ?>
<?php $attributes = $__attributesOriginal18ad2e0d264f9740dc73fff715357c28; ?>
<?php unset($__attributesOriginal18ad2e0d264f9740dc73fff715357c28); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18ad2e0d264f9740dc73fff715357c28)): ?>
<?php $component = $__componentOriginal18ad2e0d264f9740dc73fff715357c28; ?>
<?php unset($__componentOriginal18ad2e0d264f9740dc73fff715357c28); ?>
<?php endif; ?>
<script>
$(document).ready(function() {
    var startDateNext = '<?php echo e($filter->next_follow_start_date); ?>';
    var endDateNext = '<?php echo e($filter->next_follow_end_date); ?>';
    var startDateLast = '<?php echo e($filter->last_called_start_date); ?>';
    var endDateLast = '<?php echo e($filter->last_called_end_date); ?>';

    $("#editClientLeadFilterForm .select-picker").selectpicker();

    $('#customRangeEdit,#customRange1Edit').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });
        
    $('#customRangeEdit').on('apply.daterangepicker', function(ev, picker) {
        // Get start and end dates
        startDateNext = picker.startDate.format('YYYY-MM-DD');
        document.getElementById('filterstartDateNext').value=startDateNext;
        endDateNext = picker.endDate.format('YYYY-MM-DD');
        document.getElementById('filterendDateNext').value=endDateNext;
        
        $(this).val(picker.startDate.format('<?php echo e(company()->moment_date_format); ?>') + ' - ' + picker.endDate.format('<?php echo e(company()->moment_date_format); ?>'));
        
    });
    $('#customRange1Edit').on('apply.daterangepicker', function(ev, picker) {
        // Get start and end dates
        startDateLast = picker.startDate.format('YYYY-MM-DD');
        document.getElementById('filterstartDateLast').value=startDateLast;
        endDateLast = picker.endDate.format('YYYY-MM-DD');
        document.getElementById('filterendDateLast').value=endDateLast;
        
        $(this).val(picker.startDate.format('<?php echo e(company()->moment_date_format); ?>') + ' - ' + picker.endDate.format('<?php echo e(company()->moment_date_format); ?>'));
        
    });

    if(startDateNext!='' && endDateNext!=''){
        document.getElementById('filterstartDateNext').value=startDateNext;
        document.getElementById('filterendDateNext').value=endDateNext;
        
        $('#customRangeEdit').val(
            moment(startDateNext).format('<?php echo e(company()->moment_date_format); ?>') + ' - ' + moment(endDateNext).format('<?php echo e(company()->moment_date_format); ?>')
        );
    }
    if(startDateLast!='' && endDateLast!=''){
        document.getElementById('filterstartDateLast').value=startDateLast;
        document.getElementById('filterendDateLast').value=endDateLast;
        
        $('#customRange1Edit').val(
            moment(startDateLast).format('<?php echo e(company()->moment_date_format); ?>') + ' - ' + moment(endDateLast).format('<?php echo e(company()->moment_date_format); ?>')
        );
    }

    $('#edit-filter').click(function () {
        if($('#customRangeEdit').val()=='')
        {
            document.getElementById('filterstartDateNext').value='';
            document.getElementById('filterendDateNext').value='';
        }
        if($('#customRange1Edit').val()=='')
        {
            document.getElementById('filterstartDateLast').value='';
            document.getElementById('filterendDateLast').value='';
        }
        var url = "<?php echo e(route('lead-client-filter.update',$filter->id)); ?>";
        $.easyAjax({
            url: url,
            container: '#editClientLeadFilterForm',
            type: "POST",
            blockUI: true,
            disableButton: true,
            buttonSelector: '#edit-filter',
            data: $('#editClientLeadFilterForm').serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload();
                    
                }
            }
        })
    });

    $('#clearedit').click(function() {
        $('#client_members_edit').val([]).selectpicker('refresh');
        $('#client_types_edit').val([]).selectpicker('refresh');
        $('#client_status_edit').val([]).selectpicker('refresh');
        document.getElementById('filterstartDateNext').value='';
        document.getElementById('filterendDateNext').value='';
        document.getElementById('filterstartDateLast').value='';
        document.getElementById('filterendDateLast').value='';
        $('#customRange1Edit').val('');
        $('#customRangeEdit').val('');
        $('#client_name_edit').val('');
    });

});
</script><?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/lead-contact/edit-filter.blade.php ENDPATH**/ ?>