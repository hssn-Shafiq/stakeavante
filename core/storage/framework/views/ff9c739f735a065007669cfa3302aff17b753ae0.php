

<?php $__env->startSection('panel'); ?> <div class="row mb-none-30">
        <div class="col-lg-12">
            <div class="card border--light mb-5">
                <?php echo $__env->make($activeTemplate . 'user.partials.countdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

        <?php if(auth()->user()->plan_id > 0 && auth()->user()->plan_expiry > \Carbon\Carbon::now()): ?>
            <?php echo $__env->make($activeTemplate . 'user.partials.profit_summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
 
        <?php if(isUserPiad() == true): ?>
            <?php if(auth()->user()->reward_one != 0): ?>
                <div class="col-lg-12 col-sm-6 mb-10">
                    <div class="card border--light">
                        <div class="card-body">
                            <div class="bg--white">
                                <?php if(auth()->user()->reward_one == 1): ?>
                                    <img id="output"
                                        src="<?php echo e(getImage('assets/images/user/awards/reward1-main.png', null, true)); ?>"
                                        alt="<?php echo app('translator')->get('reward-1-image'); ?>" class="img-responsive b-radius--10"
                                        title="Team Leader Achieved" style="width:10%;">
                                <?php endif; ?>
                                <?php if(auth()->user()->reward_two == 1): ?>
                                    <img id="output"
                                        src="<?php echo e(getImage('assets/images/user/awards/reward2-main.png', null, true)); ?>"
                                        alt="<?php echo app('translator')->get('reward-2-image'); ?>" class="img-responsive b-radius--10"
                                        title="Region Leader Achieved" style="width:10%;">
                                <?php endif; ?>
                                <?php if(auth()->user()->reward_three == 1): ?>
                                    <img id="output"
                                        src="<?php echo e(getImage('assets/images/user/awards/reward3-main.png', null, true)); ?>"
                                        alt="<?php echo app('translator')->get('reward-3-image'); ?>" class="img-responsive b-radius--10"
                                        title="National Leader Achieved" style="width:10%;">
                                <?php endif; ?>
                                <?php if(auth()->user()->reward_four == 1): ?>
                                    <img id="output"
                                        src="<?php echo e(getImage('assets/images/user/awards/reward4-main.png', null, true)); ?>"
                                        alt="<?php echo app('translator')->get('reward-4-image'); ?>" class="img-responsive b-radius--10"
                                        title="Royal Leader Achieved" style="width:10%;">
                                <?php endif; ?>
                                <?php if(auth()->user()->reward_five == 1): ?>
                                    <img id="output"
                                        src="<?php echo e(getImage('assets/images/user/awards/reward5-main.png', null, true)); ?>"
                                        alt="<?php echo app('translator')->get('reward-5-image'); ?>" class="img-responsive b-radius--10"
                                        title="Crown Leader Achieved" style="width:10%;">
                                <?php endif; ?>
                                <?php if(auth()->user()->reward_six == 1): ?>
                                    <img id="output"
                                        src="<?php echo e(getImage('assets/images/user/awards/reward6-main.png', null, true)); ?>"
                                        alt="<?php echo app('translator')->get('reward-6-image'); ?>" class="img-responsive b-radius--10"
                                        title="Diamond Leader Achieved" style="width:10%;">
                                <?php endif; ?>
                                <?php if(auth()->user()->reward_seven == 1): ?>
                                    <img id="output"
                                        src="<?php echo e(getImage('assets/images/user/awards/reward7-main.png', null, true)); ?>"
                                        alt="<?php echo app('translator')->get('reward-7-image'); ?>" class="img-responsive b-radius--10"
                                        title="The Nobel Leader Achieved" style="width:10%;">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($general->notice != null): ?>
                <div class="col-lg-12 col-sm-6 mb-30">
                    <div class="card border--light">
                        <div class="card-header"><?php echo app('translator')->get('Notice Board'); ?>
                            <?php if(auth()->user()->plan_type != 0): ?>
                                <marquee behavior="scroll" direction="left" scrollamount="2">
                                    <h4 class="text-danger" style="font-family:Cursive;">
                                        <?php if(auth()->user()->plan_id < 1): ?>
                                            <?php echo app('translator')->get('Your Staking plan is expired on '); ?><?php echo e(auth()->user()->plan_expiry); ?>

                                        <?php else: ?>
                                            <?php echo app('translator')->get(' Your Staking will expire on '); ?><?php echo e(auth()->user()->plan_expiry); ?>

                                        <?php endif; ?>
                                    </h4>
                                </marquee>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $general->notice; ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <?php if($general->free_user_notice != null): ?>
                <div class="col-lg-12 col-sm-6 mb-30">
                    <div class="card border--light">
                        <?php if($general->notice == null): ?>
                            <div class="card-header"><?php echo app('translator')->get(' Notice'); ?></div>
                        <?php endif; ?>
                        <div class="card-body">
                            <p class="card-text"> <?php echo $general->free_user_notice; ?> </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--success b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers mb-2">
                        <?php if(isset($daily_profit) && $profit_status == 'pending'): ?>
                            <div class=" flex-row align-items-baseline ">
                                <span class="amount"><?php echo e(getAmount(auth()->user()->balance + $daily_profit)); ?></span>
                                <span class="currency-sign ml-2"><?php echo e($general->cur_text); ?></span>
                            </div>
                            <small class="d-block text--xxsmall mt-1 text--white">
                                <i class="las la-info-circle"></i> <?php echo app('translator')->get('Includes expected profit of'); ?> +<?php echo e(getAmount($daily_profit)); ?>

                                <?php echo e($general->cur_text); ?>

                            </small>
                            <span class="badge bg--warning ms-2">
                                <i class="las la-info-circle"></i> <?php echo app('translator')->get('Pending'); ?>
                            </span>
                        <?php else: ?>
                            <span class="amount"><?php echo e(getAmount(auth()->user()->balance)); ?></span>
                        <?php endif; ?>

                    </div>
                    
                    
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--10 b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e(getAmount(auth()->user()->total_invest)); ?></span>
                        <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Invest'); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--warning b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e(getAmount(auth()->user()->total_sale)); ?></span>
                        <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Sale'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-cloud-upload-alt "></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e(getAmount($totalDeposit)); ?></span>
                        <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Deposit'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--red b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-cloud-download-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e(getAmount($totalWithdraw)); ?></span>
                        <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Withdraw'); ?></span>
                    </div>
                    <?php if(isUserPiad() == true): ?>
                        <a href="<?php echo e(route('user.report.withdraw')); ?>"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--dark b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="fa fa-tree"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <div class="d-flex flex-row  justify-content-between">
                            <div class="comissions_amount">
                                <span class="amount">
                                    <i class="las la-arrow-circle-up" data-toggle="tooltip" data-placement="top"
                                        title="<?php echo app('translator')->get('Indirect Referrals Commission'); ?>"></i><?php echo e(getAmount(auth()->user()->total_indir_com)); ?>

                                </span>
                                <span class="amount">
                                    <i class="las la-user-circle" data-toggle="tooltip" data-placement="top"
                                        title="<?php echo app('translator')->get('Direct Referrals Commission'); ?>"></i><?php echo e(getAmount(auth()->user()->total_binary_com)); ?>

                                </span>
                            </div>
                            <span class="currency-sign ms-2"> <?php echo e($general->cur_text); ?></span>
                        </div>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Tree Commission'); ?></span>
                    </div>
                    <?php if(isUserPiad() == true): ?>
                        <a href="<?php echo e(route('user.report.binaryCom')); ?>"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--info b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-money-bill"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e($totalTreeUsers); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Tree Users'); ?></span>
                    </div>
                    <?php if(isUserPiad() == true): ?>
                        <a href="<?php echo e(route('user.binary.summery')); ?>"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-chart-line"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <?php if(isset($daily_profit) && $daily_profit != 'NA'): ?>
                            <span class="amount"><?php echo e(getAmount($daily_profit)); ?></span>
                            <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                        <?php else: ?>
                            <span class="amount">0.00</span>
                            <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Daily Profit'); ?></span>
                    </div>
                    <?php if(isset($next_profit_hours) && $next_profit_hours !== null): ?>
                        <div class="mt-2">
                            <span class="badge bg--white text--primary">
                                <?php if($profit_status == 'credited'): ?>
                                    <i class="las la-check-circle"></i> <?php echo app('translator')->get('Next:'); ?> <?php echo e($next_profit_hours); ?>h
                                    <?php echo e($next_profit_minutes); ?>m
                                <?php elseif($profit_status == 'pending'): ?>
                                    <i class="las la-clock"></i> <?php echo app('translator')->get('Expected In:'); ?> <?php echo e($next_profit_hours); ?>h
                                    <?php echo e($next_profit_minutes); ?>m
                                <?php endif; ?>
                            </span>
                        </div>
                    <?php endif; ?>
                    <?php if(isUserPiad() == true && $profit_status != 'inactive'): ?>
                        <a href="<?php echo e(route('user.report.profits')); ?>"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--indigo b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e($total_ref); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Referral'); ?></span>
                    </div>
                    <?php if(isUserPiad() == true): ?>
                        <a href="<?php echo e(route('user.my.ref')); ?>"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php if(auth()->user()->social_count < 6): ?>
        <?php echo $__env->make($activeTemplate . 'user.partials.socialFollowModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        $(document).ready(function() {
            $("#myModal").modal('show');
        });
    </script>
    <script>
        'use strict';
        (function($) {
            document.body.addEventListener('click', copy, true);

            function copy(e) {
                var
                    t = e.target,
                    c = t.dataset.copytarget,
                    inp = (c ? document.querySelector(c) : null);
                if (inp && inp.select) {
                    inp.select();
                    try {
                        document.execCommand('copy');
                        inp.blur();
                        t.classList.add('copied');
                        setTimeout(function() {
                            t.classList.remove('copied');
                        }, 1500);
                    } catch (err) {
                        alert(`<?php echo app('translator')->get('Please press Ctrl/Cmd+C to copy'); ?>`);
                    }
                }
            }
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\techSphereLogix\stakeavante\core\resources\views/templates/basic/user/dashboard.blade.php ENDPATH**/ ?>