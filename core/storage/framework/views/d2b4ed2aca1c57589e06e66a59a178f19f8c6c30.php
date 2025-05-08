<?php
    $topMenu=\App\Models\Menu::getAllMenus('Top');
$bottomMenu=\App\Models\Menu::getAllMenus('Bottom');
?>
<?php $__env->startSection('panel'); ?>
    <!-- 
    ===============================================
                   TOP HEADER
    ===============================================
    -->
    <?php if(crypt_widget()==1): ?>
    <header class="top-header">
      <div class="container">
     <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinMarquee.js"></script><div id="coinmarketcap-widget-marquee" coins="25923,1,1027,825,1839" currency="PKR" theme="dark" transparent="true" show-symbol-logo="true"></div>
      </div>
    </header>
    <?php endif; ?>
    <!-- 
    ===============================================
                   TOP HEADER ENDS
    ===============================================
    -->
    <!-- Header -->
    <!--
    ===============================================
                   NAVIGATION
    ===============================================
    -->
    <nav class="navbar navbar-expand-lg bg-transparent sticky-top">
      <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
          <img src="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/mainlogo.png')); ?>" alt="<?php echo app('translator')->get('site-logo'); ?>" width="60" height="auto" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mx-auto gap-4">
            <?php if($topMenu): ?>
            <?php $__currentLoopData = $topMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($top->children_count > 0): ?>
             <li class="nav-item dropdown">
              <a
                class="nav-link text-white"
                href="#"
                id="navbarDropdownMenuLink"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              ><?php echo e($top->name); ?></a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink"
              >
               <?php $__currentLoopData = $top->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="dropdown-item" href="<?php echo e($child->link); ?>"><?php echo e($child->name); ?></a></li>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </li>
            <?php else: ?>
            <li class="nav-item">
              <a
                class="nav-link active text-white"
                aria-current="page"
                href="<?php echo e($top->link); ?>"
                ><?php echo e($top->name); ?></a
              >
            </li>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </ul>
          <?php if(auth()->guard()->check()): ?>
          <div>
              <a href="<?php echo e(route('user.home')); ?>">
                <button type="button" class="btn text-white"><?php echo app('translator')->get('Dashboard'); ?></button>
              </a>
          </div>
          <div>
              <a href="<?php echo e(route('user.logout')); ?>">
                <button type="button" class="btn text-white"><?php echo app('translator')->get('Logout'); ?></button>
              </a>
          </div>
        <?php else: ?>
          <div>
              <a href="<?php echo e(route('user.login')); ?>">
                <button type="button" class="btn text-white"><?php echo app('translator')->get('Sign In'); ?></button>
              </a>
          </div>
          <div>
              <a href="<?php echo e(route('user.register')); ?>">
                <button type="button" class="btn text-white"><?php echo app('translator')->get('Sign Up'); ?></button>
              </a>
          </div>
           <?php endif; ?>
        </div>
      </div>
    </nav>
    <!-- 
    ===============================================
                   NAVIGATION ENDS
    ===============================================
    Header -->
    <?php echo $__env->yieldContent('content'); ?>
<!-- 
    ===============================================
                 FOOTER
    ===============================================
    -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <hr class="my-5" />
            <div
              class="d-flex align-items-center justify-content-md-center justify-content-between gap-md-3 mb-3"
            >
            <?php if($bottomMenu): ?>
            <?php $__currentLoopData = $bottomMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key  => $bottom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a
                href="<?php echo e($bottom->link); ?>"
                class="text-capitalize text-white text-decoration-none"
                ><?php echo e($bottom->name); ?></a
              >
              <?php if(($key+1) != count($bottomMenu)): ?>
              <hr
                style="
                  opacity: 1;
                  border: 1px solid rgb(112, 97, 97);
                  height: 15px;
                "
              />
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            </div>
            <div
              class="d-flex align-items-center justify-content-md-center justify-content-between gap-md-3 mb-5"
            >
              <span class="text-white"><?php echo e(__(@$footer->data_values->copyright)); ?></span>
              <hr
                style="
                  opacity: 1;
                  border: 1px solid rgb(112, 97, 97);
                  height: 15px;
                "
              />
               <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(@$social->data_values->url); ?>" target="_blank" class="social-link"
                  title="<?php echo e(@$social->data_values->title); ?>"><?php echo @$social->data_values->social_icon; ?></a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- 
    ===============================================
                 FOOTER ENDS
    ===============================================
    -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/layouts/master.blade.php ENDPATH**/ ?>