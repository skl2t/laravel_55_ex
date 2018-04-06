<?php $__env->startSection('main'); ?>

   <!-- content
   ================================================== -->
   <section id="content-wrap" class="site-page">
   	<div class="row">
   		<div class="col-twelve">

   			<section>  

                <div class="primary-content">

						<h1 class="entry-title add-bottom"><?php echo app('translator')->getFromJson('Get In Touch With Us'); ?></h1>

						<p class="lead"><?php echo app('translator')->getFromJson('Lorem ipsum Deserunt est dolore Ut Excepteur nulla occaecat magna occaecat Excepteur nisi esse veniam dolor consectetur minim qui nisi esse deserunt commodo ea enim ullamco non voluptate consectetur minim aliquip Ut incididunt amet ut cupidatat.'); ?></p>

						<p><?php echo app('translator')->getFromJson('Duis ex ad cupidatat tempor Excepteur cillum cupidatat fugiat nostrud cupidatat dolor sunt sint sit nisi est eu exercitation incididunt adipisicing veniam velit id fugiat enim mollit amet anim veniam dolor dolor irure velit commodo cillum sit nulla ullamco magna amet magna cupidatat qui labore cillum sit in tempor veniam consequat non laborum adipisicing aliqua ea nisi sint ut quis proident ullamco ut dolore culpa occaecat ut laboris in sit minim cupidatat ut dolor voluptate enim veniam consequat occaecat fugiat in adipisicing in amet Ut nulla nisi non ut enim aliqua laborum mollit quis nostrud sed sed.'); ?></p>

						<div class="row">
							<div class="col-six tab-full">
								<h4><?php echo app('translator')->getFromJson('Where to Find Us'); ?></h4>
					  			<p><?php echo app('translator')->getFromJson('1600 Amphitheatre Parkway<br>Mountain View, CA<br>94043 US'); ?></p>
							</div>
							<div class="col-six tab-full">
								<h4><?php echo app('translator')->getFromJson('Contact Info'); ?></h4>
					  			<p><?php echo app('translator')->getFromJson('someone@abstractwebsite.com<br>info@abstractwebsite.com<br>Phone: (+63) 555 1212'); ?></p>
							</div>
						</div>

                        <?php if(session('ok')): ?>
                            <?php $__env->startComponent('front.components.alert'); ?>
                                <?php $__env->slot('type'); ?>
                                    success
                                <?php $__env->endSlot(); ?>
                                <?php echo session('ok'); ?>

                            <?php echo $__env->renderComponent(); ?>
                        <?php endif; ?>

						<form method="post" action="<?php echo e(route('contacts.store')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <?php if($errors->has('name')): ?>
                                <?php $__env->startComponent('front.components.error'); ?>
                                    <?php echo e($errors->first('name')); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?> 
                            <input id="name" placeholder="<?php echo app('translator')->getFromJson('Your name'); ?>" type="text" class="full-width"  name="name" value="<?php echo e(old('name')); ?>" required autofocus>
                            <?php if($errors->has('email')): ?>
                                <?php $__env->startComponent('front.components.error'); ?>
                                    <?php echo e($errors->first('email')); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?> 
                            <input id="email" placeholder="<?php echo app('translator')->getFromJson('Your email'); ?>" type="email" class="full-width"  name="email" value="<?php echo e(old('email')); ?>" required>
                            <?php if($errors->has('message')): ?>
                                <?php $__env->startComponent('front.components.error'); ?>
                                    <?php echo e($errors->first('message')); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?> 
                            <textarea name="message" id="message" class="full-width" placeholder="<?php echo app('translator')->getFromJson('Your message'); ?>" ></textarea>
                            <button type="submit" class="submit button-primary full-width-on-mobile">Submit</button>
  				        </form> <!-- end form -->
                    </div>
			</section>
   		   		
		</div> <!-- end col-twelve -->
   	</div> <!-- end row -->
   </section> <!-- end content --> 
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>