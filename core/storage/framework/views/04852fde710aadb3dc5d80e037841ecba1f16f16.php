<?php $__env->startSection('panel'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-deposit">
                <div class="card-header card-header-bg">
                    <h3><?php echo e(__($page_title)); ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('user.deposit.manual.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <?php
                                $extra = $data->gateway->extra;
                            ?>
                            <div class="col-md-12 text-center">
                                <p class="text-center mt-2"><?php echo app('translator')->get('You have requested '); ?> <b
                                        class="text--success"><?php echo e(getAmount($data['amount'])); ?> <?php echo e($general->cur_text); ?></b>, <?php echo app('translator')->get('Please pay'); ?>
                                    <b class="text--success"><?php echo e(getAmount($data['amount'])); ?> <?php echo e($general->cur_text); ?></b> <?php echo app('translator')->get('for successful payment'); ?>
                                </p>
                                <h4 class="text-center mb-4"><?php echo app('translator')->get('Please follow the instruction bellow'); ?></h4>
                                <p class="my-4 text-center"><?php echo  $data->gateway->description ?></p>
                            </div>

                            <?php if($method->gateway_parameter): ?>

                                <?php $__currentLoopData = json_decode($method->gateway_parameter); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($v->type == "text"): ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><strong><?php echo e(__(inputTitle($v->field_level))); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                <input type="text" class="form-control form-control-lg"
                                                        name="<?php echo e($k); ?>"  value="<?php echo e(old($k)); ?>" placeholder="<?php echo e(__($v->field_level)); ?>">
                                            </div>
                                        </div>
                                    <?php elseif($v->type == "textarea"): ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><strong><?php echo e(__(inputTitle($v->field_level))); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                    <textarea name="<?php echo e($k); ?>"  class="form-control"  placeholder="<?php echo e(__($v->field_level)); ?>" rows="3"><?php echo e(old($k)); ?></textarea>

                                                </div>
                                            </div>
                                    <?php elseif($v->type == "file"): ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><strong><?php echo e(__($v->field_level)); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                <br>
                                                <div class="fileinput fileinput-new " data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                            data-trigger="fileinput">
                                                        <img class="w-h-220px"  src="<?php echo e(asset(imagePath()['image']['default'])); ?>" alt="<?php echo app('translator')->get('gateway-image'); ?>" >
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>

                                                    <div class="img-input-div">
                                                            <span class="btn btn--info btn-file">
                                                                <span class="fileinput-new text-white"> <?php echo app('translator')->get('Select'); ?> <?php echo e($v->field_level); ?></span>
                                                                <span class="fileinput-exists text-white"> <?php echo app('translator')->get('Change'); ?></span>
                                                                <input type="file" name="<?php echo e($k); ?>" accept="image/*" >
                                                            </span>
                                                        <a href="#" class="btn btn--danger  fileinput-exists"
                                                            data-dismiss="fileinput"> <?php echo app('translator')->get('Remove'); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn--success   btn-block mt-2 text-center"><?php echo app('translator')->get('Pay Now'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/global/js/address-generator.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/user/manual_payment/manual_confirm.blade.php ENDPATH**/ ?>