<?php $__env->startSection('panel'); ?>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body p-0">
    <div class="table-responsive--md table-responsive">
        <table class="table table--light style--two">
            <thead>
            <tr>
                <th scope="col"><?php echo app('translator')->get('Sl'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Min Price'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Max Price'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Referral Commission'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Profit'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Is default'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td data-label="<?php echo app('translator')->get('Sl'); ?>"><?php echo e($key+1); ?></td>
                    <td data-label="<?php echo app('translator')->get('Name'); ?>"><?php echo e(__($plan->name)); ?></td>
                    <td data-label="<?php echo app('translator')->get('Min Price'); ?>"><?php echo e(getAmount($plan->min_price)); ?> <?php echo e($general->cur_text); ?></td>
                    <td data-label="<?php echo app('translator')->get('Max Price'); ?>"><?php echo e(getAmount($plan->max_price)); ?> <?php echo e($general->cur_text); ?></td>
                    <td data-label="<?php echo app('translator')->get('Referral Commission'); ?>"> <?php echo e($plan->ref_com); ?> %</td>

                    <td data-label="<?php echo app('translator')->get('Profit'); ?>">
                       <?php echo e($plan->profit); ?>%
                    </td>
                    <td data-label="<?php echo app('translator')->get('Is default'); ?>">
                       <?php if($plan->is_default == 1): ?>
                            <span class="text--small badge font-weight-normal badge--primary"><?php echo app('translator')->get('Defualt'); ?></span>
                        <?php endif; ?>
                    </td>
                    <td data-label="<?php echo app('translator')->get('Status'); ?>">
                        <?php if($plan->status == 1): ?>
                            <span class="text--small badge font-weight-normal badge--success"><?php echo app('translator')->get('Active'); ?></span>
                        <?php else: ?>
                            <span class="text--small badge font-weight-normal badge--danger"><?php echo app('translator')->get('Inactive'); ?></span>
                        <?php endif; ?>
                    </td>

                    <td data-label="<?php echo app('translator')->get('Action'); ?>">
                        <button type="button" class="icon-btn edit" data-toggle="tooltip"
                                data-id="<?php echo e($plan->id); ?>"
                                data-name="<?php echo e($plan->name); ?>"
                                data-status="<?php echo e($plan->status); ?>"
                                data-isdefault="<?php echo e($plan->is_default); ?>" 
                                data-minprice="<?php echo e(getAmount($plan->min_price)); ?>"
                                data-maxprice="<?php echo e(getAmount($plan->max_price)); ?>"
                                data-ref_com="<?php echo e($plan->ref_com); ?>"
                                data-profit="<?php echo e($plan->profit); ?>"
                                data-original-title="Edit">
                            <i class="la la-pencil"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="text-muted text-center" colspan="100%"><?php echo e(__($empty_message)); ?></td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table><!-- table end -->
    </div>
</div>
<div class="card-footer py-4">
    <?php echo e($plans->links('admin.partials.paginate')); ?>

</div>
</div>
</div>
</div>



<div id="edit-plan" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title"><?php echo app('translator')->get('Edit Plan'); ?></h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
<form method="post" action="<?php echo e(route('admin.plan.update')); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal-body">

        <input class="form-control plan_id" type="hidden" name="id">

        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="font-weight-bold"> <?php echo app('translator')->get('Name'); ?> :</label>
                <input class="form-control name" name="name" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                    <label class="font-weight-bold"> <?php echo app('translator')->get('Min Price'); ?> </label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span
                                class="input-group-text"><?php echo e($general->cur_sym); ?> </span></div>
                        <input type="text" class="form-control minprice" name="minprice" required>
                    </div>
                </div>
            <div class="form-group col-md-6">
                    <label class="font-weight-bold"> <?php echo app('translator')->get('Max Price'); ?> </label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span
                                class="input-group-text"><?php echo e($general->cur_sym); ?> </span></div>
                        <input type="text" class="form-control maxprice" name="maxprice" required>
                    </div>
                </div>
            <div class="form-group col-md-6">
                <label class="font-weight-bold"> <?php echo app('translator')->get('Referral Commission'); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend"><span
                            class="input-group-text">% </span></div>
                    <input type="text" class="form-control ref_com" name="ref_com" required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="font-weight-bold"> <?php echo app('translator')->get('Profit'); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend"><span
                            class="input-group-text">% </span></div>
                    <input type="text" class="form-control profit" name="profit" required>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label class="font-weight-bold"><?php echo app('translator')->get('Is Default'); ?></label>
                <input type="checkbox" name="default">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="font-weight-bold"><?php echo app('translator')->get('Status'); ?></label>
                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Active'); ?>" data-off="<?php echo app('translator')->get('Inactive'); ?>" name="status" checked>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-block btn--primary"><?php echo app('translator')->get('Update'); ?></button>
    </div>
</form>
</div>
</div>
</div>

<div id="add-plan" class="modal  fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title"><?php echo app('translator')->get('Add New plan'); ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="post" action="<?php echo e(route('admin.plan.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal-body">

        <input class="form-control plan_id" type="hidden" name="id">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="font-weight-bold"> <?php echo app('translator')->get('Name'); ?> :</label>
                <input type="text" class="form-control " name="name"
                       required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                    <label class="font-weight-bold"> <?php echo app('translator')->get('Min Price'); ?> </label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span
                                class="input-group-text"><?php echo e($general->cur_sym); ?> </span></div>
                        <input type="text" class="form-control  " name="minprice" required>
                    </div>
                </div>
            <div class="form-group col-md-6">
                    <label class="font-weight-bold"> <?php echo app('translator')->get('Max Price'); ?> </label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span
                                class="input-group-text"><?php echo e($general->cur_sym); ?> </span></div>
                        <input type="text" class="form-control  " name="maxprice" required>
                    </div>
                </div>
            <div class="form-group col-md-6">
                <label class="font-weight-bold"> <?php echo app('translator')->get('Referral Commission'); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend"><span
                            class="input-group-text">% </span></div>
                    <input type="text" class="form-control  " name="ref_com" required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="font-weight-bold"> <?php echo app('translator')->get('Profit'); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend"><span
                            class="input-group-text">% </span></div>
                    <input type="text" class="form-control  " name="profit" required>
                </div>
            </div>
        </div>
         <div class="form-row">
            <div class="form-group col">
                <label class="font-weight-bold"><?php echo app('translator')->get('Is Default'); ?></label>
                <input type="checkbox" name="default" checked>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col">
                <label class="font-weight-bold"><?php echo app('translator')->get('Status'); ?></label>
                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Active'); ?>" data-off="<?php echo app('translator')->get('Inactive'); ?>" name="status" checked>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn-block btn btn--primary"><?php echo app('translator')->get('Submit'); ?></button>
    </div>
</form>

</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="javascript:void(0)" class="btn btn-sm btn--success add-plan"><i class="fa fa-fw fa-plus"></i><?php echo app('translator')->get('Add New'); ?></a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
"use strict";
(function ($) {
$('.edit').on('click', function () {
var modal = $('#edit-plan');
modal.find('.name').val($(this).data('name'));
modal.find('.minprice').val($(this).data('minprice'));
modal.find('.maxprice').val($(this).data('maxprice'));
modal.find('.ref_com').val($(this).data('ref_com'));
modal.find('.profit').val($(this).data('profit'));
modal.find('input[name=daily_ad_limit]').val($(this).data('daily_ad_limit'));

if($(this).data('status')){
    modal.find('.toggle').removeClass('btn--danger off').addClass('btn--success');
    modal.find('input[name="status"]').prop('checked',true);

}else{
    modal.find('.toggle').addClass('btn--danger off').removeClass('btn--success');
    modal.find('input[name="status"]').prop('checked',false);
}
if($(this).data('isdefault')){
    modal.find('input[name="default"]').prop('checked',true);

}else{
    modal.find('input[name="default"]').prop('checked',false);
}

modal.find('input[name=id]').val($(this).data('id'));
modal.modal('show');
});

$('.add-plan').on('click', function () {
var modal = $('#add-plan');
modal.modal('show');
});
})(jQuery);
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/admin/plan/index.blade.php ENDPATH**/ ?>