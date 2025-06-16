    <style>
    .btn-xs {
    padding: .25rem .4rem;
    font-size: .875rem;
    line-height: .5;
    border-radius: .2rem; 
    }

    </style>
    <div class=" d-flex flex-col">
        <div class="col-sm border-right-grey">
            <div class="row border-bottom-grey">
                <div class="col">
                    <h5 class="f-15 f-w-500 text-darkest-grey mb-0 py-2">Project Details</h5>
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                     Work Order # - <?php echo e($project->project_short_code ?? ''); ?>

                </div>
                <div class="col border-left-grey">
                     Project Status - <?php echo e($project->status ?? ''); ?> 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                     Project Type - <?php echo e($project->type ?? ''); ?>

                </div>
                <div class="col border-left-grey">
                     Client Name - <?php echo e($project->client?->name_salutation ?? ''); ?> 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                     Priority - <?php echo e($project->priority ?? ''); ?>

                </div>
                <div class="col border-left-grey">
                     Project Date - <?php echo e($project->start_date?->format(company()->date_format)); ?> 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                    Project Category - <?php echo e($project->category->category_name ?? ''); ?>

                </div>
                <div class="col border-left-grey">
                    Due Date - <?php echo e($project->deadline?->format(company()->date_format)); ?> 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                    Project SubCategory - <?php echo e($project->sub_category ?? ''); ?>

                </div>
                <div class="col border-left-grey">
                    Not To Exceed - <?php echo e($project->nte); ?> 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                    Next Follow Up Date - <?php echo e($project->nxt_follow_up_date?->format(company()->date_format)); ?>

                </div>
                <div class="col border-left-grey">
                    Next Follow Up Time - <?php echo e($project->nxt_follow_up_time ? \Carbon\Carbon::createFromFormat('H:i:s', $project->nxt_follow_up_time)->format(company()->time_format) : ''); ?> 
                </div>
            </div>
        </div>
        <div class="col-sm border-right-grey">
            <div class="row border-bottom-grey">
                <div class="col">
                    <h5 class="f-15 f-w-500 text-darkest-grey mb-0 py-2">Property Information</h5>
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        Property Address - <?php echo e($project->propertyDetails->street_address ?? ''); ?> <?php if($project->propertyDetails->optional): ?>, <?php echo e($project->propertyDetails->optional ?? ''); ?> <?php endif; ?>
                </div>
                <div class="col border-left-grey">
                        Property Type - <?php echo e($project->propertyDetails->property_type ?? ''); ?> 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        City - <?php echo e($project->propertyDetails->city ?? ''); ?>

                </div>
                <div class="col border-left-grey">
                        Bed - <?php echo e($project->propertyDetails->bedrooms ?? ''); ?>

                        <span class="ml-2">Bath - <?php echo e($project->propertyDetails->bathrooms ?? ''); ?></span>
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        State - <?php echo e($project->propertyDetails->state ?? ''); ?>

                </div>
                <div class="col border-left-grey">
                    House Size - <?php echo e($project->propertyDetails->house_size ?? ''); ?> 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        Zipcode - <?php echo e($project->propertyDetails->zipcode ?? ''); ?>

                        
                </div>
                <div class="col border-left-grey">
                        Occupied - <?php echo e($project->propertyDetails->occupancy_status ?? ''); ?>

                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        County - <?php echo e($project->propertyDetails->county ?? ''); ?>                        
                </div>
                <div class="col border-left-grey">
                        Lock Box Code - <?php echo e($project->propertyDetails->lockboxcode ?? ''); ?> 
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="row border-bottom-grey">
                <div class="col">
                    <h5 class="f-15 f-w-500 text-darkest-grey mb-0 py-2">Contact Information</h5>
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        Asset Manager Details - 
                        <?php if($project->projectContacts->amname): ?>
                        <?php echo e($project->projectContacts->amname ?? ''); ?>

                        <?php endif; ?>
                        <?php if($project->projectContacts->amph): ?>
                        , <?php echo e($project->projectContacts->amph ?? ''); ?>

                        <?php endif; ?>
                        <?php if($project->projectContacts->amemail): ?>
                        , <?php echo e($project->projectContacts->amemail ?? ''); ?>

                        <?php endif; ?>
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                    Tenant Details - 
                    <span class=" float-right">
                        <a class="btn btn-secondary m-2 btn-xs view-tenants" href="javascript:;">
                            <i class="fa fa-eye mr-2"></i>
                            <?php echo app('translator')->get('View'); ?>
                        </a>
                    </span>
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        Project Coordinators - 
                        <?php $__currentLoopData = $project->projectMembersWithoutScope; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($pm->name): ?>
                            <?php echo e($pm->name ?? ''); ?>

                            <?php endif; ?>
                            <?php if($pm->mobile): ?>
                            , <?php echo e($pm->mobile); ?>

                            <?php endif; ?>
                            <?php if($pm->email): ?>
                            , <?php echo e($pm->email); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Assigned Vendors -
                    <span class=" float-right">
                        <a class="btn btn-secondary m-2 btn-xs view-vendors" href="javascript:;">
                                <i class="fa fa-eye mr-2"></i>
                                <?php echo app('translator')->get('View'); ?>
                            </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('body').on('click', '.view-tenants', function() {
            var id = "<?php echo e($project->id); ?>";
            var url = "<?php echo e(route('projects.viewTenants',':id')); ?>";
            url = url.replace(':id', id);
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });
        $('body').on('click', '.view-vendors', function() {
            var id = "<?php echo e($project->id); ?>";
            var url = "<?php echo e(route('projects.viewVendors',':id')); ?>";
            url = url.replace(':id', id);
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });
    });
    </script><?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/projects/static.blade.php ENDPATH**/ ?>