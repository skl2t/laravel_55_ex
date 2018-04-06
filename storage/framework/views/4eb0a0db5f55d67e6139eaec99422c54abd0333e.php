<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td><?php echo e($user->id); ?></td>
		<td><?php echo e($user->name); ?></td>
		<td><?php echo e($user->email); ?></td>
		<td>
			<?php if($user->role === 'admin'): ?>
				Administrator
			<?php elseif($user->role === 'redac'): ?>
				Redactor
			<?php else: ?>
				User
			<?php endif; ?>
		</td>
		<td>
			<input type="checkbox" name="seen"
			       value="<?php echo e($user->id); ?>" <?php echo e(is_null($user->ingoing) ?  'disabled' : 'checked'); ?>>
		</td>
		<td>
			<span <?php echo $user->valid ? ' class="fa fa-check"' : ''; ?>></span>
		</td>
		<td>
			<span <?php echo $user->confirmed ? ' class="fa fa-check"' : ''; ?>></span>
		</td>
		<td><?php echo e($user->created_at->formatLocalized('%c')); ?></td>
		<td><a class="btn btn-warning btn-xs btn-block" href="<?php echo e(route('users.edit', [$user->id])); ?>" role="button"
		       title="<?php echo app('translator')->getFromJson('Edit'); ?>"><span class="fa fa-edit"></span></a></td>
		<td><a class="btn btn-danger btn-xs btn-block" href="<?php echo e(route('users.destroy', [$user->id])); ?>" role="button"
		       title="<?php echo app('translator')->getFromJson('Destroy'); ?>"><span class="fa fa-remove"></span></a></td>
	</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

