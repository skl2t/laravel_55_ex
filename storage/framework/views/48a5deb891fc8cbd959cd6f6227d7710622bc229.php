<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($post->title); ?></td>
        <td><img src="../files/<?php echo e($post->image); ?>" alt="" width="200px" height="150"></td>
        <td>
            <input type="checkbox" name="status" value="<?php echo e($post->id); ?>" <?php echo e($post->active ? 'checked' : ''); ?>>
        </td>
        <td><?php echo e($post->created_at->formatLocalized('%c')); ?></td>
        <td>
            <input type="checkbox" name="seen" value="<?php echo e($post->id); ?>" <?php echo e(is_null($post->ingoing) ?  'disabled' : 'checked'); ?>>
        </td>
        <td><?php echo e($post->seo_title); ?></td>
        <td><a class="btn btn-success btn-xs btn-block" href="<?php echo e(route('posts.show', [$post->id])); ?>" role="button" title="<?php echo app('translator')->getFromJson('Show'); ?>"><span class="fa fa-eye"></span></a></td>
        <td><a class="btn btn-warning btn-xs btn-block" href="<?php echo e(route('posts.edit', [$post->id])); ?>" role="button" title="<?php echo app('translator')->getFromJson('Edit'); ?>"><span class="fa fa-edit"></span></a></td>
        <td><a class="btn btn-danger btn-xs btn-block" href="<?php echo e(route('posts.destroy', [$post->id])); ?>" role="button" title="<?php echo app('translator')->getFromJson('Destroy'); ?>"><span class="fa fa-remove"></span></a></td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

