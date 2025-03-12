

<div class="row">
    <div class="col-sm-12">
        <?php if (isset($component)) { $__componentOriginal18ad2e0d264f9740dc73fff715357c28 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18ad2e0d264f9740dc73fff715357c28 = $attributes; } ?>
<?php $component = App\View\Components\Form::resolve(['method' => 'PUT'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'save-data-form']); ?>
            <div class="add-client bg-white rounded">
                <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                    <?php echo app('translator')->get('Vendor Contact Detail'); ?></h4>

                <div class="row p-20">      
                    <div class="col-lg-3 col-md-3">
                        <?php if (isset($component)) { $__componentOriginal4e45e801405ab67097982370a6a83cba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4e45e801405ab67097982370a6a83cba = $attributes; } ?>
<?php $component = App\View\Components\Forms\Text::resolve(['fieldLabel' => __('Company Name'),'fieldName' => 'vendor_name','fieldId' => 'vendor_name','fieldPlaceholder' => __('placeholders.name'),'fieldRequired' => 'true','fieldValue' => $vendor->vendor_name] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                    <div class="col-lg-3 col-md-3">
                        <?php if (isset($component)) { $__componentOriginal4e45e801405ab67097982370a6a83cba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4e45e801405ab67097982370a6a83cba = $attributes; } ?>
<?php $component = App\View\Components\Forms\Text::resolve(['fieldLabel' => __('POC'),'fieldName' => 'poc','fieldId' => 'poc','fieldPlaceholder' => __('Poc'),'fieldValue' => $vendor->poc] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                    <div class="col-lg-3 col-md-3">
                        <?php if (isset($component)) { $__componentOriginal50b5ca2982df8dea32bf6d82813b408f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal50b5ca2982df8dea32bf6d82813b408f = $attributes; } ?>
<?php $component = App\View\Components\Forms\Tel::resolve(['fieldId' => 'vendor_mobile','fieldLabel' => __('modules.lead.mobile'),'fieldName' => 'vendor_mobile','fieldPlaceholder' => __('placeholders.mobile'),'fieldRequired' => 'true','fieldValue' => $vendor->vendor_number] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.tel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Tel::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal50b5ca2982df8dea32bf6d82813b408f)): ?>
<?php $attributes = $__attributesOriginal50b5ca2982df8dea32bf6d82813b408f; ?>
<?php unset($__attributesOriginal50b5ca2982df8dea32bf6d82813b408f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal50b5ca2982df8dea32bf6d82813b408f)): ?>
<?php $component = $__componentOriginal50b5ca2982df8dea32bf6d82813b408f; ?>
<?php unset($__componentOriginal50b5ca2982df8dea32bf6d82813b408f); ?>
<?php endif; ?>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <?php if (isset($component)) { $__componentOriginal4cff4ad89fa6d28d8e2b88246e322241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4cff4ad89fa6d28d8e2b88246e322241 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Email::resolve(['fieldId' => 'vendor_email','fieldLabel' => __('app.email'),'fieldName' => 'vendor_email','fieldPlaceholder' => __('placeholders.email'),'fieldValue' => $vendor->vendor_email] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.email'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Email::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4cff4ad89fa6d28d8e2b88246e322241)): ?>
<?php $attributes = $__attributesOriginal4cff4ad89fa6d28d8e2b88246e322241; ?>
<?php unset($__attributesOriginal4cff4ad89fa6d28d8e2b88246e322241); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4cff4ad89fa6d28d8e2b88246e322241)): ?>
<?php $component = $__componentOriginal4cff4ad89fa6d28d8e2b88246e322241; ?>
<?php unset($__componentOriginal4cff4ad89fa6d28d8e2b88246e322241); ?>
<?php endif; ?>
                    </div>
                    
                    <div class="col-md-3 col-lg-3">
                        <?php if (isset($component)) { $__componentOriginal67cd5dc9866c6185ad92d933c387fa86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Select::resolve(['fieldId' => 'states','fieldLabel' => __('State'),'fieldName' => 'state','fieldRequired' => 'true','search' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Select::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <option value="">--</option>
                        <?php $__currentLoopData = $location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if($vendor->state == $locations->state): echo 'selected'; endif; ?> value="<?php echo e($locations->state); ?>">
                                <?php echo e($locations->state); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $attributes = $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $component = $__componentOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
                    </div>
                    <div class="col-md-3 col-lg-3">
                            <?php if (isset($component)) { $__componentOriginal67cd5dc9866c6185ad92d933c387fa86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Select::resolve(['fieldId' => 'counties','fieldLabel' => __('County'),'fieldName' => 'county','fieldRequired' => 'true','search' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Select::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <option value="">--</option>
                                <?php $__currentLoopData = $counties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if($vendor->county == $locations->county): echo 'selected'; endif; ?> value="<?php echo e($locations->county); ?>">
                                        <?php echo e($locations->county); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $attributes = $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $component = $__componentOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
                    </div>
                    <div class="col-md-3 col-lg-3">
                            <?php if (isset($component)) { $__componentOriginal67cd5dc9866c6185ad92d933c387fa86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Select::resolve(['fieldId' => 'cities','fieldLabel' => __('City'),'fieldName' => 'city','fieldRequired' => 'true','search' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Select::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <option value="">--</option>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if($vendor->city == $locations->city): echo 'selected'; endif; ?> value="<?php echo e($locations->city); ?>">
                                        <?php echo e($locations->city); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $attributes = $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $component = $__componentOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
                    </div>
                    <div class="col-md-3 col-lg-3">
                            <?php if (isset($component)) { $__componentOriginal67cd5dc9866c6185ad92d933c387fa86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Select::resolve(['fieldId' => 'contractor_type','fieldLabel' => __('Contractor Type'),'fieldName' => 'contractor_type','fieldRequired' => 'true','search' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Select::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <option value="">--</option>
                                <?php $__currentLoopData = $contracttype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if($vendor->contractor_type == $ct->contractor_type): echo 'selected'; endif; ?> value="<?php echo e($ct->contractor_type); ?>">
                                        <?php echo e($ct->contractor_type); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $attributes = $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $component = $__componentOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
                    </div>
                    <div class="col-md-3 col-lg-3">
                            <?php if (isset($component)) { $__componentOriginal67cd5dc9866c6185ad92d933c387fa86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Select::resolve(['fieldId' => 'lead_source','fieldLabel' => __('Lead Source'),'fieldName' => 'lead_source','search' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Select::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <option value="">--</option>
                                <?php $__currentLoopData = $leadsource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leadsources): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if($vendor->lead_source == $leadsources->type): echo 'selected'; endif; ?> value="<?php echo e($leadsources->type); ?>">
                                    <?php echo e($leadsources->type); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $attributes = $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $component = $__componentOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <?php if (isset($component)) { $__componentOriginal4e45e801405ab67097982370a6a83cba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4e45e801405ab67097982370a6a83cba = $attributes; } ?>
<?php $component = App\View\Components\Forms\Text::resolve(['fieldId' => 'website','fieldLabel' => __('Website'),'fieldName' => 'website','fieldPlaceholder' => __('Website'),'fieldValue' => $vendor->website] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                    <div class="col-md-3 col-lg-3">
                            <?php if (isset($component)) { $__componentOriginalf704f069031d81dfb7cf95f6709a6a66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf704f069031d81dfb7cf95f6709a6a66 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Datepicker::resolve(['fieldId' => 'nxt_date','fieldLabel' => __('Next Follow Up Date'),'fieldName' => 'nxt_date','fieldPlaceholder' => __('placeholders.date'),'fieldValue' => ($vendor->nxt_date ? $vendor->nxt_date->format(company()->date_format) : '')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.datepicker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Datepicker::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf704f069031d81dfb7cf95f6709a6a66)): ?>
<?php $attributes = $__attributesOriginalf704f069031d81dfb7cf95f6709a6a66; ?>
<?php unset($__attributesOriginalf704f069031d81dfb7cf95f6709a6a66); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf704f069031d81dfb7cf95f6709a6a66)): ?>
<?php $component = $__componentOriginalf704f069031d81dfb7cf95f6709a6a66; ?>
<?php unset($__componentOriginalf704f069031d81dfb7cf95f6709a6a66); ?>
<?php endif; ?>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <?php if (isset($component)) { $__componentOriginal67cd5dc9866c6185ad92d933c387fa86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Select::resolve(['fieldId' => 'v_status','fieldLabel' => __('Status'),'fieldName' => 'v_status'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Select::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <option value="">--</option>
                            <?php $__currentLoopData = $vendorStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status); ?>" <?php echo e($vendor->v_status === $status ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst($status)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $attributes = $__attributesOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__attributesOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86)): ?>
<?php $component = $__componentOriginal67cd5dc9866c6185ad92d933c387fa86; ?>
<?php unset($__componentOriginal67cd5dc9866c6185ad92d933c387fa86); ?>
<?php endif; ?>
                    </div>       
                </div>
                <?php if (isset($component)) { $__componentOriginalb19caa501eea72410c04d1917a586963 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb19caa501eea72410c04d1917a586963 = $attributes; } ?>
<?php $component = App\View\Components\FormActions::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form-actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\FormActions::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    <?php if (isset($component)) { $__componentOriginalcf8d12533ff890e0d6573daf32b7618d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonPrimary::resolve(['icon' => 'check'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'save-form','class' => 'mr-3']); ?><?php echo app('translator')->get('app.save'); ?>
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
                    <?php if (isset($component)) { $__componentOriginalc35c79ed7e812580313ad04118477974 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc35c79ed7e812580313ad04118477974 = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonCancel::resolve(['link' => route('vendortrack.index')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonCancel::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'border-0']); ?><?php echo app('translator')->get('app.cancel'); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc35c79ed7e812580313ad04118477974)): ?>
<?php $attributes = $__attributesOriginalc35c79ed7e812580313ad04118477974; ?>
<?php unset($__attributesOriginalc35c79ed7e812580313ad04118477974); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc35c79ed7e812580313ad04118477974)): ?>
<?php $component = $__componentOriginalc35c79ed7e812580313ad04118477974; ?>
<?php unset($__componentOriginalc35c79ed7e812580313ad04118477974); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb19caa501eea72410c04d1917a586963)): ?>
<?php $attributes = $__attributesOriginalb19caa501eea72410c04d1917a586963; ?>
<?php unset($__attributesOriginalb19caa501eea72410c04d1917a586963); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb19caa501eea72410c04d1917a586963)): ?>
<?php $component = $__componentOriginalb19caa501eea72410c04d1917a586963; ?>
<?php unset($__componentOriginalb19caa501eea72410c04d1917a586963); ?>
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

    </div>
</div>

<script>
    $(document).ready(function() {
        $('#vendor_mobile').on('input', function () {
                let value = $(this).val().replace(/[^0-9]/g, '');  // Remove non-digit characters
                if (value.length > 10) {
                    value = value.slice(0, 10);  // Limit to 10 digits
                }
                $(this).val(value);
                
                if (value.length === 10) {
                    $('#save-form').prop('disabled', false);

                } 
                else if (value.length===0)
                {
                    $('#save-form').prop('disabled', false);

                }
                else {
                    $('#save-form').prop('disabled', true);

                }

            });
        $("#save-data-form .select-picker").selectpicker();

        const dp1 = datepicker('#nxt_date', {
                position: 'bl',
                ...datepickerConfig
            });

        $('#states').change( function() {
                var state_id = $(this).val();
                if (state_id) {
                    fetchCounties(state_id);
                    $('#counties').find('option:not(:first)').remove();
                    $('#cities').find('option:not(:first)').remove();
                }
        });

        $('#counties').change( function() {
                var county_id = $(this).val();
                if (county_id) {
                    fetchCities(county_id);
                    $('#cities').find('option:not(:first)').remove();
                }
        });

        function fetchCounties(state) {
            var url = "<?php echo e(route('locations.counties', ':state')); ?>";
            url = url.replace(':state', state);
                $.easyAjax({
                    url: url,
                    container: '#save-data-form',
                    method: 'GET',
                    blockUI: true,
                    success: function(data) {
                        
                        data.counties.forEach(county => {
                            $('#counties').append(`<option value="${county.county}">${county.county}</option>`);
                            $('#counties').selectpicker('refresh');
                            $('#cities').selectpicker('refresh');
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

            function fetchCities(county) {
                var url = "<?php echo e(route('locations.cities', ':county')); ?>";
                url = url.replace(':county', county);
                $.easyAjax({
                    url: url,
                    container: '#save-data-form',
                    method: 'GET',
                    blockUI: true,
                    success: function(data) {
                        data.cities.forEach(cities => {
        
                            $('#cities').append(`<option value="${cities.city}">${cities.city}</option>`);
                            $('#cities').selectpicker('refresh');
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        $('#save-form').click(function() {
            const url = "<?php echo e(route('vendortrack.update', $vendor->id)); ?>";
            $.easyAjax({
                url: url,
                container: '#save-data-form',
                type: "POST",
                disableButton: true,
                blockUI: true,
                file: true,
                buttonSelector: "#save-form",
                data: $('#save-data-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.href = response.redirectUrl;
                    }
                }
            })
        });

        init(RIGHT_MODAL);
    });

   
</script>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/vendortrack/ajax/edit.blade.php ENDPATH**/ ?>