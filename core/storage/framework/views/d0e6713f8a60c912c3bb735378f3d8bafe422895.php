

<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Date'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Transaction'); ?></th>
                                    <th><?php echo app('translator')->get('Post Balance'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $profits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td data-label="<?php echo app('translator')->get('Date'); ?>"><?php echo e(showDateTime($data->created_at)); ?></td>                                        <td data-label="<?php echo app('translator')->get('Amount'); ?>">
                                            <span class="font-weight-bold text-success">
                                                + <?php echo e(getAmount($data->amount ?? $data->profit)); ?> <?php echo e($general->cur_text); ?>

                                            </span>
                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Transaction'); ?>">
                                            <span class="badge badge--success"><?php echo app('translator')->get('Daily Profit'); ?></span>
                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Post Balance'); ?>">
                                            <?php echo e(getAmount($data->user->balance)); ?> <?php echo e($general->cur_text); ?>

                                        </td>
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
                    <?php echo e($profits->links('admin.partials.paginate')); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\techSphereLogix\stakeavante\core\resources\views/templates/basic/user/profit_history.blade.php ENDPATH**/ ?>