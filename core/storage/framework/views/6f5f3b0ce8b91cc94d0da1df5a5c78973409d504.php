<?php
    $counterCaption = getContent('counter.content', true);
    $counters = getContent('counter.element');
?>
 <!-- 
    ===============================================
                   cOUNTER SECTION
    ===============================================
    -->
          <div
            class="col-12"
            data-aos="fade-up"
            data-aos-offset="200"
            data-aos-duration="1000"
          >
            <div class="row">
              <div class="col-md-6">
                <div class="counter-heading">
                 <?php echo e(__(@$counterCaption->data_values->heading)); ?>

                </div>
                <p class="counter-description text-white"><?php echo e(__(@$counterCaption->data_values->description)); ?></p>
              </div>
              <div class="col-md-6">
                <ul class="counter-values list-unstyled">
                 <?php $__currentLoopData = $counters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="border-bottom py-5">
                    <div class="value">
                      <span class="count"><?php echo e(_(@$counter->data_values->counter_digit)); ?></span>
                    </div>
                    <div class="description"><?php echo e(__(@$counter->data_values->title)); ?></div>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            </div>
          </div>
          <!-- 
    ===============================================
                  COUNTER SECTION ENDS
    ===============================================
    -->
<?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/sections/counter.blade.php ENDPATH**/ ?>