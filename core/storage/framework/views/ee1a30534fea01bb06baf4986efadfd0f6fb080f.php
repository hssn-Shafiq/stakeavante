<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if(empty($seo)): ?>
    <title> <?php echo e($general->sitename); ?> - <?php echo e(__(@$page_title)); ?> </title>
    <link rel="shortcut icon" href="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/favicon.png')); ?>" type="image/x-icon">
    <?php endif; ?>
    <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/jquery-ui.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/line-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/lightbox.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/owl.min.css')); ?>">

    <?php echo $__env->yieldPushContent('style-lib'); ?>

    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/main.css')); ?>">
    <?php echo $__env->yieldPushContent('css'); ?>

    <link rel="stylesheet" href='<?php echo e(asset($activeTemplateTrue."css/color.php?color=".$general->base_color.'&secondColor='.$general->secondary_color)); ?>'>

    <?php echo $__env->yieldPushContent('style'); ?>

</head>

<body class="overflow-hidden">

    <?php echo $__env->yieldPushContent('facebook'); ?>

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

    <script src="<?php echo e(asset('assets/global/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/isotope.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/rafcounter.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/lightbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/owl.min.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('script-lib'); ?>

    <script src="<?php echo e(asset($activeTemplateTrue . 'js/main.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('js'); ?>
    <?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).on("change", ".langSel", function () {
            window.location.href = "<?php echo e(route('home')); ?>/change/" + $(this).val();
        });
    </script>
    <?php echo $__env->yieldPushContent('script'); ?>

</body>

</html>
<?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/layouts/app2.blade.php ENDPATH**/ ?>