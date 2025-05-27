

<?php $__env->startPush('styles'); ?>
    <?php if((!is_null($viewEventPermission) && $viewEventPermission != 'none')
        || (!is_null($viewHolidayPermission) && $viewHolidayPermission != 'none')
        || (!is_null($viewTaskPermission) && $viewTaskPermission != 'none')
        || (!is_null($viewTicketsPermission) && $viewTicketsPermission != 'none')
        || (!is_null($viewLeavePermission) && $viewLeavePermission != 'none')
        ): ?>
        <link rel="stylesheet" href="<?php echo e(asset('vendor/full-calendar/main.min.css')); ?>" defer="defer">
    <?php endif; ?>
    <style>
        .h-200 {
            max-height: 340px;
            overflow-y: auto;
        }

        .dashboard-settings {
            width: 600px;
        }

        @media (max-width: 768px) {
            .dashboard-settings {
                width: 300px;
            }
        }

        .fc-list-event-graphic{
            display: none;
        }

        .fc .fc-list-event:hover td{
            background-color: #fff !important;
            color:#000 !important;
        }
        .left-3{
            margin-right: -22px;
        }
        .clockin-right{
            margin-right: -10px;
        }

        .week-pagination li {
            margin-right: 5px;
            z-index: 1;
        }
        .week-pagination li a {
            border-radius: 50%;
            padding: 2px 6px !important;
            font-size: 11px !important;
        }

        .week-pagination li.page-item:first-child .page-link {
            border-top-left-radius: 50%;
            border-bottom-left-radius: 50%;
        }

        .week-pagination li.page-item:last-child .page-link {
            border-top-right-radius: 50%;
            border-bottom-right-radius: 50%;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- CONTENT WRAPPER START -->
    <div class="px-4 py-2 border-top-0 emp-dashboard">
        <!-- WELOCOME START -->
        <?php if(!is_null($checkTodayLeave)): ?>
            <div class="row pt-4">
                <div class="col-md-12">
                    <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'info','icon' => 'info-circle']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'info','icon' => 'info-circle']); ?>
                        <a href="<?php echo e(route('leaves.show', $checkTodayLeave->id)); ?>" class="openRightModal text-dark-grey">
                            <u><?php echo app('translator')->get('messages.youAreOnLeave'); ?></u>
                        </a>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
                </div>
            </div>
        <?php elseif(!is_null($checkTodayHoliday)): ?>
            <div class="row pt-4">
                <div class="col-md-12">
                    <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'info','icon' => 'info-circle']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'info','icon' => 'info-circle']); ?>
                        <a href="<?php echo e(route('holidays.show', $checkTodayHoliday->id)); ?>" class="openRightModal text-dark-grey">
                            <u><?php echo app('translator')->get('messages.holidayToday'); ?></u>
                        </a>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
                </div>
            </div>
        <?php endif; ?>


        <?php if(in_array('admin', user_roles())): ?>
            <div class="row">
                <?php echo $__env->make('dashboard.update-message-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if ($__env->exists('dashboard.update-message-module-dashboard')) echo $__env->make('dashboard.update-message-module-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if (isset($component)) { $__componentOriginale691f3c66b4e7efe99161ec4ba911fdc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale691f3c66b4e7efe99161ec4ba911fdc = $attributes; } ?>
<?php $component = App\View\Components\CronMessage::resolve(['modal' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cron-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\CronMessage::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale691f3c66b4e7efe99161ec4ba911fdc)): ?>
<?php $attributes = $__attributesOriginale691f3c66b4e7efe99161ec4ba911fdc; ?>
<?php unset($__attributesOriginale691f3c66b4e7efe99161ec4ba911fdc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale691f3c66b4e7efe99161ec4ba911fdc)): ?>
<?php $component = $__componentOriginale691f3c66b4e7efe99161ec4ba911fdc; ?>
<?php unset($__componentOriginale691f3c66b4e7efe99161ec4ba911fdc); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="d-lg-flex d-md-flex d-block py-2 pb-2 align-items-center">

            <!-- WELOCOME NAME START -->
            <div>
                <h3 class="heading-h3 mb-0 f-21 font-weight-bold"><?php echo app('translator')->get('app.welcome'); ?> <?php echo e($user->name); ?></h3>
            </div>
            <!-- WELOCOME NAME END -->

            <!-- CLOCK IN CLOCK OUT START -->
            <div
                class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 m mt-4 mt-lg-0 mt-md-0 justify-content-between">
                <p
                    class="mb-0 text-lg-right text-md-right f-18 font-weight-bold text-dark-grey d-grid align-items-center">
                    <input type="hidden" id="current-latitude" name="current_latitude">
                    <input type="hidden" id="current-longitude" name="current_longitude">

                    <span id="dashboard-clock"><?php echo now()->timezone(company()->timezone)->translatedFormat(company()->time_format) . '</span><span class="f-10 font-weight-normal">' . now()->timezone(company()->timezone)->translatedFormat('l') . '</span>'; ?>


                    <?php if(!is_null($currentClockIn)): ?>
                        <span class="f-11 font-weight-normal text-lightest">
                            <?php echo app('translator')->get('app.clockInAt'); ?> -
                            <?php echo e($currentClockIn->clock_in_time->timezone(company()->timezone)->translatedFormat(company()->time_format)); ?>

                        </span>
                    <?php endif; ?>
                </p>

                <?php
                    $current_time = now()->timezone(company()->timezone)->translatedFormat(company()->time_format);
                    $msg = null;
                    $strt = \Carbon\Carbon::createFromFormat('H:i:s', $attendanceSettings->office_start_time)->translatedFormat(company()->time_format);
                    $end_time = \Carbon\Carbon::createFromFormat('H:i:s', $attendanceSettings->office_end_time)->translatedFormat(company()->time_format);

                    // if ($end_time < $strt) {
                    //     $end_time += 24 * 3600; // Adding one day worth of seconds (24 hours * 3600 seconds)
                    // }

                    if($leave->isNotEmpty()){
                        $msg = 'Leave are applied for today.';
                    }else if(!is_null($checkTodayHoliday) && $checkTodayHoliday->exists){
                        $msg = 'Today is Holiday.';
                    }else if($cannotLogin == true){
                        $msg = 'You are not within office hours.';
                    }

                ?>
                <?php if(in_array('attendance', user_modules())): ?>
                    <?php if(is_null($currentClockIn) && is_null($checkTodayLeave) && $checkJoiningDate == true): ?>
                        <button type="button" class="btn-primary rounded f-15 ml-4" id="clock-in"
                            <?php if(($cannotLogin || !is_null($msg)) && ($user->isAdmin($user->id) || $user->isEmployee($user->id))): ?>
                                disabled
                                data-toggle="tooltip" data-placement="top" title="<?php echo e(__($msg)); ?>"
                            <?php endif; ?>
                        ><i
                        class="icons icon-login mr-2"></i><?php echo app('translator')->get('modules.attendance.clock_in'); ?></button>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(!is_null($currentClockIn) && is_null($currentClockIn->clock_out_time)): ?>
                    <button type="button" class="btn-danger rounded f-15 ml-4" id="clock-out"><i
                            class="icons icon-login mr-2"></i><?php echo app('translator')->get('modules.attendance.clock_out'); ?></button>
                <?php endif; ?>

                <?php if(in_array('admin', user_roles())): ?>
                    <div class="private-dash-settings d-flex align-self-center">
                        <?php if (isset($component)) { $__componentOriginal18ad2e0d264f9740dc73fff715357c28 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18ad2e0d264f9740dc73fff715357c28 = $attributes; } ?>
<?php $component = App\View\Components\Form::resolve(['method' => 'POST'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'privateDashboardWidgetForm']); ?>
                            <div class="dropdown keep-open">
                                <a class="d-flex align-items-center justify-content-center dropdown-toggle px-4 text-dark left-3"
                                    type="link" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"

                                    aria-expanded="false">
                                    <i class="fa fa-cog" data-original-title="<?php echo e(__('modules.dashboard.dashboardWidgetsSettings')); ?>" data-toggle="tooltip"></i>
                                </a>
                                <!-- Dropdown - User Information -->
                                <ul class="dropdown-menu dropdown-menu-right dashboard-settings p-20"
                                    aria-labelledby="dropdownMenuLink" tabindex="0">
                                    <li class="border-bottom mb-3">
                                        <h4 class="heading-h3"><?php echo app('translator')->get('modules.dashboard.dashboardWidgets'); ?></h4>
                                    </li>
                                    <?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $wname = \Illuminate\Support\Str::camel($widget->widget_name);
                                        ?>
                                        <li class="mb-2 float-left w-50">
                                            <div class="checkbox checkbox-info ">
                                                <input id="<?php echo e($widget->widget_name); ?>" name="<?php echo e($widget->widget_name); ?>"
                                                    value="true" <?php if($widget->status): ?> checked <?php endif; ?> type="checkbox">
                                                <label for="<?php echo e($widget->widget_name); ?>"><?php echo app('translator')->get('modules.dashboard.' .
                                                    $wname); ?></label>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(count($widgets) % 2 != 0): ?>
                                        <li class="mb-2 float-left w-50 height-35"></li>
                                    <?php endif; ?>
                                    <li class="float-none w-100">
                                        <?php if (isset($component)) { $__componentOriginalcf8d12533ff890e0d6573daf32b7618d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonPrimary::resolve(['icon' => 'check'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'save-dashboard-widget']); ?><?php echo app('translator')->get('app.save'); ?>
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
                                    </li>
                                </ul>
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
                <?php endif; ?>
            </div>
            <!-- CLOCK IN CLOCK OUT END -->
        </div>
        <!-- WELOCOME END -->
         <!-- EMPLOYEE DASHBOARD DETAIL START -->
         <div class="row emp-dash-detail">
            <!-- EMP DASHBOARD INFO NOTICES START -->
            <?php if(count(array_intersect(['profile', 'shift_schedule', 'birthday', 'notices'], $activeWidgets)) > 0): ?>
                <div class="col-xl-5 col-lg-12 col-md-12 e-d-info-notices">
                    <div class="row">
                        <?php if(in_array('profile', $activeWidgets)): ?>
                        <!-- EMP DASHBOARD INFO START -->
                        <div class="col-md-12">
                            <div class="card border-0 b-shadow-4 mb-3 e-d-info">
                                <a <?php if(!in_array('client', user_roles())): ?> href="<?php echo e(route('employees.show', user()->id)); ?>" <?php endif; ?> >
                                    <div class="card-horizontal align-items-center">
                                        <div class="card-img">
                                            <img class="" src=" <?php echo e($user->image_url); ?>" alt="Card image">
                                        </div>
                                        <div class="card-body border-0 pl-0">
                                            <h4 class="card-title text-dark f-18 f-w-500 mb-0"><?php echo e($user->name); ?></h4>
                                            <p class="f-14 font-weight-normal text-dark-grey mb-2">
                                                <?php echo e($user->employeeDetails->designation->name ?? '--'); ?></p>
                                            <p class="card-text f-12 text-lightest"> <?php echo app('translator')->get('app.employeeId'); ?> :
                                                <?php echo e($user->employeeDetails->employee_id); ?></p>
                                        </div>
                                    </div>
                                </a>

                                <div class="card-footer bg-white border-top-grey py-3">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <?php if(in_array('tasks', user_modules())): ?>
                                            <span>
                                                <label class="f-12 text-dark-grey mb-12 text-capitalize" for="usr">
                                                    <?php echo app('translator')->get('app.openTasks'); ?> </label>
                                                <p class="mb-0 f-18 f-w-500">
                                                    <a href="<?php echo e(route('tasks.index') . '?assignee=me'); ?>"
                                                        class="text-dark">
                                                        <?php echo e($inProcessTasks); ?>

                                                    </a>
                                                </p>
                                            </span>
                                        <?php endif; ?>
                                        <?php if(in_array('projects', user_modules())): ?>
                                            <span>
                                                <label class="f-12 text-dark-grey mb-12 text-capitalize" for="usr">
                                                    <?php echo app('translator')->get('app.menu.projects'); ?> </label>
                                                <p class="mb-0 f-18 f-w-500">
                                                    <a href="<?php echo e(route('projects.index') . '?assignee=me&status=all'); ?>"
                                                        class="text-dark"><?php echo e($totalProjects); ?></a>
                                                </p>
                                            </span>
                                        <?php endif; ?>
                                        <?php if(isset($totalOpenTickets) && in_array('tickets', user_modules())): ?>
                                            <span>
                                                <label class="f-12 text-dark-grey mb-12 text-capitalize" for="usr">
                                                    <?php echo app('translator')->get('modules.dashboard.totalOpenTickets'); ?> </label>
                                                <p class="mb-0 f-18 f-w-500">
                                                    <a href="<?php echo e(route('tickets.index') . '?agent=me&status=open'); ?>"
                                                        class="text-dark"><?php echo e($totalOpenTickets); ?></a>
                                                </p>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- EMP DASHBOARD INFO END -->
                        <?php endif; ?>

                        <?php if(!is_null($myActiveTimer) && in_array('tasks', user_modules())): ?>
                            <div class="col-sm-12" id="myActiveTimerSection">
                                <?php if (isset($component)) { $__componentOriginalbc9540fa671f26a0f8028a5a8d8f93e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc9540fa671f26a0f8028a5a8d8f93e9 = $attributes; } ?>
<?php $component = App\View\Components\Cards\Data::resolve(['title' => __('modules.timeLogs.myActiveTimer')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\Data::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-3']); ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php echo e($myActiveTimer->start_time->timezone(company()->timezone)->translatedFormat('M d, Y' . ' - ' . company()->time_format)); ?>

                                            <p class="text-primary my-2">

                                                <strong><?php echo app('translator')->get('modules.timeLogs.totalHours'); ?>:</strong>
                                                <?php echo e(\Carbon\CarbonInterval::formatHuman(now()->diffInMinutes($myActiveTimer->start_time) - $myActiveTimer->breaks->sum('total_minutes'))); ?>

                                            </p>

                                            <ul class="list-group">
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center f-12 text-dark-grey">
                                                    <span><i class="fa fa-clock"></i>
                                                        <?php echo app('translator')->get('modules.timeLogs.startTime'); ?></span>
                                                    <?php echo e($myActiveTimer->start_time->timezone(company()->timezone)->translatedFormat(company()->time_format)); ?>

                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center f-12 text-dark-grey">
                                                    <span><i class="fa fa-briefcase"></i> <?php echo app('translator')->get('app.task'); ?></span>
                                                    <a href="<?php echo e(route('tasks.show', $myActiveTimer->task->id)); ?>"
                                                        class="text-dark-grey openRightModal"><?php echo e($myActiveTimer->task->heading); ?></a>
                                                </li>
                                                <?php $__currentLoopData = $myActiveTimer->breaks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center f-12 text-dark-grey">
                                                        <?php if(!is_null($item->end_time)): ?>

                                                            <span><i class="fa fa-mug-hot"></i>
                                                                <?php echo app('translator')->get('modules.timeLogs.break'); ?>
                                                                (<?php echo e(\Carbon\CarbonInterval::formatHuman($item->end_time->diffInMinutes($item->start_time))); ?>)
                                                            </span>
                                                            <?php echo e($item->start_time->timezone(company()->timezone)->translatedFormat(company()->time_format) . ' - ' . $item->end_time->timezone(company()->timezone)->translatedFormat(company()->time_format)); ?>

                                                        <?php else: ?>
                                                            <span><i class="fa fa-mug-hot"></i>
                                                                <?php echo app('translator')->get('modules.timeLogs.break'); ?></span>
                                                            <?php echo e($item->start_time->timezone(company()->timezone)->translatedFormat(company()->time_format)); ?>

                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>

                                        </div>
                                        <div class="col-sm-12 pt-3 text-right">
                                            <?php if($editTimelogPermission == 'all' || ($editTimelogPermission == 'added' && $myActiveTimer->added_by == user()->id) || ($editTimelogPermission == 'owned' && (($myActiveTimer->project && $myActiveTimer->project->client_id == user()->id) || $myActiveTimer->user_id == user()->id)) || ($editTimelogPermission == 'both' && (($myActiveTimer->project && $myActiveTimer->project->client_id == user()->id) || $myActiveTimer->user_id == user()->id || $myActiveTimer->added_by == user()->id))): ?>
                                                <?php if(is_null($myActiveTimer->activeBreak)): ?>
                                                    <?php if (isset($component)) { $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonSecondary::resolve(['icon' => 'pause-circle'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonSecondary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-time-id' => ''.e($myActiveTimer->id).'','id' => 'pause-timer-btn','data-url' => ''.e(url()->current()).'']); ?>
                                                        <?php echo app('translator')->get('modules.timeLogs.pauseTimer'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $attributes = $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $component = $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
                                                    <?php if (isset($component)) { $__componentOriginalcf8d12533ff890e0d6573daf32b7618d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonPrimary::resolve(['icon' => 'stop-circle'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ml-3 stop-active-timer','data-url' => ''.e(url()->current()).'','data-time-id' => ''.e($myActiveTimer->id).'']); ?>
                                                        <?php echo app('translator')->get('modules.timeLogs.stopTimer'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcf8d12533ff890e0d6573daf32b7618d)): ?>
<?php $attributes = $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d; ?>
<?php unset($__attributesOriginalcf8d12533ff890e0d6573daf32b7618d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf8d12533ff890e0d6573daf32b7618d)): ?>
<?php $component = $__componentOriginalcf8d12533ff890e0d6573daf32b7618d; ?>
<?php unset($__componentOriginalcf8d12533ff890e0d6573daf32b7618d); ?>
<?php endif; ?>
                                                <?php else: ?>
                                                    <?php if (isset($component)) { $__componentOriginalcf8d12533ff890e0d6573daf32b7618d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonPrimary::resolve(['icon' => 'play-circle'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'resume-timer-btn','data-url' => ''.e(url()->current()).'','data-time-id' => ''.e($myActiveTimer->activeBreak->id).'']); ?>
                                                        <?php echo app('translator')->get('modules.timeLogs.resumeTimer'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcf8d12533ff890e0d6573daf32b7618d)): ?>
<?php $attributes = $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d; ?>
<?php unset($__attributesOriginalcf8d12533ff890e0d6573daf32b7618d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf8d12533ff890e0d6573daf32b7618d)): ?>
<?php $component = $__componentOriginalcf8d12533ff890e0d6573daf32b7618d; ?>
<?php unset($__componentOriginalcf8d12533ff890e0d6573daf32b7618d); ?>
<?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
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

                            <?php echo $__env->make('dashboard.employee.widgets.shift_schedule', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('dashboard.employee.widgets.birthday', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('dashboard.employee.widgets.appreciation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('dashboard.employee.widgets.leave', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('dashboard.employee.widgets.work_from_home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('dashboard.employee.widgets.work_anniversary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('dashboard.employee.widgets.notice-period', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('dashboard.employee.widgets.probation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('dashboard.employee.widgets.internship', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('dashboard.employee.widgets.contract', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- EMP DASHBOARD INFO NOTICES END -->
            <!-- EMP DASHBOARD TASKS PROJECTS EVENTS START -->
            <div class="col-xl-7 col-lg-12 col-md-12 e-d-tasks-projects-events">
                <!-- EMP DASHBOARD TASKS PROJECTS START -->
                <div class="row mb-3 mt-xl-0 mt-lg-4 mt-md-4 mt-4">
                    <?php if(in_array('tasks', $activeWidgets) && (!is_null($viewTaskPermission) && $viewTaskPermission != 'none') && in_array('tasks', user_modules())): ?>
                        <div class="col-md-6 mb-3">
                            <div
                                class="bg-white p-20 rounded b-shadow-4 d-flex justify-content-between align-items-center mb-4 mb-md-0 mb-lg-0">
                                <div class="d-block text-capitalize">
                                    <h5 class="f-15 f-w-500 mb-20 text-darkest-grey"><?php echo app('translator')->get('app.menu.tasks'); ?></h5>
                                    <div class="d-flex">
                                        <a href="<?php echo e(route('tasks.index') . '?assignee=me'); ?>">
                                            <p class="mb-0 f-21 font-weight-bold text-blue d-grid mr-5">
                                                <?php echo e($inProcessTasks); ?><span class="f-12 font-weight-normal text-lightest">
                                                    <?php echo app('translator')->get('app.pending'); ?> </span>
                                            </p>
                                        </a>
                                        <a href="<?php echo e(route('tasks.index') . '?assignee=me&overdue=yes'); ?>">
                                            <p class="mb-0 f-21 font-weight-bold text-red d-grid"><?php echo e($dueTasks); ?><span
                                                    class="f-12 font-weight-normal text-lightest"><?php echo app('translator')->get('app.overdue'); ?></span>
                                            </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-block">
                                    <i class="fa fa-list text-lightest f-27"></i>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php echo $__env->make('dashboard.employee.widgets.projects', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('dashboard.employee.widgets.lead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('dashboard.employee.widgets.week_timelog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- EMP DASHBOARD TASKS PROJECTS END -->
                <?php echo $__env->make('dashboard.employee.widgets.my_tasks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('dashboard.employee.widgets.tickets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('dashboard.employee.widgets.my_calendar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('dashboard.employee.widgets.notices', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
            <!-- EMP DASHBOARD TASKS PROJECTS EVENTS END -->
        </div>
        <!-- EMPLOYEE DASHBOARD DETAIL END -->

    </div>
    <!-- CONTENT WRAPPER END -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php if((!is_null($viewEventPermission) && $viewEventPermission != 'none')
        || (!is_null($viewHolidayPermission) && $viewHolidayPermission != 'none')
        || (!is_null($viewTaskPermission) && $viewTaskPermission != 'none')
        || (!is_null($viewTicketsPermission) && $viewTicketsPermission != 'none')
        || (!is_null($viewLeavePermission) && $viewLeavePermission != 'none')
        ): ?>
        <script src="<?php echo e(asset('vendor/full-calendar/main.min.js')); ?>"  defer="defer"></script>
        <script src="<?php echo e(asset('vendor/full-calendar/locales-all.min.js')); ?>"  defer="defer"></script>
        <script>
            if (cannotLogin === false) {
                clockInButton.disabled = true;
                clockInButton.setAttribute('data-toggle', 'popover');
                clockInButton.setAttribute('data-trigger', 'hover');
                // Add other attributes as needed
            } else {
                clockInButton.disabled = false;
                // Remove any attributes set when the button is disabled
                clockInButton.removeAttribute('data-toggle');
                clockInButton.removeAttribute('data-trigger');
                // Remove other attributes as needed
            }
        </script>
        <script>

            $(document).ready(function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: initialLocaleCode,
                    timeZone: '<?php echo e(company()->timezone); ?>',
                    firstDay: parseInt("<?php echo e(attendance_setting()?->week_start_from); ?>"),
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    navLinks: true, // can click day/week names to navigate views
                    selectable: false,
                    initialView: 'listWeek',
                    selectMirror: true,
                    select: function(arg) {
                        addEventModal(arg.start, arg.end, arg.allDay);
                        calendar.unselect()
                    },
                    eventClick: function(arg) {
                        getEventDetail(arg.event.id,arg.event.extendedProps.event_type);
                    },
                    editable: false,
                    dayMaxEvents: true, // allow "more" link when too many events
                    events: {
                        url: "<?php echo e(route('dashboard.private_calendar')); ?>",
                    },
                    eventDidMount: function(info) {
                            $(info.el).css('background-color', info.event.extendedProps.bg_color);
                            $(info.el).css('color', info.event.extendedProps.color);
                            $(info.el).find('td.fc-list-event-title').prepend('<i class="fa '+info.event.extendedProps.icon+'"></i>&nbsp;&nbsp;');
                            // tooltip for leaves
                            if(info.event.extendedProps.event_type == 'leave'){
                                $(info.el).find('td.fc-list-event-title > a').css('cursor','default'); // list view cursor for leave
                                $(info.el).css('cursor','default')
                                $(info.el).tooltip({
                                    title: info.event.extendedProps.name,
                                    container: 'body',
                                    delay: { "show": 50, "hide": 50 }
                                });
                        }
                    },
                    eventTimeFormat: { // like '14:30:00'
                        hour: company.time_format == 'H:i' ? '2-digit' : 'numeric',
                        minute: '2-digit',
                        meridiem: company.time_format == 'H:i' ? false : true
                    }
                });

                if (calendarEl != null) {
                    calendar.render();
                }


                $('.cal-filter').on('click', function() {

                    var filter = [];

                    $('.filter-check:checked').each(function() {
                        filter.push($(this).val());
                    });

                    if(filter.length < 1){
                        filter.push('None');
                    }

                    calendar.removeAllEventSources();
                    calendar.addEventSource({
                        url: "<?php echo e(route('dashboard.private_calendar')); ?>",
                        extraParams: {
                            filter: filter
                        }
                    });

                    filter = null;
                });

            })
        </script>
        <script>
            var initialLocaleCode = '<?php echo e(user()->locale); ?>';

            // Task Detail show in sidebar
            var getEventDetail = function(id,type) {
                if(type == 'ticket')
                {
                    var url = "<?php echo e(route('tickets.show', ':id')); ?>";
                        url = url.replace(':id', id);
                        window.location = url;
                        return true;
                }

                if(type == 'leave')
                {
                    return true;
                }

                openTaskDetail();

                switch (type) {
                    case 'task':
                        var url = "<?php echo e(route('tasks.show', ':id')); ?>";
                        break;
                    case 'event':
                        var url = "<?php echo e(route('events.show', ':id')); ?>";
                        break;
                    case 'holiday':
                        var url = "<?php echo e(route('holidays.show', ':id')); ?>";
                        break;
                    case 'leave':
                        var url = "<?php echo e(route('leaves.show', ':id')); ?>";
                        break;
                    default:
                        return 0;
                        break;
                }

                url = url.replace(':id', id);

                $.easyAjax({
                    url: url,
                    blockUI: true,
                    container: RIGHT_MODAL,
                    historyPush: true,
                    success: function(response) {
                        if (response.status == "success") {
                            $(RIGHT_MODAL_CONTENT).html(response.html);
                            $(RIGHT_MODAL_TITLE).html(response.title);
                        }
                    },
                    error: function(request, status, error) {
                        if (request.status == 403) {
                            $(RIGHT_MODAL_CONTENT).html(
                                '<div class="align-content-between d-flex justify-content-center mt-105 f-21">403 | Permission Denied</div>'
                            );
                        } else if (request.status == 404) {
                            $(RIGHT_MODAL_CONTENT).html(
                                '<div class="align-content-between d-flex justify-content-center mt-105 f-21">404 | Not Found</div>'
                            );
                        } else if (request.status == 500) {
                            $(RIGHT_MODAL_CONTENT).html(
                                '<div class="align-content-between d-flex justify-content-center mt-105 f-21">500 | Something Went Wrong</div>'
                            );
                        }
                    }
                });

            };

            // calendar filter
            var hideDropdown = false;

            $('#event-btn').click(function(){
                if(hideDropdown == true)
                {
                    $('#cal-drop').hide();
                    hideDropdown = false;
                }
                else
                {
                    $('#cal-drop').toggle();
                    hideDropdown = true;
                }
            });


            $(document).mouseup(e => {

                const $menu = $('.calendar-action');

                if (!$menu.is(e.target) && $menu.has(e.target).length === 0)
                {
                    hideDropdown = false;
                    $('#cal-drop').hide();
                }
            });

        </script>
    <?php endif; ?>

    <script>
        window.setInterval(function () {
            let date = new Date();
            $('#dashboard-clock').html(moment.tz(date, "<?php echo e(company()->timezone); ?>").format(MOMENTJS_TIME_FORMAT))
        }, 1000);

        $('#save-dashboard-widget').click(function() {
            $.easyAjax({
                url: "<?php echo e(route('dashboard.widget', 'private-dashboard')); ?>",
                container: '#privateDashboardWidgetForm',
                blockUI: true,
                type: "POST",
                redirect: true,
                data: $('#privateDashboardWidgetForm').serialize(),
                success: function() {
                    window.location.reload();
                }
            })
        });

        $('#clock-in').click(function() {
            const url = "<?php echo e(route('attendances.clock_in_modal')); ?>";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('.request-shift-change').click(function() {
            var id = $(this).data('shift-schedule-id');
            var date = $(this).data('shift-schedule-date');
            var shiftId = $(this).data('shift-id');
            var url = "<?php echo e(route('shifts-change.edit', ':id')); ?>?date="+date+"&shift_id="+shiftId;
            url = url.replace(':id', id);

            $(MODAL_DEFAULT + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_DEFAULT, url);
        });

        $('#view-shifts').click(function() {
            const url = "<?php echo e(route('employee-shifts.index')); ?>";
            $(MODAL_XL + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_XL, url);
        });

        <?php if(!is_null($currentClockIn)): ?>
            $('#clock-out').click(function() {

                var token = "<?php echo e(csrf_token()); ?>";
                var currentLatitude = document.getElementById("current-latitude").value;
                var currentLongitude = document.getElementById("current-longitude").value;

                $.easyAjax({
                    url: "<?php echo e(route('attendances.update_clock_in')); ?>",
                    type: "GET",
                    data: {
                        currentLatitude: currentLatitude,
                        currentLongitude: currentLongitude,
                        _token: token,
                        id: '<?php echo e($currentClockIn->id); ?>'
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.reload();
                        }
                    }
                });
            });
        <?php endif; ?>

        $('.keep-open .dropdown-menu').on({
            "click": function(e) {
                e.stopPropagation();
            }
        });

        $('#weekly-timelogs').on('click', '.week-timelog-day', function() {
            var date = $(this).data('date');

            $.easyAjax({
                url: "<?php echo e(route('dashboard.week_timelog')); ?>",
                container: '#weekly-timelogs',
                blockUI: true,
                type: "POST",
                redirect: true,
                data: {
                    'date': date,
                    '_token': "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    $('#weekly-timelogs').html(response.html)
                }
            })
        });


        <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                text: '<?php echo e(session('success')); ?>',

                toast: true,
                position: "top-end",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,

                customClass: {
                    confirmButton: "btn btn-primary",
                },
                showClass: {
                    popup: "swal2-noanimation",
                    backdrop: "swal2-noanimation",
                },
            });
        <?php endif; ?>
        <?php if(session('error')): ?>
            Swal.fire({
                icon: 'error',
                text: '<?php echo e(session('error')); ?>',

                toast: true,
                position: "top-end",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,

                customClass: {
                    confirmButton: "btn btn-primary",
                },
                showClass: {
                    popup: "swal2-noanimation",
                    backdrop: "swal2-noanimation",
                },
            });
        <?php endif; ?>
    </script>

    <?php if(attendance_setting()->radius_check == 'yes' || attendance_setting()->save_current_location): ?>
    <script>
        function setCurrentLocation() {
            const currentLatitude = document.getElementById("current-latitude");
            const currentLongitude = document.getElementById("current-longitude");

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                }
            }

            function showPosition(position) {
                currentLatitude.value = position.coords.latitude;
                currentLongitude.value = position.coords.longitude;
            }
            getLocation();

        }

        setCurrentLocation();
    </script>

    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/dashboard/employee/index.blade.php ENDPATH**/ ?>