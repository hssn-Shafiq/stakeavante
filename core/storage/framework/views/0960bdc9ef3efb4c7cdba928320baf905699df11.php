<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">

        <div class="col-xl-3 col-lg-5 col-md-5 mb-30">

            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <div class="">
                            <img src="<?php echo e(getImage('assets/images/user/profile/'. $user->image, null, true)); ?>" alt="<?php echo app('translator')->get('profile-image'); ?>"
                                 class="b-radius--10 w-100">
                        </div>
                        <div class="mt-15">
                            <h4 class=""><?php echo e($user->fullname); ?></h4>
                            <span class="text--small"><?php echo app('translator')->get('Joined At '); ?><strong><?php echo e(showDateTime($user->created_at,'d M, Y h:i A')); ?></strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted"><?php echo app('translator')->get('User information'); ?></h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Username'); ?>
                            <span class="font-weight-bold"><?php echo e($user->username); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <?php echo app('translator')->get('Added By'); ?>
                            <span class="font-weight-bold"> <?php echo e($added_id->username ?? 'N/A'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <?php echo app('translator')->get('Tree Head'); ?>
                            <span class="font-weight-bold"> <?php echo e($ref_id->username ?? 'N/A'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <?php echo app('translator')->get('Payment'); ?>
                            <?php switch($user->plan_id):
                                case (1): ?>
                                <span class="badge badge-pill bg--success"><?php echo app('translator')->get('Paid'); ?></span>
                                <?php break; ?>
                                <?php case (0): ?>
                                <span class="badge badge-pill bg--danger"><?php echo app('translator')->get('Unpaid'); ?></span>
                                <?php break; ?>
                            <?php endswitch; ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Balance'); ?>
                            <span class="font-weight-bold"> <?php echo e(getAmount($user->balance)); ?>  <?php echo e($general->cur_text); ?> </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('User Plan'); ?>
                            <span class="font-weight-bold">
                                <?php if($user->plan_type==1): ?>
                                <?php echo app('translator')->get('12 Month'); ?>
                                <?php elseif($user->plan_type==0): ?>
                                <?php echo app('translator')->get('1 Month'); ?>
                                <?php else: ?>
                                <?php echo app('translator')->get('No Plan'); ?>
                                <?php endif; ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Status'); ?>
                            <?php switch($user->status):
                                case (1): ?>
                                <span class="badge badge-pill bg--success"><?php echo app('translator')->get('Active'); ?></span>
                                <?php break; ?>
                                <?php case (2): ?>
                                <span class="badge badge-pill bg--danger"><?php echo app('translator')->get('Banned'); ?></span>
                                <?php break; ?>
                            <?php endswitch; ?>
                        </li>

                    </ul>
                </div>
            </div>
            <?php if(auth('admin')->user()->access==1): ?>
            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted"><?php echo app('translator')->get('User action'); ?></h5>
                    <a href="<?php echo e(route('admin.users.login',$user->id)); ?>" target="_blank" class="btn btn--dark btn--shadow btn-block btn-lg">
                        <i class="las la-sign-in-alt"></i><?php echo app('translator')->get('Login as User'); ?>
                    </a>

                    <a data-toggle="modal" href="#addSubModal" class="btn btn--success btn--shadow btn-block btn-lg">
                        <?php echo app('translator')->get('Add/Subtract Balance'); ?>
                    </a>
                    <a href="<?php echo e(route('admin.users.login.history.single', $user->id)); ?>"
                       class="btn btn--primary btn--shadow btn-block btn-lg">
                        <?php echo app('translator')->get('Login Logs'); ?>
                    </a>
                    <a href="<?php echo e(route('admin.users.email.single',$user->id)); ?>"
                       class="btn btn--danger btn--shadow btn-block btn-lg">
                        <?php echo app('translator')->get('Send Email'); ?>
                    </a>
                    <a href="<?php echo e(route('admin.users.single.tree',$user->username)); ?>"
                       class="btn btn--primary btn--shadow btn-block btn-lg">
                       <?php echo app('translator')->get('User Tree'); ?>
                    </a>
                    <a href="<?php echo e(route('admin.users.ref',$user->id)); ?>"
                       class="btn btn--info btn--shadow btn-block btn-lg">
                        <?php echo app('translator')->get('User Referrals'); ?>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
            <div class="row mb-none-30">
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--success b-radius--10 box-shadow has--link">
                        <a  class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount"><?php echo e(getAmount($user->balance)); ?></span>
                                <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                            </div>
                            <div class="desciption">
                                <span><?php echo app('translator')->get('Current Balance'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--10 b-radius--10 box-shadow has--link">
                        <a href="<?php echo e(route('admin.users.transactions',$user->id)); ?>" class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount"><?php echo e(getAmount($user->total_invest)); ?></span>
                                <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                            </div>
                            <div class="desciption">
                                <span><?php echo app('translator')->get('Total Invest'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--warning b-radius--10 box-shadow has--link">
                        <a href="<?php echo e(route('admin.users.transactions',$user->id)); ?>" class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount"><?php echo e(getAmount($user->total_sale)); ?></span>
                                <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                            </div>
                            <div class="desciption">
                                <span><?php echo app('translator')->get('Total sale'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--primary b-radius--10 box-shadow has--link">
                        <a href="<?php echo e(route('admin.users.deposits',$user->id)); ?>" class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount"><?php echo e(getAmount($totalDeposit)); ?></span>
                                <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                            </div>
                            <div class="desciption">
                                <span><?php echo app('translator')->get('Total Deposit'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--red b-radius--10 box-shadow has--link">
                        <a href="<?php echo e(route('admin.users.withdrawals',$user->id)); ?>" class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-wallet"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount"><?php echo e(getAmount($totalWithdraw)); ?></span>
                                <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                            </div>
                            <div class="desciption">
                                <span><?php echo app('translator')->get('Total Withdraw'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- dashboard-w1 end -->

                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--dark b-radius--10 box-shadow has--link">
                        <a href="<?php echo e(route('admin.users.transactions',$user->id)); ?>" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-exchange-alt"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount"><?php echo e(getAmount($user->free_coins)); ?></span>
                            </div>
                            <div class="desciption">
                                <span><?php echo app('translator')->get('Total Free Coins'); ?></span>
                            </div>
                        </div>
                    </div>
                </div><!-- dashboard-w1 end -->


                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--info b-radius--10 box-shadow has--link">
                        <a href="<?php echo e(route('admin.report.invest')); ?>?user=<?php echo e($user->id); ?>" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-money"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount"><?php echo e(getAmount($user->total_invest)); ?></span>
                                <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                            </div>
                            <div class="desciption">
                                <span><?php echo app('translator')->get('Total Invest'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--indigo b-radius--10 box-shadow has--link">
                        <a href="<?php echo e(route('admin.report.binarySummery')); ?>?userID=<?php echo e($user->id); ?>" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-user"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount"><?php echo e($totalTreeUsers); ?></span>
                            </div>
                            <div class="desciption">
                                <span><?php echo app('translator')->get('Total Tree Users'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--10 b-radius--10 box-shadow has--link">
                        <a href="<?php echo e(route('admin.report.binaryCom')); ?>?userID=<?php echo e($user->id); ?>" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-tree"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount"><?php echo e(getAmount($user->total_binary_com)); ?></span>
                                <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                            </div>
                            <div class="desciption">
                                <span><?php echo app('translator')->get('Total Tree Commission'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mt-50">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2"><?php echo app('translator')->get('Information'); ?></h5>

                    <form action="<?php echo e(route('admin.users.update',[$user->id])); ?>" method="POST"
                          enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('First Name'); ?><span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="firstname"
                                           value="<?php echo e($user->firstname); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold"><?php echo app('translator')->get('Last Name'); ?> <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="lastname" value="<?php echo e($user->lastname); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Email'); ?> <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" value="<?php echo e($user->email); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold"><?php echo app('translator')->get('Mobile Number'); ?> <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="mobile" value="<?php echo e($user->mobile); ?>">
                                </div>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Address'); ?> </label>
                                    <input class="form-control" type="text" name="address"
                                           value="<?php echo e($user->address->address); ?>">
                                    <small class="form-text text-muted"><i class="las la-info-circle"></i> <?php echo app('translator')->get('House number, street address'); ?>
                                    </small>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('City'); ?> </label>
                                    <input class="form-control" type="text" name="city"
                                           value="<?php echo e($user->address->city); ?>">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('State'); ?> </label>
                                    <input class="form-control" type="text" name="state"
                                           value="<?php echo e($user->address->state); ?>">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Zip/Postal'); ?> </label>
                                    <input class="form-control" type="text" name="zip"
                                           value="<?php echo e($user->address->zip); ?>">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Country'); ?> </label>
                                    <select name="country" class="form-control"> <?php echo $__env->make('partials.country', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Status'); ?> </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Active" data-off="Banned" data-width="100%"
                                       name="status"
                                       <?php if($user->status): ?> checked <?php endif; ?>>
                            </div>

                            <div class="form-group  col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Email Verification'); ?> </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Verified" data-off="Unverified" name="ev"
                                       <?php if($user->ev): ?> checked <?php endif; ?>>

                            </div>

                            <div class="form-group  col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('SMS Verification'); ?> </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Verified" data-off="Unverified" name="sv"
                                       <?php if($user->sv): ?> checked <?php endif; ?>>

                            </div>
                            <div class="form-group  col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('2FA Status'); ?> </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Active" data-off="Deactive" name="ts"
                                       <?php if($user->ts): ?> checked <?php endif; ?>>
                            </div>

                            <div class="form-group  col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('2FA Verification'); ?> </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Verified" data-off="Unverified" name="tv"
                                       <?php if($user->tv): ?> checked <?php endif; ?>>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php if(auth('admin')->user()->access==1): ?>
                                    <button type="submit" class="btn btn--primary btn-block btn-lg"><?php echo app('translator')->get('Save Changes'); ?>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php if(auth('admin')->user()->access==1): ?>
    
    <div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Add / Subtract Balance'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.users.addSubBalance', $user->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="checkbox" data-width="100%" data-height="44px" data-onstyle="-success"
                                       data-offstyle="-danger" data-toggle="toggle" data-on="Add Balance"
                                       data-off="Subtract Balance" name="act" checked>
                            </div>


                            <div class="form-group col-md-12">
                                <label><?php echo app('translator')->get('Amount'); ?><span class="text-danger">*</span></label>
                                <div class="input-group has_append">
                                    <input type="text" name="amount" class="form-control"
                                           placeholder="Please provide positive amount">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><?php echo e($general->cur_text); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn--success"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        (function($){
            $("select[name=country]").val("<?php echo e(@$user->address->country); ?>");
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/users/detail.blade.php ENDPATH**/ ?>