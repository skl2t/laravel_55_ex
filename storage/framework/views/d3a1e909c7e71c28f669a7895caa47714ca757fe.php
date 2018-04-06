<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('Post'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Author'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Date'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Valid'); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('Post'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Author'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Date'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Valid'); ?></th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                            <?php $__currentLoopData = $user->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php $user = user($notification->data['user_id']) ?>
                                    <td><a href="<?php echo e(route('posts.display', [$notification->data['slug']])); ?>"><?php echo e($notification->data['title']); ?></a></td>
                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($notification->created_at->formatLocalized('%c')); ?></td>
                                    <td><input type="checkbox" name="valid" <?php echo e($user->valid ? 'checked' : ''); ?> disabled></td>
                                    <td>
                                        <form action="<?php echo e(route('notifications.update', [$notification->id])); ?>" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                            <?php echo e(method_field('PUT')); ?>

                                            <input type="submit" class="btn btn-success btn-xs btn-block" value="<?php echo app('translator')->getFromJson('Mark as read'); ?>">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>