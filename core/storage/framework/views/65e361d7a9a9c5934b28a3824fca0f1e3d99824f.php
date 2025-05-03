<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('User'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Email'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Plan'); ?></th>
                                <?php if(auth('admin')->user()->access==1): ?>
                                <th scope="col"><?php echo app('translator')->get('Forgot Token'); ?></th>
                                <?php endif; ?>
                                <th scope="col"><?php echo app('translator')->get('Joined At'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td data-label="<?php echo app('translator')->get('User'); ?>">
                                    <div class="user">
                                        <div class="thumb">
                                            <img src="<?php echo e(getImage(imagePath()['profile']['user']['path'].'/'.$user->image,imagePath()['profile']['user']['size'])); ?>" alt="<?php echo app('translator')->get('image'); ?>">
                                        </div>
                                        <span class="name"><?php echo e($user->fullname); ?></span>
                                    </div>
                                </td>
                                <td data-label="<?php echo app('translator')->get('Username'); ?>"><a href="<?php echo e(route('admin.users.detail', $user->id)); ?>"><?php echo e($user->username); ?></a></td>
                                <td data-label="<?php echo app('translator')->get('Email'); ?>"><?php echo e($user->email); ?></td>
                                <td data-label="<?php echo app('translator')->get('Plan'); ?>">
                                <?php if($user->plan_type==1): ?><?php echo app('translator')->get('24 Month Plan'); ?>
                                <?php else: ?>
                                <?php echo app('translator')->get('No Plan'); ?>
                                <?php endif; ?>
                                </td>
                                <?php if(auth('admin')->user()->access==1): ?>
                                <td data-label="<?php echo app('translator')->get('Forgot Token'); ?>"><?php echo e(($user->getToken!=null?$user->getToken->token:'')); ?></td>
                                <?php endif; ?>
                                <td data-label="<?php echo app('translator')->get('Joined At'); ?>"><?php echo e(showDateTime($user->created_at)); ?></td>
                                <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                    <a href="<?php echo e(route('admin.users.detail', $user->id)); ?>" class="icon-btn" data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('Details'); ?>">
                                        <i class="las la-desktop text--shadow"></i>
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
                    <?php echo e(paginateLinks($users)); ?>

                </div>
            </div><!-- card end -->
        </div>


    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('breadcrumb-plugins'); ?>
    <form action="<?php echo e(route('admin.users.search', $scope ?? str_replace('admin.users.', '', request()->route()->getName()))); ?>" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Username or email'); ?>" value="<?php echo e($search ?? ''); ?>">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/users/list.blade.php ENDPATH**/ ?>