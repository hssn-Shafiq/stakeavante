<?php $__env->startSection('panel'); ?>
<!-- Account Section -->
<div class="account-section">
    <div class="account__section-wrapper">
        <div class="account__section-content">
            <div class="w-100">
                <div class="logo mb-5">
                    <a href="<?php echo e(route('home')); ?>">
                        <img src="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/darkmainlogo.png')); ?>"  alt="<?php echo app('translator')->get('site-logo'); ?>">
                    </a>
                </div>
                <div class="section__header text-white">
                    <h6 class="section__title mb-0 text-white"><?php echo app('translator')->get('2FA Verification'); ?></h6>
                </div>
                <form class="account--form row g-4" method="post" action="<?php echo e(route('user.go2fa.verify')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="col-sm-12">
                        <label for="code" class="form--label-2"><?php echo app('translator')->get('Verification Code'); ?></label>
                        <input type="text" name="code" id="code" placeholder="<?php echo app('translator')->get('Code'); ?>" class="form-control form--control-2">
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" class="cmn--btn w-100"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Account Section -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate .'layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/auth/authorization/2fa.blade.php ENDPATH**/ ?>