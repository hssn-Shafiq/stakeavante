<?php $__env->startSection('panel'); ?>
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-10 col-xxl-7">
                <div class="card card-deposit text-center">
                    <div class="card-body card-body-deposit card-body p-0 p-sm-4">
                        <div class="deposit-preview">
                            <div class="deposit-thumb">
                                <img class="" src="<?php echo e($data->gateway_currency()->methodImage()); ?>" />
                            </div>
                            <div class="deposit-content">
                                <ul class="mb-3">
                                    <li>
                                        <?php echo app('translator')->get('Amount'); ?>:
                                        <b class="fw-bolder"><span class="text--success"><?php echo e(getAmount($data->amount)); ?> </span> <?php echo e($general->cur_text); ?></b>
                                    </li>
                                    <li>
                                        <?php echo app('translator')->get('Charge'); ?>:
                                        <b class="fw-bolder"><span class="text--danger"><?php echo e(getAmount($data->charge)); ?></span> <?php echo e($general->cur_text); ?></b>
                                    </li>
                                    <li>
                                        <?php echo app('translator')->get('Payable'); ?>:
                                        <b class="fw-bolder"><span class="text--warning"> <?php echo e(getAmount($data->amount + $data->charge)); ?></span> <?php echo e($general->cur_text); ?></b>
                                    </li>
                                    <li>
                                        <?php echo app('translator')->get('Conversion Rate'); ?>:
                                        <b class="fw-bolder"><span class="text--info">1 <?php echo e($general->cur_text); ?> = <?php echo e(getAmount($data->rate)); ?>  <?php echo e($data->baseCurrency()); ?></span></b>
                                    </li>
                                    <li>
                                        <?php echo app('translator')->get('In'); ?> <?php echo e($data->baseCurrency()); ?>:
                                        <b class="fw-bolder"><span class="text--primary"text--primary><?php echo e(getAmount($data->final_amo)); ?></span></b>
                                    </li>
                                    <?php if($data->gateway->crypto==1): ?>
                                        <li>
                                            <?php echo app('translator')->get('Conversion with'); ?>
                                            <b> <?php echo e($data->method_currency); ?></b> <?php echo app('translator')->get('and final value will show on next step'); ?>
                                        </li>
                                    <?php endif; ?>
                                </ul>

                        <?php if( 1000 >$data->method_code): ?>
                        <a href="<?php echo e(route('user.deposit.confirm')); ?>" class="btn btn--success btn-block py-3 font-weight-bold"><?php echo app('translator')->get('Confirm Deposit'); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(route('user.deposit.manual.confirm')); ?>" class="btn btn--success btn-block py-3 font-weight-bold"><?php echo app('translator')->get('Confirm Deposit'); ?></a>
                    <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/payment/preview.blade.php ENDPATH**/ ?>