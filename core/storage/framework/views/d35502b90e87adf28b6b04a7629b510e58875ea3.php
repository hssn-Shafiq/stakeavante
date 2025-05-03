

<?php $__env->startSection('panel'); ?>
    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('Date'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('IP'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Location'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Browser'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('OS'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $login_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="<?php echo app('translator')->get('Date'); ?>"><?php echo e(diffForHumans($log->created_at)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Username'); ?>"><a href="<?php echo e(route('admin.users.detail', $log->user_id)); ?>"> <?php echo e(($log->user) ? $log->user->username : ''); ?></a></td>
                                    <td data-label="<?php echo app('translator')->get('IP'); ?>">
                                        <a href="<?php echo e(route('admin.report.login.ipHistory',[$log->user_ip])); ?>">
                                            <?php echo e($log->user_ip); ?>

                                        </a>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Location'); ?>"><?php echo e($log->location); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Browser'); ?>"><?php echo e(__($log->browser)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('OS'); ?>"><?php echo e(__($log->os)); ?></td>
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
                    <?php echo e(paginateLinks($login_logs)); ?>

                </div>
            </div><!-- card end -->
        </div>


    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if(request()->routeIs('admin.report.login.history')): ?>
    <form action="<?php echo e(route('admin.report.login.history')); ?>" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Search here'); ?>" value="<?php echo e($search ?? ''); ?>">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/reports/logins.blade.php ENDPATH**/ ?>