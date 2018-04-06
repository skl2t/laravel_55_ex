<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
    <style>
        input, th span {
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('button'); ?>
    <a class="btn btn-primary" href="<?php echo e(route('categories.create')); ?>"><?php echo app('translator')->getFromJson('New Category'); ?></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

    <div class="row">
        <div class="col-md-12">
            <?php if(session('category-ok')): ?>
                <?php $__env->startComponent('back.components.alert'); ?>
                    <?php $__env->slot('type'); ?>
                        success
                    <?php $__env->endSlot(); ?>
                    <?php echo session('category-ok'); ?>

                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            <div class="box">
                <div class="box-header with-border">
                    <div id="spinner" class="text-center"></div>
                </div>
                <div class="box-body table-responsive">
                    <table id="users" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->getFromJson('Title'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Slug'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Total'); ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->getFromJson('Title'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Slug'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Total'); ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody id="pannel">
                            <?php echo $__env->make('back.categories.table', compact('categories'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </tbody>
                    </table>
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

        var category = (function () {

            var onReady = function () {
                $('#pannel').on('click', 'td a.btn-danger', function (event) {
                    var that = $(this);
                    event.preventDefault();
                    swal({
                        title: '<?php echo app('translator')->getFromJson('Really destroy category ?'); ?>',
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: '<?php echo app('translator')->getFromJson('Yes'); ?>',
                        cancelButtonText: '<?php echo app('translator')->getFromJson('No'); ?>'
                    }).then(function () {
                        back.spin();
                        $.ajax({
                            url: that.attr('href'),
                            type: 'DELETE'
                        })
                            .done(function () {
                                that.parents('tr').remove();
                                back.unSpin()
                            })
                            .fail(function () {
                                back.fail('<?php echo app('translator')->getFromJson('Looks like there is a server issue...'); ?>')
                            }
                        )
                    })
                })
            };

            return {
                onReady: onReady
            }

        })();

        $(document).ready(category.onReady)

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>