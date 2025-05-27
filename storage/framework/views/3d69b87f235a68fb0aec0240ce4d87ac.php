<?php if(in_array('my_calender', $activeWidgets) &&
                (in_array('tasks', user_modules()) || in_array('events', user_modules()) || in_array('holidays', user_modules()) ||
                in_array('tickets', user_modules()) || in_array('leaves', user_modules()))): ?>
    <div class="row">
        <div class="col-md-12">
            <?php if (isset($component)) { $__componentOriginalbc9540fa671f26a0f8028a5a8d8f93e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc9540fa671f26a0f8028a5a8d8f93e9 = $attributes; } ?>
<?php $component = App\View\Components\Cards\Data::resolve(['title' => __('app.menu.myCalendar')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\Data::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <div id="calendar"></div>
                 <?php $__env->slot('action', null, []); ?> 
                    <div class="dropdown ml-auto calendar-action">
                        <button id="event-btn" class="btn btn-lg f-14 p-0 text-lightest text-capitalize rounded  dropdown-toggle cal-event" type="button"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>

                        <div id="cal-drop" class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-2">
                            <?php if(in_array('tasks', user_modules())): ?>
                                <div class="custom-control custom-checkbox cal-filter">
                                    <input type="checkbox" value="task"
                                           class="form-check-input filter-check" name="calendar[]"
                                           id="customCheck1" <?php if(in_array('task',$event_filter)): ?> checked <?php endif; ?>>
                                    <label
                                        class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-2 text-wrap"
                                        for="customCheck1"><?php echo app('translator')->get('app.menu.tasks'); ?></label>
                                </div>
                            <?php endif; ?>
                            <?php if(in_array('events', user_modules())): ?>
                                <div class="custom-control custom-checkbox cal-filter">
                                    <input type="checkbox" value="events"
                                           class="form-check-input filter-check" name="calendar[]"
                                           id="customCheck2" <?php if(in_array('events',$event_filter)): ?> checked <?php endif; ?>>
                                    <label
                                        class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-2 text-wrap"
                                        for="customCheck2"><?php echo app('translator')->get('app.menu.events'); ?></label>
                                </div>
                            <?php endif; ?>
                            <?php if(in_array('holidays', user_modules())): ?>
                                <div class="custom-control custom-checkbox cal-filter">
                                    <input type="checkbox" value="holiday"
                                           class="form-check-input filter-check" name="calendar[]"
                                           id="customCheck3" <?php if(in_array('holiday',$event_filter)): ?> checked <?php endif; ?>>
                                    <label
                                        class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-2 text-wrap"
                                        for="customCheck3"><?php echo app('translator')->get('app.menu.holiday'); ?></label>
                                </div>
                            <?php endif; ?>
                            <?php if(in_array('tickets', user_modules())): ?>
                                <div class="custom-control custom-checkbox cal-filter">
                                    <input type="checkbox" value="tickets"
                                           class="form-check-input filter-check" name="calendar[]"
                                           id="customCheck4" <?php if(in_array('tickets',$event_filter)): ?> checked <?php endif; ?>>
                                    <label
                                        class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-2 text-wrap"
                                        for="customCheck4"><?php echo app('translator')->get('app.menu.tickets'); ?></label>
                                </div>
                            <?php endif; ?>
                            <?php if(in_array('leaves', user_modules())): ?>
                                <div class="custom-control custom-checkbox cal-filter">
                                    <input type="checkbox" value="leaves"
                                           class="form-check-input filter-check" name="calendar[]"
                                           id="customCheck5" <?php if(in_array('leaves',$event_filter)): ?> checked <?php endif; ?>>
                                    <label
                                        class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-2 text-wrap"
                                        for="customCheck5"><?php echo app('translator')->get('app.menu.leaves'); ?></label>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                 <?php $__env->endSlot(); ?>
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
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/dashboard/employee/widgets/my_calendar.blade.php ENDPATH**/ ?>