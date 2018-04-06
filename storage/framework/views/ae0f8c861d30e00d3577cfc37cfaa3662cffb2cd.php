<?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="box">
    <div class="box-body table-responsive">
        <table id="contacts" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="30%"><?php echo app('translator')->getFromJson('Name'); ?></th>
                <th width="30%"><?php echo app('translator')->getFromJson('Email'); ?></th>
                <th width="10%"><?php echo app('translator')->getFromJson('New'); ?></th>
                <th width="25%"><?php echo app('translator')->getFromJson('Creation'); ?></th>
                <th width="5%"></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo e($contact->name); ?></td>
                    <td><?php echo e($contact->email); ?></td>
                    <td>
                        <input type="checkbox" name="seen" value="<?php echo e($contact->id); ?>" <?php echo e(is_null($contact->ingoing) ?  'disabled' : 'checked'); ?>>
                    </td>
                    <td><?php echo e($contact->created_at->formatLocalized('%c')); ?></td>
                    <td><a class="btn btn-danger btn-xs btn-block" href="<?php echo e(route('contacts.destroy', [$contact->id])); ?>" role="button" title="<?php echo app('translator')->getFromJson('Destroy'); ?>"><span class="fa fa-remove"></span></a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    <div id="message" class="box-footer">
        <?php echo e($contact->message); ?>

    </div>
</div>
<!-- /.box -->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
