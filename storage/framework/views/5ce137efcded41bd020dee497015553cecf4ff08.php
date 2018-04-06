<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
    <style>
        input, th span {
            cursor: pointer;
        }
        #message {
            background-color: #a2cce4;
        }
        #message.box-footer {
            margin: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <strong><?php echo app('translator')->getFromJson('Status'); ?> :</strong> &nbsp;
                    <input type="checkbox" name="new" <?php if(request()->new): ?> checked <?php endif; ?>> <?php echo app('translator')->getFromJson('New'); ?>&nbsp;
                    <div id="spinner" class="text-center"></div>
                </div>
                <div id="pannel" class="box-body">
                    <?php echo $__env->make('back.contacts.table', compact('contacts'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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

    var contact = (function () {

        var url = '<?php echo e(route('contacts.index')); ?>';
        var swalTitle = '<?php echo app('translator')->getFromJson('Really destroy contact ?'); ?>';
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
            $('.box-header :radio, .box-header :checkbox').click(function () {
                back.filters(url, errorAjax)
            })
        };

        return {
            onReady: onReady
        }

    })();

    $(document).ready(contact.onReady)

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>