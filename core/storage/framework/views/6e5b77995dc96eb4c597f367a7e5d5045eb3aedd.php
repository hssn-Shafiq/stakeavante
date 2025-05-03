<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-xl-4 col-md-6 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted"><?php echo app('translator')->get('Deposit Via'); ?> <?php echo e(__(@$deposit->gateway->name)); ?></h5>
                    <div class="p-3 bg--white">
                        <img src="<?php echo e($deposit->gateway_currency()->methodImage()); ?>" alt="<?php echo app('translator')->get('Profile Image'); ?>" class="b-radius--10 deposit-imgView">
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Date'); ?>
                            <span class="font-weight-bold"><?php echo e(showDateTime($deposit->created_at)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Transaction Number'); ?>
                            <span class="font-weight-bold"><?php echo e($deposit->trx); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Username'); ?>
                            <span class="font-weight-bold">
                                <a href="<?php echo e(route('admin.users.detail', $deposit->user_id)); ?>"><?php echo e(@$deposit->user->username); ?></a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Method'); ?>
                            <span class="font-weight-bold"><?php echo e(__(@$deposit->gateway->name)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Amount'); ?>
                            <span class="font-weight-bold"><?php echo e(getAmount($deposit->amount )); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Charge'); ?>
                            <span class="font-weight-bold"><?php echo e(getAmount($deposit->charge )); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('After Charge'); ?>
                            <span class="font-weight-bold"><?php echo e(getAmount($deposit->amount+$deposit->charge )); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Rate'); ?>
                            <span class="font-weight-bold">1 <?php echo e(__($general->cur_text)); ?>

                                = <?php echo e(getAmount($deposit->rate)); ?> <?php echo e(__($deposit->baseCurrency())); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Payable'); ?>
                            <span class="font-weight-bold"><?php echo e(getAmount($deposit->final_amo )); ?> <?php echo e(__($deposit->method_currency)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Status'); ?>
                            <?php if($deposit->status == 2): ?>
                                <span class="badge badge-pill bg--warning"><?php echo app('translator')->get('Pending'); ?></span>
                            <?php elseif($deposit->status == 1): ?>
                                <span class="badge badge-pill bg--success"><?php echo app('translator')->get('Approved'); ?></span>
                            <?php elseif($deposit->status == 3): ?>
                                <span class="badge badge-pill bg--danger"><?php echo app('translator')->get('Rejected'); ?></span>
                            <?php endif; ?>
                        </li>
                        <?php if($deposit->admin_feedback): ?>
                            <li class="list-group-item">
                                <strong><?php echo app('translator')->get('Admin Response'); ?></strong>
                                <br>
                                <p><?php echo e(__($deposit->admin_feedback)); ?></p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-md-6 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2"><?php echo app('translator')->get('User Deposit Information'); ?></h5>
                    <?php if($details != null): ?>
                        <?php $__currentLoopData = json_decode($details); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($val->type == 'file'): ?>
                                <div class="row mt-4">
                                    <div class="col-md-8">
                                        <h6><?php echo e(inputTitle($k)); ?></h6>
                                        <img src="<?php echo e(getImage('assets/images/verify/deposit/'.$val->field_name)); ?>" alt="<?php echo app('translator')->get('Image'); ?>">
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h6><?php echo e(inputTitle($k)); ?></h6>
                                        <p><?php echo e(__($val->field_name)); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php if($deposit->status == 2): ?>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button class="btn btn--success ml-1 approveBtn"
                                        data-id="<?php echo e($deposit->id); ?>"
                                        data-info="<?php echo e($details); ?>"
                                        data-amount="<?php echo e(getAmount($deposit->amount)); ?> <?php echo e(__($general->cur_text)); ?>"
                                        data-username="<?php echo e(@$deposit->user->username); ?>"
                                        data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('Approve'); ?>"><i class="fas fa-check"></i>
                                    <?php echo app('translator')->get('Approve'); ?>
                                </button>

                                <button class="btn btn--danger ml-1 rejectBtn"
                                        data-id="<?php echo e($deposit->id); ?>"
                                        data-info="<?php echo e($details); ?>"
                                        data-amount="<?php echo e(getAmount($deposit->amount)); ?> <?php echo e(__($general->cur_text)); ?>"
                                        data-username="<?php echo e(@$deposit->user->username); ?>"
                                        data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('Reject'); ?>"><i class="fas fa-ban"></i>
                                    <?php echo app('translator')->get('Reject'); ?>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    
    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Approve Deposit Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.deposit.approve')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to'); ?> <span class="font-weight-bold"><?php echo app('translator')->get('approve'); ?></span> <span class="font-weight-bold withdraw-amount text-success"></span> <?php echo app('translator')->get('deposit of'); ?> <span class="font-weight-bold withdraw-user"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn--success"><?php echo app('translator')->get('Approve'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Reject Deposit Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.deposit.reject')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to'); ?> <span class="font-weight-bold"><?php echo app('translator')->get('reject'); ?></span> <span class="font-weight-bold withdraw-amount text-success"></span> <?php echo app('translator')->get('deposit of'); ?> <span class="font-weight-bold withdraw-user"></span>?</p>

                        <div class="form-group">
                            <label class="font-weight-bold mt-2"><?php echo app('translator')->get('Reason for Rejection'); ?></label>
                            <textarea name="message" id="message" placeholder="<?php echo app('translator')->get('Reason for Rejection'); ?>" class="form-control" rows="5"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn--danger"><?php echo app('translator')->get('Reject'); ?></button>
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
            $('.approveBtn').on('click', function () {
                var modal = $('#approveModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.find('.withdraw-user').text($(this).data('username'));
                modal.modal('show');
            });

            $('.rejectBtn').on('click', function () {
                var modal = $('#rejectModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.find('.withdraw-user').text($(this).data('username'));
                modal.modal('show');
            });
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/deposit/detail.blade.php ENDPATH**/ ?>