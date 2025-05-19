<?php
    $clientCaption = getContent('client.content',true);
    $client = getContent('client.element');
?>
<?php if($client): ?>
 <!-- 
    ===============================================
                 BRANDS SCROLL ANIMATION
    ===============================================
    -->
          <div class="col-12">
            <div class="card-intro text-center mt-top">
              <div class="heading">
                <h1><?php echo e(__(@$clientCaption->data_values->heading)); ?></h1>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="logos">
              <div class="logos-slide">
                <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <img src="<?php echo e(getImage('assets/images/frontend/client/' . @$data->data_values->client_image, '210x35')); ?>" width="210"
                      height="auto" alt="<?php echo app('translator')->get('client'.$k++); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
            <div class="logos-rev">
              <div class="logos-slide">
                <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <img src="<?php echo e(getImage('assets/images/frontend/client/' . @$data->data_values->client_image, '210x35')); ?>" width="210"
                      height="auto" alt="<?php echo app('translator')->get('client'.$k++); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
            <div class="logos">
              <div class="logos-slide">
                <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <img src="<?php echo e(getImage('assets/images/frontend/client/' . @$data->data_values->client_image, '210x35')); ?>" width="210"
                      height="auto" alt="<?php echo app('translator')->get('client'.$k++); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
         </div>
          <!-- 
    ===============================================
                 BRANDS SCROLL ANIMATION ENDS
    ===============================================
    -->
<?php endif; ?><?php /**PATH C:\laragon\www\techSphereLogix\stakeavante\core\resources\views/templates/basic/sections/client.blade.php ENDPATH**/ ?>