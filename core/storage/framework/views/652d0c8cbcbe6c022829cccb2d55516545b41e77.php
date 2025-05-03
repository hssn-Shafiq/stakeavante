<?php $__env->startSection('panel'); ?>
    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('SL'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Date'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('TRX'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Charge'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Post Balance'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Detail'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="<?php echo app('translator')->get('SL'); ?>"><?php echo e($transactions->firstItem()+$loop->index); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Date'); ?>"><?php echo e(showDateTime($trx->created_at)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('TRX'); ?>" class="font-weight-bold"><?php echo e($trx->trx); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Amount'); ?>" class="budget">
                                        <strong <?php if($trx->trx_type == '+'): ?> class="text-success"
                                                <?php else: ?> class="text-danger" <?php endif; ?>> <?php echo e(($trx->trx_type == '+') ? '+':'-'); ?> <?php echo e(getAmount($trx->amount)); ?> <?php echo e($general->cur_text); ?></strong>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Charge'); ?>"
                                        class="budget"><?php echo e($general->cur_sym); ?> <?php echo e(getAmount($trx->charge)); ?> </td>
                                    <td data-label="<?php echo app('translator')->get('Post Balance'); ?>"><?php echo e($trx->post_balance +0); ?> <?php echo e($general->cur_text); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Detail'); ?>"><?php echo e(__($trx->details)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo e(__($empty_message)); ?></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <?php echo e($transactions->appends($_GET)->links()); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Search by TRX'); ?>" value="<?php echo e($search ?? ''); ?>">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
<?php $__env->stopPush(); ?>


<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/user/transactions.blade.php ENDPATH**/ ?>