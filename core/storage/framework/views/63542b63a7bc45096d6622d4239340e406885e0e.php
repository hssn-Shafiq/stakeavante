<?php $__env->startSection('panel'); ?>
    <div class="col-lg-12">
        <div class="card">
            <form action="<?php echo e(route('admin.setting.notice.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('All user notice'); ?></label>
                                <textarea rows="10" class="form-control nicEdit"  name="notice"><?php echo e(__($general->notice)); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('Free user notice'); ?></label>
                                <textarea rows="10" class="form-control nicEdit"  name="free_user_notice"><?php echo e(__($general->free_user_notice)); ?></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer py-4">
                    <button type="submit" class="btn btn-block btn--primary mr-2"><?php echo app('translator')->get('Update'); ?></button>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/admin/notice.blade.php ENDPATH**/ ?>