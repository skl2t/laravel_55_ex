<?php $__env->startSection('form-open'); ?>
    <form method="post" action="<?php echo e(route('posts.store')); ?>">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.posts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>