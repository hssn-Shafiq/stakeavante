<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">


        <div class="col-lg-4 col-md-4 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted"><?php echo app('translator')->get('Withdraw Via'); ?> <?php echo e(__(@$withdrawal->method->name)); ?></h5>

                    <div class="p-3 bg--white">
                        <div class="">
                            <img src="<?php echo e($methodImage); ?>" alt="<?php echo app('translator')->get('Image'); ?>" class="b-radius--10 withdraw-detailImage" >
                        </div>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Date'); ?>
                            <span class="font-weight-bold"><?php echo e(showDateTime($withdrawal->created_at)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Trx Number'); ?>
                            <span class="font-weight-bold"><?php echo e($withdrawal->trx); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Name'); ?>
                            <span class="font-weight-bold">
                                <?php echo e(@$withdrawal->user->full_name); ?>

                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Email'); ?>
                            <span class="font-weight-bold">
                                <?php echo e(@$withdrawal->user->email); ?>

                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Username'); ?>
                            <span class="font-weight-bold">
                                <a href="<?php echo e(route('admin.users.detail', $withdrawal->user_id)); ?>"><?php echo e(@$withdrawal->user->username); ?></a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Method'); ?>
                            <span class="font-weight-bold"><?php echo e(__($withdrawal->method->name)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Amount'); ?>
                            <span class="font-weight-bold"><?php echo e(getAmount($withdrawal->amount )); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Charge'); ?>
                            <span class="font-weight-bold"><?php echo e(getAmount($withdrawal->charge )); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('After Charge'); ?>
                            <span class="font-weight-bold"><?php echo e(getAmount($withdrawal->after_charge )); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Rate'); ?>
                            <span class="font-weight-bold">1 <?php echo e(__($general->cur_text)); ?>

                                = <?php echo e(getAmount($withdrawal->rate )); ?> <?php echo e(__($withdrawal->currency)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Payable'); ?>
                            <span class="font-weight-bold"><?php echo e(getAmount($withdrawal->final_amount)); ?> <?php echo e(__($withdrawal->currency)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Status'); ?>
                            <?php if($withdrawal->status == 2): ?>
                                <span class="badge badge-pill bg--warning"><?php echo app('translator')->get('Pending'); ?></span>
                            <?php elseif($withdrawal->status == 1): ?>
                                <span class="badge badge-pill bg--success"><?php echo app('translator')->get('Approved'); ?></span>
                            <?php elseif($withdrawal->status == 3): ?>
                                <span class="badge badge-pill bg--danger"><?php echo app('translator')->get('Rejected'); ?></span>
                            <?php endif; ?>
                        </li>

                        <?php if($withdrawal->admin_feedback): ?>
                        <li class="list-group-item">
                            <strong><?php echo app('translator')->get('Admin Response'); ?></strong>
                            <br>
                           <p><?php echo e($withdrawal->admin_feedback); ?></p>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 mb-30">

            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2"><?php echo app('translator')->get('User Withdraw Information'); ?></h5>


                    <?php if($details != null): ?>
                        <?php $__currentLoopData = \GuzzleHttp\json_decode($details); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($val->type == 'file'): ?>
                                <div class="row mt-4">
                                    <div class="col-md-8">
                                        <h6><?php echo e(__(inputTitle($k))); ?></h6>
                                        <img src="<?php echo e(getImage('assets/images/verify/withdraw/'.$val->field_name)); ?>" alt="<?php echo app('translator')->get('Image'); ?>">
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h6><?php echo e(__(inputTitle($k))); ?></h6>
                                        <p><?php echo e($val->field_name); ?></p>
                                    </div>
                                </div>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>


                    <?php if($withdrawal->status == 2): ?>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button class="btn btn--success ml-1 approveBtn" data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('Approve'); ?>"
                                        data-id="<?php echo e($withdrawal->id); ?>" data-amount="<?php echo e(getAmount($withdrawal->final_amount)); ?> <?php echo e($withdrawal->currency); ?>">
                                    <i class="fas la-check"></i> <?php echo app('translator')->get('Approve'); ?>
                                </button>

                                <button class="btn btn--danger ml-1 rejectBtn" data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('Reject'); ?>"
                                        data-id="<?php echo e($withdrawal->id); ?>" data-amount="<?php echo e(getAmount($withdrawal->final_amount)); ?> <?php echo e(__($withdrawal->currency)); ?>">
                                    <i class="fas fa-ban"></i> <?php echo app('translator')->get('Reject'); ?>
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
                    <h5 class="modal-title"><?php echo app('translator')->get('Approve Withdrawal Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.withdraw.approve')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Have you Sent'); ?> <span class="font-weight-bold withdraw-amount text-success"></span>?</p>
                        <p class="withdraw-detail"></p>
                        <textarea name="details" class="form-control pt-3" rows="3" placeholder="<?php echo app('translator')->get('Provide the Details. eg: Transaction number'); ?>" required=""></textarea>
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
                    <h5 class="modal-title"><?php echo app('translator')->get('Reject Withdrawal Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.withdraw.reject')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <strong><?php echo app('translator')->get('Reason of Rejection'); ?></strong>
                        <textarea name="details" class="form-control pt-3" rows="3" placeholder="<?php echo app('translator')->get('Provide the Details'); ?>" required=""></textarea>
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
        $(function () {
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#approveModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.modal('show');
            });

            $('.rejectBtn').on('click', function() {
                var modal = $('#rejectModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.modal('show');
            });
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/withdraw/detail.blade.php ENDPATH**/ ?>