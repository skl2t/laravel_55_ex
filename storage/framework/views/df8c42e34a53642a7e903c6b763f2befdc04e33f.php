<?php $__env->startSection('main'); ?>

	<!-- masonry
    ================================================== -->
	<section id="bricks">

		<div class="row masonry">
			<?php if(isset($info)): ?>
				<?php $__env->startComponent('front.components.alert'); ?>
					<?php $__env->slot('type'); ?>
						info
					<?php $__env->endSlot(); ?>
					<?php echo $info; ?>

				<?php echo $__env->renderComponent(); ?>
			<?php endif; ?>
			<?php if($errors->has('search')): ?>
				<?php $__env->startComponent('front.components.alert'); ?>
					<?php $__env->slot('type'); ?>
						error
				<?php $__env->endSlot(); ?>
				<?php echo e($errors->first('search')); ?>

			<?php echo $__env->renderComponent(); ?>
		<?php endif; ?>
		<!-- brick-wrapper -->
			<div class="bricks-wrapper">

				<div class="grid-sizer"></div>

				<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<?php echo $__env->make('front.brick-standard', compact('$post'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			</div>

		</div> <!-- end row -->

		<div class="row">

			<?php echo e($posts->links('front.pagination')); ?>


		</div>
	</section> <!-- end bricks -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>