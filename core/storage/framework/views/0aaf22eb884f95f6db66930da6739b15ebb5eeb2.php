<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($general->sitename($page_title ?? '')); ?></title>
    <!-- site favicon -->
    <link rel="shortcut icon" type="image/png" href="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/favicon.png')); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/grid.min.css')); ?>">
    <!-- bootstrap toggle css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/bootstrap-toggle.min.css')); ?>">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/all.min.css')); ?>">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/line-awesome.min.css')); ?>">

    <?php echo $__env->yieldPushContent('style-lib'); ?>

    <!-- select 2 css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/select2.min.css')); ?>">
    <!-- jvectormap css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/jquery-jvectormap-2.0.5.css')); ?>">
    <!-- datepicker css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/datepicker.min.css')); ?>">
    <!-- timepicky for time picker css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/jquery-timepicky.css')); ?>">
    <!-- bootstrap-clockpicker css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/bootstrap-clockpicker.min.css')); ?>">
    <!-- bootstrap-pincode css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/bootstrap-pincode-input.css')); ?>">
    <!-- dashdoard main css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/app.css')); ?>">


    <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body>
<?php echo $__env->yieldContent('content'); ?>



<!-- jQuery library -->
<script src="<?php echo e(asset('assets/global/js/jquery-3.6.0.min.js')); ?>"></script>
<!-- bootstrap js -->
<script src="<?php echo e(asset('assets/admin/js/vendor/bootstrap.bundle.min.js')); ?>"></script>
<!-- bootstrap-toggle js -->
<script src="<?php echo e(asset('assets/admin/js/vendor/bootstrap-toggle.min.js')); ?>"></script>
<!-- slimscroll js for custom scrollbar -->
<script src="<?php echo e(asset('assets/admin/js/vendor/jquery.slimscroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/nicEdit.js')); ?>"></script>
<!-- seldct 2 js -->
<script src="<?php echo e(asset('assets/global/js/select2.min.js')); ?>"></script>

<?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldPushContent('script-lib'); ?>

<script src="<?php echo e(asset('assets/admin/js/app.js')); ?>"></script>


<script>
    "use strict";
    (function($){
        bkLib.onDomLoaded(function() {
            $( ".nicEdit" ).each(function( index ) {
                $(this).attr("id","nicEditor"+index);
                new nicEditor({fullPanel : false}).panelInstance('nicEditor'+index,{hasPanel : true});
            });
        });

        $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain',function(){
            $('.nicEdit-main').focus();
        });
    })(jQuery);
    $(document).on('click', '.delete_model', function(){
                var id  = $(this).attr("data-id");
                var url = $(this).attr("data-url");
                $("#delete").val(id);
                $("#delete_form").attr("action",url);
                $("#delete_modal").modal('show');
            });
</script>

<?php echo $__env->yieldPushContent('script'); ?>


</body>
</html>
<?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>