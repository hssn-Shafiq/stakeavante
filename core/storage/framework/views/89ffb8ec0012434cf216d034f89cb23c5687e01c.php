<?php
    $works = getContent('why_we_are.element', false, null, true);
    $workCaption = getContent('why_we_are.content',true);
?>
<?php if($works): ?>
 <!-- 
    ===============================================
                   WHY WE ARE SECTION
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
                    <img src="<?php echo e(getImage('assets/images/frontend/why_we_are/' . @$data->data_values->feature_image, '400x400')); ?>" width="200"
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
                   WHY WE ARE SECTION ENDS
    ===============================================
    -->
<?php endif; ?>

<?php /**PATH C:\laragon\www\techSphereLogix\stakeavante\core\resources\views/templates/basic/sections/why_we_are.blade.php ENDPATH**/ ?>