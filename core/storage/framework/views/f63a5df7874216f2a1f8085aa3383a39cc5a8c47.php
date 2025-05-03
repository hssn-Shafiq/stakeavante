<?php $__env->startSection('panel'); ?>
<div class="row">
<div class="col-lg-12">
<div class="card b-radius--10 ">
<div class="card-body p-0">
    <div class="table-responsive--md  table-responsive">
        <?php if(auth()->user()->plan_type==0): ?>
    <div class="modal-content">
        <div class="modal-body">
            <h5 class=" text-danger"><?php echo app('translator')->get('When you subscribe 24 month plan'); ?> , <?php echo app('translator')->get('you will get rewards as well as your sale will be counted.'); ?></h5>
            </h5>
        </div>
    </div>
    <?php elseif(auth()->user()->plan_type==1): ?>
        <table class="table table--light style--two">
            <thead>
            <tr>
                <th scope="col"><?php echo app('translator')->get('User'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                <th scope="col"><?php echo app('translator')->get('User Type'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Total Invest:'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Each Leg Sale'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Reward 1 Required'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Reward 2 Required'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Reward 3 Required'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Reward 4 Required'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Reward 5 Required'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Reward 6 Required'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Reward 7 Required'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
                $user1Sale=0;
                $user2Sale=0;
                $user3Sale=0;
                $firstRequired = null;
                $secondRequired = null;
                $thirdRequired = null;
                $fourthRequired = null;
                $fifthRequired = null;
                $sixthRequired = null;
                $seventhRequired = null;
            ?>
            <?php $__empty_1 = true; $__currentLoopData = $users->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $userSale=\App\Models\User::getTotalSaleInner($user->id,null,$users->id);
                if($key==0){
                   $user1Sale=$userSale;
                   $firstRequired = 1000;
                   $secondRequired = 2500;
                   $thirdRequired = 5000;
                   $fourthRequired = 10000;
                   $fifthRequired = 50000;
                   $sixthRequired = 100000;
                   $seventhRequired = 500000;
                }else if($key==1){
                   $user2Sale=$userSale;
                   $firstRequired = 1000;
                   $secondRequired = 2500;
                   $thirdRequired = 5000;
                   $fourthRequired = 10000;
                   $fifthRequired = 50000;
                   $sixthRequired = 100000;
                   $seventhRequired = 500000;
                }else if($key==2){
                   $user3Sale=$userSale;
                   $firstRequired = 1000;
                   $secondRequired = 2500;
                   $thirdRequired = 5000;
                   $fourthRequired = 10000;
                   $fifthRequired = 50000;
                   $sixthRequired = 100000;
                   $seventhRequired = 500000;
                }
            ?>
            <tr>
                <td data-label="<?php echo app('translator')->get('User'); ?>">
                    <div class="user">
                        <div class="thumb">
                            <img src="<?php echo e(getImage(imagePath()['profile']['user']['path'].'/'.$user->image,imagePath()['profile']['user']['size'])); ?>" alt="<?php echo app('translator')->get('image'); ?>">
                        </div>
                        <span class="name"><?php echo e($user->fullname); ?></span>
                    </div>
                </td>
                <td data-label="<?php echo app('translator')->get('Username'); ?>"><a href="<?php echo e(route('user.other.tree', $user->username)); ?>"><?php echo e($user->username); ?></a></td>
                <td data-label="<?php echo app('translator')->get('User Type'); ?>"><?php echo app('translator')->get('Sub User'); ?></td>
                <td data-label="<?php echo app('translator')->get('Total Invest:'); ?>"><?php echo e($user->total_invest); ?> <?php echo e($general->cur_text); ?></td>
                <td data-label="<?php echo app('translator')->get('Each Leg Sale'); ?>">
                    <?php echo e($userSale); ?>

                <?php echo e($general->cur_text); ?></td>
                <td data-label="<?php echo app('translator')->get('Reward 1'); ?>"><?php if($userSale >= $firstRequired): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo e($firstRequired); ?></td>
                <td data-label="<?php echo app('translator')->get('Reward 2'); ?>"><?php if($userSale >= $secondRequired): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo e($secondRequired); ?></td>
                <td data-label="<?php echo app('translator')->get('Reward 3'); ?>"><?php if($userSale >= $thirdRequired): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo e($thirdRequired); ?></td>
                <td data-label="<?php echo app('translator')->get('Reward 4'); ?>"><?php if($userSale >= $fourthRequired): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo e($fourthRequired); ?></td>
                <td data-label="<?php echo app('translator')->get('Reward 5'); ?>"><?php if($userSale >= $fifthRequired): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo e($fifthRequired); ?></td>
                <td data-label="<?php echo app('translator')->get('Reward 6'); ?>"><?php if($userSale >= $sixthRequired): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo e($sixthRequired); ?></td>
                <td data-label="<?php echo app('translator')->get('Reward 7'); ?>"><?php if($userSale >= $seventhRequired): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo e($seventhRequired); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="text-muted text-center" colspan="100%"><?php echo e(__(@$empty_message)); ?></td>
                </tr>
            <?php endif; ?>
            <tr style="background-color:#cbae88;">
                <td data-label="<?php echo app('translator')->get('User'); ?>"><div class="user">
                        <div class="thumb">
                            <img src="<?php echo e(getImage(imagePath()['profile']['user']['path'].'/'.$users->image,imagePath()['profile']['user']['size'])); ?>" alt="<?php echo app('translator')->get('image'); ?>">
                        </div>
                        <span class="name"><strong class="text--dark"><?php echo e($users->fullname); ?></strong></span>
                    </div></td>
                    <td data-label="<?php echo app('translator')->get('Username'); ?>"><a href="<?php echo e(route('user.other.tree', $users->username)); ?>"><strong class="text--dark"><?php echo e($users->username); ?></a></strong></td>
                <td data-label="<?php echo app('translator')->get('User Type'); ?>"><strong class="text--dark"><?php echo app('translator')->get('Main User'); ?></strong></td>
                <td data-label="<?php echo app('translator')->get('Total Invest:'); ?>"><strong class="text--dark"><?php echo e($users->total_invest); ?> <?php echo e($general->cur_text); ?></strong></td>
                <td data-label="<?php echo app('translator')->get('Total Sale'); ?>"><strong class="text--dark"><?php echo e($users->total_sale); ?> <?php echo e($general->cur_text); ?></strong></td>
                <td data-label="<?php echo app('translator')->get('Reward 1'); ?>"><strong class="text--dark">
                        <?php if($user1Sale >= 1000 && $user2Sale >= 1000 && $user3Sale >= 1000 && $users->children_count==3): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo app('translator')->get('3000'); ?></strong></td>
                <td data-label="<?php echo app('translator')->get('Reward 2'); ?>"><strong class="text--dark"><?php if($user1Sale >= 2500 && $user2Sale >= 2500 && $user3Sale >= 2500 && $users->children_count==3): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo app('translator')->get('7500'); ?></strong></td>
                <td data-label="<?php echo app('translator')->get('Reward 3'); ?>"><strong class="text--dark"><?php if($user1Sale >= 5000 && $user2Sale >= 5000 && $user3Sale >= 5000 && $users->children_count==3): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo app('translator')->get('15000'); ?></strong></td>
                <td data-label="<?php echo app('translator')->get('Reward 4'); ?>"><strong class="text--dark"><?php if($user1Sale >= 10000 && $user2Sale >= 10000 && $user3Sale >= 10000 && $users->children_count==3): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo app('translator')->get('30000'); ?></strong></td>
                <td data-label="<?php echo app('translator')->get('Reward 5'); ?>"><strong class="text--dark"><?php if($user1Sale >= 50000 && $user2Sale >= 50000 && $user3Sale >= 50000 && $users->children_count==3): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo app('translator')->get('150000'); ?></strong></td>
                <td data-label="<?php echo app('translator')->get('Reward 6'); ?>"><strong class="text--dark"><?php if($user1Sale >= 100000 && $user2Sale >= 100000 && $user3Sale >= 100000 && $users->children_count==3): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo app('translator')->get('300000'); ?></strong></td>
                <td data-label="<?php echo app('translator')->get('Reward 7'); ?>"><strong class="text--dark"><?php if($user1Sale >= 500000 && $user2Sale >= 500000 && $user3Sale >= 500000 && $users->children_count==3): ?> <?php echo '<i class="fa fa-check text-success"></i>'; ?><?php else: ?> <?php echo '<i class="fa fa-times text-danger"></i>'; ?> <?php endif; ?> <?php echo app('translator')->get('1500000'); ?></strong></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
    <div class="modal-content">
        <div class="modal-body">
            <h5 class=" text-danger"><?php echo app('translator')->get('No chart available.'); ?></h5>
            </h5>
        </div>
    </div>
    <?php endif; ?>

        <!-- table end -->
    </div>
</div>
</div><!-- card end -->
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>

    <script>
        'use strict';
        (function($) {
            (function($) {
$(document).on('click', '.copybtn', function(){
     var targetField = $(this).attr("data-id");
    if (targetField) {
    const area = document.querySelector('#'+targetField)
        area.select();
        document.execCommand('copy');
            //area.blur();
            $(this).addClass('copied');
            setTimeout(function() { 
                $(this).removeClass('copied'); 
            }, 1500);
        }
    });
})(jQuery);
        })(jQuery);
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic//user/achievments.blade.php ENDPATH**/ ?>