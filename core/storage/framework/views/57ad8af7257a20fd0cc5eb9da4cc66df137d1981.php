<?php $__env->startSection('panel'); ?>
    <div class="row justify-content-center">
        <?php if(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.method') || request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.users.withdrawals.method')): ?>
        <div class="col-xl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--success">
            <div class="widget-two__content">
                <h2 class="text-white"><?php echo e(__($general->cur_sym)); ?><?php echo e($withdrawals->where('status',1)->sum('amount')); ?></h2>
                <p class="text-white"><?php echo app('translator')->get('Approved Withdrawals'); ?></p>
            </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-xl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--6">
                <div class="widget-two__content">
                    <h2 class="text-white"><?php echo e(__($general->cur_sym)); ?><?php echo e($withdrawals->where('status',2)->sum('amount')); ?></h2>
                    <p class="text-white"><?php echo app('translator')->get('Pending Withdrawals'); ?></p>
                </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-xl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--pink">
            <div class="widget-two__content">
                <h2 class="text-white"><?php echo e(__($general->cur_sym)); ?><?php echo e($withdrawals->where('status',3)->sum('amount')); ?></h2>
                <p class="text-white"><?php echo app('translator')->get('Rejected Withdrawals'); ?></p>
            </div>
            </div><!-- widget-two end -->
        </div>
        <?php endif; ?>
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('Date'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Trx Number'); ?></th>
                                <?php if(!request()->routeIs('admin.users.withdrawals') && !request()->routeIs('admin.users.withdrawals.method')): ?>
                                <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                                <?php endif; ?>
                                <th scope="col"><?php echo app('translator')->get('Method'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Charge'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('After Charge'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Rate'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Payable'); ?></th>
                                <?php if(request()->routeIs('admin.withdraw.pending')): ?>
                                    <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                                <?php elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search')  || request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.withdraw.method')): ?>
                                    <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                <?php endif; ?>

                                <?php if(request()->routeIs('admin.withdraw.approved') || request()->routeIs('admin.withdraw.rejected') || request()->routeIs('admin.users.withdrawals.method')): ?>
                                    <th scope="col"><?php echo app('translator')->get('Info'); ?></th>
                                <?php endif; ?>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $details = ($withdraw->withdraw_information != null) ? json_encode($withdraw->withdraw_information) : null;
                                ?>
                                <tr>
                                    <td data-label="<?php echo app('translator')->get('Date'); ?>"><?php echo e(showDateTime($withdraw->created_at)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Trx Number'); ?>" class="font-weight-bold"><?php echo e(strtoupper($withdraw->trx)); ?></td>
                                    <?php if(!request()->routeIs('admin.users.withdrawals') && !request()->routeIs('admin.users.withdrawals.method')): ?>
                                    <td data-label="<?php echo app('translator')->get('Username'); ?>">
                                        <a href="<?php echo e(route('admin.users.detail', $withdraw->user_id)); ?>"><?php echo e(@$withdraw->user->username); ?></a>
                                    </td>
                                    <?php endif; ?>
                                    <td data-label="<?php echo app('translator')->get('Method'); ?>">
                                        <?php if(request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.users.withdrawals')): ?>
                                       <a href="<?php echo e(route('admin.users.withdrawals.method',[$withdraw->method->id,@$type?$type:'all',$userId])); ?>"> <?php echo e(__(@$withdraw->method->name)); ?></a>
                                       <?php else: ?>
                                       <a href="<?php echo e(route('admin.withdraw.method',[$withdraw->method->id,@$type])); ?>"> <?php echo e(__(@$withdraw->method->name)); ?></a>
                                       <?php endif; ?>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Amount'); ?>" class="budget font-weight-bold"><?php echo e(getAmount($withdraw->amount)); ?> <?php echo e(__($general->cur_text)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Charge'); ?>" class="budget text-danger"><?php echo e(getAmount($withdraw->charge)); ?> <?php echo e(__($general->cur_text)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('After Charge'); ?>" class="budget"><?php echo e(getAmount($withdraw->after_charge)); ?> <?php echo e(__($general->cur_text)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Rate'); ?>" class="budget"><?php echo e(getAmount($withdraw->rate)); ?>  <?php echo e(__($withdraw->currency)); ?></td>

                                    <td data-label="<?php echo app('translator')->get('Payable'); ?>" class="budget font-weight-bold"><?php echo e(getAmount($withdraw->final_amount)); ?> <?php echo e(__($withdraw->currency)); ?> </td>
                                    <?php if(request()->routeIs('admin.withdraw.pending')): ?>

                                        <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                            <a href="<?php echo e(route('admin.withdraw.details', $withdraw->id)); ?>" class="icon-btn ml-1 " data-toggle="tooltip"data-original-title="<?php echo app('translator')->get('Detail'); ?>">
                                                <i class="la la-eye"></i>
                                            </a>
                                        </td>
                                    <?php elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search') || request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.withdraw.method') ||  request()->routeIs('admin.users.withdrawals.method')): ?>
                                        <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                            <?php if($withdraw->status == 2): ?>
                                                <span class="text--small badge font-weight-normal badge--warning"><?php echo app('translator')->get('Pending'); ?></span>
                                            <?php elseif($withdraw->status == 1): ?>
                                                <span class="text--small badge font-weight-normal badge--success"><?php echo app('translator')->get('Approved'); ?></span>
                                            <?php elseif($withdraw->status == 3): ?>
                                                <span class="text--small badge font-weight-normal badge--danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                    <?php if(request()->routeIs('admin.withdraw.approved') || request()->routeIs('admin.withdraw.rejected')): ?>
                                        <td data-label="<?php echo app('translator')->get('Info'); ?>">
                                            <a href="<?php echo e(route('admin.withdraw.details', $withdraw->id)); ?>" class="icon-btn ml-1 " data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('Detail'); ?>">
                                                <i class="la la-desktop"></i>
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo e(__($empty_message)); ?></td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>

                <div class="card-footer py-4">
                    <?php echo e(paginateLinks($withdrawals)); ?>

                </div>
            </div><!-- card end -->
        </div>
    </div>

<?php $__env->stopSection(); ?>




<?php $__env->startPush('breadcrumb-plugins'); ?>

    <?php if(!request()->routeIs('admin.users.withdrawals') && !request()->routeIs('admin.users.withdrawals.method')): ?>

        <form action="<?php echo e(route('admin.withdraw.search', $scope ?? str_replace('admin.withdraw.', '', request()->route()->getName()))); ?>"
            method="GET" class="form-inline float-sm-right bg--white">
            <div class="input-group has_append">
                <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Withdrawal code/Username'); ?>" value="<?php echo e($search ?? ''); ?>">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <form action="<?php echo e(route('admin.withdraw.dateSearch',$scope ?? str_replace('admin.withdraw.', '', request()->route()->getName()))); ?>" method="GET" class="form-inline float-sm-right bg--white mr-0 mr-xl-2 mr-lg-0">
            <div class="input-group has_append">
                <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en" class="datepicker-here bg--white text--black form-control" data-position='bottom right' placeholder="<?php echo app('translator')->get('Min Date - Max date'); ?>" autocomplete="off" value="<?php echo e(@$dateSearch); ?>" readonly>
                <input type="hidden" name="method" value="<?php echo e(@$method->id); ?>">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
  <script src="<?php echo e(asset('assets/admin/js/vendor/datepicker.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/vendor/datepicker.en.js')); ?>"></script>
  <script>
    'use strict';
    (function($){
        if(!$('.datepicker-here').val()){
            $('.datepicker-here').datepicker();
        }
    })(jQuery)
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/withdraw/withdrawals.blade.php ENDPATH**/ ?>