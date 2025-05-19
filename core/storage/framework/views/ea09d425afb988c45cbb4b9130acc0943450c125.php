<?php
    $works = getContent('how_it_works.element', false, null, true);
    $workCaption = getContent('how_it_works.content',true);
?>

<?php if($works): ?>
 <!-- 
    ===============================================
                   HOW IT WORK SECTION
    ===============================================
    -->
          <div
            class="col-12"
            data-aos="fade-up"
            data-aos-offset="200"
            data-aos-duration="1000"
          >
            <div class="card-intro">
              <div class="heading">
                <h1><?php echo e(__(@$workCaption->data_values->heading)); ?></h1>
              </div>
            </div>
          </div>
          <div
            class="col-12"
            data-aos="fade-up"
            data-aos-offset="200"
            data-aos-duration="1000"
          >
            <div class="row g-3">
            <?php $__currentLoopData = $works; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-6">
                <div class="custom-card">
                  <div class="card-img">
                    <img src="<?php echo e(getImage('assets/images/frontend/how_it_works/' . @$data->data_values->feature_image, '400x400')); ?>" width="200"
                      height="auto" alt="<?php echo app('translator')->get('step'.$k++); ?>">
                  </div>
                  <div class="card-heading">
                    <h4><?php echo e(__(@$data->data_values->title)); ?></h4>
                  </div>
                  <div class="card-desc">
                    <p>
                     <?php echo e(__(@$data->data_values->description)); ?>

                    </p>
                  </div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
          <!-- 
    ===============================================
                   HOW IT WORK SECTION ENDS
    ===============================================
    -->
<?php endif; ?>

<?php /**PATH C:\laragon\www\techSphereLogix\stakeavante\core\resources\views/templates/basic/sections/how_it_works.blade.php ENDPATH**/ ?>