<?php $__env->startSection('main'); ?>

    <?php echo $__env->yieldContent('form-open'); ?>
        <?php echo e(csrf_field()); ?>


        <div class="row">

            <div class="col-md-12">
                <?php echo $__env->make('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Title'),
                    ],
                    'input' => [
                        'name' => 'title',
                        'value' => isset($category) ? $category->title : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Slug'),
                    ],
                    'input' => [
                        'name' => 'slug',
                        'value' => isset($category) ? $category->slug : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('Submit'); ?></button>
            </div>

        </div>
        <!-- /.row -->
    </form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script src="<?php echo e(asset('adminlte/plugins/voca/voca.min.js')); ?>"></script>
    <script>

        $('#slug').keyup(function () {
            $(this).val(v.slugify($(this).val()))
        });

        $('#title').keyup(function () {
            $('#slug').val(v.slugify($(this).val()))
        })

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>