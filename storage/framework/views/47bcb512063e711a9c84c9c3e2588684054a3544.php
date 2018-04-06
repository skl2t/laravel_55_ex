<?php $__env->startSection('css'); ?>
	<?php if(Auth::check()): ?>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

	<!-- content
   ================================================== -->
	<section id="content-wrap" class="blog-single">
		<div class="row">
			<div class="col-twelve">

				<article class="format-standard">

					<div class="content-media">
						<div class="post-thumb">
							<img src="/files/<?php echo e($post->image); ?>">
						</div>
					</div>

					<div class="primary-content">

						<h1 class="page-title"><?php echo e($post->title); ?></h1>

						<ul class="entry-meta">
							<li class="date"><?php echo e(ucfirst (utf8_encode ($post->created_at->formatLocalized('%A %d %B %Y')))); ?></li>
							<li class="cat">
								<?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<a href="<?php echo e(route('category', [$category->slug])); ?>"><?php echo e($category->title); ?></a>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</li>
						</ul>

					<?php echo $post->body; ?>


					<!-- Tags -->
						<?php if($post->tags->count()): ?>
							<p class="tags">
								<span><?php echo app('translator')->getFromJson('Tagged in'); ?> :</span>
								<?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<a href="<?php echo e(route('posts.tag', [$tag->id])); ?>"><?php echo e($tag->tag); ?></a>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</p>
						<?php endif; ?>

						<div class="author-profile">
							<img src="<?php echo e(Gravatar::get($post->user->email)); ?>" alt="">
							<div class="about">
								<h4><?php echo e($post->user->name); ?></h4>
							</div>
						</div> <!-- end author-profile -->

					</div> <!-- end entry-primary -->

					<div class="pagenav group">
						<?php if($post->previous): ?>
							<div class="prev-nav">
								<a href="<?php echo e(url('posts/' . $post->previous->slug)); ?>" rel="prev">
									<span><?php echo app('translator')->getFromJson('Previous'); ?></span>
									<?php echo e($post->previous->title); ?>

								</a>
							</div>
						<?php endif; ?>
						<?php if($post->next): ?>
							<div class="next-nav">
								<a href="<?php echo e(url('posts/' . $post->next->slug)); ?>" rel="next">
									<span><?php echo app('translator')->getFromJson('Next'); ?></span>
									<?php echo e($post->next->title); ?>

								</a>
							</div>
						<?php endif; ?>
					</div>

				</article>

			</div> <!-- end col-twelve -->
		</div> <!-- end row -->

		<div class="comments-wrap">
			<div id="comments" class="row">
				<?php if(session('warning')): ?>
					<?php $__env->startComponent('front.components.alert'); ?>
						<?php $__env->slot('type'); ?>
							notice
						<?php $__env->endSlot(); ?>
						<?php echo session('warning'); ?>

					<?php echo $__env->renderComponent(); ?>
				<?php endif; ?>
				<h3><?php echo e($post->valid_comments_count); ?> <?php echo e(trans_choice(__('comment|comments'), $post->valid_comments_count)); ?></h3>

				<!-- commentlist -->
				<?php if($post->valid_comments_count): ?>
					<?php
						$level = 0;
					?>
					<ol class="commentlist">
						<?php echo $__env->make('front/comments/comments', ['comments' => $post->parentComments], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</ol>
					<?php if($post->parent_comments_count > config('app.numberParentComments')): ?>
						<p id="morebutton" class="text-center">
							<a id="nextcomments" href="<?php echo e(route('posts.comments', [$post->id, 1])); ?>"
							   class="button"><?php echo app('translator')->getFromJson('More comments'); ?></a>
						</p>
						<p id="moreicon" class="text-center hide">
							<span class="fa fa-spinner fa-pulse fa-3x fa-fw"></span>
						</p>
				<?php endif; ?>
			<?php endif; ?>

			<!-- respond -->
				<div class="respond">

					<h3><?php echo app('translator')->getFromJson('Leave a Comment'); ?></h3>
					<?php if(Auth::check()): ?>
						<form method="post" action="<?php echo e(route('posts.comments.store', [$post->id])); ?>">
							<?php echo e(csrf_field()); ?>

							<div class="message form-field">
								<?php if($errors->has('message')): ?>
									<?php $__env->startComponent('front.components.error'); ?>
										<?php echo e($errors->first('message')); ?>

									<?php echo $__env->renderComponent(); ?>
								<?php endif; ?>
								<textarea name="message" id="message" class="full-width"
								          placeholder="<?php echo app('translator')->getFromJson('Your message'); ?>" value="<?php echo e(old('message')); ?>"
								          required></textarea>
							</div>
							<button type="submit" class="submit button-primary"><?php echo app('translator')->getFromJson('Submit'); ?></button>
						</form>
					<?php else: ?>
						<em><?php echo app('translator')->getFromJson('You must be logged to add a comment !'); ?></em>
					<?php endif; ?>

				</div> <!-- Respond End -->

			</div> <!-- end row comments -->
		</div> <!-- end comments-wrap -->

	</section> <!-- end content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	<?php if(auth()->check()): ?>
		<script src="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.js"></script>
		<script>

					var post = (function () {

						var onReady = function () {
							$('body').on('click', 'a.deletecomment', deleteComment)
								.on('click', 'a.editcomment', editComment)
								.on('click', '.btnescape', escapeComment)
								.on('submit', '.comment-form', submitComment)
								.on('click', 'a.reply', replyCreation)
								.on('click', '.btnescapereply', escapeReply)
								.on('submit', '.reply-form', submitReply)
						};

						var toggleEditControls = function (id) {
							$('#comment-edit' + id).toggle();
							$('#comment-body' + id).toggle('slow');
							$('#comment-form' + id).toggle('slow');
						};

						// Delete comment
						var deleteComment = function (event) {
							event.preventDefault();
							var that = $(this);
							swal({
								title: "<?php echo __('Really delete this comment ?'); ?>",
								type: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#DD6B55',
								confirmButtonText: "<?php echo __('Yes'); ?>",
								cancelButtonText: "<?php echo __('No'); ?>"
							}).then(function () {
								that.next('form').submit();
							})
						};

						// Set comment edition
						var editComment = function (event) {
							event.preventDefault();
							var i = $(this).attr('id').substring(12);
							$('form.comment-form textarea#message' + i).val($('#comment-body' + i).text());
							toggleEditControls(i);
						};

						// Escape comment edition
						var escapeComment = function (event) {
							event.preventDefault();
							var i = $(this).attr('id').substring(14);
							toggleEditControls(i);
							$('form.comment-form textarea#message' + i).prev().text('');
						};

						// Submit comment
						var submitComment = function (event) {
							event.preventDefault();
							$.ajax({
								method: 'put',
								url: $(this).attr('action'),
								data: $(this).serialize()
							})
								.done(function (data) {
									$('#comment-body' + data.id).text(data.message);
									toggleEditControls(data.id);
								})
								.fail(function (data) {
									var errors = data.responseJSON;
									$.each(errors, function (index, value) {
										value = value[0].replace(index, '<?php echo app('translator')->getFromJson('message'); ?>');
										$('form.comment-form textarea[name="' + index + '"]').prev().text(value);
									});
								});
						};

						// Set reply creation
						var replyCreation = function (event) {
							event.preventDefault();
							var i = $(this).attr('id').substring(12);
							$('form.reply-form textarea#message' + i).val('');
							$('#reply-form' + i).toggle('slow');
						};

						// Escape reply creation
						var escapeReply = function (event) {
							event.preventDefault();
							var i = $(this).attr('id').substring(12);
							$('#reply-form' + i).toggle('slow');
						};

						// Submit reply
						var submitReply = function (event) {
							event.preventDefault();
							$.ajax({
								method: 'post',
								url: $(this).attr('action'),
								data: $(this).serialize()
							})
								.done(function (data) {
									document.location.reload(true);
								})
								.fail(function (data) {
									var errors = data.responseJSON;
									$.each(errors, function (index, value) {
										value = value[0].replace(index, '<?php echo app('translator')->getFromJson('message'); ?>');
										$('form.reply-form textarea[name="' + index + '"]').prev().text(value);
									});
								});
						};

						return {
							onReady: onReady
						}

					})();

					$(document).ready(post.onReady)

		</script>
	<?php endif; ?>

	<script>
			$(function () {
				// Get next comments
				$('#nextcomments').click(function (event) {
					event.preventDefault();
					$('#morebutton').hide();
					$('#moreicon').show();
					$.get($(this).attr('href'))
						.done(function (data) {
							$('ol.commentlist').append(data.html);
							if (data.href !== 'none') {
								$('#nextcomments').attr('href', data.href);
								$('#morebutton').show();
							}
							$('#moreicon').hide();
						})
				})
			})
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>