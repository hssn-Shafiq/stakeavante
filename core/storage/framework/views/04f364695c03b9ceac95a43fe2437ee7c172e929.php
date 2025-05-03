<?php
    $faqTitle = getContent('faq.content', true);
    $faqs = getContent('faq.element');
?>
<div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="faq-heading text-center text-white">
              <h1 class="text-capitalize"><?php echo e(__(@$faqTitle->data_values->heading)); ?></h1>
            </div>
            <div class="faq-para text-center text-white">
              <p><?php echo e(__(@$faqTitle->data_values->description)); ?></p>
            </div>
          </div>
          <!-- 
    ===============================================
                 TABS
    ===============================================
    -->
          <div class="col-12">
            <div class="tabs">
              <div class="row gx-3">
                <div class="col-md-6">
                  <div
                    class="accordion accordion-flush"
                    id="accordionFlushExample"
                  >
                  <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faql): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->odd): ?>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-heading<?php echo e($key); ?>">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#flush-collapse<?php echo e($key); ?>"
                          aria-expanded="false"
                          aria-controls="flush-collapse<?php echo e($key); ?>"
                        >
                          <strong><?php echo e(__(@$faql->data_values->question)); ?></strong>
                        </button>
                      </h2>
                      <div
                        id="flush-collapse<?php echo e($key); ?>"
                        class="accordion-collapse collapse"
                        aria-labelledby="flush-heading<?php echo e($key); ?>"
                        data-bs-parent="#accordionFlushExample"
                      >
                        <div class="accordion-body"><?php echo __(@$faql->data_values->answer); ?>

                        </div>
                      </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div
                    class="accordion accordion-flush"
                    id="accordionFlushExample2"
                  >
                  <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faql): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->even): ?>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-heading<?php echo e($key); ?>">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#flush-collapse<?php echo e($key); ?>"
                          aria-expanded="false"
                          aria-controls="flush-collapse<?php echo e($key); ?>"
                        >
                          <strong><?php echo e(__(@$faql->data_values->question)); ?></strong>
                        </button>
                      </h2>
                      <div
                        id="flush-collapse<?php echo e($key); ?>"
                        class="accordion-collapse collapse"
                        aria-labelledby="flush-heading<?php echo e($key); ?>"
                        data-bs-parent="#accordionFlushExample2"
                      >
                        <div class="accordion-body"><?php echo __(@$faql->data_values->answer); ?>

                        </div>
                      </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- 
    ===============================================
                 TABS ENDS
    ===============================================
    -->
        </div>
      </div>
    </div>
<?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/sections/faq.blade.php ENDPATH**/ ?>