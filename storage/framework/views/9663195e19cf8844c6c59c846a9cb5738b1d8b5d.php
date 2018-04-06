<?php $__env->startSection('main'); ?>
	<section id="content-wrap">
		<div class="row">
			<div class="col-twelve">
				<div class="primary-content">
					<?php if(session('confirmation-success')): ?>
						<?php $__env->startComponent('front.components.alert'); ?>
							<?php $__env->slot('type'); ?>
								success
							<?php $__env->endSlot(); ?>
							<?php echo session('confirmation-success'); ?>

						<?php echo $__env->renderComponent(); ?>
					<?php endif; ?>
					<?php if(session('confirmation-danger')): ?>
						<?php $__env->startComponent('front.components.alert'); ?>
							<?php $__env->slot('type'); ?>
								error
							<?php $__env->endSlot(); ?>
							<?php echo session('confirmation-danger'); ?>

						<?php echo $__env->renderComponent(); ?>
					<?php endif; ?>
					<h3><?php echo app('translator')->getFromJson('Login'); ?></h3>
					<form role="form" method="POST" action="<?php echo e(route('login')); ?>">
						<?php echo e(csrf_field()); ?>

						<?php if($errors->has('log')): ?>
							<?php $__env->startComponent('front.components.error'); ?>
								<?php echo e($errors->first('log')); ?>

							<?php echo $__env->renderComponent(); ?>
						<?php endif; ?>
						<input id="log" type="text" placeholder="<?php echo app('translator')->getFromJson('Login'); ?>" class="full-width" name="log"
						       value="<?php echo e(old('log')); ?>" required autofocus>
						<input id="password" type="password" placeholder="<?php echo app('translator')->getFromJson('Password'); ?>" class="full-width"
						       name="password" required>
						<label class="add-bottom">
							<input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
							<span class="label-text"><?php echo app('translator')->getFromJson('Remember me'); ?></span>
						</label>
						<input class="button-primary full-width-on-mobile" type="submit" value="<?php echo app('translator')->getFromJson('Login'); ?>">
						<label class="add-bottom">
							<a href="<?php echo e(route('password.request')); ?>">
								<?php echo app('translator')->getFromJson('Forgot Your Password?'); ?>
							</a><br>
							<a href="<?php echo e(route('register')); ?>">
								<?php echo app('translator')->getFromJson('Not registered?'); ?>
							</a>
						</label>
					</form>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>