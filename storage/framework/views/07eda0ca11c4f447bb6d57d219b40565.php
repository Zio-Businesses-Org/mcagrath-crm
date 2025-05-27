<?php if(in_array('birthday', $activeWidgets) && in_array('employees', user_modules())): ?>
    <!-- EMP DASHBOARD BIRTHDAY START -->
    <div class="col-sm-12">
        <?php if (isset($component)) { $__componentOriginalbc9540fa671f26a0f8028a5a8d8f93e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc9540fa671f26a0f8028a5a8d8f93e9 = $attributes; } ?>
<?php $component = App\View\Components\Cards\Data::resolve(['title' => __('modules.dashboard.birthday'),'padding' => 'false','otherClasses' => 'h-200'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\Data::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'e-d-info mb-2']); ?>
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
                <?php $__empty_1 = true; $__currentLoopData = $upcomingBirthdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upcomingBirthday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="pl-20">
                            <?php if (isset($component)) { $__componentOriginal9a71dc76dd25d4db3618f7b2896e958f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a71dc76dd25d4db3618f7b2896e958f = $attributes; } ?>
<?php $component = App\View\Components\Employee::resolve(['user' => $upcomingBirthday->user] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('employee'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Employee::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a71dc76dd25d4db3618f7b2896e958f)): ?>
<?php $attributes = $__attributesOriginal9a71dc76dd25d4db3618f7b2896e958f; ?>
<?php unset($__attributesOriginal9a71dc76dd25d4db3618f7b2896e958f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a71dc76dd25d4db3618f7b2896e958f)): ?>
<?php $component = $__componentOriginal9a71dc76dd25d4db3618f7b2896e958f; ?>
<?php unset($__componentOriginal9a71dc76dd25d4db3618f7b2896e958f); ?>
<?php endif; ?>
                        </td>
                        <td>
                            <span class="badge badge-light p-2">
                                <i class="fa fa-birthday-cake"></i>
                                <?php echo e($upcomingBirthday->date_of_birth->translatedFormat('d M')); ?>

                            </span>
                        </td>
                        <td class="pr-20" align="right">
                            <?php
                                $currentYear = now(company()->timezone)->year;
                                $year = $upcomingBirthday->date_of_birth->timezone(company()->timezone)->year(date('Y'));
                                $dateBirth = $upcomingBirthday->date_of_birth->format($currentYear . '-m-d');
                                $dateBirth = \Carbon\Carbon::parse($dateBirth);

                                $diffInDays = $year->copy()->diffForHumans(now()->timezone(company()->timezone),[
                                    'syntax' => \Carbon\CarbonInterface::DIFF_RELATIVE_AUTO,
                                    'options' => \Carbon\Carbon::JUST_NOW | \Carbon\Carbon::ONE_DAY_WORDS | \Carbon\Carbon::TWO_DAY_WORDS,
                                ]);

                            ?>

                            <?php if($dateBirth->isToday()): ?>
                                <span class="badge badge-light text-success p-2"><i class="fa fa-smile"></i> <?php echo app('translator')->get('app.today'); ?></span>
                            <?php else: ?>
                                <span class="badge badge-light p-2"><?php echo e($diffInDays); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="3" class="shadow-none">
                            <?php if (isset($component)) { $__componentOriginal269164c77d9d34462c34359c03da6a68 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269164c77d9d34462c34359c03da6a68 = $attributes; } ?>
<?php $component = App\View\Components\Cards\NoRecord::resolve(['icon' => 'birthday-cake','message' => __('messages.noRecordFound')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.no-record'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\NoRecord::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal269164c77d9d34462c34359c03da6a68)): ?>
<?php $attributes = $__attributesOriginal269164c77d9d34462c34359c03da6a68; ?>
<?php unset($__attributesOriginal269164c77d9d34462c34359c03da6a68); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal269164c77d9d34462c34359c03da6a68)): ?>
<?php $component = $__componentOriginal269164c77d9d34462c34359c03da6a68; ?>
<?php unset($__componentOriginal269164c77d9d34462c34359c03da6a68); ?>
<?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
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
    <!-- EMP DASHBOARD BIRTHDAY END -->
<?php endif; ?>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/dashboard/employee/widgets/birthday.blade.php ENDPATH**/ ?>