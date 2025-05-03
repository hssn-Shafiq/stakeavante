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
                    <h4 class="section__title mb-0 text-white"><?php echo app('translator')->get('Verification Code'); ?></h4>
                </div>
                <form class="account--form g-4" method="post" action="<?php echo e(route('user.password.verify-code')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="email" value="<?php echo e($email); ?>">

                    <div class="form-group">
                        <input type="text" name="code" pattern="[0-9]*" class="form-control" maxlength="6" required >
                    </div>

                    <button type="submit" class="cmn--btn w-100"><?php echo app('translator')->get('Submit'); ?></button>
                </form>
                <div class="mt-4 text--white">
                    <?php echo app('translator')->get('Please check including your Junk/Spam Folder. if not found, you can'); ?>
                        <a href="<?php echo e(route('user.password.request')); ?>" class="text--base">
                            <?php echo app('translator')->get('Try to send again'); ?>
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Account Section -->
<?php $__env->stopSection(); ?>



<?php echo $__env->make($activeTemplate.'layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/auth/passwords/code_verify.blade.php ENDPATH**/ ?>