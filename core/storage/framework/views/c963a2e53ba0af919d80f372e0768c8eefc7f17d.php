<?php $__env->startSection('panel'); ?>
<div class="row mb-30">
<div class="col-lg-12 col-md-12 mb-30">
<div class="card">
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"> <?php echo app('translator')->get('Site Title'); ?> </label>
                        <input class="form-control form-control-lg" type="text" name="sitename" value="<?php echo e($general->sitename); ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Currency'); ?></label>
                        <input class="form-control  form-control-lg" type="text" name="cur_text"
                               value="<?php echo e($general->cur_text); ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Currency Symbol'); ?></label>
                        <input class="form-control  form-control-lg" type="text" name="cur_sym" value="<?php echo e($general->cur_sym); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Secondary Currency'); ?></label>
                        <input class="form-control  form-control-lg" type="text" name="sec_cur_text"
                               value="<?php echo e($general->sec_cur_text); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Secondary Currency Symbol'); ?></label>
                        <input class="form-control  form-control-lg" type="text" name="sec_cur_sym"
                               value="<?php echo e($general->sec_cur_sym); ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Balance Transfer Carge'); ?> (<?php echo app('translator')->get('Fixed'); ?>)</label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="bal_trans_fixed_charge" value="<?php echo e(getAmount($general->bal_trans_fixed_charge)); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text"><?php echo e($general->cur_text); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Balance Transfer Carge'); ?> (<?php echo app('translator')->get('Percent'); ?>)</label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="bal_trans_per_charge" value="<?php echo e(getAmount($general->bal_trans_per_charge)); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Free Coin Limit'); ?></label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="coin_limit" value="<?php echo e(getAmount($general->coin_limit)); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">USDT</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Free Coin Commission'); ?></label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="coin_commission" value="<?php echo e(getAmount($general->coin_commission)); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">USDT</span>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Free Coin Daily'); ?></label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="coin_daily" value="<?php echo e(getAmount($general->coin_daily)); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">USDT</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Free Coin Multiple'); ?></label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="coin_multiple" value="<?php echo e(getAmount($general->coin_multiple)); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">USDT</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Site Base Color'); ?></label>
                    <div class="input-group">
                    <span class="input-group-addon ">
                        <input type='text' class="form-control  form-control-lg colorPicker"
                               value="<?php echo e($general->base_color); ?>"/>
                    </span>
                        <input type="text" class="form-control form-control-lg colorCode" name="base_color"
                               value="<?php echo e($general->base_color); ?>"/>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="form-control-label font-weight-bold"> <?php echo app('translator')->get('Site Secondary Color'); ?></label>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <input type='text' class="form-control form-control-lg colorPicker" value="<?php echo e($general->secondary_color); ?>"/>
                    </span>
                        <input type="text" class="form-control form-control-lg colorCode" name="secondary_color" value="<?php echo e($general->secondary_color); ?>"/>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('User Registration'); ?></label>
                        <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="<?php echo app('translator')->get('Disabled'); ?>" name="registration" <?php if($general->registration): ?> checked <?php endif; ?>>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Force Secure Password'); ?></label>
                        <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="<?php echo app('translator')->get('Disabled'); ?>" name="secure_password" <?php if($general->secure_password): ?> checked <?php endif; ?>>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Force SSL'); ?></label>
                        <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="<?php echo app('translator')->get('Disabled'); ?>" name="force_ssl" <?php if($general->force_ssl): ?> checked <?php endif; ?>>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Agree Policy on Registration'); ?></label>
                        <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="<?php echo app('translator')->get('Disabled'); ?>" name="agree_policy" <?php if($general->agree_policy): ?> checked <?php endif; ?>>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Email Verification'); ?></label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="Disable" name="ev" <?php if($general->ev): ?> checked <?php endif; ?>>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Email Notification'); ?></label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="Disable" name="en" <?php if($general->en): ?> checked <?php endif; ?>>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('SMS Verification'); ?></label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="Disable" name="sv" <?php if($general->sv): ?> checked <?php endif; ?>>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('SMS Notification'); ?></label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="Disable" name="sn" <?php if($general->sn): ?> checked <?php endif; ?>>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Crypto Widget'); ?></label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="Disable" name="cryp_widget" <?php if($general->cryp_widget): ?> checked <?php endif; ?>>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Crypto Calculator'); ?></label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="Disable" name="cryp_calculator" <?php if($general->cryp_calculator): ?> checked <?php endif; ?>>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Profit'); ?></label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="Disable" name="profit" <?php if($general->profit_status): ?> checked <?php endif; ?>>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Reward'); ?></label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="Disable" name="reward" <?php if($general->reward_status): ?> checked <?php endif; ?>>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn--primary btn-block btn-lg"><?php echo app('translator')->get('Update'); ?></button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-lib'); ?>
<script src="<?php echo e(asset('assets/admin/js/spectrum.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/spectrum.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('style'); ?>
<style>
.sp-replacer {
padding: 0;
border: 1px solid rgba(0, 0, 0, .125);
border-radius: 5px 0 0 5px;
border-right: none;
}

.sp-preview {
width: 100px;
height: 46px;
border: 0;
}

.sp-preview-inner {
width: 110px;
}

.sp-dd {
display: none;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
'use strict';
(function($){
$('.colorPicker').spectrum({
    color: $(this).data('color'),
    change: function (color) {
        $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
    }
});

$('.colorCode').on('input', function () {
    var clr = $(this).val();
    $(this).parents('.input-group').find('.colorPicker').spectrum({
        color: clr,
    });
});
})(jQuery)

</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/setting/general_setting.blade.php ENDPATH**/ ?>