<?php $__env->startSection('content'); ?>
<!-- Contact -->
<div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 align-self-center">
            <div class="adress-wrapper">
              <div class="main-head">
                <h1><?php echo e(__(@$contact->data_values->title)); ?></h1>
              </div>
              <div class="about-address">
                <p>
                  <?php echo e(__(@$contact->data_values->short_details)); ?>

                </p>
              </div>
              <div class="sub-head">
                <h4><?php echo app('translator')->get('More Information'); ?></h4>
              </div>
              <div class="row">
                <div class="col-2 mb-3" style="width: fit-content">
                  <div class="address-icon">
                    <i class="fa-solid fa-location-dot"></i>
                  </div>
                </div>
                <div class="col-10 mb-3">
                  <div class="address-values">
                    <div class="label"><?php echo app('translator')->get('Address'); ?></div>
                    <div class="label-value"><?php echo e(@$contact->data_values->contact_details); ?></div>
                  </div>
                </div>
                <div class="col-2 mb-3" style="width: fit-content">
                  <div class="address-icon">
                    <i class="fa-solid fa-envelope"></i>
                  </div>
                </div>
                <div class="col-10 mb-3">
                  <div class="address-values">
                    <div class="label"><?php echo app('translator')->get('Email'); ?></div>
                    <div class="label-value"><?php echo e(@$contact->data_values->email_address); ?></div>
                  </div>
                </div>
                <div class="col-2 mb-3" style="width: fit-content">
                  <div class="address-icon">
                    <i class="fa-solid fa-phone"></i>
                  </div>
                </div>
                <div class="col-10 mb-3">
                  <div class="address-values">
                    <div class="label"><?php echo app('translator')->get('Phone'); ?></div>
                    <div class="label-value">
                     <a href="tel:<?php echo e(@$contact->data_values->contact_number); ?>">
                                        <?php echo e(@$contact->data_values->contact_number); ?>

                                    </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="form-wrapper text-white">
              <div class="form-heading">
                <h1><?php echo app('translator')->get('Contact US'); ?></h1>
              </div>
              <form class="row g-4 contact-form" method="post" action="">
                <?php echo csrf_field(); ?>
                <div class="col-md-6">
                  <label for="name" class="form-label mb-3"><?php echo app('translator')->get('Name'); ?></label>
                  <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control form--control" placeholder="<?php echo app('translator')->get('Your Name'); ?>" id="name" required>
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label mb-3"><?php echo app('translator')->get('Email US'); ?></label>
                   <input type="email" name="email"  value="<?php echo e(old('email')); ?>" id="email" placeholder="<?php echo app('translator')->get('Enter E-Mail Address'); ?>" required class="form-control form--control">
                </div>
                <div class="col-12">
                  <label for="subject" class="form-label mb-3"><?php echo app('translator')->get('Subject'); ?></label>
                  <input type="text" name="subject" placeholder="<?php echo app('translator')->get('Write your subject'); ?>" value="<?php echo e(old('subject')); ?>" id="subject" required class="form-control form--control">
                </div>
                <div class="col-12">
                  <label for="floatingTextarea2" class="form-label mb-3"
                    ><?php echo app('translator')->get('Message'); ?></label
                  >
                   <textarea name="message" id="message" class="form-control form--control" placeholder="<?php echo app('translator')->get('Write your message'); ?>"><?php echo e(old('message')); ?></textarea>
                </div>

                        <?php
                            $reCpatcha = reCaptcha();
                        ?>

                        <?php if($reCpatcha): ?>
                            <div class="col-lg-12">
                                <div class="form-group preview">
                                    <?php echo $reCpatcha ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-12">
                            <?php echo $__env->make($activeTemplate.'partials.custom-captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Send Message'); ?></button>
                        </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- Contact -->

    <?php if($sections->secs != null): ?>
        <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($activeTemplate.'sections.'.$sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/contact.blade.php ENDPATH**/ ?>