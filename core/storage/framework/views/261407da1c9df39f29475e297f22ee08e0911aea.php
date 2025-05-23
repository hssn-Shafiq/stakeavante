<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-lg-3 col-md-3 mb-30">
            <div class="card b-radius--5 overflow-hidden">
                <div class="card-body p-0">
                    <div class="d-flex p-3 bg--primary align-items-center">
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
                    <h5 class="card-title mb-50 border-bottom pb-2"><?php echo app('translator')->get('Profile Information'); ?></h5>
                    <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url(<?php echo e(getImage(imagePath()['profile']['admin']['path'].'/'.auth()->guard('admin')->user()->image,imagePath()['profile']['admin']['size'])); ?>)">
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--success"><?php echo app('translator')->get('Upload Image'); ?></label>
                                                <small class="mt-2 text-facebook"><?php echo app('translator')->get('Supported files'); ?>: <b><?php echo app('translator')->get('jpeg'); ?>, <?php echo app('translator')->get('jpg'); ?>.</b> <?php echo app('translator')->get('Image will be resized into 400x400px'); ?> </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Name'); ?></label>
                                    <input class="form-control" type="text" name="name" value="<?php echo e(auth()->guard('admin')->user()->name); ?>" >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold"><?php echo app('translator')->get('Email'); ?></label>
                                    <input class="form-control" type="email" name="email" value="<?php echo e(auth()->guard('admin')->user()->email); ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block btn-lg"><?php echo app('translator')->get('Save Changes'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.password')); ?>" class="btn btn-sm btn--primary box--shadow1 text--small" ><i class="fa fa-key"></i><?php echo app('translator')->get('Password Setting'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/profile.blade.php ENDPATH**/ ?>