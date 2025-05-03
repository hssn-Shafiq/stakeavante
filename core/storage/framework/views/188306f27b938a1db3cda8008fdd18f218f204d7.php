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
                                <th scope="col"><?php echo app('translator')->get('IP'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Location'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Browser'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('OS'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $login_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="<?php echo app('translator')->get('Date'); ?>"><?php echo e(\Carbon\Carbon::parse($log->created_at)->diffForHumans()); ?></td>
                                    <td data-label="<?php echo app('translator')->get('IP'); ?>"><?php echo e($log->user_ip); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Location'); ?>"><?php echo e($log->location); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Browser'); ?>"><?php echo e($log->browser); ?></td>
                                    <td data-label="<?php echo app('translator')->get('OS'); ?>"><?php echo e($log->os); ?></td>
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
                    <?php echo e($login_logs->links($activeTemplate .'user.partials.paginate')); ?>

                </div>
            </div><!-- card end -->
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if(request()->routeIs('admin.users.login.history')): ?>
    <form action="<?php echo e(route('admin.users.login.history')); ?>" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Username'); ?>" value="<?php echo e($search ?? ''); ?>">

            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/logins.blade.php ENDPATH**/ ?>