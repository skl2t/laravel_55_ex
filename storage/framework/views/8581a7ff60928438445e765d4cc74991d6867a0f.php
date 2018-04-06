<?php $__env->startSection('form-open'); ?>
    <form method="post" action="<?php echo e(route('categories.update', [$category->id])); ?>">
        <?php echo e(method_field('PUT')); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('back.categories.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>