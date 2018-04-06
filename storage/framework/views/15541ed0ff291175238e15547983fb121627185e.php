<?php $__env->startSection('css'); ?>
    <style>
        textarea { resize: vertical; }
    </style>
    <link href="<?php echo e(asset('adminlte/plugins/colorbox/colorbox.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

    <?php echo $__env->yieldContent('form-open'); ?>
        <?php echo e(csrf_field()); ?>


        <div class="row">

            <div class="col-md-8">
                <?php if(session('post-ok')): ?>
                    <?php $__env->startComponent('back.components.alert'); ?>
                        <?php $__env->slot('type'); ?>
                            success
                        <?php $__env->endSlot(); ?>
                        <?php echo session('post-ok'); ?>

                    <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
                <?php echo $__env->make('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Title'),
                    ],
                    'input' => [
                        'name' => 'title',
                        'value' => isset($post) ? $post->title : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Excerpt'),
                    ],
                    'input' => [
                        'name' => 'excerpt',
                        'value' => isset($post) ? $post->excerpt : '',
                        'input' => 'textarea',
                        'rows' => 3,
                        'required' => true,
                    ],
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Body'),
                    ],
                    'input' => [
                        'name' => 'body',
                        'value' => isset($post) ? $post->body : '',
                        'input' => 'textarea',
                        'rows' => 10,
                        'required' => true,
                    ],
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('Submit'); ?></button>
            </div>

            <div class="col-md-4">

                <?php $__env->startComponent('back.components.box'); ?>
                    <?php $__env->slot('type'); ?>
                        warning
                    <?php $__env->endSlot(); ?>
                    <?php $__env->slot('boxTitle'); ?>
                        <?php echo app('translator')->getFromJson('Categories'); ?>
                    <?php $__env->endSlot(); ?>
                    <?php echo $__env->make('back.partials.input', [
                        'input' => [
                            'name' => 'categories',
                            'values' => isset($post) ? $post->categories : collect(),
                            'input' => 'select',
                            'options' => $categories,
                        ],
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->renderComponent(); ?>

                <?php $__env->startComponent('back.components.box'); ?>
                    <?php $__env->slot('type'); ?>
                        danger
                    <?php $__env->endSlot(); ?>
                    <?php $__env->slot('boxTitle'); ?>
                        <?php echo app('translator')->getFromJson('Tags'); ?>
                    <?php $__env->endSlot(); ?>
                    <?php echo $__env->make('back.partials.input', [
                        'input' => [
                            'name' => 'tags',
                            'value' => isset($post) ? implode(',', $post->tags->pluck('tag')->toArray()) : '',
                            'input' => 'text',
                            'required' => false,
                        ],
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->renderComponent(); ?>

                <?php $__env->startComponent('back.components.box'); ?>
                    <?php $__env->slot('type'); ?>
                        success
                    <?php $__env->endSlot(); ?>
                    <?php $__env->slot('boxTitle'); ?>
                        <?php echo app('translator')->getFromJson('Details'); ?>
                    <?php $__env->endSlot(); ?>
                    <?php echo $__env->make('back.partials.input', [
                        'input' => [
                            'name' => 'slug',
                            'value' => isset($post) ? $post->slug : '',
                            'input' => 'text',
                            'title' => __('Slug'),
                            'required' => true,
                        ],
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('back.partials.input', [
                        'input' => [
                            'name' => 'active',
                            'value' => isset($post) ? $post->active : false,
                            'input' => 'checkbox',
                            'title' => __('Status'),
                            'label' => __('Active'),
                        ],
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->renderComponent(); ?>

                <?php $__env->startComponent('back.components.box'); ?>
                    <?php $__env->slot('type'); ?>
                        primary
                    <?php $__env->endSlot(); ?>
                    <?php $__env->slot('boxTitle'); ?>
                        <?php echo app('translator')->getFromJson('Image'); ?>
                    <?php $__env->endSlot(); ?>
                    <img id="img" src="<?php if(isset($post)): ?> <?php echo e($post->image); ?> <?php endif; ?>" alt="" class="img-responsive">
                    <?php $__env->slot('footer'); ?>
                        <div class="<?php echo e($errors->has('image') ? 'has-error' : ''); ?>">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <a href="" class="popup_selector btn btn-primary" data-inputid="image"><?php echo app('translator')->getFromJson('Select an image'); ?></a>
                                </div>
                                <!-- /btn-group -->
                                <input class="form-control" type="text" id="image" name="image" value="<?php echo e(old('image', isset($post) ? $post->image : '')); ?>">
                            </div>
                            <?php echo $errors->first('image', '<span class="help-block">:message</span>'); ?>

                        </div>
                    <?php $__env->endSlot(); ?>
                <?php echo $__env->renderComponent(); ?>

                <?php $__env->startComponent('back.components.box'); ?>
                    <?php $__env->slot('type'); ?>
                        info
                    <?php $__env->endSlot(); ?>
                    <?php $__env->slot('boxTitle'); ?>
                        SEO
                    <?php $__env->endSlot(); ?>
                    <?php echo $__env->make('back.partials.input', [
                        'input' => [
                            'name' => 'meta_description',
                            'value' => isset($post) ? $post->meta_description : '',
                            'input' => 'text',
                            'title' => __('META Description'),
                            'input' => 'textarea',
                            'rows' => 3,
                            'required' => true,
                        ]
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('back.partials.input', [
                        'input' => [
                            'name' => 'meta_keywords',
                            'value' => isset($post) ? $post->meta_keywords : '',
                            'input' => 'text',
                            'title' => __('META Keywords'),
                            'input' => 'textarea',
                            'rows' => 3,
                            'required' => true,
                        ]
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('back.partials.input', [
                        'input' => [
                            'name' => 'seo_title',
                            'value' => isset($post) ? $post->seo_title : '',
                            'input' => 'text',
                            'title' => __('SEO Title'),
                            'required' => true,
                        ],
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->renderComponent(); ?>

        </div>
        </div>
        <!-- /.row -->
    </form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script src="<?php echo e(asset('adminlte/plugins/colorbox/jquery.colorbox-min.js')); ?>"></script>
    <script src="<?php echo e(asset('adminlte/plugins/voca/voca.min.js')); ?>"></script>
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script>

        CKEDITOR.replace('body', {customConfig: '/adminlte/js/ckeditor.js'});

        $('.popup_selector').click( function (event) {
            event.preventDefault();
            var updateID = $(this).attr('data-inputid');
            var elfinderUrl = '/elfinder/popup/';
            var triggerUrl = elfinderUrl + updateID;
            $.colorbox({
                href: triggerUrl,
                fastIframe: true,
                iframe: true,
                width: '70%',
                height: '70%'
            })
        });

        function processSelectedFile(filePath, requestingField) {
            $('#' + requestingField).val(filePath);
            $('#img').attr('src', filePath)
        }

        $('#slug').keyup(function () {
            $(this).val(v.slugify($(this).val()))
        });

        $('#title').keyup(function () {
            $('#slug').val(v.slugify($(this).val()))
        })

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>