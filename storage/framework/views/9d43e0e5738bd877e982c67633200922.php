<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <?php if(!empty($themeColor)): ?>
                                        <a href="<?php echo e($url); ?>" style="background-color: <?php echo e($themeColor); ?>;
                                        border-bottom: 8px solid <?php echo e($themeColor); ?>;
                                        border-left: 18px solid <?php echo e($themeColor); ?>;
                                        border-right: 18px solid <?php echo e($themeColor); ?>;
                                        border-top: 8px solid <?php echo e($themeColor); ?>;" class="button" target="_blank"><?php echo e($slot); ?></a>
                                    <?php else: ?>
                                        <a href="<?php echo e($url); ?>" class="button button-blue" target="_blank"><?php echo e($slot); ?></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/vendor/mail/html/button.blade.php ENDPATH**/ ?>