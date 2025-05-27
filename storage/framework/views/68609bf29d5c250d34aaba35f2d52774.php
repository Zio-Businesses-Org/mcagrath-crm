<div <?php echo e($attributes); ?>></div>
<script>
    var data = {
        labels: [
            <?php $__currentLoopData = $chartData['labels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                "<?php echo e($label); ?>",
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
        datasets: [
            <?php $__currentLoopData = $chartData['datasets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            {
            name: "<?php echo e($dataset['name']); ?>",
            values: [
                <?php $__currentLoopData = $dataset['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($value); ?>,
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ],
            chartType: 'bar'
            },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
        yMarkers: [{ label: "", value: <?php echo e($chartData['threshold'] ?? 0); ?>, options: { labelPos: 'left' } }]
    }

    var chart = new frappe.Chart("#<?php echo e($attributes['id']); ?>", { // or a DOM element,
        data: data,
        type: 'bar', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
        height: <?php echo e($attributes['height']); ?>,
        barOptions: {
            stacked: true,
            spaceRatio: 0.2 
        },
        valuesOverPoints: 1,
        axisOptions: {
            yAxisMode: 'tick',
            xAxisMode: 'tick',
            xIsSeries: 0
        },
        colors: [
            <?php $__currentLoopData = $chartData['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                "<?php echo e($color); ?>",
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ]
    });
</script>



<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/stacked-chart.blade.php ENDPATH**/ ?>