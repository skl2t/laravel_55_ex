<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
    <style>
        input, th span {
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('button'); ?>
    <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-primary"><?php echo app('translator')->getFromJson('New Post'); ?></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <strong><?php echo app('translator')->getFromJson('Status'); ?> :</strong> &nbsp;
                    <input type="checkbox" name="new" <?php if(request()->new): ?> checked <?php endif; ?>> <?php echo app('translator')->getFromJson('New'); ?>&nbsp;
                    <input type="checkbox" name="active" <?php if(request()->active): ?> checked <?php endif; ?>> <?php echo app('translator')->getFromJson('Active'); ?>&nbsp;
                    <div id="spinner" class="text-center"></div>
                </div>
                <div class="box-body table-responsive">
                    <table id="users" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('Title'); ?><span id="title" class="fa fa-sort pull-right"
                                                              aria-hidden="true"></span></th>
                            <th><?php echo app('translator')->getFromJson('Image'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Active'); ?><span id="active" class="fa fa-sort pull-right"
                                                              aria-hidden="true"></span></th>
                            <th><?php echo app('translator')->getFromJson('Creation'); ?><span id="created_at" class="fa fa-sort-desc pull-right"
                                                              aria-hidden="true"></span></th>
                            <th><?php echo app('translator')->getFromJson('New'); ?></th>
                            <th><?php echo app('translator')->getFromJson('SEO Title'); ?><span id="seo_title" class="fa fa-sort pull-right"
                                                              aria-hidden="true"></span></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('Title'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Image'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Active'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Creation'); ?></th>
                            <th><?php echo app('translator')->getFromJson('New'); ?></th>
                            <th><?php echo app('translator')->getFromJson('SEO Title'); ?></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody id="pannel">
                            <?php if(session('post-ok')): ?>
                                <?php $__env->startComponent('back.components.alert'); ?>
                                    <?php $__env->slot('type'); ?>
                                        success
                                    <?php $__env->endSlot(); ?>
                                    <?php echo session('post-ok'); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?>
                            <?php echo $__env->make('back.posts.table', compact('posts'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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

        var post = (function () {

            var url = '<?php echo e(route('posts.index')); ?>';
            var swalTitle = '<?php echo app('translator')->getFromJson('Really destroy post ?'); ?>';
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
                    .on('change', ':checkbox[name="status"]', function () {
                        back.status(url, $(this), errorAjax)
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

        $(document).ready(post.onReady)

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>