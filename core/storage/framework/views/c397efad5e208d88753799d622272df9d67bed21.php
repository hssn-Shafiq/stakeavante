<?php $__env->startSection('panel'); ?>
<div class="row">
<div class="col-lg-12 mb-5">
<div class="card mt-3">
<div class="card-header">
    <h4 class="card-title font-weight-normal"><?php echo app('translator')->get('Referrer Link'); ?></h4>
</div>
<div class="card-body">
    <form id="copyBoard" >
        <div class="form-row align-items-center">
            <div class="col-md-10 my-1">
                <input value="<?php echo e(route('user.register')); ?>/?ref=<?php echo e(auth()->user()->username); ?>&reg=<?php echo e(auth()->user()->username); ?>" type="url" id="ref" class="form-control from-control-lg" readonly>
            </div>
            <div class="col-md-2 my-1">
                <button   type="button" @click="copyBtnClick" data-copytarget="#ref" id="copybtn" class="btn btn--primary btn-block"> <i class="fa fa-copy"></i> <?php echo app('translator')->get('Copy'); ?></button>
            </div>
        </div>
    </form>
</div>
</div>
</div>

<div class="col-lg-12 ">
<div class="card b-radius--10 overflow-hidden">
<div class="card-body p-0">

    <div class="table-responsive--sm">
        <table class="table table--light style--two">
            <thead>
            <tr>
                <th scope="col"><?php echo app('translator')->get('Sl'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Email'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Join Date'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td data-label="<?php echo app('translator')->get('Sl'); ?>" ><?php echo e($logs->firstItem()+$key); ?></td>
                    <td data-label="<?php echo app('translator')->get('Username'); ?>"><?php echo e($data->username); ?></td>
                    <td data-label="<?php echo app('translator')->get('Name'); ?>"><?php echo e($data->fullname); ?></td>
                    <td data-label="<?php echo app('translator')->get('Email'); ?>"><?php echo e(printEmail($data->email)); ?></td>
                    <td data-label="<?php echo app('translator')->get('Join Date'); ?>">
                        <?php if($data->created_at != ''): ?>
                        <?php echo e(showDateTime($data->created_at)); ?>

                        <?php else: ?>
                        <?php echo app('translator')->get('Not Assign'); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="text-muted text-center" colspan="100%"><?php echo e(__($empty_message)); ?></td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>
<div class="card-footer py-4">
    <?php echo e($logs->links('admin.partials.paginate')); ?>

</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

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
        setTimeout(function() { t.classList.remove('copied'); }, 1500);
    }catch (err) {
        alert(`<?php echo app('translator')->get('Please press Ctrl/Cmd+C to copy'); ?>`);
    }
}
}
})(jQuery);
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic//user/myRef.blade.php ENDPATH**/ ?>