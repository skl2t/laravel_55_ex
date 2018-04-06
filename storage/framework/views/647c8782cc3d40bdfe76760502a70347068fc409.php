<?php if($paginator->hasPages()): ?>
	<nav class="pagination">
		
		<?php if($paginator->onFirstPage()): ?>
			<span class="page-numbers prev inactive"><?php echo app('translator')->getFromJson('pagination.previous'); ?></span>
		<?php else: ?>
			<a href="<?php echo e($paginator->previousPageUrl()); ?>" class="page-numbers prev"
			   rel="prev"><?php echo app('translator')->getFromJson('pagination.previous'); ?></a>
		<?php endif; ?>

		
		<?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
			<?php if(is_string($element)): ?>
				<span class="page-numbers current"><?php echo e($element); ?></span>
			<?php endif; ?>

			
			<?php if(is_array($element)): ?>
				<?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($page == $paginator->currentPage()): ?>
						<span class="page-numbers current"><?php echo e($page); ?></span>
					<?php else: ?>
						<a href="<?php echo e($url); ?>" class="page-numbers"><?php echo e($page); ?></a>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		
		<?php if($paginator->hasMorePages()): ?>
			<a href="<?php echo e($paginator->nextPageUrl()); ?>" class="page-numbers next" rel="next"><?php echo app('translator')->getFromJson('pagination.next'); ?></a>
		<?php else: ?>
			<span class="page-numbers next inactive"><?php echo app('translator')->getFromJson('pagination.next'); ?></span>
		<?php endif; ?>
	</nav>
<?php endif; ?>