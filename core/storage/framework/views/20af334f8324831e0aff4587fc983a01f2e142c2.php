

<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="<?php echo e(route('admin.withdraw.method.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <h6 class="card-title mb-20"><?php echo app('translator')->get('New Method Form'); ?></h6>
                        <div class="payment-method-item">
                            <div class="payment-method-header d-flex flex-wrap">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url('<?php echo e(getImage(imagePath()['withdraw']['method']['path'],imagePath()['withdraw']['method']['size'])); ?>')"></div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
                                        <label for="image" class="bg--primary"><i class="la la-pencil"></i></label>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="form-group">
                                        <label class="font-weight-bold"><?php echo app('translator')->get('Method Name'); ?></label>
                                        <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>"/>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                           <div class="form-group">
                                               <label class="font-weight-bold"><?php echo app('translator')->get('Currency'); ?> <span class="text-danger">*</span></label>

                                               <div class="input-group">
                                                   <input type="text" name="currency" class="form-control border-radius-5" value="<?php echo e(old('currency')); ?>"/>
                                               </div>
                                           </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold"><?php echo app('translator')->get('Rate'); ?> <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">1 <?php echo e(__($general->cur_text)); ?> =</div>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0" name="rate" value="<?php echo e(old('rate')); ?>"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span class="currency_symbol"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold"><?php echo app('translator')->get('Processing Time'); ?>  <span class="text-danger">*</span></label>
                                                <input type="text" name="delay" class="form-control border-radius-5" value="<?php echo e(old('delay')); ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-method-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card border--primary mb-2">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Range'); ?></h5>
                                            <div class="card-body">

                                                <label class="font-weight-bold"><?php echo app('translator')->get('Minimum Amount'); ?> <span class="text-danger">*</span></label>
                                                <div class="input-group has_append mb-3">
                                                    <input type="text" class="form-control" name="min_limit" placeholder="0" value="<?php echo e(old('min_limit')); ?>"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </div>
                                                    </div>
                                                </div>

                                                <label class="font-weight-bold"><?php echo app('translator')->get('Maximum Amount'); ?> <span class="text-danger">*</span></label>
                                                <div class="input-group has_append">
                                                    <input type="text" class="form-control" placeholder="0" name="max_limit" value="<?php echo e(old('max_limit')); ?>"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card border--primary">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Charge'); ?></h5>
                                            <div class="card-body">
                                                <label class="font-weight-bold"><?php echo app('translator')->get('Fixed Charge'); ?> <span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="0" name="fixed_charge" value="<?php echo e(old('fixed_charge')); ?>"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </div>
                                                    </div>
                                                </div>
                                                <label class="font-weight-bold"><?php echo app('translator')->get('Percent Charge'); ?> <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="0" name="percent_charge" value="<?php echo e(old('percent_charge')); ?>">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border--dark my-2">

                                            <h5 class="card-header bg--dark"><?php echo app('translator')->get('Withdraw Instruction'); ?> </h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea rows="5" class="form-control border-radius-5 nicEdit" name="instruction"><?php echo e(old('instruction')); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border--dark">
                                            <h5 class="card-header bg--dark"><?php echo app('translator')->get('User data'); ?>
                                                <button type="button" class="btn btn-sm btn-outline-light float-right addUserData">
                                                    <i class="la la-fw la-plus"></i><?php echo app('translator')->get('Add New'); ?>
                                                </button>
                                            </h5>

                                            <div class="card-body">
                                                <div class="row addedField">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block"><?php echo app('translator')->get('Save Method'); ?></button>
                    </div>
                </form>
            </div><!-- card end -->
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.withdraw.method.index')); ?>" class="btn btn-sm btn--dark box--shadow1 text--small">
        <i class="la la-fw la-backward"></i> <?php echo app('translator')->get('Go Back'); ?>
    </a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        (function($){
            $('input[name=currency]').on('input', function () {
                $('.currency_symbol').text($(this).val());
            });

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
                                    <span class="input-group-btn">
                                        <button class="btn btn--danger btn-lg removeBtn w-100" type="button">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>`;

                $('.addedField').append(html);
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\techSphereLogix\stakeavante\core\resources\views/admin/withdraw/create.blade.php ENDPATH**/ ?>