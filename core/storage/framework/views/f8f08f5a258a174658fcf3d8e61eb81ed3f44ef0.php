<?php if(auth()->user()->plan_id > 0 && auth()->user()->plan_expiry > \Carbon\Carbon::now()): ?>
    <div class="col-lg-12 col-sm-6 mb-30">
        <div class="card border--light">
            <div class="card-header">
                <h5><?php echo app('translator')->get('Staking Profit Information'); ?></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="profit-info">
                            <h6 class="mb-3"><?php echo app('translator')->get('Daily Profit Status'); ?></h6>
                            <?php if($profit_status == 'credited'): ?>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="p-2 bg-success rounded me-3">
                                        <i class="las la-check-circle text-white"></i>
                                    </span>
                                    <div>
                                        <h5 class="text-success mb-0"><?php echo app('translator')->get('Profit Credited Today'); ?></h5>
                                        <small><?php echo e(getAmount($daily_profit)); ?> <?php echo e($general->cur_text); ?> added to your
                                            balance</small>
                                    </div>
                                </div>
                            <?php elseif($profit_status == 'pending'): ?>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="p-2 bg-warning rounded me-3">
                                        <i class="las la-clock text-white"></i>
                                    </span>
                                    <div>
                                        <h5 class="text-warning mb-0"><?php echo app('translator')->get('Profit Pending'); ?></h5>
                                        <small><?php echo app('translator')->get('Expected'); ?> <?php echo e(getAmount($daily_profit)); ?> <?php echo e($general->cur_text); ?>

                                            today</small>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="p-2 bg-secondary rounded me-3">
                                        <i class="las la-times-circle text-white"></i>
                                    </span>
                                    <div>
                                        <h5 class="text-secondary mb-0"><?php echo app('translator')->get('No Active Plan'); ?></h5>
                                        <small><?php echo app('translator')->get('Purchase a plan to earn daily profits'); ?></small>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="next-profit-info">
                            <h6 class="mb-3"><?php echo app('translator')->get('Next Profit Distribution'); ?></h6>
                            <?php if(isset($next_profit_hours) && $next_profit_hours !== null): ?>
                                <div class="d-flex align-items-center">
                                    <span class="p-2 bg-primary rounded me-3">
                                        <i class="las la-hourglass-half text-white"></i>
                                    </span>
                                    <div>
                                        <h5 class="text-primary mb-0">
                                            <?php if($next_profit_hours > 0): ?>
                                                <?php echo e($next_profit_hours); ?> <?php echo app('translator')->get('hours'); ?>
                                            <?php endif; ?>

                                            <?php if($next_profit_minutes > 0): ?>
                                                <?php echo e($next_profit_minutes); ?> <?php echo app('translator')->get('minutes'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->get('remaining'); ?>
                                        </h5>
                                        <small><?php echo app('translator')->get('Next profit distribution on'); ?>
                                            <?php echo e(\Carbon\Carbon::parse($next_profit_time)->format('M d, Y, h:i A')); ?></small>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="d-flex align-items-center">
                                    <span class="p-2 bg-secondary rounded me-3">
                                        <i class="las la-ban text-white"></i>
                                    </span>
                                    <div>
                                        <h5 class="text-secondary mb-0"><?php echo app('translator')->get('Not Available'); ?></h5>
                                        <small><?php echo app('translator')->get('Purchase a plan to see profit distribution schedule'); ?></small>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\techSphereLogix\stakeavante\core\resources\views/templates/basic/user/partials/profit_display.blade.php ENDPATH**/ ?>