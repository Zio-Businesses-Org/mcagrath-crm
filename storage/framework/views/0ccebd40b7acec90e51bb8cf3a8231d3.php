<?php if(in_array('attendance', user_modules()) && in_array('shift_schedule', $activeWidgets) && $sidebarUserPermissions['view_shift_roster'] != 5 && $sidebarUserPermissions['view_shift_roster'] != 'none' && in_array('attendance', user_modules())): ?>
    <div class="col-sm-12">
        <?php if (isset($component)) { $__componentOriginalbc9540fa671f26a0f8028a5a8d8f93e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc9540fa671f26a0f8028a5a8d8f93e9 = $attributes; } ?>
<?php $component = App\View\Components\Cards\Data::resolve(['title' => __('modules.attendance.shiftSchedule'),'padding' => 'false','otherClasses' => 'h-200'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\Data::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-3']); ?>
             <?php $__env->slot('action', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginalcf8d12533ff890e0d6573daf32b7618d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonPrimary::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'view-shifts']); ?><?php echo app('translator')->get('modules.attendance.shift'); ?>
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
             <?php $__env->endSlot(); ?>

            <?php if (isset($component)) { $__componentOriginal7d9f6e0b9001f5841f72577781b2d17f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f = $attributes; } ?>
<?php $component = App\View\Components\Table::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Table::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <?php $__currentLoopData = $currentWeekDates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $weekDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($weekShifts[$key])): ?>
                        <tr>
                            <td class="pl-20">
                                <?php echo e($weekDate->translatedFormat(company()->date_format)); ?>

                            </td>
                            <td><?php echo e($weekDate->translatedFormat('l')); ?></td>
                            <td>
                                <?php if(isset($weekShifts[$key]->shift)): ?>
                                    <?php if($weekShifts[$key]->shift->shift_name == 'Day Off'): ?>
                                        <span class="badge badge-secondary text-body"
                                              style="background-color:<?php echo e($weekShifts[$key]->shift->color); ?>"><?php echo e(__('modules.attendance.' . str($weekShifts[$key]->shift->shift_name)->camel())); ?>

                                                                </span>
                                    <?php else: ?>
                                        <span class="badge badge-success"
                                              style="background-color:<?php echo e($weekShifts[$key]->shift->color); ?>"><?php echo e($weekShifts[$key]->shift->shift_name); ?>

                                                                </span>
                                    <?php endif; ?>

                                    <?php if(!is_null($weekShifts[$key]->remarks) && $weekShifts[$key]->remarks != ''): ?>
                                        <i class="fa fa-info-circle text-dark-grey" data-toggle="popover" data-placement="top" data-content="<?php echo e($weekShifts[$key]->remarks); ?>" data-html="true" data-trigger="hover"></i>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php echo $weekShifts[$key]; ?>

                                <?php endif; ?>
                            </td>
                            <td class="pr-20 text-right">
                                <?php if(isset($weekShifts[$key]->shift)): ?>
                                    <?php if(attendance_setting()->allow_shift_change && !$weekDate->isPast()): ?>
                                        <?php if(!is_null($weekShifts[$key]->requestChange) && $weekShifts[$key]->requestChange->status == 'waiting'): ?>
                                            <div class="task_view">
                                                <a href="javascript:;"
                                                   data-shift-schedule-id="<?php echo e($weekShifts[$key]->id); ?>" data-shift-schedule-date="<?php echo e($weekDate->translatedFormat(company()->date_format)); ?>"
                                                   data-shift-id="<?php echo e($weekShifts[$key]->shift->id); ?>" class="taskView border-right-0 request-shift-change f-11"><?php echo app('translator')->get('modules.attendance.requestPending'); ?></a>
                                            </div>
                                        <?php else: ?>
                                            <div class="task_view">
                                                <a href="javascript:;"
                                                   data-shift-schedule-id="<?php echo e($weekShifts[$key]->id); ?>" data-shift-schedule-date="<?php echo e($weekDate->translatedFormat(company()->date_format)); ?>"
                                                   data-shift-id="<?php echo e($weekShifts[$key]->shift->id); ?>" class="taskView border-right-0 request-shift-change f-11"><?php echo app('translator')->get('modules.attendance.requestChange'); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        --
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('app.defaultShift'); ?>
                                <?php endif; ?>

                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f)): ?>
<?php $attributes = $__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f; ?>
<?php unset($__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d9f6e0b9001f5841f72577781b2d17f)): ?>
<?php $component = $__componentOriginal7d9f6e0b9001f5841f72577781b2d17f; ?>
<?php unset($__componentOriginal7d9f6e0b9001f5841f72577781b2d17f); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc9540fa671f26a0f8028a5a8d8f93e9)): ?>
<?php $attributes = $__attributesOriginalbc9540fa671f26a0f8028a5a8d8f93e9; ?>
<?php unset($__attributesOriginalbc9540fa671f26a0f8028a5a8d8f93e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc9540fa671f26a0f8028a5a8d8f93e9)): ?>
<?php $component = $__componentOriginalbc9540fa671f26a0f8028a5a8d8f93e9; ?>
<?php unset($__componentOriginalbc9540fa671f26a0f8028a5a8d8f93e9); ?>
<?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/dashboard/employee/widgets/shift_schedule.blade.php ENDPATH**/ ?>