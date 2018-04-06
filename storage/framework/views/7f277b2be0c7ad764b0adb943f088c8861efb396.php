<?php $__env->startSection('css'); ?>
    <style>
        .box-body hr+p {
            font-size: x-large;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('main'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <hr>
                    <p>ID</p>
                    <?php echo e($post->id); ?>

                    <hr>
                    <p><?php echo app('translator')->getFromJson('Title'); ?></p>
                    <?php echo e($post->title); ?>

                    <hr>
                    <p><?php echo app('translator')->getFromJson('Author'); ?></p>
                    <?php echo e($post->user->name); ?>

                    <hr>
                    <p><?php echo app('translator')->getFromJson('Excerpt'); ?></p>
                    <?php echo e($post->excerpt); ?>

                    <hr>
                    <p><?php echo app('translator')->getFromJson('Body'); ?></p>
                    <?php echo $post->body; ?>

                    <hr>
                    <p><?php echo app('translator')->getFromJson('Image'); ?></p>
                    <img src="../../files/<?php echo e($post->image); ?>" alt="" width="200px">
                    <hr>
                    <p><?php echo app('translator')->getFromJson('Categories'); ?></p>
                    <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($category->title); ?><br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <hr>
                    <p><?php echo app('translator')->getFromJson('Slug'); ?></p>
                    <?php echo e($post->slug); ?>

                    <?php if($post->tags->count()): ?>
                        <p><?php echo app('translator')->getFromJson('Tags'); ?></p>
                        <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge"><?php echo e($tag->tag); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <hr>
                    <p><?php echo app('translator')->getFromJson('SEO Title'); ?></p>
                    <?php echo e($post->seo_title); ?>

                    <hr>
                    <p><?php echo app('translator')->getFromJson('META Description'); ?></p>
                    <?php echo e($post->meta_description); ?>

                    <hr>
                    <p><?php echo app('translator')->getFromJson('META Keywords'); ?></p>
                    <?php echo e($post->meta_keywords); ?>

                    <hr>
                    <p><?php echo app('translator')->getFromJson('Status'); ?></p>
                    <?php echo e($post->active ? __('Active') : __('No Active')); ?>

                    <hr>
                    <p><?php echo app('translator')->getFromJson('Date Creation'); ?></p>
                    <?php echo e($post->created_at->formatLocalized('%c')); ?>

                    <hr>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>