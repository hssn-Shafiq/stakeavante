<?php $__env->startSection('panel'); ?>
    <div class="row justify-content-center">
        <?php if(request()->routeIs('admin.deposit.list') || request()->routeIs('admin.deposit.method') || request()->routeIs('admin.users.deposits') || request()->routeIs('admin.deposit.dateSearch') || request()->routeIs('admin.users.deposits.method')): ?>
            <div class="col-md-4 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 bg--success">
                    <div class="widget-two__content">
                        <h2 class="text-white"><?php echo e(__($general->cur_sym)); ?><?php echo e($deposits->where('status',1)->sum('amount')); ?></h2>
                        <p class="text-white"><?php echo app('translator')->get('Successful Deposit'); ?></p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-md-4 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 bg--6">
                    <div class="widget-two__content">
                        <h2 class="text-white"><?php echo e(__($general->cur_sym)); ?><?php echo e($deposits->where('status',2)->sum('amount')); ?></h2>
                        <p class="text-white"><?php echo app('translator')->get('Pending Deposit'); ?></p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-md-4 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 bg--pink">
                    <div class="widget-two__content">
                        <h2 class="text-white"><?php echo e(__($general->cur_sym)); ?><?php echo e($deposits->where('status',3)->sum('amount')); ?></h2>
                        <p class="text-white"><?php echo app('translator')->get('Rejected Deposit'); ?></p>
                    </div>
                </div><!-- widget-two end -->
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('Date'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Trx Number'); ?></th>
                                <?php if(!request()->routeIs('admin.users.deposits') && !request()->routeIs('admin.users.deposits.method')): ?>
                                    <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                                <?php endif; ?>
                                <th scope="col"><?php echo app('translator')->get('Method'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Payable'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $details = ($deposit->detail != null) ? json_encode($deposit->detail) : null;
                                ?>
                                <tr>
                                    <td data-label="<?php echo app('translator')->get('Date'); ?>"> <?php echo e(showDateTime($deposit->created_at)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Trx Number'); ?>"
                                        class="font-weight-bold text-uppercase"><?php echo e($deposit->trx); ?></td>
                                    <?php if(!request()->routeIs('admin.users.deposits') && !request()->routeIs('admin.users.deposits.method')): ?>
                                        <td data-label="<?php echo app('translator')->get('Username'); ?>"><a
                                                href="<?php echo e(route('admin.users.detail', $deposit->user_id)); ?>"><?php echo e($deposit->user->username); ?></a>
                                        </td>
                                    <?php endif; ?>
                                    <td data-label="<?php echo app('translator')->get('Method'); ?>">
                                        <?php if(request()->routeIs('admin.users.deposits') || request()->routeIs('admin.users.deposits.method')): ?>
                                            <a href="<?php echo e(route('admin.users.deposits.method',[$deposit->gateway->alias,@$type?$type:'all',$userId])); ?>"><?php echo e(__($deposit->gateway->name)); ?></a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('admin.deposit.method',[$deposit->gateway->alias,@$type?$type:'all'])); ?>"><?php echo e(__($deposit->gateway->name)); ?></a>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Amount'); ?>"
                                        class="font-weight-bold"><?php echo e(getAmount($deposit->amount )); ?> <?php echo e(__($general->cur_text)); ?></td>

                                    <td data-label="<?php echo app('translator')->get('Payable'); ?>" class="font-weight-bold">
                                        <?php echo e(getAmount($deposit->final_amo)); ?> <?php echo e(__($deposit->method_currency)); ?>

                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                        <?php if($deposit->status == 2): ?>
                                            <span class="badge badge--warning"><?php echo app('translator')->get('Pending'); ?></span>
                                        <?php elseif($deposit->status == 1): ?>
                                            <span class="badge badge--success"><?php echo app('translator')->get('Approved'); ?></span>
                                        <?php elseif($deposit->status == 3): ?>
                                            <span class="badge badge--danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                        <a href="<?php echo e(route('admin.deposit.details', $deposit->id)); ?>"
                                           class="icon-btn ml-1 " data-toggle="tooltip" title=""
                                           data-original-title="<?php echo app('translator')->get('Detail'); ?>">
                                            <i class="la la-eye"></i>
                                        </a>
                                    </td>
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
                    <?php echo e(paginateLinks($deposits)); ?>

                </div>
            </div><!-- card end -->
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if(!request()->routeIs('admin.users.deposits') && !request()->routeIs('admin.users.deposits.method')): ?>
        <form
            action="<?php echo e(route('admin.deposit.search', $scope ?? str_replace('admin.deposit.', '', request()->route()->getName()))); ?>"
            method="GET" class="form-inline float-sm-right bg--white mb-2">
            <div class="input-group has_append  ">
                <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Deposit code/Username'); ?>"
                       value="<?php echo e($search ?? ''); ?>">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        <form
            action="<?php echo e(route('admin.deposit.dateSearch',$scope ?? str_replace('admin.deposit.', '', request()->route()->getName()))); ?>"
            method="GET" class="form-inline float-sm-right bg--white mr-0 mr-xl-2 mr-lg-0">
            <div class="input-group has_append ">
                <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en"
                       class="datepicker-here form-control bg-white text--black" data-position='bottom right'
                       placeholder="<?php echo app('translator')->get('Min Date - Max date'); ?>" autocomplete="off" readonly
                       value="<?php echo e(@$dateSearch); ?>">
                <input type="hidden" name="method" value="<?php echo e(@$methodAlias); ?>">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/vendor/datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/datepicker.en.js')); ?>"></script>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        (function ($) {
            if (!$('.datepicker-here').val()) {
                $('.datepicker-here').datepicker();
            }
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/deposit/log.blade.php ENDPATH**/ ?>