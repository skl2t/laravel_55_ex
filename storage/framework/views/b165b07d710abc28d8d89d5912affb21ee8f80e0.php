<!DOCTYPE html>
<!--[if IE 8 ]>
<html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>
<html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="<?php echo e(config('app.locale')); ?>"> <!--<![endif]-->
<head>

	<!--- basic page needs
	================================================== -->
	<meta charset="utf-8">
	<title><?php echo e(isset($post) && $post->seo_title ? $post->seo_title :  'hot news'); ?></title>
	<meta name="description"
	      content="<?php echo e(isset($post) && $post->meta_description ? $post->meta_description : __('description')); ?>">
	<meta name="author" content="<?php echo app('translator')->getFromJson(lcfirst ('Author')); ?>">
	<?php if(isset($post) && $post->meta_keywords): ?>
		<meta name="keywords" content="<?php echo e($post->meta_keywords); ?>">
	<?php endif; ?>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<!-- mobile specific metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
	================================================== -->
	<link rel="stylesheet" href="<?php echo e(asset('css/base.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('css/vendor.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">
	<?php echo $__env->yieldContent('css'); ?>

	<style>
		.search-wrap .search-form::after {
			content: "<?php echo app('translator')->getFromJson('Press Enter to begin your search.'); ?>";
		}
	</style>


	<!-- script
	================================================== -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>

	<!-- favicons
	================================================== -->
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body id="top">

<!-- header
================================================== -->
<header class="short-header">

	<div class="gradient-block"></div>

	<div class="row header-content">

		<div class="logo">
			<a href="<?php echo e(url('')); ?>">Author</a>
		</div>

		<nav id="main-nav-wrap">
			<ul class="main-navigation sf-menu">
				<li <?php echo e(currentRoute('home')); ?>>
					<a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->getFromJson('Home'); ?></a>
				</li>
				<li class="has-children">
					<a href="#"><?php echo app('translator')->getFromJson('Categories'); ?></a>
					<ul class="sub-menu">
						<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><a href="<?php echo e(route('category', [$category->slug ])); ?>"><?php echo e($category->title); ?></a></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</li>
				<?php if(auth()->guard()->guest()): ?>
					<li <?php echo e(currentRoute('contacts.create')); ?>>
						<a href="<?php echo e(route('contacts.create')); ?>"><?php echo app('translator')->getFromJson('Contact'); ?></a>
					</li>
				<?php endif; ?>
				<?php if (\Illuminate\Support\Facades\Blade::check('request', 'register')): ?>
				<li class="current">
					<a href="<?php echo e(request()->url()); ?>"><?php echo app('translator')->getFromJson('Register'); ?></a>
				</li>
				<?php endif; ?>
				<?php if (\Illuminate\Support\Facades\Blade::check('request', 'password/email')): ?>
				<li class="current">
					<a href="<?php echo e(request()->url()); ?>"><?php echo app('translator')->getFromJson('Forgotten password'); ?></a>
				</li>
				<?php else: ?>
					<?php if(auth()->guard()->guest()): ?>
						<li <?php echo e(currentRoute('login')); ?>>
							<a href="<?php echo e(route('login')); ?>"><?php echo app('translator')->getFromJson('Login'); ?></a>
						</li>
						<?php if (\Illuminate\Support\Facades\Blade::check('request', 'password/reset')): ?>
						<li class="current">
							<a href="<?php echo e(request()->url()); ?>"><?php echo app('translator')->getFromJson('Password'); ?></a>
						</li>
						<?php endif; ?>
						<?php if (\Illuminate\Support\Facades\Blade::check('request', 'password/reset/*')): ?>
						<li class="current">
							<a href="<?php echo e(request()->url()); ?>"><?php echo app('translator')->getFromJson('Password'); ?></a>
						</li>
						<?php endif; ?>
					<?php else: ?>
						<?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
						<li>
							<a href="<?php echo e(url('admin')); ?>"><?php echo app('translator')->getFromJson('Administration'); ?></a>
						</li>
						<?php endif; ?>
						<?php if (\Illuminate\Support\Facades\Blade::check('redac')): ?>
						<li>
							<a href="<?php echo e(url('admin/posts')); ?>"><?php echo app('translator')->getFromJson('Administration'); ?></a>
						</li>
						<?php endif; ?>
						<li>
							<a id="logout" href="<?php echo e(route('logout')); ?>"><?php echo app('translator')->getFromJson('Logout'); ?></a>
							<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="hide">
								<?php echo e(csrf_field()); ?>

							</form>
						</li>
					<?php endif; ?>
					<?php endif; ?>
			</ul>
		</nav> <!-- end main-nav-wrap -->

		<div class="search-wrap">
			<form role="search" method="get" class="search-form" action="<?php echo e(route('posts.search')); ?>">
				<label>
					<input type="search" class="search-field" placeholder="<?php echo app('translator')->getFromJson('Type Your Keywords'); ?>" name="search"
					       autocomplete="off" required>
				</label>
				<input type="submit" class="search-submit" value="">
			</form>

			<a href="#" id="close-search" class="close-btn">Close</a>

		</div> <!-- end search wrap -->

		<div class="triggers">
			<a class="search-trigger" href="#"><i class="fa fa-search"></i></a>
			<a class="menu-toggle" href="#"><span>Menu</span></a>
		</div> <!-- end triggers -->

	</div>

</header> <!-- end header -->

<?php echo $__env->yieldContent('main'); ?>

<!-- footer
   ================================================== -->
<footer>

	<div class="footer-main">

		<div class="row">

			<div class="col-six tab-full mob-full footer-info">

				<h4><?php echo app('translator')->getFromJson('About Our Site'); ?></h4>

				<p><?php echo app('translator')->getFromJson('Lorem ipsum Ut velit dolor Ut labore id fugiat in ut fugiat nostrud qui in dolore commodo eu magna Duis cillum dolor officia esse mollit proident Excepteur exercitation nulla. Lorem ipsum In reprehenderit commodo aliqua irure labore.'); ?></p>

			</div> <!-- end footer-info -->

			<div class="col-three tab-1-2 mob-1-2 site-links">

				<h4><?php echo app('translator')->getFromJson('Site Links'); ?></h4>

				<ul>
					<li><a href="#"><?php echo app('translator')->getFromJson('About us'); ?></a></li>
					<li><a href="<?php echo e(url('')); ?>"><?php echo app('translator')->getFromJson('Blog'); ?></a></li>
					<li><a href="<?php echo e(route('contacts.create')); ?>"><?php echo app('translator')->getFromJson('Contact'); ?></a></li>
					<li><a href="#"><?php echo app('translator')->getFromJson('Privacy Policy'); ?></a></li>
				</ul>

			</div> <!-- end site-links -->

			<div class="col-three tab-1-2 mob-1-2 social-links">

				<h4><?php echo app('translator')->getFromJson('Social'); ?></h4>

				<ul>
					<li><a href="#">Twitter</a></li>
					<li><a href="#">Facebook</a></li>
					<li><a href="#">Dribbble</a></li>
					<li><a href="#">Google+</a></li>
					<li><a href="#">Instagram</a></li>
				</ul>

			</div> <!-- end social links -->

		</div> <!-- end row -->

	</div> <!-- end footer-main -->

	<div class="footer-bottom">
		<div class="row">

			<div class="col-twelve">
				<div class="copyright">
					<span>© Copyright Abstract 2016</span>
					<span>Design by <a href="http://www.styleshout.com/">styleshout</a></span>
				</div>

				<div id="go-top">
					<a class="smoothscroll" title="Back to Top" href="#top"><i class="icon icon-arrow-up"></i></a>
				</div>
			</div>

		</div>
	</div> <!-- end footer-bottom -->

</footer>

<div id="preloader">
	<div id="loader"></div>
</div>

<!-- Java Script
================================================== -->
<script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
<script src="<?php echo e(asset('js/plugins.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
<script>
	$(function () {
		$('#logout').click(function (e) {
			e.preventDefault();
			$('#logout-form').submit()
		})
	})
</script>

<?php echo $__env->yieldContent('scripts'); ?>

</body>

</html>
