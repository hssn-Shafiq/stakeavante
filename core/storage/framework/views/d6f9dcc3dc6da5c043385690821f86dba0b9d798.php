<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive--sm">
                        <table class="table align-items-center table--light">
                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Short Code'); ?></th>
                                <th><?php echo app('translator')->get('Description'); ?></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <?php $__empty_1 = true; $__currentLoopData = $email_template->shortcodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shortcode => $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <th data-label="<?php echo app('translator')->get('Short Code'); ?>"><?php echo "{{". $shortcode ."}}"  ?></th>
                                    <td data-label="<?php echo app('translator')->get('Description'); ?>"><?php echo e(__($key)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="100%" class="text-muted text-center"><?php echo e(__($empty_message)); ?></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- card end -->
        </div>

        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header bg--dark">
                    <h5 class="card-title text-white"><?php echo e(__($page_title)); ?></h5>
                </div>
                <form action="<?php echo e(route('admin.email.template.update', $email_template->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Subject'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" placeholder="<?php echo app('translator')->get('Email subject'); ?>" name="subject" value="<?php echo e($email_template->subj); ?>"/>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Status'); ?> <span class="text-danger">*</span></label>
                                <input type="checkbox" data-height="46px" data-width="100%" data-onstyle="-success"
                                       data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Send Email'); ?>"
                                       data-off="<?php echo app('translator')->get("Don't Send"); ?>" name="email_status"
                                       <?php if($email_template->email_status): ?> checked <?php endif; ?>>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Message'); ?> <span class="text-danger">*</span></label>
                                <textarea name="email_body" rows="10" class="form-control nicEdit" placeholder="<?php echo app('translator')->get('Your message using shortcodes'); ?>"><?php echo e($email_template->email_body); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn--primary mr-2"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.email.template.index')); ?>" class="btn btn-sm btn--dark box--shadow1 text--small"><i class="la la-fw la-backward"></i> <?php echo app('translator')->get('Go Back'); ?> </a>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/email_template/edit.blade.php ENDPATH**/ ?>