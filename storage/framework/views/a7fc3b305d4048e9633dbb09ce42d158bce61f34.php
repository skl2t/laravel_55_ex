<div class="col-lg-3 col-xs-6">
	<!-- small box -->
	<div class="small-box bg-<?php echo e($pannel->color); ?>">
		<div class="inner">
			<h3><?php echo e($pannel->nbr); ?></h3>

			<p><?php echo e($pannel->name); ?></p>
		</div>
		<div class="icon">
			<span class="fa fa-<?php echo e($pannel->icon); ?>"></span>
		</div>
		<a href="<?php echo e($pannel->url); ?>" class="small-box-footer">
			<?php echo app('translator')->getFromJson('More info'); ?> <span class="fa fa-arrow-circle-right"></span>
		</a>
	</div>
</div>