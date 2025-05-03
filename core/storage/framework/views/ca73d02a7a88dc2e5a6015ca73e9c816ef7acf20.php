<?php $__env->startSection('panel'); ?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<form action="<?php echo e(route('admin.gateway.manual.update', $method->code)); ?>" method="POST"
enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<div class="card-body">
<div class="payment-method-item">
<div class="payment-method-header d-flex flex-wrap">
<div class="thumb">
<div class="avatar-preview">
<div class="profilePicPreview" style="background-image: url('<?php echo e(getImage(imagePath()['gateway']['path'].'/'. $method->image,imagePath()['gateway']['path'])); ?>')"></div>
</div>
<div class="avatar-edit">
<input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
<label for="image" class="bg--primary"><i class="la la-pencil"></i></label>
</div>
</div>

<div class="content">
<div class="row mt-4">
<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-15">
<div class="form-group">
<label class="w-100 font-weight-bold"><?php echo app('translator')->get('Gateway Name'); ?> <span class="text-danger">*</span></label>
<input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Method Name'); ?>" name="name" value="<?php echo e($method->name); ?>"/>
</div>
</div>
<div class="col-xl-3 col-md-6">
<div>
<label class="w-100 font-weight-bold"><?php echo app('translator')->get('Currency'); ?> <span class="text-danger">*</span></label>
<input type="text" name="currency" placeholder="<?php echo app('translator')->get('Currency'); ?>" class="form-control border-radius-5" value="<?php echo e(@$method->single_currency->currency); ?>"/>
</div>
</div>
<div class="col-xl-5 col-md-12">
<label class="w-100 font-weight-bold"><?php echo app('translator')->get('Rate'); ?> <span class="text-danger">*</span></label>

<div class="input-group has_append">
<div class="input-group-prepend">
<div class="input-group-text">1 <?php echo e(__($general->cur_text)); ?>=
</div>
</div>
<input type="text" class="form-control" placeholder="0" name="rate" value="<?php echo e(getAmount(@$method->single_currency->rate)); ?>"/>
<div class="input-group-append">
<div class="input-group-text"><span class="currency_symbol"></span>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="payment-method-body">
<div class="row">

<div class="col-lg-6">
<div class="card border--primary mt-3">
<h5 class="card-header bg--primary"><?php echo app('translator')->get('Range'); ?></h5>
<div class="card-body">
<label class="font-weight-bold"><?php echo app('translator')->get('Minimum Amount'); ?> <span class="text-danger">*</span></label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<div class="input-group-text"><?php echo e(__($general->cur_text)); ?></div>
</div>
<input type="text" class="form-control" name="min_limit" placeholder="0" value="<?php echo e(getAmount(@$method->single_currency->min_amount)); ?>"/>
</div>
<label class="font-weight-bold"><?php echo app('translator')->get('Maximum Amount'); ?> <span class="text-danger">*</span></label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text"><?php echo e(__($general->cur_text)); ?></div>
</div>
<input type="text" class="form-control" placeholder="0" name="max_limit" value="<?php echo e(getAmount(@$method->single_currency->max_amount)); ?>"/>
</div>
</div>
</div>
</div>
<div class="col-lg-6">
<div class="card border--primary mt-3">
<h5 class="card-header bg--primary"><?php echo app('translator')->get('Charge'); ?></h5>
<div class="card-body">
<label class="font-weight-bold"><?php echo app('translator')->get('Fixed Charge'); ?> <span class="text-danger">*</span></label>
<div class="input-group mb-3">
<input type="text" class="form-control" placeholder="0" name="fixed_charge" value="<?php echo e(getAmount(@$method->single_currency->fixed_charge)); ?>"/>
<div class="input-group-append">
<div class="input-group-text"><?php echo e(__($general->cur_sym)); ?></div>
</div>
</div>
<label class="font-weight-bold"><?php echo app('translator')->get('Percent Charge'); ?> <span class="text-danger">*</span></label>
<div class="input-group">
<input type="text" class="form-control" placeholder="0" name="percent_charge" value="<?php echo e(getAmount(@$method->single_currency->percent_charge)); ?>">
<div class="input-group-append">
<div class="input-group-text">%</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="card border--dark mt-3">

<h5 class="card-header bg--dark"><?php echo app('translator')->get('Deposit Instruction'); ?></h5>
<div class="card-body">
<div class="form-group">
<textarea rows="8" class="form-control border-radius-5 nicEdit" name="instruction"><?php echo e(__(@$method->description)); ?></textarea>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="card border--dark mt-3">
<h5 class="card-header bg--dark  text-white"><?php echo app('translator')->get('User data'); ?>
<button type="button" class="btn btn-sm btn-outline-light float-right addUserData"><i class="la la-fw la-plus"></i><?php echo app('translator')->get('Add New'); ?>
</button>
</h5>

<div class="card-body">
<span><?php echo app('translator')->get('Use word "transaction id" if you want to add transaction id and select type input text.Marke it required.'); ?></span>
<div class="row addedField">
<?php if($method->input_form != null): ?>
<?php $__currentLoopData = $method->input_form; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-12 user-data">
    <div class="form-group">
        <div class="input-group mb-md-0 mb-4">
            <div class="col-md-4">
                <input name="field_name[]" class="form-control" type="text" value="<?php echo e($v->field_level); ?>" required placeholder="<?php echo app('translator')->get('Field Name'); ?>">
            </div>
            <div class="col-md-3 mt-md-0 mt-2">
                <select name="type[]" class="form-control">
                    <option value="text" <?php if($v->type == 'text'): ?> selected <?php endif; ?>> <?php echo app('translator')->get('Input Text'); ?> </option>
                    <option value="textarea" <?php if($v->type == 'textarea'): ?> selected <?php endif; ?>> <?php echo app('translator')->get('Textarea'); ?> </option>
                    <option value="file" <?php if($v->type == 'file'): ?> selected <?php endif; ?>> <?php echo app('translator')->get('File upload'); ?> </option>
                </select>
            </div>
            <div class="col-md-3 mt-md-0 mt-2">
                <select name="validation[]" class="form-control">
                    <option value="required" <?php if($v->validation == 'required'): ?> selected <?php endif; ?>> <?php echo app('translator')->get('Required'); ?> </option>
                    <option value="nullable" <?php if($v->validation == 'nullable'): ?> selected <?php endif; ?>>  <?php echo app('translator')->get('Optional'); ?> </option>
                </select>
            </div>
            <div class="col-md-2 mt-md-0 mt-2 text-right">
                <button class="btn btn-block btn--danger removeBtn" type="button">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="card-footer">
<button type="submit" class="btn btn--primary btn-block "><?php echo app('translator')->get('Save Method'); ?></button>
</div>
</form>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('admin.gateway.manual.index')); ?>" class="btn btn-sm btn--dark box--shadow1 text--small"><i class="la la-fw la-backward"></i> <?php echo app('translator')->get('Go Back'); ?> </a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
'use strict';
(function($){
$('input[name=currency]').on('input', function () {
$('.currency_symbol').text($(this).val());
});
$('.currency_symbol').text($('input[name=currency]').val());


$('.addUserData').on('click', function () {
var html = `
<div class="col-md-12 user-data">
<div class="form-group">
<div class="input-group mb-md-0 mb-4">
<div class="col-md-4">
<input name="field_name[]" class="form-control" type="text" value="" required placeholder="<?php echo app('translator')->get('Field Name'); ?>">
</div>
<div class="col-md-3 mt-md-0 mt-2">
<select name="type[]" class="form-control">
<option value="text" > <?php echo app('translator')->get('Input Text'); ?> </option>
<option value="textarea" > <?php echo app('translator')->get('Textarea'); ?> </option>
<option value="file"> <?php echo app('translator')->get('File upload'); ?> </option>
</select>
</div>
<div class="col-md-3 mt-md-0 mt-2">
<select name="validation[]"
class="form-control">
<option value="required"> <?php echo app('translator')->get('Required'); ?> </option>
<option value="nullable">  <?php echo app('translator')->get('Optional'); ?> </option>
</select>
</div>
<div class="col-md-2 mt-md-0 mt-2 text-right">
<button class="btn btn-block btn--danger removeBtn" type="button">
<i class="fa fa-times"></i>
</button>
</div>
</div>
</div>
</div>`;
$('.addedField').append(html)
});

$(document).on('click', '.removeBtn', function () {
$(this).closest('.user-data').remove();
});

<?php if(old('currency')): ?>
$('input[name=currency]').trigger('input');
<?php endif; ?>
})(jQuery)

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/gateway_manual/edit.blade.php ENDPATH**/ ?>