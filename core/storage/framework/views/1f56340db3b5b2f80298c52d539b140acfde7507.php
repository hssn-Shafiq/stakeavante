<?php $__env->startSection('panel'); ?>
<!-- Account Section -->
<div class="account-section">
    <div class="account__section-wrapper">
        <div class="account__section-content">
            <div class="w-100"> 
                <div class="logo mb-5">
                    <a href="<?php echo e(route('home')); ?>">
                        <img src="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/darkLogo.png')); ?>"  alt="<?php echo app('translator')->get('site-logo'); ?>">
                    </a>
                </div>
                <div class="section__header text-white">
                    <h4 class="section__title mb-0 text-white"><?php echo app('translator')->get('Reset Password'); ?></h4>
                </div>
                <form class="account--form row g-4" method="post" action="<?php echo e(route('user.password.update')); ?>">
                    <?php echo csrf_field(); ?> 
                    <input type="hidden" name="email" value="<?php echo e($email); ?>">
                    <input type="hidden" name="token" value="<?php echo e($token); ?>">

                    <div class="col-sm-12">
                        <label for="username" class="form--label-2"><?php echo app('translator')->get('New Password'); ?></label>
                        <input type="Password" name="password" placeholder="<?php echo app('translator')->get('Password'); ?>" class="form-control form--control-2">
                    </div>

                    <div class="col-sm-12">
                        <label for="username" class="form--label-2"><?php echo app('translator')->get('Confirm Password'); ?></label>
                        <input type="Password" name="password_confirmation"  placeholder="<?php echo app('translator')->get('Confirm Password'); ?>" class="form-control form--control-2">
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" class="cmn--btn w-100"><?php echo app('translator')->get('Change Password'); ?></button>
                    </div>
                </form>
                <div class="mt-4 text--white">
                    <?php echo app('translator')->get('Go to Sign In'); ?> 
                        <a href="<?php echo e(route('user.login')); ?>" class="text--base">
                            <?php echo app('translator')->get('Sign In'); ?>
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Account Section -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/auth/passwords/reset.blade.php ENDPATH**/ ?>