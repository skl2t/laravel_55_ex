<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('errors.partial', ['number' => '403'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('errors.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>