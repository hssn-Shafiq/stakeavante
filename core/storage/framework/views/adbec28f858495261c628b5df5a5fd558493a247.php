<?php $__env->startSection('panel'); ?>

    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content blue-bg">
                <div class="modal-header">
                    <h4 class="modal-title text-dark"><?php echo app('translator')->get('Verify Your OTP'); ?></h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>

                </div>
                <form action="<?php echo e(route('user.twofactor.enable')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" name="key" value="<?php echo e($secret); ?>">
                            <input type="text" class="form-control" name="code" placeholder="<?php echo app('translator')->get('Enter Google Authenticator Code'); ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn--success pull-right"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content blue-bg ">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo app('translator')->get('Verify Your OTP to Disable'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <form action="<?php echo e(route('user.twofactor.disable')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="code" placeholder="<?php echo app('translator')->get('Enter Google Authenticator Code'); ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--success btn-block pull-left"><?php echo app('translator')->get('Verify'); ?></button>
                        <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>



    <div class="row design-order-process">
        <div class="col-lg-6 col-sm-12 mb-10">
            <div class="faq-contact">

                <?php if(Auth::user()->ts == '1'): ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="panel-title text-center"><?php echo app('translator')->get('Two Factor Authenticator'); ?></h4>
                        </div>
                        <div class="card-body min-height-310 text-center">
                            <button type="button" class="btn btn-block btn-lg bttn btn-fill btn--danger" data-toggle="modal" data-target="#disableModal"><?php echo app('translator')->get('Disable Two Factor Authenticator'); ?></button>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="panel-title text-center"><?php echo app('translator')->get('Two Factor Authenticator'); ?></h4>
                        </div>
                        <div class="card-body text-center">
                            <div class="input-group mb-3">
                                <input type="text" name="key" value="<?php echo e($secret); ?>" class="form-control" id="code" readonly>
                                <div class="input-group-append">
                                    <button class="input-group-text bg--success border-0" id="copybtnpp"><?php echo app('translator')->get('Copy'); ?></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <img src="<?php echo e($qrCodeUrl); ?>">
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-block btn--primary" data-toggle="modal" data-target="#enableModal"><?php echo app('translator')->get('Enable Two Factor Authenticator'); ?></button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="faq-contact">
                <div class="card">
                    <div class="card-header">
                        <h4 class="panel-title"><?php echo app('translator')->get('Google Authenticator'); ?></h4>
                    </div>
                    <div class="card-body text-justify min-height-310">
                        <h3 class="mb-2"><?php echo app('translator')->get('Use Google Authenticator to Scan the QR code  or use the code'); ?></h3>
                        <p class="font-20"><?php echo e(__('Google Authenticator is a multi factor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')); ?></p>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn--primary btn-block" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank"><?php echo app('translator')->get('DOWNLOAD APP'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        document.getElementById("copybtnpp").onclick = function()
        {
            document.getElementById('code').select();
            document.execCommand('copy');
            notify('success', 'Copied successfully');
        }
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('style'); ?>
    <style>
        .min-height-310 {
            min-height: 310px !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/user/twofactor.blade.php ENDPATH**/ ?>