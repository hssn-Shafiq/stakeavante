<?php $__env->startSection('content'); ?>
<?php
    $banner = getContent('banner.content', true);
?>
    <div class="wrapper">
      <div class="container">
        <div class="row">
          <!-- 
    ===============================================
                   HERO SECTION
    ===============================================
    -->
          <div class="col-lg-7 col-12">
            <div class="hero-content">
              <div class="animate__animated animate__fadeInLeft">
                <h1 class="hero-heading">
                  <?php echo e(__(@$banner->data_values->heading)); ?>  
                  <span class="colored-text"><?php echo e(__(@$banner->data_values->subheading)); ?></span>
                </h1>
              </div>
              <div>
                <p class="hero-text"><?php echo e(__(@$banner->data_values->description)); ?></p>
              </div>
              <div class="py-md-5 py-2 d-flex gap-3">
                <a href="<?php echo e(__(@$banner->data_values->left_button_link)); ?>" class="text-decoration-none">
                  <button type="button" class="btn btn-primary">
                    <?php echo e(__(@$banner->data_values->left_button)); ?>

                    <i class="fa-solid fa-arrow-right"></i>
                  </button>
                </a>
                <a href="<?php echo e(__(@$banner->data_values->right_button_link)); ?>" class="text-decoration-none">
                  <button type="button" class="btn btn-outline-light">
                    <?php echo e(__(@$banner->data_values->right_button)); ?>

                    <i class="fa-solid fa-arrow-right"></i>
                  </button>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-12 position-relative">
            <div class="hero-wrap d-md-block d-none">
              <div class="hero-img">
                <img src="assets/images/logoIcon/logo.png"  alt="<?php echo app('translator')->get('banner'); ?>" class="img-fluid">
              </div>
              <div class="shape"></div>
            </div>
          </div>
          <!-- 
    ===============================================
                   HERO SECTION ENDS
    ===============================================
    -->
    <?php if($sections->secs != null): ?>
                <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make($activeTemplate.'sections.'.$sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/home.blade.php ENDPATH**/ ?>