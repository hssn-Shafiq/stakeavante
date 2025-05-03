<?php $__env->startSection('panel'); ?>
<div class="row">
<div class="col-lg-12">
<div class="card b-radius--10 ">
<div class="card-body p-0">
    <div class="table-responsive--md  table-responsive">
        <table class="table table--light style--two">
            <thead>
            <tr>
                <th scope="col" style="width:15%"><?php echo app('translator')->get('User'); ?></th>
                <th scope="col" style="width:10%"><?php echo app('translator')->get('Level'); ?></th>
                <th scope="col" style="width:10%"><?php echo app('translator')->get('Username'); ?></th>
                <th scope="col" style="width:10%"><?php echo app('translator')->get('Tree'); ?><br/><?php echo app('translator')->get('Users'); ?></th>
                <th scope="col" style="width:55%"><?php echo app('translator')->get('Tree Link'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if(treeAuth($user->id,auth()->id(),'user')==true): ?>
            <tr>
                <td data-label="<?php echo app('translator')->get('User'); ?>">
                    <div class="user">
                        <div class="thumb">
                            <img src="<?php echo e(getImage(imagePath()['profile']['user']['path'].'/'.$user->image,imagePath()['profile']['user']['size'])); ?>" alt="<?php echo app('translator')->get('image'); ?>">
                        </div>
                        <span class="name"><?php echo e($user->fullname); ?></span>
                    </div>
                </td>
                <td data-label="<?php echo app('translator')->get('Level'); ?>"><?php if($user->level1_parent==auth()->id()): ?>
                <?php echo e('Level 1'); ?>

                <?php elseif($user->level2_parent==auth()->id()): ?>
                <?php echo e('Level 2'); ?>

                <?php elseif($user->level3_parent==auth()->id()): ?>
                <?php echo e('Level 3'); ?>

                <?php elseif($user->level4_parent==auth()->id()): ?>
                <?php echo e('Level 4'); ?>

                <?php elseif($user->level5_parent==auth()->id()): ?>
                <?php echo e('Level 5'); ?>

                <?php elseif($user->level6_parent==auth()->id()): ?>
                <?php echo e('Level 6'); ?>

                <?php elseif($user->level7_parent==auth()->id()): ?>
                <?php echo e('Level 7'); ?>

                <?php endif; ?></td>
                <td data-label="<?php echo app('translator')->get('Username'); ?>"><a href="<?php echo e(route('user.other.tree', $user->username)); ?>"><?php echo e($user->username); ?></a></td>
                <td data-label="<?php echo app('translator')->get('Tree Users'); ?>"><?php echo e($user->userRef()->count()); ?>/3</td>
                <td data-label="<?php echo app('translator')->get('Tree Link'); ?>">
                    <form class="copyBoard" >
                        <div class="form-row align-items-center">
                            <div class="col-md-10 my-1">
                                <input value="<?php echo e(route('user.register')); ?>/?ref=<?php echo e($user->username); ?>&reg=<?php echo e(auth()->user()->username); ?>" type="url"  class="form-control from-control-lg" id="ref<?php echo e($user->id); ?>" readonly>
                            </div>
                            <div class="col-md-2 my-1">
                                <button   type="button" class="btn btn--primary btn-block copybtn" data-id="ref<?php echo e($user->id); ?>"> <i class="fa fa-copy"></i> <?php echo app('translator')->get('Copy'); ?></button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="text-muted text-center" colspan="100%"><?php echo e(__(@$empty_message)); ?></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table><!-- table end -->
    </div>
</div>
<div class="card-footer py-4">
    <?php echo e(paginateLinks($users)); ?>

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

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic//user/binarySummery.blade.php ENDPATH**/ ?>