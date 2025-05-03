<?php $__env->startSection('panel'); ?>
    <!-- Account Section -->
    <div class="account-section" style= "background:#0a3238" >
        <div class="account__section-wrapper">
            <div class="account__section-content">

                <div class="w-100">

                    <div class="logo mb-5">

                        <a href="<?php echo e(route('home')); ?>">

                            <img src="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/darkLogo.png')); ?>"  alt="<?php echo app('translator')->get('site-logo'); ?>">

                        </a>

                    </div>

                    <div class="section__header ">

                        <h4 class="section__title mb-0 "><?php echo app('translator')->get('Sign In'); ?></h4>

                    </div>

                    <form class="account--form row g-4" method="post" action="<?php echo e(route('user.login')); ?>"

                        onsubmit="return submitUserForm();">

                        <?php echo csrf_field(); ?>

                        <div class="col-sm-12">

                            <label for="username" class="form--label-2"><?php echo app('translator')->get('Avante ID'); ?></label>

                            <input type="text" id="username" name="username" value="<?php echo e(old('username')); ?>" placeholder="<?php echo app('translator')->get('Avante ID'); ?>" required class="form-control form--control-2">

                        </div>

                        <div class="col-sm-12">

                            <label for="myInputThree" class="form--label-2"><?php echo app('translator')->get('Your Password'); ?></label>

                            <input type="password" id="myInputThree" name="password" placeholder="<?php echo app('translator')->get('Password'); ?>" required class="form-control form--control-2">

                        </div>



                        <?php if(reCaptcha()): ?>

                            <div class="form-group my-3">

                                <?php echo reCaptcha(); ?>

                            </div>

                        <?php endif; ?>



                        <div class="col-lg-12 form-group my-3">

                            <?php echo $__env->make($activeTemplate.'partials.custom-captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </div>



                        <div class="col-sm-12">

                            <button type="submit" class="cmn--btn w-100"><?php echo app('translator')->get('Sign In'); ?></button>

                        </div>

                    </form>

                    <div class="mt-4 text--white">

                        <span class="d-block">

                            <?php echo app('translator')->get('Forget Password'); ?> ? <a href="<?php echo e(route('user.password.request')); ?>" class="text--base"><?php echo app('translator')->get('Reset Password'); ?></a>

                        </span>

                        <span class="d-block">

                            <?php echo app('translator')->get('Don\'t Have an Account'); ?> ? <a href="<?php echo e(route('user.register')); ?>" class="text--base"><?php echo app('translator')->get('Create New'); ?></a>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Account Section -->

<?php $__env->stopSection(); ?>



<?php $__env->startPush('script'); ?>

    <script>

        function submitUserForm() {

            var response = grecaptcha.getResponse();

            if (response.length == 0) {

                document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger"><?php echo app('translator')->get("Captcha field is required"); ?></span>';

                return false;

            }

            return true;

        }

        function verifyCaptcha() {

            document.getElementById('g-recaptcha-error').innerHTML = '';

        }

    </script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make($activeTemplate.'layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/auth/login.blade.php ENDPATH**/ ?>