<?php $__env->startSection('css'); ?>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
	<style>
		input, th span {
			cursor: pointer;
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<strong><?php echo app('translator')->getFromJson('Roles'); ?> :</strong> &nbsp;
					<input type="radio" name="role" value="all" checked> <?php echo app('translator')->getFromJson('All'); ?>&nbsp;
					<input type="radio" name="role" value="admin"> <?php echo app('translator')->getFromJson('Administrator'); ?>&nbsp;
					<input type="radio" name="role" value="redac"> <?php echo app('translator')->getFromJson('Redactor'); ?>&nbsp;
					<input type="radio" name="role" value="user"> <?php echo app('translator')->getFromJson('User'); ?>&nbsp;<br>
					<strong><?php echo app('translator')->getFromJson('Status'); ?> :</strong> &nbsp;
					<input type="checkbox" name="new" <?php if(request()->new): ?> checked <?php endif; ?>> <?php echo app('translator')->getFromJson('New'); ?>&nbsp;
					<input type="checkbox" name="valid"> <?php echo app('translator')->getFromJson('Valid'); ?>&nbsp;
					<input type="checkbox" name="confirmed"> <?php echo app('translator')->getFromJson('Confirmed'); ?>
					<div id="spinner" class="text-center"></div>
				</div>
				<div class="box-body table-responsive">
					<table id="users" class="table table-striped table-bordered">
						<thead>
						<tr>
							<th>#</th>
							<th><?php echo app('translator')->getFromJson('Name'); ?><span id="name" class="fa fa-sort pull-right"
							                       aria-hidden="true"></span></th>
							<th><?php echo app('translator')->getFromJson('Email'); ?><span id="email" class="fa fa-sort pull-right"
							                        aria-hidden="true"></span></th>
							<th><?php echo app('translator')->getFromJson('Role'); ?><span id="role" class="fa fa-sort pull-right"
							                       aria-hidden="true"></span></th>
							<th><?php echo app('translator')->getFromJson('New'); ?></th>
							<th><?php echo app('translator')->getFromJson('Valid'); ?></th>
							<th><?php echo app('translator')->getFromJson('Confirmed'); ?></th>
							<th><?php echo app('translator')->getFromJson('Creation'); ?><span id="created_at" class="fa fa-sort-desc pull-right"
							                           aria-hidden="true"></span></th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>#</th>
							<th><?php echo app('translator')->getFromJson('Name'); ?></th>
							<th><?php echo app('translator')->getFromJson('Email'); ?></th>
							<th><?php echo app('translator')->getFromJson('Role'); ?></th>
							<th><?php echo app('translator')->getFromJson('New'); ?></th>
							<th><?php echo app('translator')->getFromJson('Valid'); ?></th>
							<th><?php echo app('translator')->getFromJson('Confirmed'); ?></th>
							<th><?php echo app('translator')->getFromJson('Creation'); ?></th>
							<th></th>
							<th></th>
						</tr>
						</tfoot>
						<tbody id="pannel">
						<?php echo $__env->make('back.users.table', compact('users'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
				<div id="pagination" class="box-footer">
					<?php echo e($links); ?>

				</div>
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script src="<?php echo e(asset('adminlte/js/back.js')); ?>"></script>
	<script>

			var user = (function () {

				var url = '<?php echo e(route('users.index')); ?>';
				var swalTitle = '<?php echo app('translator')->getFromJson('Really destroy user ?'); ?>';
				var confirmButtonText = '<?php echo app('translator')->getFromJson('Yes'); ?>';
				var cancelButtonText = '<?php echo app('translator')->getFromJson('No'); ?>';
				var errorAjax = '<?php echo app('translator')->getFromJson('Looks like there is a server issue...'); ?>';

				var onReady = function () {
					$('#pagination').on('click', 'ul.pagination a', function (event) {
						back.pagination(event, $(this), errorAjax)
					});
					$('#pannel').on('change', ':checkbox[name="seen"]', function () {
						back.seen(url, $(this), errorAjax)
					})
						.on('click', 'td a.btn-danger', function (event) {
							back.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
						});
					$('th span').click(function () {
						back.ordering(url, $(this), errorAjax)
					});
					$('.box-header :radio, .box-header :checkbox').click(function () {
						back.filters(url, errorAjax)
					})
				};

				return {
					onReady: onReady
				}

			})();

			$(document).ready(user.onReady)

	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>