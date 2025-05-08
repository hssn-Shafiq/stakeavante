<?php $__env->startSection('panel'); ?>
<?php
$policyElements =  getContent('policy_pages.element');
?>
<!-- Account Section -->
<div class="account-section ">
    <div class="account__section-wrapper">
        <div class="account__section-content sign-up">
            <div class="w-100">
                <div class="logo mb-4">
                    <a href="<?php echo e(route('home')); ?>">
                        <img src="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/darkmainlogo.png')); ?>" alt="<?php echo app('translator')->get('site-logo'); ?>">
                    </a>
                </div>
                <div class="section__header  mb-4">
                    <h5 class="section__title mb-0 "><?php echo app('translator')->get('Sign Up'); ?></h5>
                </div>
                <form class="account--form row gy-3" method="post" action="<?php echo e(route('user.register')); ?>" onsubmit="return submitUserForm();">
                    <?php echo csrf_field(); ?>
            <?php if(session()->get('sponsor') != null): ?>
            <div class="col-sm-6">
                <label for="reg_name" class="form--label-2"><?php echo app('translator')->get('Referal User ID'); ?></label>
                <input type="text" name="registrant" class="referral form-control form--control-2 check_referal" id="reg_name" value="<?php echo e($sponsorId->username); ?>" placeholder="<?php echo app('translator')->get('Enter Referal User ID'); ?>*" required>
                <p class="referal_msg"></p>
                <span class="text-success"><?php echo $addedBy; ?></span>
            </div>
            <?php if(session()->get('position') != null): ?>
            <div class="col-sm-6">
                <label for="ref_name" class="form--label-2"><?php echo app('translator')->get('Network Tree ID'); ?></label>
                <input type="text" name="referral" class="referral form-control form--control-2 check_referal" id="ref_name" value="<?php echo e($treeId->username); ?>" placeholder="<?php echo app('translator')->get('Enter Network Tree ID'); ?>*" required>
                <p class="tree_msg"></p>
                <span class="text-success"><?php echo $joining; ?></span>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <div class="col-sm-6">
                <label for="firstname" class="form--label-2"><?php echo app('translator')->get('First Name'); ?></label>
                <input type="text" name="firstname" id="firstname" value="<?php echo e(old('firstname')); ?>" autocomplete="off" placeholder="<?php echo app('translator')->get('First Name'); ?>" required class="form-control form--control-2">
            </div>
            <div class="col-sm-6">
                <label for="lastname" class="form--label-2"><?php echo app('translator')->get('Last Name'); ?></label>
                <input type="text" name="lastname" id="lastname" value="<?php echo e(old('lastname')); ?>" placeholder="<?php echo app('translator')->get('Last Name'); ?>" required class="form-control form--control-2">
            </div>
            <div class="col-sm-6">
                <label for="email" class="form--label-2"><?php echo app('translator')->get('Email'); ?></label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo app('translator')->get('Email'); ?>" required class="form-control form--control-2">
            </div>
            <div class="col-sm-6">
                <label for="email" class="form--label-2"><?php echo app('translator')->get('Phone Number'); ?></label>
                <div class="input-group input-group-custom">
                    <div class="input-group-prepend">
                        <select name="country_code" class="input-group-text form-control form--control-2">
                            <?php echo $__env->make('partials.country_code', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </select>
                    </div>
                    <input type="text" class="form-control form--control-2" name="mobile" placeholder="<?php echo app('translator')->get('Phone Number'); ?>" required>
                </div>
            </div>
            <div class="col-sm-6 hover-input-popup">
                <label for="password" class="form--label-2"><?php echo app('translator')->get('Password'); ?></label>
                <input type="password" id="password" name="password" placeholder="<?php echo app('translator')->get('Password'); ?>" class="form-control form--control-2">
                <?php if($general->secure_password): ?>
                <div class="input-popup">
                    <p class="text-danger my-1 capital"><?php echo app('translator')->get('At least 1 capital letter is required'); ?></p>
                    <p class="text-danger my-1 number"><?php echo app('translator')->get('At least 1 number is required'); ?></p>
                    <p class="text-danger my-1 special"><?php echo app('translator')->get('At least 1 special character is required'); ?></p>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-6">
                <label for="password_confirmation" class="form--label-2"><?php echo app('translator')->get('Confirm Password'); ?></label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="<?php echo app('translator')->get('Confirm Password'); ?>"  class="form-control form--control-2">
            </div>
            <?php if(reCaptcha()): ?>
                <div class="col-lg-12">
                    <?php echo reCaptcha(); ?>
                </div>
            <?php endif; ?>
            <div class="col-lg-12">
                <?php echo $__env->make($activeTemplate.'partials.custom-captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php if($general->agree_policy): ?>
                <div class="col-md-12">
                    <div class="d-flex flex-wrap justify-content-between">
                        <div class="checkgroup d-flex flex-wrap align-items-center">
                            <input type="checkbox" class="border-0" id="agree" name="agree">
                            &nbsp;
                            <label for="agree" class="m-0 pl-2 "><?php echo app('translator')->get('I agree with'); ?>&nbsp;</label>
                            <?php $__currentLoopData = $policyElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('policy.details',[slug(@$item->data_values->title),$item->id])); ?>" class="text--base"> <?php echo e(__($item->data_values->title)); ?> </a> <?php if(!$loop->last): ?> ,&nbsp; <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-sm-12">
                <button type="submit" class="cmn--btn w-100"><?php echo app('translator')->get('Sign Up'); ?></button>
            </div>
            </form>
            <div class="mt-4 text--white">
                <span class="d-block">
                    <?php echo app('translator')->get('Already Have an Account'); ?> ? <a href="<?php echo e(route('user.login')); ?>" class="text--base"><?php echo app('translator')->get('Sign In'); ?></a>
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
    (function($) {
        "use strict";
        $(document).on('blur', '.check_referal', function() {
            var ref_id = $('#ref_name').val();
            var reg_id = $('#reg_name').val();
            var token = "<?php echo e(csrf_token()); ?>";
            $.ajax({
                type: "POST",
                url: "<?php echo e(route('check.referral')); ?>",
                data: {
                    'ref_id': ref_id,
                    'reg_id' : reg_id,
                    '_token': token
                },
                success: function(data) {
                    if(data.success && data.field==1){
                        $('.tree_msg').html('');
                        $('.referal_msg').html(data.msg);
                    }
                    else if (data.success && data.field==2) {
                        $('.referal_msg').html();
                        $('.tree_msg').html(data.msg);
                    }
                    else if (data.success==false && data.field==1){
                      $('.tree_msg').html('');
                        $('.referal_msg').html(data.msg);
                    } else if (data.success==false && data.field==2)
                    {
                      $('.referal_msg').html();
                      $('.tree_msg').html(data.msg);
                    }else{
                        alert('Some Error');
                    }
                }
            });
        });
        <?php if(@$country_code): ?>
        $(`option[data-code=<?php echo e($country_code); ?>]`).attr('selected', '');
        <?php endif; ?>
        $('select[name=country_code]').change(function() {
            $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
        }).change();
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;"><?php echo app('translator')->get("Captcha field is required."); ?></span>';
                return false;
            }
            return true;
        }
        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
        <?php if($general -> secure_password): ?>
        $('input[name=password]').on('input', function() {
            var password = $(this).val();
            var capital = /[ABCDEFGHIJKLMNOPQRSTUVWXYZ]/;
            var capital = capital.test(password);
            if (!capital) {
                $('.capital').removeClass('text--success');
            } else {
                $('.capital').addClass('text--success');
            }
            var number = /[123456790]/;
            var number = number.test(password);
            if (!number) {
                $('.number').removeClass('text--success');
            } else {
                $('.number').addClass('text--success');
            }
            var special = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            var special = special.test(password);
            if (!special) {
                $('.special').removeClass('text--success');
            } else {
                $('.special').addClass('text--success');
            }
        });
        <?php endif; ?>
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('style'); ?>
<style>
    .form-control:disabled,
    .form-control[readonly] {
        background-color: transparent !important;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate.'layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/user/auth/register.blade.php ENDPATH**/ ?>