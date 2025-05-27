<?php if($value == '0'): ?>
    <div class="text-lightest">0% <?php echo app('translator')->get('app.progress'); ?></div>
<?php else: ?>
    <div <?php echo e($attributes); ?>></div>
    <script>
        // Element inside which you want to see the chart
        var elementGauge = document.querySelector("#<?php echo e($attributes['id']); ?>")

        // Properties of the gauge
        var gaugeOptions = {
            hasNeedle: false,
            needleColor: 'gray',
            needleUpdateSpeed: 1000,
            arcColors: ['rgb(44, 177, 0)', 'rgb(232, 238, 243)'],
            arcDelimiters: [<?php echo e($value); ?>],
            rangeLabel: ['0', '100'],
            centralLabel: '<?php echo e($value); ?>%'
        }
        // Drawing and updating the chart
        GaugeChart.gaugeChart(elementGauge, <?php echo e($width); ?>, gaugeOptions).updateNeedle(50);

    </script>
<?php endif; ?>

  
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/gauge-chart.blade.php ENDPATH**/ ?>