<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($category->id); ?></td>
        <td><?php echo e($category->title); ?></td>
        <td><?php echo e($category->slug); ?></td>
        <td><?php echo e($category->posts_count); ?></td>
        <td><a class="btn btn-warning btn-xs btn-block" href="<?php echo e(route('categories.edit', [$category->id])); ?>" role="button" title="<?php echo app('translator')->getFromJson('Edit'); ?>"><span class="fa fa-edit"></span></a></td>
        <td><a class="btn btn-danger btn-xs btn-block" href="<?php echo e(route('categories.destroy', [$category->id])); ?>" role="button" title="<?php echo app('translator')->getFromJson('Destroy'); ?>"><span class="fa fa-remove"></span></a></td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

