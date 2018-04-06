<article class="brick entry format-standard animate-this">

	<div class="entry-thumb">
		<a href="<?php echo e(url('posts/' . $post->slug)); ?>" class="thumb-link"><img src="/files/<?php echo e($post->image); ?>"></a>
	</div>

	<div class="entry-text">
		<div class="entry-header">
			<h1 class="entry-title"><a href="<?php echo e(url('posts/' . $post->slug)); ?>"><?php echo e($post->title); ?></a></h1>
		</div>
		<div class="entry-excerpt">
			<?php echo e($post->excerpt); ?>

		</div>
	</div>

</article>