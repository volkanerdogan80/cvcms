<div class="main-wrapper">
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li>
                    <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                </li>
                <li>
                    <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
                </li>
            </ul>
        </form>
        <ul class="navbar-nav navbar-right">
            <?php if (config('webmaster')->accountId): ?>
                <li>
                    <a href="<?= base_url(route_to('admin_analytics_realtime')) ?>"
                       data-toggle="tooltip" data-placement="top" title="<?= cve_admin_lang('Buttons', 'analytics'); ?>"
                       class="nav-link nav-link-lg">
                        <i class="fas fa-chart-line"></i>
                    </a>
                </li>
            <?php endif; ?>
            <li>
                <a href="<?= base_url(route_to('admin_cache_clean')) ?>"
                   data-toggle="tooltip" data-placement="top" title="<?= cve_admin_lang('Navbar', 'clear_cache') ?>"
                   class="nav-link nav-link-lg">
                    <i class="fas fa-tachometer-alt"></i>
                </a>
            </li>
            <li class="dropdown dropdown-list-toggle">
                <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle">
                    <i class="far fa-envelope"></i>
                </a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header"><?= cve_admin_lang('Navbar', 'messages') ?>
                        <div class="float-right">
                            <a class="message-mark-all-read" href="javascript:void(0) " data-url="<?= base_url(route_to('admin_message_all_read')) ?>" ><?= cve_admin_lang('Navbar', 'mark_all_read') ?></a>
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-message navbar-message-list">

                    </div>
                    <div class="dropdown-footer text-center">
                        <a href="<?= base_url(route_to('admin_message_listing', null)) ?>">
                            <?= cve_admin_lang('Navbar', 'view_all') ?> <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </li>
            <?php if(config('firebase')->status): ?>
                <li>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#notification-modal" class="nav-link nav-link-lg notification-modal-show">
                        <i class="far fa-bell"></i>
                    </a>
                </li>
            <?php endif; ?>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="<?= cve_language(true)->getFlag() ?>" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block"><?= cve_language(true)->getTitle() ?></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <?php foreach (cve_language() as $lang): ?>
                        <a href="<?= base_url(route_to('admin_language_change', $lang->getCode())); ?>" class="dropdown-item has-icon">
                            <img width="25" alt="" src="<?= $lang->getFlag() ?>"> <?= $lang->getTitle() ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="<?= base_url('public/admin/img/avatar/avatar-1.png'); ?>" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block"><?= session('userData.name') ?></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="features-profile.html" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> <?= cve_admin_lang('Navbar', 'profile') ?>
                    </a>
                    <a href="<?= base_url(route_to('admin_setting_home')); ?>" class="dropdown-item has-icon">
                        <i class="fas fa-cog"></i> <?= cve_admin_lang('Navbar', 'settings') ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url(route_to('homepage')); ?>" target="_blank" class="dropdown-item has-icon">
                        <i class="fas fa-home"></i> <?= cve_admin_lang('Navbar', 'go_to_site') ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url(route_to('admin_logout')); ?>" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> <?= cve_admin_lang('Navbar', 'logout') ?>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</div>