<?php $__env->startSection('panel'); ?>
<div class="row mb-none-30">
<?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-4 col-md-6 mb-30">
        <div class="card"> 
            <div class="card-body pt-5 pb-5 ">
                <div class="pricing-table text-center mb-4">
                    <h2 class="package-name mb-20 text-"><strong><?php echo app('translator')->get($data->name); ?></strong></h2>
                    <span class="text--dark font-weight-bold d-block"><?php echo app('translator')->get('Min Price'); ?> <?php echo e($general->cur_sym); ?> <?php echo e(getAmount($data->min_price)); ?></span><br/>
                    <span class="text--dark font-weight-bold d-block"><?php echo app('translator')->get('Max Price'); ?> <?php echo e($general->cur_sym); ?> <?php echo e(getAmount($data->max_price)); ?></span>
                    <hr>
                    <ul class="package-features-list mt-30">
                        <li><i class="fas fa-check bg--success"></i> <span><?php echo app('translator')->get('Total  Level 7'); ?></span>   <span class="icon" data-toggle="modal" data-target="#bvInfoModal"><i
                                    class="fas fa-question-circle"></i></span></li>
                        <li><i class="fas fa-check bg--success"></i> <span> <?php echo app('translator')->get('Referral Commission'); ?>: <?php echo e(getAmount($data->ref_com)); ?> % </span>
                            <span class="icon" data-toggle="modal" data-target="#refComInfoModal"><i
                            class="fas fa-question-circle"></i></span>
                        </li>
                        <li>
                            <i class="fas fa-check bg--success"></i>  <span><?php echo app('translator')->get('Monthly Profit'); ?>: <?php echo e(getAmount($data->profit)); ?> %</span>
                             <span class="icon" data-toggle="modal" data-target="#treeComInfoModal"><i
                            class="fas fa-question-circle"></i></span>
                        </li>
                    </ul>
                </div>
                <?php if(Auth::user()->plan_id != $data->id): ?>
                    <a href="#confBuyModal<?php echo e($data->id); ?>" data-toggle="modal" class="btn w-100 btn-outline--primary  mt-20 py-2 box--shadow1"><?php echo app('translator')->get('Stake'); ?></a>
                <?php else: ?>
                    <a href="#confRestakeModal<?php echo e($data->id); ?>" data-toggle="modal" class="btn w-100 btn-outline--primary  mt-20 py-2 box--shadow1"><?php echo app('translator')->get('Re Stake'); ?></a>
                <?php endif; ?>
            </div>

        </div><!-- card end -->
    </div>


    <div class="modal fade" id="confBuyModal<?php echo e($data->id); ?>" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> <?php echo app('translator')->get('Confirm Purchase '.$data->name); ?>?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="<?php echo e(route('user.plan.purchase')); ?>">
                    <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <h5 class="text-danger text-center"><?php echo app('translator')->get('Minimum '); ?><?php echo e(getAmount($data->min_price)); ?> <?php echo e($general->cur_text); ?> <?php echo app('translator')->get(' are required to purchase this plan.'); ?></h5>
                    <div class="form-group">
                        <label><?php echo app('translator')->get('With 24 Month Plan avail  rewards benifits'); ?></label>
                        <select class="form-control" name="mplan" required>
                            <option value="1"><?php echo app('translator')->get('24 Months'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Membership will unlock more level'); ?></label>
                        <select class="form-control" name="membership" required>
                            <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($membership->id); ?>"><?php echo e($membership->name); ?> -- <?php echo e($general->cur_text); ?> <?php echo e($membership->price); ?> -- <?php echo app('translator')->get('Levels'); ?> <?php echo e($membership->level); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal"><i
                            class="fa fa-times"></i> <?php echo app('translator')->get('Close'); ?></button>

                    <button type="submit" name="plan_id" value="<?php echo e($data->id); ?>" class="btn btn--success"><i
                            class="lab la-telegram-plane"></i> <?php echo app('translator')->get('Subscribe'); ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Re stake -->
    <div class="modal fade" id="confRestakeModal<?php echo e($data->id); ?>" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> <?php echo app('translator')->get('Confirm Order'); ?>?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="<?php echo e(route('user.plan.restake')); ?>">
                    <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <?php if(auth()->user()->membership_id < 7): ?>
                    <h5 class="text-danger text-center"><?php echo app('translator')->get('Minimum '); ?><?php echo e((1000-getAmount(auth()->user()->total_invest))); ?> <?php echo e($general->cur_text); ?> <?php echo app('translator')->get(' are required to unlock all levels.'); ?></h5>
                    <?php else: ?>
                    <h5 class="text-danger text-center"><?php echo app('translator')->get('Congratulations ! You have unlocked all levels.Re stake more and more to get more profit and commission.'); ?></h5>
                    <?php endif; ?>
                    <?php if(auth()->user()->plan_type==0): ?>
                    <div class="form-group">
                        <label><?php echo app('translator')->get('With 24 Month Plan avail  rewards benifits'); ?></label>
                        <select class="form-control" name="mplan" required>
                            <option value="1"><?php echo app('translator')->get('24 Months'); ?></option>
                        </select>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Add amount'); ?></label>
                        <input class="form-control" name="amount" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal"><i
                            class="fa fa-times"></i> <?php echo app('translator')->get('Close'); ?></button>

                    <button type="submit" name="plan_id" value="<?php echo e($data->id); ?>" class="btn btn--success"><i
                            class="lab la-telegram-plane"></i> <?php echo app('translator')->get('Subscribe'); ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="modal fade" id="bvInfoModal">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><?php echo app('translator')->get("7 Level info"); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo app('translator')->get('Close'); ?>">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <table class="table">
                <tr>
                    <th><?php echo app('translator')->get("Name"); ?></th>
                    <th><?php echo app('translator')->get("Price"); ?></th>
                    <th><?php echo app('translator')->get("Unlock Level"); ?></th>
                </tr>
                <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="text-danger">
                    <td><?php echo e($membership->name); ?></td>
                    <td><?php echo e($general->cur_sym); ?> <?php echo e($membership->price); ?></td>
                    <td><?php echo e($membership->level); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="refComInfoModal">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><?php echo app('translator')->get('Plan Referral Commission info'); ?></h5>
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h5 class=" text-danger"><?php echo app('translator')->get('When you subscribe 24 month plan'); ?> , <?php echo app('translator')->get('you will get rewards as well as your sale will be counted.'); ?></h5>
            </h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="treeComInfoModal">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><?php echo app('translator')->get('Monthly Profit Info'); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h5 class=" text-danger"><?php echo app('translator')->get('Every user will get mentioned % profit on monthly base.'); ?>. </h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic//user/plan.blade.php ENDPATH**/ ?>