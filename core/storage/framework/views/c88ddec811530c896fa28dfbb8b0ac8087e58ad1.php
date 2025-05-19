

<?php $__env->startSection('content'); ?>
    <div class="page-wrapper default-version">
        <?php echo $__env->make($activeTemplate .'user.partials.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make($activeTemplate .'user.partials.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="body-wrapper">
            <div class="bodywrapper__inner">
                <?php echo $__env->make($activeTemplate .'user.partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->yieldContent('panel'); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate .'user.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\techSphereLogix\stakeavante\core\resources\views/templates/basic/user/layouts/app.blade.php ENDPATH**/ ?>