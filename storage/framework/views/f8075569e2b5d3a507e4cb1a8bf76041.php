<?php
$valuesTotal = array_sum($values);
?>

<?php if($valuesTotal > 0): ?>
<div class="m-auto" style="height: <?php echo e($attributes['height']); ?>px; width: <?php echo e($attributes['width']); ?>px">
    <canvas <?php echo e($attributes); ?>></canvas>
</div>
<script>
var ctx = document.getElementById("<?php echo e($attributes['id']); ?>");

var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
  labels: [
    <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        "<?php echo e($label); ?>",
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  ],
  datasets: [
    {
      label: 'Dataset 1',
      data: [
        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($value); ?>,
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      ],
        backgroundColor: [
            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                "<?php echo e($color); ?>",
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
    }
  ]
},
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'right',
      },
      title: {
        display: false,
        text: 'Chart.js Pie Chart'
      }
    }
  },
});
</script>
<?php else: ?>
    <div class="text-center text-lightest p-20"
        style="height: <?php echo e($attributes['height']); ?>px">

        <i class="side-icon f-21 bi bi-pie-chart"></i>
        <div class="f-15 mt-4">
            - <?php echo app('translator')->get('messages.notEnoughData'); ?> -
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/components/pie-chart.blade.php ENDPATH**/ ?>