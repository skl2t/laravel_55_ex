<?php $__env->startSection('main'); ?>
   <section id="content-wrap">
        <div class="row">
            <div class="col-twelve">
                <div class="primary-content">
                    <?php if(session('status')): ?>
                        <?php $__env->startComponent('front.components.alert'); ?>
                            <?php $__env->slot('type'); ?>
                                success
                            <?php $__env->endSlot(); ?>
                            <p><?php echo e(session('status')); ?></p>
                        <?php echo $__env->renderComponent(); ?>
                    <?php endif; ?>
                    <div class="alert-box ss-notice hideit">
                        <p><?php echo app('translator')->getFromJson('You have forgotten your password, dont mind ! You can create a new one. But for your own security we want to be sure of your identity. So send us your email by filling this form. You will get a message with instruction to create your new password.'); ?></p>
                        <i class="fa fa-times close"></i>
                    </div>
                    <h3><?php echo app('translator')->getFromJson('Reset Password'); ?></h3>
                    <form role="form" method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <?php if($errors->has('email')): ?>
                            <?php $__env->startComponent('front.components.error'); ?>
                                <?php echo e($errors->first('email')); ?>

                            <?php echo $__env->renderComponent(); ?>
                        <?php endif; ?>   
                        <input id="email" type="email" placeholder="<?php echo app('translator')->getFromJson('Email'); ?>" class="full-width" name="email" value="<?php echo e(old('email')); ?>" required>
                        <input class="button-primary full-width-on-mobile" type="submit" value="<?php echo app('translator')->getFromJson('Send Password Reset Link'); ?>">
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>