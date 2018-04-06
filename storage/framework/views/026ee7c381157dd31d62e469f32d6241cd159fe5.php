<li class="treeview">
	<a href="#"><i class="fa fa-fw fa-<?php echo e($icon); ?>"></i> <span><?php echo app('translator')->getFromJson('admin.menu.' . $type . 's'); ?></span>
		<span class="pull-right-container">
            <span class="fa fa-angle-left pull-right"></span>
        </span>
	</a>
	<ul class="treeview-menu">
		<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li><a href="<?php echo e($item['route']); ?>"><span class="fa fa-fw fa-circle-o text-<?php echo e($item['color']); ?>"></span>
					<span><?php echo app('translator')->getFromJson('admin.menu.' . $item['command']); ?></span></a></li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</li>