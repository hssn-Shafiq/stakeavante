<?php $__env->startSection('panel'); ?>
    <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card cmn--card">
                    <div class="card-header"><?php echo e(__($page_title)); ?>

                    </div>
                    <div class="card-body">
                        <form  action="<?php echo e(route('ticket.store')); ?>"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                            <?php echo csrf_field(); ?>
                            <div class="row ">
                                <div class="form-group col-md-6">
                                    <label for="name"><?php echo app('translator')->get('Name'); ?></label>
                                    <input type="text"  name="name" value="<?php echo e(@$user->firstname . ' '.@$user->lastname); ?>" class="form-control form-control-lg" placeholder="<?php echo app('translator')->get('Enter Name'); ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email"><?php echo app('translator')->get('Email address'); ?></label>
                                    <input type="email"  name="email" value="<?php echo e(@$user->email); ?>" class="form-control form-control-lg" placeholder="<?php echo app('translator')->get('Enter your Email'); ?>" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="website"><?php echo app('translator')->get('Subject'); ?></label>
                                    <input type="text" name="subject" value="<?php echo e(old('subject')); ?>" class="form-control form-control-lg" placeholder="<?php echo app('translator')->get('Subject'); ?>" >
                                </div>
                                <div class="col-12 form-group">
                                    <label for="inputMessage"><?php echo app('translator')->get('Message'); ?></label>
                                    <textarea name="message" id="inputMessage" rows="6" class="form-control form-control-lg"><?php echo e(old('message')); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <span for="inputAttachments text-white"><?php echo app('translator')->get('Attachments'); ?></span>
                                <div class="custom-file">
                                    <input name="attachments[]" type="file" id="customFile" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf">

                                    <label class="custom-file-label form-control-lg" for="custmFile"><?php echo app('translator')->get('Choose file'); ?></label>
                                </div>
                            </div>

                            <div class="fileUploadsContainer"></div>

                            <p class="text-muted m-2">
                                <i class="la la-info-circle"></i> <?php echo app('translator')->get("Allowed File Extensions: .jpg, .jpeg, .png, .pdf"); ?>
                            </p>

                            <div class="form-group">
                                <a href="javascript:void(0)" class="btn btn--success add-more-btn">
                                    <i class="la la-plus"></i>
                                    <?php echo app('translator')->get('Add More'); ?>
                                </a>
                            </div>

                            <div class="row form-group justify-content-center">
                                <div class="col-md-12">
                                    <button class="btn btn-block btn--success" type="submit" id="recaptcha" ><i class="fa fa-paper-plane"></i>&nbsp;<?php echo app('translator')->get('Send'); ?></button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        (function($){
            $(document).on("change", '.custom-file-input' ,function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            var itr = 0;

            $('.add-more-btn').on('click', function(){
                itr++
                $(".fileUploadsContainer").append(`
                    <div class="form-group custom-file mt-3">
                        <input type="file" name="attachments[]" id="customFile${itr}" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf" />
                        <label class="custom-file-label form-control-lg" for="customFile${itr}"><?php echo app('translator')->get('Choose file'); ?></label>
                    </div>`
                );
            });

        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('ticket')); ?>" class="btn btn-sm btn--dark box--shadow1 text--small"><i class="la la-backward"></i> <?php echo app('translator')->get('Go Back'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/support/create.blade.php ENDPATH**/ ?>