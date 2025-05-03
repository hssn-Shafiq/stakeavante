<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-xl-4">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="profilePicPreview logoPicPrev" style="background-image: url(<?php echo e(getImage(imagePath()['logoIcon']['path'].'/logo.png', '?'.time())); ?>)">
                                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" id="profilePicUpload1" accept=".png, .jpg, .jpeg" name="logo">
                                            <label for="profilePicUpload1" class="bg--primary"><?php echo app('translator')->get('Select Logo'); ?> </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xl-4">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="row">
                                                <div class="col-sm-12 mt-sm-0 mt-4">
                                                    <div class="profilePicPreview logoPicPrev bg--dark" style="background-image: url(<?php echo e(getImage(imagePath()['logoIcon']['path'].'/darkLogo.png', '?'.time())); ?>)">
                                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" id="profilePicUpload3" accept=".png, .jpg, .jpeg" name="darkLogo">
                                            <label for="profilePicUpload3" class="bg--primary"><?php echo app('translator')->get('Select Dark Logo'); ?> </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xl-4">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="profilePicPreview logoPicPrev" style="background-image: url(<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/favicon.png', '?'.time())); ?>)">
                                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-sm-0 mt-4">
                                                    <div class="profilePicPreview logoPicPrev bg--dark" style="background-image: url(<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/favicon.png', '?'.time())); ?>)">
                                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" id="profilePicUpload2" accept=".png" name="favicon">
                                            <label for="profilePicUpload2" class="bg--primary"><?php echo app('translator')->get('Select Favicon'); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn--primary btn-block btn-lg"><?php echo app('translator')->get('Update'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
<style type="text/css">
    .logoPrev{
        background-size: 100%;
    }
    .iconPrev{
        background-size: 100%;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/setting/logo_icon.blade.php ENDPATH**/ ?>