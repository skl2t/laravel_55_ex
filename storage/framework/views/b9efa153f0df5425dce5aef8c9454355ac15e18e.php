<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/bootstrap-slider/slider.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <div class="row">
        <div class="col-md-12">
            <?php if($errors->count()): ?>
                <?php $__env->startComponent('back.components.alert'); ?>
                    <?php $__env->slot('type'); ?>
                        danger
                    <?php $__env->endSlot(); ?>
                    <?php echo app('translator')->getFromJson('There is some validation issue...'); ?>
                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            <?php if(session('ok')): ?>
                <?php $__env->startComponent('back.components.alert'); ?>
                    <?php $__env->slot('type'); ?>
                        success
                    <?php $__env->endSlot(); ?>
                    <?php echo session('ok'); ?>

                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-12">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-pills">
                            <li><a href="#tab_1" data-toggle="tab"><?php echo app('translator')->getFromJson('Application'); ?></a></li>
                            <li><a href="#tab_2" data-toggle="tab"><?php echo app('translator')->getFromJson('Paginations'); ?></a></li>
                            <li><a href="#tab_3" data-toggle="tab"><?php echo app('translator')->getFromJson('Comments'); ?></a></li>
                            <li><a href="#tab_4" data-toggle="tab"><?php echo app('translator')->getFromJson('Database'); ?></a></li>
                            <li><a href="#tab_5" data-toggle="tab"><?php echo app('translator')->getFromJson('Mails'); ?></a></li>
                        </ul>
                        <div class="tab-content">

                            <?php $envRepository = app('App\Repositories\EnvRepository'); ?>

                            <div class="tab-pane fade" id="tab_1">
                                <form method="post" action="<?php echo e(route('settings.update', ['page' => 1])); ?>">
                                    <?php echo e(method_field('PUT')); ?>

                                    <?php echo e(csrf_field()); ?>

                                    <?php echo $__env->make('back.partials.input', [
                                        'input' => [
                                            'title' => __('Application name'),
                                            'name' => 'app_name',
                                            'value' => old('app_name', config('app.name')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('back.partials.input', [
                                        'input' => [
                                            'title' => __('Base URL'),
                                            'name' => 'app_url',
                                            'value' => old('app_url', $envRepository->get('APP_URL')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <div class="form-group">
                                        <label for="locale"><?php echo app('translator')->getFromJson('Default language'); ?></label>
                                        <select id="locale" name="locale" class="form-control">
                                            <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($id); ?>" <?php echo e(old('locale') ? ($id === old('locale') ? 'selected' : '') : $locale === $actualLocale ? 'selected' : ''); ?>><?php echo e($locale); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="timezone"><?php echo app('translator')->getFromJson('Server timezone'); ?></label>
                                        <select id="timezone" name="timezone" class="form-control">
                                            <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e(old('timezone') ? ($id === old('timezone') ? 'selected' : '') : $key === $actualTimezone ? 'selected' : ''); ?>><?php echo e($key . ' - ' . $value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cache_driver"><?php echo app('translator')->getFromJson('Cache driver'); ?></label>
                                        <select id="cache_driver" name="cache_driver" class="form-control">
                                            <?php $__currentLoopData = $caches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cache): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cache); ?>" <?php echo e(old('mail_driver') ? ($cache === old('cache_driver') ? 'selected' : '') : $cache === $actualCacheDriver ? 'selected' : ''); ?>><?php echo e($cache); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" type="submit"><?php echo app('translator')->getFromJson('Submit'); ?></button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="tab_2">
                                <form method="post" action="<?php echo e(route('settings.update', ['page' => 2])); ?>">
                                    <?php echo e(method_field('PUT')); ?>

                                    <?php echo e(csrf_field()); ?>

                                    <?php echo $__env->make('back.partials.boxinput', [
                                         'box' => [
                                             'type' => 'box-warning',
                                             'title' => __('Front'),
                                         ],
                                         'input' => [
                                             'title' => __('Posts'),
                                             'name' => 'frontposts',
                                             'value' => old('frontposts', config('app.nbrPages.front.posts')),
                                             'input' => 'slider',
                                             'min' => 2,
                                             'max' => 16,
                                         ],
                                     ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php $__env->startComponent('back.components.boxinputs'); ?>
                                        <?php $__env->slot('boxtype'); ?>
                                            warning
                                        <?php $__env->endSlot(); ?>
                                        <?php $__env->slot('boxtitle'); ?>
                                            <?php echo app('translator')->getFromJson('Back'); ?>
                                        <?php $__env->endSlot(); ?>
                                        <?php echo $__env->make('back.partials.input', [
                                            'input' => [
                                                'title' => __('Posts'),
                                                'name' => 'backposts',
                                                'value' => old('backposts', config('app.nbrPages.back.posts')),
                                                'input' => 'slider',
                                                'min' => 2,
                                                'max' => 16,
                                            ],
                                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php echo $__env->make('back.partials.input', [
                                            'input' => [
                                                'title' => __('Users'),
                                                'name' => 'backusers',
                                                'value' => old('backusers', config('app.nbrPages.back.users')),
                                                'input' => 'slider',
                                                'min' => 2,
                                                'max' => 16,
                                            ],
                                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php echo $__env->make('back.partials.input', [
                                            'input' => [
                                                'title' => __('Comments'),
                                                'name' => 'backcomments',
                                                'value' => old('backcomments', config('app.nbrPages.back.comments')),
                                                'input' => 'slider',
                                                'min' => 2,
                                                'max' => 10,
                                            ],
                                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php echo $__env->make('back.partials.input', [
                                            'input' => [
                                                'title' => __('Contacts'),
                                                'name' => 'backcontacts',
                                                'value' => old('backcontacts', config('app.nbrPages.back.contacts')),
                                                'input' => 'slider',
                                                'min' => 2,
                                                'max' => 10,
                                            ],
                                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->renderComponent(); ?>
                                    <button class="btn btn-primary" type="submit"><?php echo app('translator')->getFromJson('Submit'); ?></button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="tab_3">
                                <form method="post" action="<?php echo e(route('settings.update', ['page' => 3])); ?>">
                                    <?php echo e(method_field('PUT')); ?>

                                    <?php echo e(csrf_field()); ?>

                                    <?php echo $__env->make('back.partials.input', [
                                        'input' => [
                                                'title' => __('Comments nested level'),
                                                'name' => 'backcommentsnestedlevel',
                                                'value' => old('backcommentsnestedlevel', config('app.commentsNestedLevel')),
                                                'input' => 'slider',
                                                'min' => 2,
                                                'max' => 10,
                                        ],
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('back.partials.input', [
                                        'input' => [
                                                'title' => __('Number of parent comments to see each time'),
                                                'name' => 'backcommentsparent',
                                                'value' => old('backcommentsparent', config('app.numberParentComments')),
                                                'input' => 'slider',
                                                'min' => 1,
                                                'max' => 10,
                                        ],
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <button class="btn btn-primary" type="submit"><?php echo app('translator')->getFromJson('Submit'); ?></button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="tab_4">
                                <h3 class="text-danger text-center"><?php echo app('translator')->getFromJson('Be careful not to enter wrong parameters!'); ?></h3>
                                <form id="formdatabase" method="post" action="<?php echo e(route('settings.update', ['page' => 4])); ?>">
                                    <?php echo e(method_field('PUT')); ?>

                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group">
                                        <label for="db_connection"><?php echo app('translator')->getFromJson('Connection'); ?></label>
                                        <select id="db_connection" name="db_connection" class="form-control">
                                            <?php $__currentLoopData = $connections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $connection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($connection); ?>" <?php echo e(old('db_connection') ? ($connection === old('db_connection') ? 'selected' : '') : $connection === $actualConnection ? 'selected' : ''); ?>><?php echo e($connection); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php echo $__env->make('back.partials.input', [
                                        'input' => [
                                            'title' => __('Host'),
                                            'name' => 'db_host',
                                            'value' => old('db_host', $envRepository->get('DB_HOST')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('back.partials.input', [
                                        'input' => [
                                            'title' => __('Port'),
                                            'name' => 'db_port',
                                            'value' => old('db_port', $envRepository->get('DB_PORT')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('back.partials.input', [
                                        'input' => [
                                            'title' => __('Database name'),
                                            'name' => 'db_database',
                                            'value' => old('db_database', $envRepository->get('DB_DATABASE')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('back.partials.input', [
                                        'input' => [
                                            'title' => __('User name'),
                                            'name' => 'db_username',
                                            'value' => old('db_username', $envRepository->get('DB_USERNAME')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('back.partials.input', [
                                        'input' => [
                                            'title' => __('Password'),
                                            'name' => 'db_password',
                                            'value' => old('db_password', $envRepository->get('DB_PASSWORD')),
                                            'input' => 'text',
                                            'required' => false,
                                        ],
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <button class="btn btn-primary" type="submit"><?php echo app('translator')->getFromJson('Submit'); ?></button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="tab_5">
                                <form method="post" action="<?php echo e(route('settings.update', ['page' => 5])); ?>">
                                    <?php echo e(method_field('PUT')); ?>

                                    <?php echo e(csrf_field()); ?>

                                    <?php echo $__env->make('back.partials.input', [
                                        'input' => [
                                            'title' => __('Sender mail address'),
                                            'name' => 'mail_from_address',
                                            'value' => old('mail_from_address', $envRepository->get('MAIL_FROM_ADDRESS')),
                                            'input' => 'mail',
                                            'required' => true,
                                        ],
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('back.partials.input', [
                                        'input' => [
                                            'title' => __('Sender name'),
                                            'name' => 'mail_from_name',
                                            'value' => old('mail_from_name', $envRepository->get('MAIL_FROM_NAME')),
                                            'input' => 'text',
                                            'required' => true,
                                        ],
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <div class="form-group">
                                        <label for="mail_driver"><?php echo app('translator')->getFromJson('Driver'); ?></label>
                                        <select id="mail_driver" name="mail_driver" class="form-control">
                                            <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e(old('mail_driver') ? ($key === old('mail_driver') ? 'selected' : '') : $key === $actualDriver ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div id="smtp" <?php if(old('mail_driver', $actualDriver) === 'mail'): ?> style="display: none" <?php endif; ?>>
                                        <?php echo $__env->make('back.partials.input', [
                                            'input' => [
                                                'title' => __('Host'),
                                                'name' => 'mail_host',
                                                'value' => old('mail_host', $envRepository->get('MAIL_HOST')),
                                                'input' => 'text',
                                                'required' => true,
                                            ],
                                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php echo $__env->make('back.partials.input', [
                                            'input' => [
                                                'title' => __('Port'),
                                                'name' => 'mail_port',
                                                'value' => old('mail_port', $envRepository->get('MAIL_PORT')),
                                                'input' => 'text',
                                                'required' => false,
                                            ],
                                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php echo $__env->make('back.partials.input', [
                                            'input' => [
                                                'title' => __('User name'),
                                                'name' => 'mail_username',
                                                'value' => old('mail_username', $envRepository->get('MAIL_USERNAME')),
                                                'input' => 'mail',
                                                'required' => false,
                                            ],
                                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php echo $__env->make('back.partials.input', [
                                            'input' => [
                                                'title' => __('Password'),
                                                'name' => 'mail_password',
                                                'value' => old('mail_password', $envRepository->get('MAIL_PASSWORD')),
                                                'input' => 'text',
                                                'required' => false,
                                            ],
                                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php echo $__env->make('back.partials.input', [
                                            'input' => [
                                                'title' => __('Encryption'),
                                                'name' => 'mail_encryption',
                                                'value' => old('mail_encryption', $envRepository->get('MAIL_ENCRYPTION')),
                                                'input' => 'text',
                                                'required' => false,
                                            ],
                                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                    <button class="btn btn-primary" type="submit"><?php echo app('translator')->getFromJson('Submit'); ?></button>
                                </form>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('adminlte/plugins/bootstrap-slider/bootstrap-slider.js')); ?>"></script>
    <script>
        $(function() {
            $('.slider').slider();
            $('#mail_driver').change (function() {
                if ($(this).val() == 'smtp') {
                    $('#smtp').show().slow()
                } else {
                    $('#smtp').hide().slow()
                }
            });
            $('a[href="#tab_<?php echo e(setTabActive ()); ?>"]').tab('show')
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('back.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>