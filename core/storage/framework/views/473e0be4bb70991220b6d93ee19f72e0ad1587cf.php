<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-lg-3 col-md-3 mb-30">

            <div class="card b-radius--5 overflow-hidden">
                <div class="card-body p-0">
                    <div class="d-flex p-3 bg--primary">
                        <div class="avatar avatar--lg">
                            <img src="<?php echo e(getImage(imagePath()['profile']['admin']['path'].'/'. $admin->image,imagePath()['profile']['admin']['size'])); ?>" alt="<?php echo app('translator')->get('Image'); ?>">
                        </div>
                        <div class="pl-3">
                            <h4 class="text--white"><?php echo e(__($admin->name)); ?></h4>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Name'); ?>
                            <span class="font-weight-bold"><?php echo e(__($admin->name)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Username'); ?>
                            <span  class="font-weight-bold"><?php echo e(__($admin->username)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Email'); ?>
                            <span  class="font-weight-bold"><?php echo e($admin->email); ?></span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2"><?php echo app('translator')->get('Change Password'); ?></h5>

                    <form action="<?php echo e(route('admin.password.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"><?php echo app('translator')->get('Password'); ?></label>
                            <div class="col-lg-9">

                                <input class="form-control" type="password" placeholder="<?php echo app('translator')->get('Password'); ?>" name="old_password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"><?php echo app('translator')->get('New Password'); ?></label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" placeholder="<?php echo app('translator')->get('New Password'); ?>" name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"><?php echo app('translator')->get('Confirm Password'); ?></label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" placeholder="<?php echo app('translator')->get('Confirm Password'); ?>" name="password_confirmation">
                            </div>
                        </div>


                        <div class="form-group row">

                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                            <button type="submit" class="btn btn--primary btn-block btn-lg"><?php echo app('translator')->get('Save Changes'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.profile')); ?>" class="btn btn-sm btn--primary box--shadow1 text--small" ><i class="fa fa-user"></i><?php echo app('translator')->get('Profile Setting'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/password.blade.php ENDPATH**/ ?>