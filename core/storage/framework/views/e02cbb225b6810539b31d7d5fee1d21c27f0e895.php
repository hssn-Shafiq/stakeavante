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
                <th scope="col"><?php echo app('translator')->get('Price'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Level'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td data-label="<?php echo app('translator')->get('Sl'); ?>"><?php echo e($key+1); ?></td>
                    <td data-label="<?php echo app('translator')->get('Name'); ?>"><?php echo e(__($membership->name)); ?></td>
                    <td data-label="<?php echo app('translator')->get(' Price'); ?>"><?php echo e(getAmount($membership->price)); ?> <?php echo e($general->cur_text); ?></td>
                    <td data-label="<?php echo app('translator')->get('Levels'); ?>"><?php echo e($membership->level); ?></td>
                    <td data-label="<?php echo app('translator')->get('Action'); ?>">
                        <button type="button" class="icon-btn edit" data-toggle="tooltip"
                                data-id="<?php echo e($membership->id); ?>"
                                data-name="<?php echo e($membership->name); ?>"
                                data-price="<?php echo e(getAmount($membership->price)); ?>"
                                data-level="<?php echo e($membership->level); ?>"
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
    <?php echo e($memberships->links('admin.partials.paginate')); ?>

</div>
</div>
</div>
</div>



<div id="edit-plan" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title"><?php echo app('translator')->get('Edit Membership'); ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="post" action="<?php echo e(route('admin.membership.update')); ?>">
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
                    <label class="font-weight-bold"> <?php echo app('translator')->get('Price'); ?> </label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span
                                class="input-group-text"><?php echo e($general->cur_sym); ?> </span></div>
                        <input type="text" class="form-control price" name="price" required>
                    </div>
                </div>
            <div class="form-group col-md-6">
                    <label class="font-weight-bold"> <?php echo app('translator')->get('Level'); ?> </label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span
                                class="input-group-text">Level Access </span></div>
                        <input type="text" class="form-control level" name="level" required>
                    </div>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
"use strict";
(function ($) {
$('.edit').on('click', function () {
var modal = $('#edit-plan');
modal.find('.name').val($(this).data('name'));
modal.find('.price').val($(this).data('price'));
modal.find('.level').val($(this).data('level'));
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


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/admin/plan/membership.blade.php ENDPATH**/ ?>