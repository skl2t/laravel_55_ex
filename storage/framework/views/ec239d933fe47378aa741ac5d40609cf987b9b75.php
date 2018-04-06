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
                    <h3><?php echo app('translator')->getFromJson('Register'); ?></h3>
                    <form role="form" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <?php if($errors->has('name')): ?>
                            <?php $__env->startComponent('front.components.error'); ?>
                                <?php echo e($errors->first('name')); ?>

                            <?php echo $__env->renderComponent(); ?>
                        <?php endif; ?> 
                        <input id="name" placeholder="<?php echo app('translator')->getFromJson('Name'); ?>" type="text" class="full-width"  name="name" value="<?php echo e(old('name')); ?>" required autofocus>
                        <?php if($errors->has('email')): ?>
                            <?php $__env->startComponent('front.components.error'); ?>
                                <?php echo e($errors->first('email')); ?>

                            <?php echo $__env->renderComponent(); ?>
                        <?php endif; ?>                       
                        <input id="email" placeholder="<?php echo app('translator')->getFromJson('Email'); ?>" type="email" class="full-width"  name="email" value="<?php echo e(old('email')); ?>" required>
                        <?php if($errors->has('password')): ?>
                            <?php $__env->startComponent('front.components.error'); ?>
                                <?php echo e($errors->first('password')); ?>

                            <?php echo $__env->renderComponent(); ?>
                        <?php endif; ?> 
                        <input id="password" placeholder="<?php echo app('translator')->getFromJson('Password'); ?>" type="password" class="full-width"  name="password" required>
                        <input id="password-confirm" placeholder="<?php echo app('translator')->getFromJson('Confirm your password'); ?>" type="password" class="full-width" name="password_confirmation" required>
                        <input class="button-primary full-width-on-mobile" type="submit" value="<?php echo app('translator')->getFromJson('Register'); ?>">
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>