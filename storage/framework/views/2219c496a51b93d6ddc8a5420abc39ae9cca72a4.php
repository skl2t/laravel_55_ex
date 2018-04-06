<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<title><?php echo app('translator')->getFromJson('Administration'); ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo e(asset('adminlte/css/AdminLTE.min.css')); ?>">
	<!-- AdminLTE Skins. -->
	<link rel="stylesheet" href="<?php echo e(asset('adminlte/css/skins/skin-blue.min.css')); ?>">

<?php echo $__env->yieldContent('css'); ?>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="<?php echo e(route('admin')); ?>" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b><span class="fa fa-fw fa-dashboard"></span></b></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b><?php echo app('translator')->getFromJson('Dashboard'); ?></b></span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

				<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<img src="../../files/<?php echo e(auth()->user()->profile_img); ?>" class="user-image" alt="User Image">
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs"><?php echo e(auth()->user()->name); ?></span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								<img src="../../files/<?php echo e(auth()->user()->profile_img); ?>" class="img-circle" alt="User Image">
								<p><?php echo e(auth()->user()->name); ?></p>
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a id="profile" href="<?php echo e(route('admin.profile', [auth()->user()->id])); ?>" class="btn btn-default btn-flat"><?php echo app('translator')->getFromJson('Profile'); ?></a>
								</div>
								<div class="pull-right">
									<a id="logout" href="#" class="btn btn-default btn-flat"><?php echo app('translator')->getFromJson('Sign out'); ?></a>
									<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="hide">
										<?php echo e(csrf_field()); ?>

									</form>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<section class="sidebar">
			<!-- Sidebar Menu -->
			<ul class="sidebar-menu">
				<!-- Optionally, you can add icons to the links -->
				<li <?php echo e(currentRouteBootstrap('admin')); ?>>
					<a href="<?php echo e(route('admin')); ?>"><i class="fa fa-fw fa-dashboard"></i> <span><?php echo app('translator')->getFromJson('Dashboard'); ?></span></a>
				</li>
				<?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>

				<?php echo $__env->make('back.partials.treeview', [
				  'icon' => 'user',
				  'type' => 'user',
				  'items' => [
					[
					  'route' => route('users.index'),
					  'command' => 'list',
					  'color' => 'blue',
					],
					[
					  'route' => route('users.index', ['new' => 'on']),
					  'command' => 'new',
					  'color' => 'yellow',
					],
				  ]
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<?php echo $__env->make('back.partials.treeview', [
				  'icon' => 'envelope',
				  'type' => 'contact',
				  'items' => [
					[
					  'route' => route('contacts.index'),
					  'command' => 'list',
					  'color' => 'blue',
					],
					[
					  'route' => route('contacts.index', ['new' => 'on']),
					  'command' => 'new',
					  'color' => 'yellow',
					],
				  ]
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<?php echo $__env->make('back.partials.treeview', [
				  'icon' => 'comment',
				  'type' => 'comment',
				  'items' => [
					[
					  'route' => route('comments.index'),
					  'command' => 'list',
					  'color' => 'blue',
					],
					[
					  'route' => route('comments.index', ['new' => 'on']),
					  'command' => 'new',
					  'color' => 'yellow',
					],
				  ]
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<li><a href="<?php echo e(route('categories.index')); ?>"><i class="fa fa-list"></i> <span><?php echo app('translator')->getFromJson('Categories'); ?></span></a></li>

				<?php endif; ?>

				<?php echo $__env->make('back.partials.treeview', [
				  'icon' => 'file-text',
				  'type' => 'post',
				  'items' => [
					[
					  'route' => route('posts.index'),
					  'command' => 'list',
					  'color' => 'blue',
					],
					[
					  'route' => route('posts.index', ['new' => 'on']),
					  'command' => 'new',
					  'color' => 'yellow',
					],
					[
					  'route' => route('posts.create'),
					  'command' => 'create',
					  'color' => 'green',
					],
				  ]
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<li><a href="<?php echo e(route('medias.index')); ?>"><i class="fa fa-image"></i> <span><?php echo app('translator')->getFromJson('Medias'); ?></span></a></li>

				<?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
				<li><a href="<?php echo e(route('settings.edit')); ?>"><i class="fa fa-cog"></i> <span><?php echo app('translator')->getFromJson('Settings'); ?></span></a></li>
				<?php endif; ?>

				<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> <span><?php echo app('translator')->getFromJson('Home'); ?></span></a></li>

			</ul>
			<!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				
				<?php echo $__env->yieldContent('button'); ?>
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">
		<div class="row">
			<div class="col-md-3">
				<h2>User information</h2>
			</div>
		</div>
			<div class="row">
				<?php if( isset($mess) ): ?>
					<?php if($mess['stt'] == true): ?>
						<div class="alert alert-success"> <strong>Success!</strong> <?php echo e($mess['mess']); ?></div>
					<?php else: ?>
						<div class="alert alert-danger"> <strong>Fail!</strong> <?php echo e($mess['mess']); ?></div>
					<?php endif; ?>
				<?php endif; ?>

				<?php if( session('msg') ): ?>
					<?php $__currentLoopData = session('msg'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="alert alert-danger"> <strong>Fail!</strong> <?php echo e($error); ?></div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</div>
			<div class="row">
			<div style="margin-left: 50px">
				<form name="edit-form" action="<?php echo e(route('profile.edit')); ?>" method="POST">
					<?php echo e(csrf_field()); ?>

					<input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>">
			<div class="row">
					<div class="col-md-2">
						<p><?php echo app('translator')->getFromJson('Username:'); ?></p>
					</div>
					<div class="col-md-6">
						<input name="user_name" class="form-control" value="<?php echo e($profile->name); ?>" style="width: 500px" required>
					</div>
			</div>
					<hr>
			<div class="row">
					<div class="col-md-2">
						<p><?php echo app('translator')->getFromJson('Email:'); ?></p>
					</div>
					<div class="col-md-6">
						<input name="user_email" class="form-control"  value="<?php echo e($profile->email); ?>" style="width: 500px" required>
					</div>
			</div>
					<hr>
			<div class="row">
					<div class="col-md-2">
						<p><?php echo app('translator')->getFromJson('Password:'); ?></p>
					</div>
					<div class="col-md-6">
						<input name="user_pw" type="password" class="form-control"  placeholder="enter your current password" style="width: 500px" required>
					</div>
			</div>
					<hr>
			<div class="row">
					<div class="col-md-2">
						<p><?php echo app('translator')->getFromJson('New Password:'); ?></p>
					</div>
					<div class="col-md-6">
						<input name="user_pw_new" type="password" class="form-control"  placeholder="enter your new password" style="width: 500px">
					</div>
			</div>
					<hr>
			<div class="row">
					<div class="col-md-2">
						<p><?php echo app('translator')->getFromJson('Confirm new password:'); ?></p>
					</div>
					<div class="col-md-6">
						<input name="user_pw_new_confirmation" type="password" class="form-control"  placeholder="confirm new password" style="width: 500px">
					</div>
			</div>
					<hr>
			<div class="row">
					<div class="col-md-2">
						<p><?php echo app('translator')->getFromJson('Profile Image:'); ?></p>
					</div>
				<div class="col-md-6">
						<img src="../../files/<?php echo e(auth()->user()->profile_img); ?>" style="width: 350px; height: 350px; border-radius: 50%;">
				</div>
			</div>
					<hr>
			<div class="row">
					<div class="col-md-2">

					</div>
				<div class="col-md-6">
					<input class="btn-info" type="submit" value="<?php echo app('translator')->getFromJson('Accept'); ?>">
				</div>
			</div>
				</form>
			</div>

			</div>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- Default to the left -->
		<strong>Copyright &copy; 2017 <a href="#"><?php echo app('translator')->getFromJson('My nice Company'); ?></a>.</strong> <?php echo app('translator')->getFromJson('All rights reserved'); ?>.
	</footer>

</div>

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3.2.0 -->
<script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.js"></script>

<?php echo $__env->yieldContent('js'); ?>

<!-- AdminLTE App -->
<script src="<?php echo e(asset('adminlte/js/app.min.js')); ?>"></script>

<!-- Commom -->


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<script>
	$(function() {
		$('#logout').click(function(e) {
			e.preventDefault();
			$('#logout-form').submit()
		})
	})

</script>
</body>
</html>
