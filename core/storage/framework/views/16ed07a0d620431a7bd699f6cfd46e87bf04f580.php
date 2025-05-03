<?php $__env->startSection('panel'); ?>
    <div class="row">
        <?php $__currentLoopData = $gatewayCurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($data->method_code!=1001): ?>
         
            <div class="col-xl-4 col-xxl-3 col-lg-6 col-md-5 col-sm-6 mb-4">
                <div class="card card-deposit">
            <h5 class="card-header text-center"><?php echo e(__($data->name)); ?>

                    </h5>
                    <div class="card-body card-body-deposit">
                        <img src="<?php echo e($data->methodImage()); ?>" class="card-img-top depo" alt="<?php echo e(__($data->name)); ?>">
                    </div>
                    <div class="card-footer">
                        <a href="javascript:void(0)"  data-id="<?php echo e($data->id); ?>" data-resource="<?php echo e($data); ?>"
                            data-min_amount="<?php echo e(getAmount($data->min_amount)); ?>"
                            data-max_amount="<?php echo e(getAmount($data->max_amount)); ?>"
                            data-base_symbol="<?php echo e($data->baseSymbol()); ?>"
                            data-fix_charge="<?php echo e(getAmount($data->fixed_charge)); ?>"
                            data-percent_charge="<?php echo e(getAmount($data->percent_charge)); ?>" class=" btn  btn--success btn-block custom-success deposit" data-toggle="modal" data-target="#depositModal">
                            <?php echo app('translator')->get('Deposit Now'); ?></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="modal fade" id="depositModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title method-name"></strong>
                    <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <form action="<?php echo e(route('user.deposit.insert')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <h4 class="text-danger depositLimit"></h4>
                        <h4 class="text-danger depositCharge"></h4>
                        <div class="form-group">
                            <input type="hidden" name="currency" class="edit-currency" value="">
                            <input type="hidden" name="method_code" class="edit-method-code" value="">
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Enter Amount'); ?>:</label>
                            <div class="input-group">
                                <input id="amount" type="text" class="form-control form-control-lg" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount" placeholder="0.00" required  value="<?php echo e(old('amount')); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text currency-addon addon"><?php echo e($general->cur_text); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-block btn-lg btn--success"><?php echo app('translator')->get('Submit'); ?></button>
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
            $('.deposit').on('click', function () {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var baseSymbol = "<?php echo e($general->cur_text); ?>";
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var depositLimit = `<?php echo app('translator')->get('Deposit Limit:'); ?> ${minAmount} - ${maxAmount}  ${baseSymbol}`;
                $('.depositLimit').text(depositLimit);
                var depositCharge = `<?php echo app('translator')->get('Charge:'); ?> ${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' +percentCharge + ' % ' : ''}`;
                $('.depositCharge').text(depositCharge);
                $('.method-name').text(`<?php echo app('translator')->get('Payment By '); ?> ${result.name}`);
                $('.currency-addon').text(baseSymbol);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.method_code);
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/user/payment/deposit.blade.php ENDPATH**/ ?>