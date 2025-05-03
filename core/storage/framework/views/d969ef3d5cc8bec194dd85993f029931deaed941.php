<?php $__env->startSection('panel'); ?>
    <div class="row  mt-2">
        <?php $__currentLoopData = $withdrawMethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-4 col-xxl-3 col-lg-6 col-md-5 col-sm-6 mb-4">
                <div class="card card-deposit method-card">
                    <h5 class="card-header text-center"><?php echo e(__($data->name)); ?></h5>
                    <div class="card-body card-body-deposit">
                        <img src="<?php echo e(getImage(imagePath()['withdraw']['method']['path'].'/'. $data->image)); ?>"
                                class="card-img-top w-100" alt="<?php echo e(__($data->name)); ?>">
                            <div class="deposit-content mt-4">
                                <ul  class="text-center font-15 ">
                                    <li>
                                        <?php echo app('translator')->get('Limit'); ?>
                                        : <span class="text--success"> <?php echo e(getAmount($data->min_limit)); ?>

                                            - <?php echo e(getAmount($data->max_limit)); ?> <?php echo e($general->cur_text); ?></li></span>

                                    <li>
                                         <?php echo app('translator')->get('Charge'); ?> -
                                        <span class="text--danger">
                                            <?php echo e(getAmount($data->fixed_charge)); ?> <?php echo e($general->cur_text); ?>

                                        + <?php echo e(getAmount($data->percent_charge)); ?>%
                                        </span>
                                    </li>
                                    <li>
                                        <?php echo app('translator')->get('Processing Time'); ?>
                                        - <span class="text--info">
                                            <?php echo e($data->delay); ?></li>
                                        </span>
                                </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="javascript:void(0)"  data-id="<?php echo e($data->id); ?>"
                            data-resource="<?php echo e($data); ?>"
                            data-min_amount="<?php echo e(getAmount($data->min_limit)); ?>"
                            data-max_amount="<?php echo e(getAmount($data->max_limit)); ?>"
                            data-fix_charge="<?php echo e(getAmount($data->fixed_charge)); ?>"
                            data-percent_charge="<?php echo e(getAmount($data->percent_charge)); ?>"
                            data-base_symbol="<?php echo e($general->cur_text); ?>"
                            class="btn btn-block  btn--success deposit" data-toggle="modal" data-target="#exampleModal">
                            <?php echo app('translator')->get('Withdraw Now'); ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title method-name" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('user.withdraw.money')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="currency"  class="edit-currency form-control" value="">
                            <input type="hidden" name="method_code" class="edit-method-code  form-control" value="">
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Enter Amount'); ?>:</label>
                            <div class="input-group">
                                <input id="amount" type="text" class="form-control form-control-lg" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount" placeholder="0.00" required=""  value="<?php echo e(old('amount')); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text currency-addon"><?php echo e(__($general->cur_text)); ?></span>
                                </div>
                            </div>
                        </div>
                        <p class="text-danger text-center depositLimit"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn--success"><?php echo app('translator')->get('Confirm'); ?></button>
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
            $('.deposit').on('click', function () {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var depositLimit = `<?php echo app('translator')->get('Withdraw Limit:'); ?> ${minAmount} - ${maxAmount}  <?php echo e($general->cur_text); ?>`;
                $('.depositLimit').text(depositLimit);
                var depositCharge = `<?php echo app('translator')->get('Charge:'); ?> ${fixCharge} <?php echo e($general->cur_text); ?> ${(0 < percentCharge) ? ' + ' + percentCharge + ' %' : ''}`
                $('.depositCharge').text(depositCharge);
                $('.method-name').text(`<?php echo app('translator')->get('Withdraw Via '); ?> ${result.name}`);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.id);
            });
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/user/withdraw/methods.blade.php ENDPATH**/ ?>