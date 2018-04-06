<?php $__env->startSection('main'); ?>
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="<?php echo route('elfinder.index'); ?>"></iframe>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>