<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="<?php echo e(route('admin.email.template.setting')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Sending Method'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <select name="email_method" class="form-control" >
                                    <option value="php" <?php if($general_setting->mail_config->name == 'php'): ?> selected <?php endif; ?>><?php echo app('translator')->get('PHP Mail'); ?></option>
                                    <option value="smtp" <?php if($general_setting->mail_config->name == 'smtp'): ?> selected <?php endif; ?>><?php echo app('translator')->get('SMTP'); ?></option>
                                    <option value="sendgrid" <?php if($general_setting->mail_config->name == 'sendgrid'): ?> selected <?php endif; ?>><?php echo app('translator')->get('SendGrid API'); ?></option>
                                    <option value="mailjet" <?php if($general_setting->mail_config->name == 'mailjet'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Mailjet API'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 d-none configForm" id="smtp"></div>

                        <div class="mt-4 d-none configForm" id="sendgrid"> </div>

                        <div class="mt-4 d-none configForm" id="mailjet"></div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn--primary mr-2"><?php echo app('translator')->get('Update'); ?></button>
                    </div>
                </form>
            </div><!-- card end -->
        </div>
    </div>


    
    <div id="testMailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Sending Test Mail'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?php echo e(route('admin.email.template.sendTestMail')); ?>" method="POST">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="font-weight-bold" for="mail-to"><?php echo app('translator')->get('To'); ?></label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="email" id="mail-to" class="form-control" placeholder="<?php echo app('translator')->get('Email Address'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn text--small btn--success"><?php echo app('translator')->get('Send'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function ($) {
            var method = $('select[name=email_method]').val();
            config(method);
            $('select[name=email_method]').on('change', function() {
                config($(this).val());
            });

            function config(method){
                $('.configForm').hide('300');
                $('.configForm').html('');

                if(method=='smtp'){
                    $(`#sendgrid`).html('');
                    $(`#mailjet`).html('');
                    $(`#${method}`).html(`<h4 class="border-bottom pb-2 mb-4"><?php echo app('translator')->get('Configuration'); ?></h4>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="font-weight-bold"><?php echo app('translator')->get('Host'); ?></label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('e.g. smtp.googlemail.com'); ?>" name="host" value="<?php echo e($general_setting->mail_config->host ?? ''); ?>" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="font-weight-bold"><?php echo app('translator')->get('Port'); ?></label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Available port'); ?>" name="port" value="<?php echo e($general_setting->mail_config->port ?? ''); ?>" required/>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="enc"><?php echo app('translator')->get('Encryption'); ?></label>
                                </div>
                                <div class="col-md-10">
                                    <select class="custom-select" name="enc" id="enc">
                                        <option null selected><?php echo app('translator')->get('Select one'); ?></option>
                                        <option value="ssl" <?php echo e(@$general_setting->mail_config->enc == 'ssl'?'selected':''); ?>><?php echo app('translator')->get('SSL'); ?></option>
                                        <option value="tls" <?php echo e(@$general_setting->mail_config->enc == 'tls'?'selected':''); ?>><?php echo app('translator')->get('TLS'); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="font-weight-bold"><?php echo app('translator')->get('Username'); ?></label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('May be your email address'); ?>" name="username" value="<?php echo e($general_setting->mail_config->username ?? ''); ?>" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="font-weight-bold"><?php echo app('translator')->get('Password'); ?></label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('May be your email password'); ?>" name="password" value="<?php echo e($general_setting->mail_config->password ?? ''); ?>" required/>
                                </div>
                            </div>`)
                    $(`#${method}`).removeClass('d-none').hide().show(300);

                }

                if(method=='sendgrid'){
                    $(`#smtp`).html('');
                    $(`#mailjet`).html('');
                    $(`#${method}`).removeClass('d-none');
                    $(`#${method}`).html(`<h4 class="border-bottom pb-2 mb-4"><?php echo app('translator')->get('Configuration'); ?></h4>
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <label class="font-weight-bold"><?php echo app('translator')->get('APP KEY'); ?></label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('SendGrid app key'); ?>" name="appkey" value="<?php echo e($general_setting->mail_config->appkey ?? ''); ?>" required/>
                                                </div>
                                            </div>
                                        `);
                    $(`#${method}`).removeClass('d-none').hide().show(300);
                }
                if(method=='mailjet'){
                    $(`#smtp`).html('');
                    $(`#sendgrid`).html('');

                    $(`#${method}`).html(` <h4 class="border-bottom pb-2 mb-4"><?php echo app('translator')->get('Configuration'); ?></h4>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <label class="font-weight-bold"><?php echo app('translator')->get('API PUBLIC KEY'); ?></label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Mailjet API PUBLIC KEY'); ?>" name="public_key" value="<?php echo e($general_setting->mail_config->public_key ?? ''); ?>" required/>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <label class="font-weight-bold"><?php echo app('translator')->get('API SECRET KEY'); ?></label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Mailjet API SECRET KEY'); ?>" name="secret_key" value="<?php echo e($general_setting->mail_config->secret_key ?? ''); ?>" required/>
                                                    </div>
                                                </div>`
                                            );

                    $(`#${method}`).removeClass('d-none').hide().show(300);
                }
            }
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
<button type="button" data-target="#testMailModal" data-toggle="modal" class="btn btn-sm btn--primary box--shadow1 text--small">
    <?php echo app('translator')->get('Send Test Mail'); ?>
</button>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/email_template/email_setting.blade.php ENDPATH**/ ?>