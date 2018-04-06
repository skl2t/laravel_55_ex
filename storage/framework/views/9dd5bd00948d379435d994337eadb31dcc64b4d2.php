<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <?php if(session('user-updated')): ?>
                <?php $__env->startComponent('back.components.alert'); ?>
                    <?php $__env->slot('type'); ?>
                        success
                    <?php $__env->endSlot(); ?>
                    <?php echo session('user-updated'); ?>

                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" method="POST" action="<?php echo e(route('users.update', [$user->id])); ?>">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(method_field('PUT')); ?>

                    <div class="box-body">
                        <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                            <label for="name"><?php echo app('translator')->getFromJson('Name'); ?></label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>" required>
                            <?php echo $errors->first('name', '<small class="help-block">:message</small>'); ?>

                        </div>
                        <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                            <label for="email"><?php echo app('translator')->getFromJson('Email'); ?></label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required>
                            <?php echo $errors->first('email', '<small class="help-block">:message</small>'); ?>

                        </div>
                        <div class="form-group">
                            <label for="role"><?php echo app('translator')->getFromJson('Role'); ?></label>
                            <select class="form-control" name="role" id="role">
                                <option value="admin" <?php echo e(old('role', $user->role) === 'admin' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('Administrator'); ?></option>
                                <option value="redac" <?php echo e(old('role', $user->role) === 'redac' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('Redactor'); ?></option>
                                <option value="user" <?php echo e(old('role', $user->role) === 'user' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('User'); ?></option>
                            </select>
                        </div>
                        <?php if($user->ingoing): ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="new" checked> <?php echo app('translator')->getFromJson('New'); ?>
                                </label>
                            </div>
                        <?php endif; ?>
                        <?php if($user->confirmed): ?>
                            <p><span class="badge bg-green"><?php echo app('translator')->getFromJson('Confirmed'); ?></span></p>
                        <?php else: ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="confirmed" <?php echo e(old('confirmed') ? 'checked' : ''); ?>> <?php echo app('translator')->getFromJson('Confirmed'); ?>
                                </label>
                            </div>
                        <?php endif; ?>
                        <?php if($user->valid): ?>
                            <p><span class="badge bg-green"><?php echo app('translator')->getFromJson('Valid'); ?></span></p>
                        <?php else: ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="valid" <?php echo e(old('valid') ? 'checked' : ''); ?>> <?php echo app('translator')->getFromJson('Valid'); ?>
                                </label>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('Submit'); ?></button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>