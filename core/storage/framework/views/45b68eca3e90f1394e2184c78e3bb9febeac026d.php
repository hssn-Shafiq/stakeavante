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
                <form class="account--form row g-4" method="post" action="<?php echo e(route('user.password.email')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-sm-12">
                        <label for="username" class="form--label-2"><?php echo app('translator')->get('Choose Option'); ?></label>
                        <select class="form-control form--control-2" name="type">
                            <option value="email"><?php echo app('translator')->get('E-Mail Address'); ?></option>
                            <option value="username"><?php echo app('translator')->get('Avante ID'); ?></option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label for="myInputThree" class="form--label-2 my_value"><?php echo app('translator')->get('Type Here'); ?></label>
                        <input type="text" class=" <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control form--control-2 my_value" name="value" value="<?php echo e(old('value')); ?>" required autofocus="off" placeholder="<?php echo app('translator')->get('Type Here...'); ?>">
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" class="cmn--btn w-100"><?php echo app('translator')->get('Send Password Reset Code'); ?></button>
                    </div>
                </form>
                <div class="mt-4 text--white">
                    <?php echo app('translator')->get('Go to Sign In'); ?> <a href="<?php echo e(route('user.login')); ?>" class="text--base"><?php echo app('translator')->get('Sign In'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Account Section -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    $('select[name=type]').change(function(){
        $('.my_value').text($('select[name=type] :selected').text());
    }).change();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate.'layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/user/auth/passwords/email.blade.php ENDPATH**/ ?>