<h1><?php echo e(__('errors.error-' . $number)); ?></h1>
<p class="lead"><?php echo e(__('errors.error-' . $number . '-info')); ?></p>
<?php if($number != '503'): ?>
	<p class="lead">
		<a href="<?php echo e(url('/')); ?>" class="btn btn-default"><?php echo e(__('Home')); ?></a>
	</p>
<?php endif; ?>