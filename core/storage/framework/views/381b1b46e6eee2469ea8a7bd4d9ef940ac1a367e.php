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
                                <th scope="col"><?php echo app('translator')->get('Reward 1'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Reward 2'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Reward 3'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Reward 4'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Reward 5'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Reward 6'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Reward 7'); ?></th>
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
                                <td data-label="<?php echo app('translator')->get('Reward 1'); ?>"><?php echo ($user->reward_one==1?'<i class="fa fa-check text-success" title="Team Leader"></i></i>':'<i class="fa fa-times text-danger"></i>'); ?></td>
                                <td data-label="<?php echo app('translator')->get('Reward 2'); ?>"><?php echo ($user->reward_two==1?'<i class="fa fa-check text-success" title="Region Leader"></i></i>':'<i class="fa fa-times text-danger"></i>'); ?></td>
                                <td data-label="<?php echo app('translator')->get('Reward 3'); ?>"><?php echo ($user->reward_three==1?'<i class="fa fa-check text-success" title="National Leader"></i></i>':'<i class="fa fa-times text-danger"></i>'); ?></td>
                                <td data-label="<?php echo app('translator')->get('Reward 4'); ?>"><?php echo ($user->reward_four==1?'<i class="fa fa-check text-success" title="Royal Leader"></i></i>':'<i class="fa fa-times text-danger"></i>'); ?></td>
                                <td data-label="<?php echo app('translator')->get('Reward 5'); ?>"><?php echo ($user->reward_five==1?'<i class="fa fa-check text-success" title="Crown Leader"></i></i>':'<i class="fa fa-times text-danger"></i>'); ?></td>
                                <td data-label="<?php echo app('translator')->get('Reward 6'); ?>"><?php echo ($user->reward_six==1?'<i class="fa fa-check text-success" title="Diamond Leader"></i></i>':'<i class="fa fa-times text-danger"></i>'); ?></td>
                                <td data-label="<?php echo app('translator')->get('Reward 7'); ?>"><?php echo ($user->reward_seven==1?'<i class="fa fa-check text-success" title="The Nobel Leader"></i></i>':'<i class="fa fa-times text-danger"></i>'); ?></td>
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
            <input type="hidden" name="winner_user" value="1">
            <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Username or email'); ?>" value="<?php echo e($search ?? ''); ?>">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/admin/users/winner.blade.php ENDPATH**/ ?>