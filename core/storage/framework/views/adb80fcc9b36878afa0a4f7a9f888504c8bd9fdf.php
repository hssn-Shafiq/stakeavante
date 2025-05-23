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
                    <h6 class="section__title mb-0 text-white"><?php echo app('translator')->get('Verify your email to get access'); ?></h6>
                    <p class="mt-3"><?php echo app('translator')->get('Your Email:'); ?> <strong><?php echo e(auth()->user()->email); ?></strong></p>
                </div>
                <form class="account--form row g-4" method="post" action="<?php echo e(route('user.verify_email')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="col-sm-12">
                        <label for="code" class="form--label-2"><?php echo app('translator')->get('Verification Code'); ?></label>
                        <input type="text" name="code" id="code" placeholder="<?php echo app('translator')->get('Code'); ?>" class="form-control form--control-2">
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" class="cmn--btn w-100"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
                <div class="mt-4 text--white">
                    <?php echo app('translator')->get('Please check including your Junk/Spam Folder. if not found, you can'); ?>
                        <a href="<?php echo e(route('user.send_verify_code')); ?>?type=email" class="text--base">
                            <?php echo app('translator')->get('Resend code'); ?>
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Account Section -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/auth/authorization/email.blade.php ENDPATH**/ ?>