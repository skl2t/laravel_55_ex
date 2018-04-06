<?php $__env->startSection('main'); ?>
	<?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
	<div class="row">
		<?php echo $__env->renderEach('back/partials/pannel', $pannels, 'pannel'); ?>
	</div>
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>