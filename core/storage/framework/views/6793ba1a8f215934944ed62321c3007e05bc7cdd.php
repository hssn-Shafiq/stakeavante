<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-xl-12">
            <div class="card">
                <form action="<?php echo e(route('admin.users.email.single', $user->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Subject'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Email subject'); ?>" name="subject"  required/>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Message'); ?> <span class="text-danger">*</span></label>
                                <textarea name="message" rows="10" class="form-control nicEdit" placeholder="<?php echo app('translator')->get('Your message'); ?>"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <button type="submit" class="btn btn-block btn--primary mr-2"><?php echo app('translator')->get('Send Email'); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/users/email_single.blade.php ENDPATH**/ ?>