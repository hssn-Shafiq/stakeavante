<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php if(empty($seo)): ?>
    <title> <?php echo e($general->sitename); ?> - <?php echo e(__(@$page_title)); ?> </title>
    <link rel="shortcut icon" href="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/favicon.png')); ?>" type="image/x-icon">
    <?php endif; ?>
    <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/home.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/owl.theme.default.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/aos.css')); ?>">
     <?php echo $__env->yieldPushContent('style-lib'); ?>
    <?php echo $__env->yieldPushContent('css'); ?>
    <link rel="stylesheet" href='<?php echo e(asset($activeTemplateTrue."css/color.php?color=".$general->base_color.'&secondColor='.$general->secondary_color)); ?>'>
    <?php echo $__env->yieldPushContent('style'); ?>
  </head>
  <body>
    <div class="preloader">
        <div class="loader">
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
        </div>
    </div>
    <div class="overlay"></div>

    <?php echo $__env->yieldContent('panel'); ?>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/all.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/aos.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/app.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('script-lib'); ?>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/main.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('js'); ?>
    <?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
      AOS.init();
    </script>
    <?php echo $__env->yieldPushContent('js'); ?>
  </body>
</html><?php /**PATH C:\laragon\www\techSphereLogix\stakeavante\core\resources\views/templates/basic/layouts/app.blade.php ENDPATH**/ ?>