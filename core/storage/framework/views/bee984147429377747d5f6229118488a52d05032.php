<?php
    $participationCaption = getContent('participation.content',true);
    $participation = getContent('participation.element');
?>

<?php if($participation): ?>
 <!-- 
    ===============================================
                 PARTICIPATION SECTION
    ===============================================
    -->
          <div
            class="col-12"
            data-aos="fade-up"
            data-aos-offset="200"
            data-aos-duration="1000"
          >
            <div class="card-intro text-center">
              <div class="heading">
                <h1><?php echo e(__(@$participationCaption->data_values->heading)); ?></h1>
              </div>
            </div>
          </div>
          <div
            class="col-12"
            data-aos="fade-up"
            data-aos-offset="200"
            data-aos-duration="1000"
          >
            <div class="participant-links-wrap">
              <div class="row gy-5 gy-md-0">
                <?php $__currentLoopData = $participation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6">
                  <h4 class="head-text"><?php echo e(__(@$data->data_values->title)); ?></h4>
                  <p class="desc-para"><?php echo e(__(@$data->data_values->description)); ?>

                  </p>
                  <a href="<?php echo e(__(@$data->data_values->button_link)); ?>" class="btn btn-outline-light"><?php echo e(__(@$data->data_values->button)); ?> <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <!-- 
    ===============================================
                 PARTICIPATION SECTION ENDS
    ===============================================
    --><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/sections/participation.blade.php ENDPATH**/ ?>