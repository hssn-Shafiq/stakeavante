<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <img id="output" src="<?php echo e(getImage('assets/images/user/profile/'. auth()->user()->image,  null, true)); ?>" alt="<?php echo app('translator')->get('profile-image'); ?>" class="b-radius--10 w-100">
                        <ul class="list-group mt-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span><?php echo app('translator')->get('Name'); ?></span> <?php echo e(auth()->user()->fullname); ?>

                            </li>
                            <li class="list-group-item rounded-0 d-flex justify-content-between">
                                <span><?php echo app('translator')->get('Username'); ?></span> <?php echo e(auth()->user()->username); ?>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2"><?php echo app('translator')->get('Change Password'); ?></h5>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"><?php echo app('translator')->get('Password'); ?></label>
                            <div class="col-lg-9">
                                <input class="form-control form-control-lg" type="password" name="current_password" required minlength="5">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"><?php echo app('translator')->get('New password'); ?></label>
                            <div class="col-lg-9">
                                <input class="form-control form-control-lg" type="password" name="password" required minlength="5">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"><?php echo app('translator')->get('Confirm password'); ?></label>
                            <div class="col-lg-9">
                                <input class="form-control form-control-lg" type="password" required minlength="5"
                                       name="password_confirmation">
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
    <a href="<?php echo e(route('user.profile-setting')); ?>" class="btn btn--success btn--shadow"><i class="fa fa-user"></i><?php echo app('translator')->get('Profile Setting'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/password.blade.php ENDPATH**/ ?>