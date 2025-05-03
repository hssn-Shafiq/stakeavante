<div class="sidebar capsule--rounded bg_img overlay--dark"
     data-background="<?php echo e(asset('assets/admin/images/sidebar/2.jpg')); ?>">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="<?php echo e(route('user.home')); ?>" class="sidebar__main-logo"><img
                    src="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/logo.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></a>
            <a href="<?php echo e(route('user.home')); ?>" class="sidebar__logo-shape"><img
                    src="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/favicon.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></a>
            <button type="button" class="navbar__expand"></button>
        </div>
        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item <?php echo e(menuActive('user.home')); ?>">
                    <a href="<?php echo e(route('user.home')); ?>" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Dashboard'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('user.deposit')); ?>">
                    <a href="<?php echo e(route('user.deposit')); ?>" class="nav-link">
                        <i class=" menu-icon las la-credit-card"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Deposit Now'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('user.plan.index')); ?>">
                    <a href="<?php echo e(route('user.plan.index')); ?>" class="nav-link ">
                        <i class="menu-icon las la-money-bill"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Staking'); ?></span>
                    </a>
                </li>
                <?php if(isUserPiad()==true): ?>
                <li class="sidebar-menu-item <?php echo e(menuActive('user.achievments')); ?>">
                    <a href="<?php echo e(route('user.achievments')); ?>" class="nav-link">
                        <i class="menu-icon las la-clock"></i>
                        <span class="menu-title"><?php echo app('translator')->get('My Achievments'); ?></span>
                    </a>
                </li>
                <?php endif; ?>
                <li class="sidebar-menu-item <?php echo e(menuActive('user.my.ref')); ?>">
                    <a href="<?php echo e(route('user.my.ref')); ?>" class="nav-link">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title"><?php echo app('translator')->get('My Referrals'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('user.my.tree')); ?>">
                    <a href="<?php echo e(route('user.my.tree')); ?>" class="nav-link">
                        <i class="menu-icon las la-tree"></i>
                        <span class="menu-title"><?php echo app('translator')->get('My Tree'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('user.binary.summery')); ?>">
                    <a href="<?php echo e(route('user.binary.summery')); ?>" class="nav-link">
                        <i class=" menu-icon las la-chart-area"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Tree Summery'); ?></span>
                    </a>
                </li>
                 <?php if(isUserPiad()==true): ?>
                <li class="sidebar-menu-item <?php echo e(menuActive('user.withdraw')); ?>">
                    <a href="<?php echo e(route('user.withdraw')); ?>" class="nav-link">
                        <i class="menu-icon las la-cloud-download-alt"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Withdraw Now'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('user.balance.transfer')); ?>">
                    <a href="<?php echo e(route('user.balance.transfer')); ?>" class="nav-link">
                        <i class="menu-icon las la-hand-holding-usd"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Balance Transfer'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('user.report*',3)); ?> my-2">
                        <i class="menu-icon las la-exchange-alt"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Reports'); ?> / <?php echo app('translator')->get('Logs'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('user.report*',2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('user.report.transactions')); ?> ">
                                <a href="<?php echo e(route('user.report.transactions')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Transactions Log'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('user.report.deposit')); ?>">
                                <a href="<?php echo e(route('user.report.deposit')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Deposit Log'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('user.report.withdraw')); ?>">
                                <a href="<?php echo e(route('user.report.withdraw')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Withdraw Log'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('user.report.invest')); ?>">
                                <a href="<?php echo e(route('user.report.invest')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Invest Log'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('user.report.binaryCom')); ?>">
                                <a href="<?php echo e(route('user.report.binaryCom')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Tree  Commission'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('user.bv.log')); ?>">
                                <a href="<?php echo e(route('user.reward.log')); ?>" class="nav-link">
                                <i class="menu-icon las la-dot-circle"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Reward Log'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('user.transfer.log')); ?>">
                                <a href="<?php echo e(route('user.transfer.log')); ?>" class="nav-link">
                                <i class="menu-icon las la-dot-circle"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Transfer Log'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('user.twofactor')); ?>">
                    <a href="<?php echo e(route('user.twofactor')); ?>" class="nav-link">
                        <i class="menu-icon las la-shield-alt"></i>
                        <span class="menu-title"><?php echo app('translator')->get('2FA Security'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('ticket*')); ?>">
                    <a href="<?php echo e(route('ticket')); ?>" class="nav-link">
                        <i class="menu-icon las la-ticket-alt"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Support'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('user.login.history')); ?>">
                    <a href="<?php echo e(route('user.login.history')); ?>" class="nav-link">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Login History'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="<?php echo e(route('user.logout')); ?>" class="nav-link">
                        <i class="menu-icon las la-sign-out-alt"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Logout'); ?></span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/user/partials/sidenav.blade.php ENDPATH**/ ?>