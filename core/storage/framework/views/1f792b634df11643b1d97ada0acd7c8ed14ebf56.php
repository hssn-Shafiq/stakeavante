<?php $__env->startSection('panel'); ?>

        <div class="row justify-content-center mt-2">
            <div class="col-lg-8 ">
                <div class="card card-deposit">
                    <h5 class="text-center my-3"><?php echo app('translator')->get('Current Balance'); ?> :
                        <strong><?php echo e(getAmount(auth()->user()->balance)); ?>  <?php echo e($general->cur_text); ?></strong></h5>
                    <span class="text-center">
                        <?php
                            echo  $withdraw->method->description;
                        ?>
                    </span>
                    <div class="card-body mt-4">
                        <div class="row">
                            <div class="col-md-5">

                                <ul  class="list-group text-center">
                                    <li class="list-group-item">
                                        <span class="font-weight-bold"><?php echo app('translator')->get('Request Amount'); ?> :
                                        <?php echo e(getAmount($withdraw->amount)); ?> <?php echo e($general->cur_text); ?>  </span>
                                    </li>

                                    <li class="list-group-item">
                                        <span class="font-weight-bold"><?php echo app('translator')->get('Withdrawal Charge'); ?> :
                                         <?php echo e(getAmount($withdraw->charge)); ?> <?php echo e($general->cur_text); ?> </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="font-weight-bold"><?php echo app('translator')->get('After Charge'); ?> :
                                         <?php echo e(getAmount($withdraw->after_charge)); ?> <?php echo e($general->cur_text); ?> </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="font-weight-bold"><?php echo app('translator')->get('Conversion Rate'); ?> : 1 <?php echo e($general->cur_text); ?> =
                                         <?php echo e(getAmount($withdraw->rate)); ?> <?php echo e($withdraw->currency); ?> </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="font-weight-bold"><?php echo app('translator')->get('You Will Get'); ?>
                                            <?php echo e(getAmount($withdraw->final_amount)); ?> <?php echo e($withdraw->currency); ?> </span>
                                    </li>
                                </ul>
                                <div class="form-group mt-5">
                                    <label class="font-weight-bold"><?php echo app('translator')->get('Balance Will be'); ?> : </label>
                                    <div class="input-group">
                                        <input type="text" value="<?php echo e(getAmount($withdraw->user->balance - ($withdraw->amount))); ?>"  class="form-control form-control-lg" placeholder="<?php echo app('translator')->get('Enter Amount'); ?>" required readonly>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text "><?php echo e($general->cur_text); ?> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <form action="<?php echo e(route('user.withdraw.submit')); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>

                                    <?php if($withdraw->method->user_data): ?>
                                    <?php $__currentLoopData = $withdraw->method->user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($v->type == "text"): ?>
                                            <div class="form-group">
                                                <label><strong><?php echo e(__($v->field_level)); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                <input type="text" name="<?php echo e($k); ?>" class="form-control" value="<?php echo e(old($k)); ?>" placeholder="<?php echo e(__($v->field_level)); ?>" <?php if($v->validation == "required"): ?> required <?php endif; ?>>
                                                <?php if($errors->has($k)): ?>
                                                    <span class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php elseif($v->type == "textarea"): ?>
                                            <div class="form-group">
                                                <label><strong><?php echo e(__($v->field_level)); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                <textarea name="<?php echo e($k); ?>"  class="form-control"  placeholder="<?php echo e(__($v->field_level)); ?>" rows="3" <?php if($v->validation == "required"): ?> required <?php endif; ?>><?php echo e(old($k)); ?></textarea>
                                                <?php if($errors->has($k)): ?>
                                                    <span class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php elseif($v->type == "file"): ?>

                                            <label><strong><?php echo e(__($v->field_level)); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new " data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                         data-trigger="fileinput">
                                                        <img class="m-w-220px" src="<?php echo e(getImage(imagePath()['image']['default'])); ?>" alt="<?php echo app('translator')->get('image'); ?>">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>

                                                    <div class="img-input-div">
                                                                <span class="btn btn--info btn-file">
                                                                    <span class="fileinput-new text-white"> <?php echo app('translator')->get('Select'); ?> <?php echo e($v->field_level); ?></span>
                                                                    <span class="fileinput-exists text-white"> <?php echo app('translator')->get('Change'); ?></span>
                                                                    <input type="file" name="<?php echo e($k); ?>" accept="image/*" <?php if($v->validation == "required"): ?> required <?php endif; ?>>
                                                                </span>
                                                        <a href="#" class="btn btn--danger fileinput-exists"
                                                           data-dismiss="fileinput"> <?php echo app('translator')->get('Remove'); ?></a>
                                                    </div>

                                                </div>
                                                <?php if($errors->has($k)): ?>
                                                    <br>
                                                    <span class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn--success btn-block btn-lg mt-4 text-center"><?php echo app('translator')->get('Confirm'); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make($activeTemplate . 'user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/user/withdraw/preview.blade.php ENDPATH**/ ?>