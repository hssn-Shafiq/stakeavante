<div class="sidebar <?php echo e(sidebarVariation()['selector']); ?> <?php echo e(sidebarVariation()['sidebar']); ?> <?php echo e(@sidebarVariation()['overlay']); ?> <?php echo e(@sidebarVariation()['opacity']); ?>"
data-background="<?php echo e(getImage('assets/admin/images/sidebar/2.jpg','400x800')); ?>">
<button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
<div class="sidebar__inner">
<div class="sidebar__logo">
<a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar__main-logo"><img
src="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/logo.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></a>
<a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar__logo-shape"><img
src="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/favicon.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></a>
<button type="button" class="navbar__expand"></button>
</div>
<div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
<ul class="sidebar__menu">
<li class="sidebar-menu-item <?php echo e(menuActive('admin.dashboard')); ?>">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link ">
        <i class="menu-icon las la-home"></i>
        <span class="menu-title"><?php echo app('translator')->get('Dashboard'); ?></span>
    </a>
</li>
<?php if(auth('admin')->user()->access==1): ?>
<li class="sidebar-menu-item <?php echo e(menuActive('admin.plan*')); ?>">
            <a href="<?php echo e(route('admin.plan')); ?>" class="nav-link ">
                <i class="menu-icon las la-paper-plane"></i>
                <span class="menu-title"><?php echo app('translator')->get('Plans'); ?></span>
            </a>
        </li>
<li class="sidebar-menu-item <?php echo e(menuActive('admin.membership*')); ?>">
            <a href="<?php echo e(route('admin.membership')); ?>" class="nav-link ">
                <i class="menu-icon las la-cogs"></i>
                <span class="menu-title"><?php echo app('translator')->get('Memberships'); ?></span>
            </a>
        </li>
<li class="sidebar-menu-item <?php echo e(menuActive('admin.rewards*')); ?>">
            <a href="<?php echo e(route('admin.rewards')); ?>" class="nav-link ">
                <i class="menu-icon las la-paper-plane"></i>
                <span class="menu-title"><?php echo app('translator')->get('Rewards'); ?></span>
            </a>
        </li>
<?php endif; ?>
<li class="sidebar-menu-item sidebar-dropdown">
    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.users*',3)); ?>">
        <i class="menu-icon las la-users"></i>
        <span class="menu-title"><?php echo app('translator')->get('Users'); ?></span>
        <?php if($banned_users_count > 0 || $email_unverified_users_count > 0 || $sms_unverified_users_count > 0): ?>
        <span class="menu-badge pill bg--primary ml-auto">
            <i class="fa fa-exclamation"></i>
        </span>
        <?php endif; ?>
    </a>
    <div class="sidebar-submenu <?php echo e(menuActive('admin.users*',2)); ?> ">
        <ul>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.all')); ?> ">
                <a href="<?php echo e(route('admin.users.all')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('All Users'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.winner')); ?> ">
                <a href="<?php echo e(route('admin.users.winner')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Winner Users'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.active')); ?> ">
                <a href="<?php echo e(route('admin.users.active')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Active Users'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.unpaid')); ?> ">
                <a href="<?php echo e(route('admin.users.unpaid')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Un Paid Users'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.banned')); ?> ">
                <a href="<?php echo e(route('admin.users.banned')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Banned Users'); ?></span>
                    <?php if($banned_users_count): ?>
                    <span class="menu-badge pill bg--primary ml-auto"><?php echo e($banned_users_count); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="sidebar-menu-item  <?php echo e(menuActive('admin.users.emailUnverified')); ?>">
                <a href="<?php echo e(route('admin.users.emailUnverified')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Email Unverified'); ?></span>
                    <?php if($email_unverified_users_count): ?>
                    <span
                    class="menu-badge pill bg--primary ml-auto"><?php echo e($email_unverified_users_count); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.sale-defected')); ?> ">
                <a href="<?php echo e(route('admin.users.sale-defected')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Sale Defected Users'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.email.all')); ?>">
                <a href="<?php echo e(route('admin.users.email.all')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Send Email'); ?></span>
                </a>
            </li>
        </ul>
    </div>
</li>
<li class="sidebar-menu-item sidebar-dropdown">
    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.deposit*',3)); ?>">
        <i class="menu-icon las la-credit-card"></i>
        <span class="menu-title"><?php echo app('translator')->get('Deposits'); ?></span>
        <?php if(0 < $pending_deposits_count): ?>
        <span class="menu-badge pill bg--primary ml-auto">
            <i class="fa fa-exclamation"></i>
        </span>
        <?php endif; ?>
    </a>
    <div class="sidebar-submenu <?php echo e(menuActive('admin.deposit*',2)); ?> ">
        <ul>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.pending')); ?> ">
                <a href="<?php echo e(route('admin.deposit.pending')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Pending Deposits'); ?></span>
                    <?php if($pending_deposits_count): ?>
                    <span class="menu-badge pill bg--primary ml-auto"><?php echo e($pending_deposits_count); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.approved')); ?> ">
                <a href="<?php echo e(route('admin.deposit.approved')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Approved Deposits'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.successful')); ?> ">
                <a href="<?php echo e(route('admin.deposit.successful')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Successful Deposits'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.rejected')); ?> ">
                <a href="<?php echo e(route('admin.deposit.rejected')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Rejected Deposits'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.list')); ?> ">
                <a href="<?php echo e(route('admin.deposit.list')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('All Deposits'); ?></span>
                </a>
            </li>
        </ul>
    </div>
</li>
<li class="sidebar-menu-item sidebar-dropdown">
    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.withdraw*',3)); ?>">
        <i class="menu-icon la la-bank"></i>
        <span class="menu-title"><?php echo app('translator')->get('Withdrawals'); ?> </span>
        <?php if(0 < $pending_withdraw_count): ?>
        <span class="menu-badge pill bg--primary ml-auto">
            <i class="fa fa-exclamation"></i>
        </span>
        <?php endif; ?>
    </a>
    <div class="sidebar-submenu <?php echo e(menuActive('admin.withdraw*',2)); ?> ">
        <ul>
            <?php if(auth('admin')->user()->access==1): ?>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.withdraw.method.index')); ?>">
                        <a href="<?php echo e(route('admin.withdraw.method.index')); ?>" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Withdraw Methods'); ?></span>
                        </a>
                    </li>
            <?php endif; ?>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.withdraw.pending')); ?> ">
                <a href="<?php echo e(route('admin.withdraw.pending')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Pending Log'); ?></span>
                    <?php if($pending_withdraw_count): ?>
                    <span class="menu-badge pill bg--primary ml-auto"><?php echo e($pending_withdraw_count); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.withdraw.approved')); ?> ">
                <a href="<?php echo e(route('admin.withdraw.approved')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Approved Log'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.withdraw.rejected')); ?> ">
                <a href="<?php echo e(route('admin.withdraw.rejected')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Rejected Log'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.withdraw.log')); ?> ">
                <a href="<?php echo e(route('admin.withdraw.log')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Withdrawals Log'); ?></span>
                </a>
            </li>
        </ul>
    </div>
</li>
<li class="sidebar-menu-item sidebar-dropdown">
    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.ticket*',3)); ?>">
        <i class="menu-icon la la-ticket"></i>
        <span class="menu-title"><?php echo app('translator')->get('Support Ticket'); ?> </span>
        <?php if(0 < $pending_ticket_count): ?>
        <span class="menu-badge pill bg--primary ml-auto">
            <i class="fa fa-exclamation"></i>
        </span>
        <?php endif; ?>
    </a>
    <div class="sidebar-submenu <?php echo e(menuActive('admin.ticket*',2)); ?> ">
        <ul>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket')); ?> ">
                <a href="<?php echo e(route('admin.ticket')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('All Ticket'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.pending')); ?> ">
                <a href="<?php echo e(route('admin.ticket.pending')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Pending Ticket'); ?></span>
                    <?php if($pending_ticket_count): ?>
                    <span
                    class="menu-badge pill bg--primary ml-auto"><?php echo e($pending_ticket_count); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.closed')); ?> ">
                <a href="<?php echo e(route('admin.ticket.closed')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Closed Ticket'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.answered')); ?> ">
                <a href="<?php echo e(route('admin.ticket.answered')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Answered Ticket'); ?></span>
                </a>
            </li>
        </ul>
    </div>
</li>
<li class="sidebar-menu-item sidebar-dropdown">
            <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.report*',3)); ?>">
                <i class="menu-icon la la-list"></i>
                <span class="menu-title"><?php echo app('translator')->get('Report'); ?> </span>
            </a>
            <div class="sidebar-submenu <?php echo e(menuActive('admin.report*',2)); ?> ">
                <ul>
                    <li class="sidebar-menu-item <?php echo e(menuActive(['admin.report.transaction','admin.report.transaction.search'])); ?>">
                        <a href="<?php echo e(route('admin.report.transaction')); ?>" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Transaction Log'); ?></span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item <?php echo e(menuActive(['admin.report.invest'])); ?>">
                        <a href="<?php echo e(route('admin.report.invest')); ?>" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Invest Log'); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item <?php echo e(menuActive(['admin.report.bvLog'])); ?>">
                        <a href="<?php echo e(route('admin.report.bvLog')); ?>" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Reward Log'); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item <?php echo e(menuActive(['admin.report.binaryCom'])); ?>">
                        <a href="<?php echo e(route('admin.report.binaryCom')); ?>" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Tree Commission'); ?></span>
                        </a>
                    </li>



                    <li class="sidebar-menu-item <?php echo e(menuActive(['admin.report.login.history','admin.report.login.ipHistory'])); ?>">
                        <a href="<?php echo e(route('admin.report.login.history')); ?>" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Login History'); ?></span>
                        </a>
                    </li>

                </ul>
            </div>
        </li>
<?php if(auth('admin')->user()->access==1): ?>
<li class="sidebar__menu-header"><?php echo app('translator')->get('Settings'); ?></li>
<li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.index')); ?>">
    <a href="<?php echo e(route('admin.setting.index')); ?>" class="nav-link">
        <i class="menu-icon las la-life-ring"></i>
        <span class="menu-title"><?php echo app('translator')->get('General Setting'); ?></span>
    </a>
</li>
<li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.logo_icon')); ?>">
    <a href="<?php echo e(route('admin.setting.logo_icon')); ?>" class="nav-link">
        <i class="menu-icon las la-images"></i>
        <span class="menu-title"><?php echo app('translator')->get('Logo Icon Setting'); ?></span>
    </a>
</li>
<li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notice')); ?>">
    <a href="<?php echo e(route('admin.setting.notice')); ?>" class="nav-link">
        <i class="menu-icon las la-exclamation-triangle"></i>
        <span class="menu-title"><?php echo app('translator')->get('Notice'); ?></span>
    </a>
</li>
<li class="sidebar-menu-item <?php echo e(menuActive('admin.gateway.manual.index')); ?> ">
    <a href="<?php echo e(route('admin.gateway.manual.index')); ?>" class="nav-link">
        <i class="menu-icon las la-dot-circle"></i>
        <span class="menu-title"><?php echo app('translator')->get('Manual Gateways'); ?></span>
    </a>
</li>
<li class="sidebar-menu-item <?php echo e(menuActive('admin.seo')); ?>">
            <a href="<?php echo e(route('admin.seo')); ?>" class="nav-link">
                <i class="menu-icon las la-globe"></i>
                <span class="menu-title"><?php echo app('translator')->get('SEO Manager'); ?></span>
            </a>
        </li>
<li class="sidebar-menu-item sidebar-dropdown">
    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.email.template*',3)); ?>">
        <i class="menu-icon la la-envelope-o"></i>
        <span class="menu-title"><?php echo app('translator')->get('Email Manager'); ?></span>
    </a>
    <div class="sidebar-submenu <?php echo e(menuActive('admin.email.template*',2)); ?> ">
        <ul>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.email.template.global')); ?> ">
                <a href="<?php echo e(route('admin.email.template.global')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Global Template'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive(['admin.email.template.index','admin.email.template.edit'])); ?> ">
                <a href="<?php echo e(route('admin.email.template.index')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Email Templates'); ?></span>
                </a>
            </li>
            <li class="sidebar-menu-item <?php echo e(menuActive('admin.email.template.setting')); ?> ">
                <a href="<?php echo e(route('admin.email.template.setting')); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo app('translator')->get('Email Configure'); ?></span>
                </a>
            </li>
        </ul>
    </div>
</li>
<li class="sidebar-menu-item <?php echo e(menuActive('admin.extensions.index')); ?>">
    <a href="<?php echo e(route('admin.extensions.index')); ?>" class="nav-link">
        <i class="menu-icon las la-cogs"></i>
        <span class="menu-title"><?php echo app('translator')->get('Extensions'); ?></span>
    </a>
</li>
<li class="sidebar__menu-header"><?php echo app('translator')->get('Frontend Manager'); ?></li>
<li class="sidebar-menu-item <?php echo e(menuActive('admin.frontend.manage.pages')); ?>">
    <a href="<?php echo e(route('admin.frontend.manage.pages')); ?>" class="nav-link ">
        <i class="menu-icon la la-list"></i>
        <span class="menu-title"><?php echo app('translator')->get('Manage Pages'); ?></span>
    </a>
</li>
<li class="sidebar-menu-item <?php echo e(menuActive('admin.frontend.manage-menu*')); ?>">
    <a href="<?php echo e(route('admin.frontend.manage-menu')); ?>" class="nav-link ">
        <i class="menu-icon la la-book"></i>
        <span class="menu-title"><?php echo app('translator')->get('Manage Menu'); ?></span>
    </a>
</li>
<li class="sidebar-menu-item sidebar-dropdown">
    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.frontend.sections*',3)); ?>">
        <i class="menu-icon la la-html5"></i>
        <span class="menu-title"><?php echo app('translator')->get('Manage Section'); ?></span>
    </a>
    <div class="sidebar-submenu <?php echo e(menuActive('admin.frontend.sections*',2)); ?> ">
        <ul>
            <?php
            $lastSegment =  collect(request()->segments())->last();
            ?>
            <?php $__currentLoopData = getPageSections(true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $secs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($secs['builder']): ?>
            <li class="sidebar-menu-item  <?php if($lastSegment == $k): ?> active <?php endif; ?> ">
                <a href="<?php echo e(route('admin.frontend.sections',$k)); ?>" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title"><?php echo e(__($secs['name'])); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</li>
<?php endif; ?>
</ul>
</div>
</div>
</div>
<!-- sidebar end --><?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/admin/partials/sidenav.blade.php ENDPATH**/ ?>