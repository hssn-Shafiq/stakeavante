<?php $__env->startSection('content'); ?>
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row g-4 justify-content-center">

            <div class="col-xl-12">
                <div class="card  cmn--card">
                    <div class="card-header d-flex flex-wrap justify-content-between" style="gap: 10px">
                        <h6 class="my-0">
                            <?php if($my_ticket->status == 0): ?>
                                <span class="badge badge--success"><?php echo app('translator')->get('Open'); ?></span>
                            <?php elseif($my_ticket->status == 1): ?>
                                <span class="badge badge--primary"><?php echo app('translator')->get('Answered'); ?></span>
                            <?php elseif($my_ticket->status == 2): ?>
                                <span class="badge badge--warning"><?php echo app('translator')->get('Replied'); ?></span>
                            <?php elseif($my_ticket->status == 3): ?>
                                <span class="badge badge--danger"><?php echo app('translator')->get('Closed'); ?></span>
                            <?php endif; ?>
                            [<?php echo app('translator')->get('Ticket'); ?>#<?php echo e($my_ticket->ticket); ?>] <?php echo e($my_ticket->subject); ?>

                        </h6>

                        <?php if($my_ticket->status != 3): ?>
                            <button class="btn btn--danger btn-sm close-button" type="button" data-bs-toggle="modal" data-bs-target="#DelModal"><i class="fa fa-times me-2"></i> <?php echo app('translator')->get('Close Ticket'); ?>
                            </button>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                        <?php if($my_ticket->status != 3): ?>
                            <div class="accordion" id="accordionExample">
                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <form method="post" action="<?php echo e(route('ticket.reply', $my_ticket->id)); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="replayTicket" value="1">
                                        <div class="row justify-content-between">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="message" class="form-control form--control" id="inputMessage" placeholder="<?php echo app('translator')->get('Your Reply'); ?>" rows="4" cols="10" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between align-items-center gy-3 pb-3">
                                            <div class="col-md-12">
                                                <div class="form-group mb-0">
                                                    <label class="form--label-2 text--title"><?php echo app('translator')->get('Attachments'); ?></label>
                                                    <div class="input-group d-flex mb-2">
                                                        <input type="file" class="form-control form--control" name="attachments[]">
                                                        <a href="javascript:void(0)" class="btn btn--success btn-round addFile support-btn"
                                                        onclick="extraTicketAttachment()">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                                <div id="fileUploadsContainer"></div>
                                                    <p class="my-2 ticket-attachments-message text-muted fs--13px">
                                                        <?php echo app('translator')->get('Allowed File Extensions'); ?>: .<?php echo app('translator')->get('jpg'); ?>, .<?php echo app('translator')->get('jpeg'); ?>, .<?php echo app('translator')->get('png'); ?>, .<?php echo app('translator')->get('pdf'); ?>, .<?php echo app('translator')->get('doc'); ?>, .<?php echo app('translator')->get('docx'); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="cmn--btn"><i class="fa fa-reply"></i>&nbsp;<?php echo app('translator')->get('Reply'); ?></button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0 p-sm-3">
                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($message->admin_id == 0): ?>
                                <div class="row border border-primary border-radius-3 my-3 py-5 mx-sm-2">
                                    <div class="col-md-3 border-right text-right">
                                        <h5 class="mb-3 "><?php echo e($message->ticket->name); ?></h5>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-muted font-weight-bold mb-3">
                                            <?php echo app('translator')->get('Posted on'); ?> <?php echo e($message->created_at->format('l, dS F Y @ H:i')); ?></p>
                                        <p><?php echo e($message->message); ?></p>
                                        <?php if($message->attachments()->count() > 0): ?>
                                            <div class="mt-2">
                                                <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('ticket.download',encrypt($image->id))); ?>" class="mr-3"><i class="fa fa-file"></i>  <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?> </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row border border-warning border-radius-3 my-3 py-5 mx-sm-2">
                                    <div class="col-md-3 border-right text-right">
                                        <h5 class="my-3"><?php echo e($message->admin->name); ?></h5>
                                        <p class="lead text-muted"><?php echo app('translator')->get('Staff'); ?></p>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-muted font-weight-bold my-3">
                                            <?php echo app('translator')->get('Posted on'); ?> <?php echo e($message->created_at->format('l, dS F Y @ H:i')); ?></p>
                                        <p><?php echo e($message->message); ?></p>
                                        <?php if($message->attachments()->count() > 0): ?>
                                            <div class="mt-2">
                                                <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('ticket.download',encrypt($image->id))); ?>" class="mr-3"><i class="fa fa-file"></i>  <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?> </a>
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
    </div>
</section>

<div class="modal cmn--modal fade" id="DelModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <?php echo app('translator')->get('Confirmation Alert'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?php echo e(route('ticket.reply', $my_ticket->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <strong class="text-dark"><?php echo app('translator')->get('Are you sure to close this support ticket'); ?>?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-bs-dismiss="modal"><?php echo app('translator')->get('No'); ?></button>
                    <button type="submit" class="btn btn--base" name="replayTicket" value="2"><?php echo app('translator')->get('Yes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'frontend/css/ticket.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function ($) {
            "use strict";

            $(document).on('click','.remove-btn',function(){
                $(this).closest('.input-group').remove();
            });

        })(jQuery);

        function extraTicketAttachment() {
            $("#fileUploadsContainer").append(`
                <div class="input-group d-flex mt-4">
                    <input type="file" name="attachments[]" class="form-control form--control"/>
                    <button class="input-group-text support-btn remove-btn btn--danger border-0"><i class="las la-times"> </i></button>
                </div>
            `)
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/support/view.blade.php ENDPATH**/ ?>