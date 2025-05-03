<?php $__env->startSection('panel'); ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-bg d-flex flex-wrap justify-content-between align-items-center">
                    <h5 class="card-title mt-0">
                        <?php if($my_ticket->status == 0): ?>
                            <span class="badge badge--success"><?php echo app('translator')->get('Open'); ?></span>
                        <?php elseif($my_ticket->status == 1): ?>
                            <span class="badge badge--primary "><?php echo app('translator')->get('Answered'); ?></span>
                        <?php elseif($my_ticket->status == 2): ?>
                            <span class="badge badge--warning"><?php echo app('translator')->get('Replied'); ?></span>
                        <?php elseif($my_ticket->status == 3): ?>
                            <span class="badge badge--dark"><?php echo app('translator')->get('Closed'); ?></span>
                        <?php endif; ?>
                        [<?php echo app('translator')->get('Ticket'); ?>#<?php echo e($my_ticket->ticket); ?>] <?php echo e($my_ticket->subject); ?>

                    </h5>
                    <button class="btn btn-sm btn--danger close-button" type="button" data-toggle="modal" data-target="#DelModal"><i class="fa fa-times"></i> <?php echo app('translator')->get('Close Ticket'); ?>
                    </button>
                </div>
                <div class="card-body">
                    <?php if($my_ticket->status != 4): ?>
                        <form method="post" action="<?php echo e(route('ticket.reply', $my_ticket->id)); ?>"
                                enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="row justify-content-between">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control form-control-lg" id="inputMessage" placeholder="<?php echo app('translator')->get('Your Reply'); ?> ..." rows="4" cols="10" required></textarea>
                                    </div>
                                </div>
                            </div>


                          <div class="form-group mb-0">
                                <span for="inputAttachments text-white"><?php echo app('translator')->get('Attachments'); ?></span>
                                <div class="custom-file">
                                    <input name="attachments[]" type="file" id="customFile" class="custom-file-input form--control form-control" accept=".jpg,.jpeg,.png,.pdf">

                                    <label class="custom-file-label form-label" for="custmFile"><?php echo app('translator')->get('Choose file'); ?></label>
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

                            <button type="submit" class="btn btn--success btn-block" name="replayTicket" value="1"><i class="fa fa-reply"></i> <?php echo app('translator')->get('Reply'); ?></button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($message->admin_id == 0): ?>
                            <div class="row border border-primary border-radius-3 my-3 py-3 mx-2">
                                <div class="col-md-3 border-right text-right">
                                    <h5 class="my-3"><?php echo e($message->ticket->name); ?></h5>
                                </div>
                                <div class="col-md-9">
                                    <p class="text-muted font-weight-bold my-3">
                                        <?php echo app('translator')->get('Posted on'); ?> <?php echo e($message->created_at->format('l, dS F Y @ H:i')); ?></p>
                                    <p><?php echo e($message->message); ?></p>
                                    <?php if($message->attachments()->count() > 0): ?>
                                        <div class="mt-2">
                                            <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('ticket.download',encrypt($image->id))); ?>"
                                                   class="mr-3"><i
                                                        class="fa fa-file"></i> <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?>

                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row border border-warning border-radius-3 my-3 py-3 mx-2">
                                <div class="col-md-3 border-right text-right">
                                    <h5 class="my-3"><?php echo e($message->admin->name); ?></h5>
                                    <p class="lead text-muted"><?php echo app('translator')->get('Staff'); ?></p>
                                </div>
                                <div class="col-md-9">
                                    <p class="text-muted font-weight-bold my-3">
                                        <?php echo app('translator')->get('Posted on'); ?> <?php echo e($message->created_at->format('l, dS F Y @ H:i')); ?></p>
                                    <p><?php echo e($message->message); ?></p><?php if($message->attachments()->count() > 0): ?>
                                        <div class="mt-2">
                                            <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('ticket.download',encrypt($image->id))); ?>"
                                                   class="mr-3"><i
                                                        class="fa fa-file"></i> <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?>

                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DelModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="<?php echo e(route('ticket.reply', $my_ticket->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title"> <?php echo app('translator')->get('Confirmation Alert'); ?>!</h5>
                        <button type="button" class="close close-button" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <strong class="text-dark"><?php echo app('translator')->get('Are you sure you want to Close This Support Ticket'); ?>?</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark btn-sm" data-dismiss="modal">
                            <?php echo app('translator')->get('No'); ?>
                        </button>
                        <button type="submit" class="btn btn--success btn-sm" name="replayTicket"
                                value="2"></i> <?php echo app('translator')->get("Yes"); ?>
                        </button>
                    </div>
                </form>
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
                $(".fileUploadsContainer").append(` <div class="form-group custom-file mt-3">
                                            <input type="file" name="attachments[]" id="customFile${itr}" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf" />
                                            <label class="custom-file-label" for="customFile${itr}"><?php echo app('translator')->get('Choose file'); ?></label>
                                        </div>`);

            });

        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/support/view.blade.php ENDPATH**/ ?>