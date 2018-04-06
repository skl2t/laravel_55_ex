<div class="box box-solid box-<?php echo e($type); ?>">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo e($boxTitle); ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php echo e($slot); ?>

    </div>
    <!-- /.box-body -->
    <?php if(isset($footer)): ?>
        <div class="box-footer">
            <?php echo e($footer); ?>

        </div>
    <?php endif; ?>
    <!-- box-footer -->
</div>
<!-- /.box -->