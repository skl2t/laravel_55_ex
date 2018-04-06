<div class="box <?php echo e($box['type']); ?>">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo e($box['title']); ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php echo $__env->make('back.partials.input', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

