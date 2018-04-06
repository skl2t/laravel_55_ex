<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="box">
    <div class="box-body table-responsive">
        <table id="comments" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="15%"><?php echo app('translator')->getFromJson('Name'); ?></th>
                <th width="15%"><?php echo app('translator')->getFromJson('Email'); ?></th>
                <th width="35%"><?php echo app('translator')->getFromJson('Post'); ?></th>
                <th width="10%"><?php echo app('translator')->getFromJson('New'); ?></th>
                <th width="10%"><?php echo app('translator')->getFromJson('Valid'); ?></th>
                <th width="10%"><?php echo app('translator')->getFromJson('Creation'); ?></th>
                <th width="5%"></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo e($comment->user->name); ?></td>
                    <td><?php echo e($comment->user->email); ?></td>
                    <td>
                        <a href="<?php echo e(route('posts.display', [$comment->post->slug ])); ?>"><?php echo e($comment->post->title); ?></a>
                        <br><span class="badge"><?php echo e($comment->post->comments_count); ?></span>
                    </td>
                    <td>
                        <input type="checkbox" name="seen" value="<?php echo e($comment->id); ?>" <?php echo e(is_null($comment->ingoing) ?  'disabled' : 'checked'); ?>>
                    </td>
                    <td>
                        <input type="checkbox" name="uservalid" value="<?php echo e($comment->user->id); ?>" <?php echo e($comment->user->valid ?  'checked disabled' : ''); ?>>
                    </td>
                    <td><?php echo e($comment->created_at->formatLocalized('%c')); ?></td>
                    <td><a class="btn btn-danger btn-xs btn-block" href="<?php echo e(route('comments.destroy', [$comment->id])); ?>" role="button" title="<?php echo app('translator')->getFromJson('Destroy'); ?>"><span class="fa fa-remove"></span></a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    <div id="message" class="box-footer">
        <?php echo e($comment->body); ?>

    </div>
</div>
<!-- /.box -->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
