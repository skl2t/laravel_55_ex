<li>
	<div class="avatar">
		<img width="50" height="50" class="avatar" src="<?php echo e(Gravatar::get($comment->user->email)); ?>" alt="">
	</div>

	<div class="comment-content">

		<div class="comment-info">
			<cite><?php echo e($comment->user->name); ?></cite>

			<?php if(Auth::check() && Auth::user()->name == $comment->user->name): ?>
				<a href="#" class="deletecomment"><span class="fa fa-fw fa-trash fa-lg  pull-right"
				                                        title="<?php echo app('translator')->getFromJson('Delete comment'); ?>"></span></a>
				<form action="<?php echo e(route('front.comments.destroy', [$comment->id])); ?>" method="POST" class="hide">
					<?php echo e(csrf_field()); ?>

					<?php echo e(method_field('DELETE')); ?>

				</form>
				<a id="comment-edit<?php echo $comment->id; ?>" href="#" class="editcomment"><span
							class="fa fa-fw fa-pencil fa-lg pull-right" title="<?php echo app('translator')->getFromJson('Edit comment'); ?>"></span></a>
			<?php endif; ?>

			<div class="comment-meta">
				<time class="comment-time"
				      datetime="<?php echo e($comment->created_at); ?>"><?php echo e(ucfirst (utf8_encode ($comment->created_at->formatLocalized('%A %d %B %Y')))); ?></time>
				<?php if(Auth::check() && $level < config('app.commentsNestedLevel')): ?>
					<span class="sep">/</span><a id="reply-create<?php echo $comment->id; ?>" class="reply"
					                             href="#"><?php echo app('translator')->getFromJson('Reply'); ?></a>
					<form id="reply-form<?php echo e($comment->id); ?>" method="post"
					      action="<?php echo e(route('posts.comments.comments.store', [$post->id, $comment->id])); ?>"
					      class="reply-form hide">
						<?php echo e(csrf_field()); ?>

						<div class="form-field">
							<strong class="red"></strong>
							<textarea name="message<?php echo e($comment->id); ?>" id="message<?php echo e($comment->id); ?>"
							          placeholder="<?php echo app('translator')->getFromJson('Your Reply'); ?>" class="full-width" required></textarea>
						</div>
						<button id="reply-escape<?php echo e($comment->id); ?>" class="btnescapereply"><?php echo app('translator')->getFromJson('Escape'); ?></button>
						<button type="submit" class="submit button-primary"><?php echo app('translator')->getFromJson('Submit'); ?></button>
					</form>
				<?php endif; ?>
			</div>
		</div>

		<div class="comment-text">
			<p id="comment-body<?php echo e($comment->id); ?>"><?php echo e($comment->body); ?></p>

			<?php if(Auth::check() && Auth::user()->name == $comment->user->name): ?>
				<form id="comment-form<?php echo e($comment->id); ?>" method="post"
				      action="<?php echo e(route('comments.update', [$comment->id])); ?>" class="comment-form hide">
					<?php echo e(csrf_field()); ?>

					<div class="form-field">
						<strong class="red"></strong>
						<textarea title="message" name="message<?php echo e($comment->id); ?>" id="message<?php echo e($comment->id); ?>"
						          class="full-width" required></textarea>
					</div>
					<button id="comment-escape<?php echo e($comment->id); ?>" class="btnescape"><?php echo app('translator')->getFromJson('Escape'); ?></button>
					<button type="submit" class="submit button-primary"><?php echo app('translator')->getFromJson('Submit'); ?></button>
				</form>
			<?php endif; ?>

		</div>

		<?php if (! ($comment->isLeaf())): ?>
			<?php
				$level++;
			?>
			<ul class="children">
				<?php echo $__env->make('front/comments/comments', ['comments' => $comment->getImmediateDescendants()], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</ul>
		<?php endif; ?>

	</div>
</li>
