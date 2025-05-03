<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('Transaction ID'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Gateway'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Charge'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('After Charge'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Rate'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Receivable'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Time'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="#<?php echo app('translator')->get('Trx'); ?>"><?php echo e($data->trx); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Gateway'); ?>"><?php echo e($data->method->name); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Amount'); ?>">
                                        <strong><?php echo e(getAmount($data->amount)); ?> <?php echo e($general->cur_text); ?></strong>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Charge'); ?>" class="text--danger">
                                        <?php echo e(getAmount($data->charge)); ?> <?php echo e($general->cur_text); ?>

                                    </td>
                                    <td data-label="<?php echo app('translator')->get('After Charge'); ?>">
                                        <?php echo e(getAmount($data->after_charge)); ?> <?php echo e($general->cur_text); ?>

                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Rate'); ?>">
                                        <?php echo e(getAmount($data->rate)); ?> <?php echo e($data->currency); ?>

                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Receivable'); ?>" class="text--success">
                                        <strong><?php echo e(getAmount($data->final_amount)); ?> <?php echo e($data->currency); ?></strong>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                        <?php if($data->status == 2): ?>
                                            <span class="badge badge--warning"><?php echo app('translator')->get('Pending'); ?></span>
                                        <?php elseif($data->status == 1): ?>
                                            <span class="badge badge--success"><?php echo app('translator')->get('Completed'); ?></span>
                                            <button class="btn-info btn-rounded  badge approveBtn"
                                                    data-admin_feedback="<?php echo e($data->admin_feedback); ?>"><i
                                                    class="fa fa-info"></i></button>
                                        <?php elseif($data->status == 3): ?>
                                            <span class="badge badge--danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                            <button class="btn-info btn-rounded badge approveBtn"
                                                    data-admin_feedback="<?php echo e($data->admin_feedback); ?>"><i
                                                    class="fa fa-info"></i></button>
                                        <?php endif; ?>

                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Time'); ?>">
                                        <i class="las la-calendar"></i> <?php echo e(showDateTime($data->created_at)); ?>

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
                    <?php echo e($withdraws->appends($_GET)->links()); ?>

                </div>
            </div>
        </div>
    </div>

    
    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Details'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="withdraw-detail"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        (function($){
            $('.approveBtn').on('click', function () {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');

                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Search by TRX'); ?>"
                   value="<?php echo e($search ?? ''); ?>">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
<?php $__env->stopPush(); ?>


<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/withdraw/log.blade.php ENDPATH**/ ?>