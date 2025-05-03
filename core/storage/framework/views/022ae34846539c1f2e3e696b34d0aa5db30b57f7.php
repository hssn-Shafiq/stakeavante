
<?php
    $testimonialCaption = getContent('testimonial.content',true);
    $testimonials = getContent('testimonial.element');
?>
<?php if($testimonials): ?>
  <!--
    ===============================================
                  TESTIMONIAL SECTION
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
            <div id="testimonial-slider" class="owl-carousel owl-theme">
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="item">
                <div class="testimonial">
                  <p>
                    "<?php echo e(__(@$testimonial->data_values->description)); ?>"
                  </p>
                  <div class="testimonial-img">
                     <img src="<?php echo e(getImage('assets/images/frontend/testimonial/' . $testimonial->data_values->logo_image, '128x128')); ?>" width="128"
                      height="auto" alt="<?php echo app('translator')->get('logo'.$k++); ?>">
                  </div>
                  <h4 class="user-name">
                    <?php echo e(__(@$testimonial->data_values->name)); ?></h4>
                  <span class="designation"><?php echo e(__(@$testimonial->data_values->title)); ?></span>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
          <!-- 
    ===============================================
                 TESTIMONIAL SECTION ENDS
    ===============================================
    -->

<?php endif; ?>
<?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/sections/testimonial.blade.php ENDPATH**/ ?>