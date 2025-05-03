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
                            <li class="list-group-item d-flex justify-content-between">
                                <span><?php echo app('translator')->get('Joined at'); ?></span> <?php echo e(date('d M, Y h:i A',strtotime(auth()->user()->created_at))); ?>

                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2"><?php echo e(auth()->user()->fullname); ?> <?php echo app('translator')->get('Information'); ?></h5>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('First Name'); ?> <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text" name="firstname"
                                           value="<?php echo e(auth()->user()->firstname); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold"><?php echo app('translator')->get('Last Name'); ?> <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text" name="lastname" value="<?php echo e(auth()->user()->lastname); ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Email'); ?><span class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="email" name="email" value="<?php echo e(auth()->user()->email); ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold"><?php echo app('translator')->get('Mobile Number'); ?><span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text" name="mobile" 
                                           value="<?php echo e(auth()->user()->mobile); ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold"><?php echo app('translator')->get('Avatar'); ?></label>
                                    <input class="form-control form-control-lg" type="file" accept="image/*"  onchange="loadFile(event)" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Address'); ?> </label>
                                    <input class="form-control form-control-lg" type="text" name="address"
                                           value="<?php echo e(auth()->user()->address->address); ?>">
                                    <small class="form-text text-muted"><i
                                            class="las la-info-circle"></i><?php echo app('translator')->get('House number, street address'); ?>
                                    </small>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('City'); ?></label>
                                    <input class="form-control form-control-lg" type="text" name="city"
                                           value="<?php echo e(auth()->user()->address->city); ?>">
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('State'); ?></label>
                                    <input class="form-control form-control-lg" type="text" name="state"
                                           value="<?php echo e(auth()->user()->address->state); ?>">
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Zip/Postal'); ?></label>
                                    <input class="form-control form-control-lg" type="text" name="zip"
                                           value="<?php echo e(auth()->user()->address->zip); ?>">
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Country'); ?></label>
                                    <select name="country" class="form-control form-control-lg"> <?php echo $__env->make('partials.country', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn--primary btn-block btn-lg"><?php echo app('translator')->get('Save Changes'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('user.change-password')); ?>" class="btn btn--success btn--shadow"><i class="fa fa-key"></i><?php echo app('translator')->get('Change Password'); ?></a>
<?php $__env->stopPush(); ?>



<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        (function($){
            $("select[name=country]").val("<?php echo e(auth()->user()->address->country); ?>");
        })(jQuery)

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };


    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/profile-setting.blade.php ENDPATH**/ ?>