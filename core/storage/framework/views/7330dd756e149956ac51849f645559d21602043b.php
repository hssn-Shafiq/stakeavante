
<?php $__env->startSection('panel'); ?>
    <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title font-weight-normal"><?php echo app('translator')->get('Balance Transfer'); ?></h4>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="alert block-none alert-danger p-2" role="alert">
                            <strong><?php echo app('translator')->get('Balance Transfer Charge'); ?> <?php echo e(getAmount($general->bal_trans_fixed_charge)); ?> <?php echo e(__($general->cur_text)); ?> <?php echo app('translator')->get('Fixed and'); ?>  <?php echo e(getAmount($general->bal_trans_per_charge)); ?>

                                % <?php echo app('translator')->get('of your total amount to transfer balance.'); ?></strong>
                            <p id="after-balance"></p>
                        </div>
                    </div>
                    <form class="contact-form"  method="POST" action="<?php echo e(route('user.balance.transfer.post')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                      <label> <h5>  <?php echo app('translator')->get('Username / Email To Send Amount'); ?>  <span class="text-danger">*</span> </h5></label>
                                    <input type="text" class="form-control form-control-lg" id="username" name="username"
                                           placeholder="<?php echo app('translator')->get('username / email'); ?>" required autocomplete="off">
                                    <span id="position-test"></span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="InputMail">
                                        <h5><?php echo app('translator')->get('Transfer Amount'); ?><span class="requred">*</span> </h5>
                                    </label>
                                    <input onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"  class="form-control form-control-lg" autocomplete="off" id="amount" name="amount" placeholder="<?php echo app('translator')->get('Amount'); ?> <?php echo e(__($general->cur_text)); ?>" required>
                                    <span id="balance-message"></span>
                                </div>
                                <!-- <div class="form-group col-md-12">
                                    <label for="InputOtp">
                                        <h5><?php echo app('translator')->get('Enter OTP'); ?><span class="requred">*</span> </h5>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control form-control-lg" autocomplete="off"  name="otp" id="otp-field" placeholder="<?php echo app('translator')->get('Enter OTP'); ?>" disabled required>
                                        <div class="input-group-append">
                                        <span class="input-group-text"><?php echo app('translator')->get('OR '); ?>&nbsp;&nbsp;<button type="button" id="otp"  class="btn btn--danger mr-2"><?php echo app('translator')->get('Send OTP'); ?></button></span></div>
                                    </div>
                                    <span id="otp-message"></span>
                                </div> -->
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group col-md-12 text-center">
                                <button type="submit" class=" btn btn-block btn--primary mr-2" id="transfer-btn"><?php echo app('translator')->get('Transfer Balance'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        (function($){
            $(document).on('keyup', '#username', function () {
                var username = $('#username').val();
                var token = "<?php echo e(csrf_token()); ?>";
                if(username){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(route('user.search.user')); ?>",
                        data: {
                            'username': username,
                            '_token': token
                        },
                        success: function (data) {
                            if (data.success) {
                                $('#position-test').html('<div class="text--success mt-1"><?php echo app('translator')->get("You are transfering amount to '+data.username+' ."); ?></div>');
                            } else {
                                $('#position-test').html('<div class="text--danger mt-2"><?php echo app('translator')->get("User not found"); ?></div>');
                            }
                        }
                    });
                }else{
                    $('#position-test').html('');
                }
            });
            $(document).on('keyup', '#amount', function () {
                var amount = parseFloat($('#amount').val()) ;
                var balance = parseFloat("<?php echo e(Auth::user()->balance+0); ?>");
                var fixed_charge = parseFloat("<?php echo e($general->bal_trans_fixed_charge+0); ?>");
                var percent_charge = parseFloat("<?php echo e($general->bal_trans_per_charge+0); ?>");
                var percent = (amount * percent_charge) / 100;
                var with_charge = amount+fixed_charge+percent;
                if(with_charge > balance)
                {
                    $('#after-balance').html('<p  class="text-danger">' + with_charge  + ' <?php echo e($general->cur_text); ?> ' + ' <?php echo e(__('will be subtracted from your balance')); ?>' + '</p>');
                    $('#balance-message').html('<small class="text-danger">Insufficient Balance!</small>');
                } else if (with_charge <= balance) {
                    $('#after-balance').html('<p class="text-danger">' + with_charge  + ' <?php echo e($general->cur_text); ?> ' + ' <?php echo e(__('will be subtracted from your balance')); ?>' + '</p>');
                    $('#balance-message').html('');
                }
            });
             $(document).on('click', '#otp', function () {
                var id = parseInt("<?php echo e(Auth::user()->id); ?>");
                var token = "<?php echo e(csrf_token()); ?>";
                if(token){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(route('user.otp-send')); ?>",
                        data: {
                            'id':id,
                            '_token': token
                        },
                        success: function (data) {
                            if (data.success) {
                                $('#otp-field').attr('disabled',false);
                                $('#transfer-btn').attr('disabled',false);
                                $('#otp').text('<?php echo app('translator')->get("Re Send OTP"); ?>');
                                $('#otp-message').html('<div class="text--success mt-1"><?php echo app('translator')->get("An Otp is send to your email Please copy,paste in otp field to process the transfer."); ?></div>');
                            } else {
                                $('#otp-message').html('<div class="text--danger mt-2"><?php echo app('translator')->get("Cannot send an Otp"); ?></div>');
                            }
                        }
                    });
                }else{
                    $('#otp-message').html('');
                }
            });
        $(document).on('keyup', '#otp-field', function () {
                var otp = $('#otp-field').val();
                var token = "<?php echo e(csrf_token()); ?>";
                if(otp){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(route('user.verify-otp')); ?>",
                        data: {
                            'otp': otp,
                            '_token': token
                        },
                        success: function (data) {
                            if (data.success) {
                                $('#transfer-btn').attr('disabled',false);
                                $('#otp-message').html('<div class="text--success mt-1"><?php echo app('translator')->get("Otp verified"); ?></div>');
                            } else {
                                $('#transfer-btn').attr('disabled',true);
                                $('#otp-message').html('<div class="text--danger mt-2"><?php echo app('translator')->get("Otp invalid.Try again"); ?></div>');
                            }
                        }
                    });
                }else{
                    $('#position-test').html('');
                }
            });
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\techSphereLogix\stakeavante\core\resources\views/templates/basic//user/balanceTransfer.blade.php ENDPATH**/ ?>