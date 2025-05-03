<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('Transaction ID'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Gateway'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Time'); ?></th>
                                <th scope="col"> <?php echo app('translator')->get('Details'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(count($logs) >0): ?>
                                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td data-label="#<?php echo app('translator')->get('Transaction ID'); ?>"><?php echo e($data->trx); ?></td>
                                        <td data-label="<?php echo app('translator')->get('Gateway'); ?>"><?php echo e(__($data->gateway->name)); ?></td>
                                        <td data-label="<?php echo app('translator')->get('Amount'); ?>">
                                            <strong><?php echo e(getAmount($data->amount)); ?> <?php echo e($general->cur_text); ?></strong>
                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                            <?php if($data->status == 1): ?>
                                                <span class="badge badge--success"><?php echo app('translator')->get('Complete'); ?></span>
                                            <?php elseif($data->status == 2): ?>
                                                <span class="badge badge--warning"><?php echo app('translator')->get('Pending'); ?></span>
                                            <?php elseif($data->status == 3): ?>
                                                <span class="badge badge--danger"><?php echo app('translator')->get('Cancel'); ?></span>
                                            <?php endif; ?>
                                            <?php if($data->admin_feedback != null): ?>
                                                <button class="btn--info btn-rounded  badge detailBtn"
                                                        data-admin_feedback="<?php echo e($data->admin_feedback); ?>"><i
                                                        class="fa fa-info"></i></button>
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Time'); ?>">
                                            <i class="las la-calendar"></i> <?php echo e(showDateTime($data->created_at)); ?>

                                        </td>
                                        <?php
                                            $details = ($data->detail != null) ? json_encode($data->detail) : null;
                                        ?>
                                        <td data-label="<?php echo app('translator')->get('Details'); ?>">
                                            <a href="javascript:void(0)" class="icon-btn  approveBtn"
                                               data-info="<?php echo e($details); ?>"
                                               data-id="<?php echo e($data->id); ?>"
                                               data-amount="<?php echo e(getAmount($data->amount)); ?> <?php echo e($general->cur_text); ?>"
                                               data-charge="<?php echo e(getAmount($data->charge)); ?> <?php echo e($general->cur_text); ?>"
                                               data-after_charge="<?php echo e(getAmount($data->amount + $data->charge)); ?> <?php echo e($general->cur_text); ?>"
                                               data-rate="<?php echo e(getAmount($data->rate)); ?> <?php echo e($data->method_currency); ?>"
                                               data-payable="<?php echo e(getAmount($data->final_amo)); ?> <?php echo e($data->method_currency); ?>">
                                                <i class="fa fa-desktop"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="100%" class="text-center"> <?php echo app('translator')->get('No results found'); ?>!</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <?php echo e($logs->appends($_GET)->links()); ?>

                </div>
            </div>
        </div>
    </div>

    
    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Details'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item "><?php echo app('translator')->get('Amount'); ?> : <span class="withdraw-amount "></span></li>
                        <li class="list-group-item "><?php echo app('translator')->get('Charge'); ?> : <span class="withdraw-charge "></span></li>
                        <li class="list-group-item "><?php echo app('translator')->get('After Charge'); ?> : <span class="withdraw-after_charge"></span>
                        </li>
                        <li class="list-group-item "><?php echo app('translator')->get('Conversion Rate'); ?> : <span class="withdraw-rate"></span></li>
                        <li class="list-group-item "><?php echo app('translator')->get('Payable Amount'); ?> : <span class="withdraw-payable"></span>
                        </li>
                    </ul>
                    <ul class="list-group withdraw-detail mt-1">
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                </div>
            </div>
        </div>
    </div>


    
    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Details'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo app('translator')->get('Close'); ?>">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="withdraw-detail"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function ($) {
            $('.approveBtn').on('click', function () {
                var modal = $('#approveModal');
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.find('.withdraw-charge').text($(this).data('charge'));
                modal.find('.withdraw-after_charge').text($(this).data('after_charge'));
                modal.find('.withdraw-rate').text($(this).data('rate'));
                modal.find('.withdraw-payable').text($(this).data('payable'));
                var list = [];
                var details = Object.entries($(this).data('info'));

                var ImgPath = "<?php echo e(asset(imagePath()['verify']['deposit']['path'])); ?>/";
                var singleInfo = '';
                for (var i = 0; i < details.length; i++) {
                    if (details[i][1].type == 'file') {
                        singleInfo += `<li class="list-group-item">
                                    <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <img src="${ImgPath}/${details[i][1].field_name}" alt="..." class="w-100">
                                </li>`;
                    } else {
                        singleInfo += `<li class="list-group-item">
                                    <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <span class="font-weight-bold ml-3">${details[i][1].field_name}</span>
                                </li>`;
                    }
                }

                if (singleInfo) {
                    modal.find('.withdraw-detail').html(`<br><strong class="my-3"><?php echo app('translator')->get('Payment Information'); ?></strong>  ${singleInfo}`);
                } else {
                    modal.find('.withdraw-detail').html(`${singleInfo}`);
                }
                modal.modal('show');
            });

            $('.detailBtn').on('click', function () {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Search by TRX'); ?>" value="<?php echo e(@$search); ?>">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
<?php $__env->stopPush(); ?>



<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/deposit_history.blade.php ENDPATH**/ ?>