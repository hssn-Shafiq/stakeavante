<?php $__env->startSection('panel'); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive--sm">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('SL'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Subject'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Last Reply'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $supports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-label="<?php echo app('translator')->get('SL'); ?>"><?php echo e($key+1); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Subject'); ?>"> <a href="<?php echo e(route('ticket.view', $support->ticket)); ?>" class="font-weight-bold"> [<?php echo app('translator')->get('Ticket'); ?>#<?php echo e($support->ticket); ?>] <?php echo e($support->subject); ?> </a></td>
                                    <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                        <?php if($support->status == 0): ?>
                                            <span class="badge badge--success"><?php echo app('translator')->get('Open'); ?></span>
                                        <?php elseif($support->status == 1): ?>
                                            <span class="badge badge--primary "><?php echo app('translator')->get('Answered'); ?></span>
                                        <?php elseif($support->status == 2): ?>
                                            <span class="badge badge--warning"><?php echo app('translator')->get('Reply'); ?></span>
                                        <?php elseif($support->status == 3): ?>
                                            <span class="badge badge--dark"><?php echo app('translator')->get('Closed'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Last Reply'); ?>"><?php echo e(\Carbon\Carbon::parse($support->last_reply)->diffForHumans()); ?> </td>

                                    <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                        <a href="<?php echo e(route('ticket.view', $support->ticket)); ?>" class="icon-btn" data-toggle="tooltip" title="" data-original-title="<?php echo app('translator')->get('Details'); ?>">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <?php echo e($supports->links()); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('ticket.open')); ?>" class="btn btn-sm btn--success box--shadow1 text--small"><i class="las la-plus-circle"></i><?php echo app('translator')->get('New Ticket'); ?></a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/support/index.blade.php ENDPATH**/ ?>