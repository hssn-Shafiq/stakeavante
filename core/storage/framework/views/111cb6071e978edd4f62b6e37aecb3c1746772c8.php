<?php
    use App\Models\UserProfit;
    use Carbon\Carbon;

    // Check if there's already a profit for today
    $todayProfit = UserProfit::getUserProfitForDate(auth()->id());
    $profitCredited = $todayProfit != null;

    // Get expected profit if not credited yet
    if (!$profitCredited) {
        $expectedProfit = UserProfit::getExpectedProfit(auth()->id());
    }

    // Calculate next profit time
    if ($profitCredited) {
        // If profit already received, next is tomorrow at same time
        $lastProfitTime = Carbon::parse($todayProfit->created_at);
        $nextProfitTime = $lastProfitTime->copy()->addDay();
    } else {
        // If not yet received, next is at midnight
        $nextProfitTime = Carbon::tomorrow()->startOfDay();
    }

    // Calculate remaining time
    $hoursRemaining = Carbon::now()->diffInHours($nextProfitTime, false);
    $minutesRemaining = Carbon::now()->diffInMinutes($nextProfitTime, false) % 60;
?>

<div class="" style="width: 100% ; margin-bottom: 30px;">
    <div class="card  b-radius--10">
        <div class="card-header">
            <h5><?php echo app('translator')->get('Daily Profit Summary'); ?></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h6 class="text-muted mb-2"><?php echo app('translator')->get('Today\'s Profit Status'); ?></h6>

                    <?php if(isset($todayProfit)): ?>
                        <div class="profit-status credited">
                            <div class="d-flex align-items-center">
                                <span class="icon-circle bg-success me-2">
                                    <i class="las la-check-circle text-white"></i>
                                </span>
                                <div>
                                    <h5 class="mb-0 text-success">
                                        <?php echo e(getAmount($todayProfit->amount ?? $todayProfit->profit)); ?>

                                        <?php echo e($general->cur_text); ?></h5>
                                    <small class="text-muted"><?php echo app('translator')->get('Credited at'); ?>
                                        <?php echo e(showDateTime($todayProfit->created_at, 'h:i A')); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php elseif(isset($expectedProfit) && $expectedProfit > 0): ?>
                        <div class="profit-status pending">
                            <div class="d-flex align-items-center">
                                <span class="icon-circle bg-warning me-2">
                                    <i class="las la-clock text-white"></i>
                                </span>
                                <div class="ml-4">
                                    <h5 class="mb-0 text-warning"><?php echo e(getAmount($expectedProfit)); ?>

                                        <?php echo e($general->cur_text); ?></h5>
                                    <small class="text-muted"><?php echo app('translator')->get('Expected today'); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="profit-status inactive">
                            <div class="d-flex align-items-center">
                                <span class="icon-circle bg-secondary me-2">
                                    <i class="las la-ban text-white"></i>
                                </span>
                                <div class="ml-4">
                                    <h5 class="mb-0 text-secondary"><?php echo app('translator')->get('No Active Investment'); ?></h5>
                                    <small class="text-muted"><?php echo app('translator')->get('Invest to earn daily profits'); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <h6 class="text-muted mb-2"><?php echo app('translator')->get('Next Profit'); ?></h6>

                    <?php if(isset($expectedProfit) || isset($todayProfit)): ?>
                        <div class="next-profit">
                            <div class="d-flex align-items-center">
                                <span class="icon-circle bg-primary me-2">
                                    <i class="las la-hourglass-half text-white"></i>
                                </span>
                                <div class="ml-4">
                                    <h5 class="mb-0 text-primary">
                                        <?php echo e($hoursRemaining); ?>h <?php echo e($minutesRemaining); ?>m
                                    </h5>
                                    <small class="text-muted">
                                        <?php echo app('translator')->get('Next credit on'); ?> <?php echo e($nextProfitTime->format('M d, Y h:i A')); ?>

                                    </small>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="next-profit inactive">
                            <div class="d-flex align-items-center">
                                <span class="icon-circle bg-secondary me-2">
                                    <i class="las la-clock text-white"></i>
                                </span>
                                <div class="ml-4">
                                    <h5 class="mb-0 text-secondary"><?php echo app('translator')->get('Not Available'); ?></h5>
                                    <small class="text-muted"><?php echo app('translator')->get('Purchase a plan first'); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if(isset($expectedProfit) || isset($todayProfit)): ?>
                <div class="text-center mt-4">
                    <a href="<?php echo e(route('user.report.profits')); ?>" class="btn btn-sm btn-primary">
                        <i class="las la-history"></i> <?php echo app('translator')->get('View Profit History'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-circle i {
        font-size: 1.5em;
    }

    .card {
        width: 100%;
        margin: 0 auto;
    }
</style>
<?php /**PATH C:\laragon\www\techSphereLogix\stakeavante\core\resources\views/templates/basic/user/partials/profit_summary.blade.php ENDPATH**/ ?>