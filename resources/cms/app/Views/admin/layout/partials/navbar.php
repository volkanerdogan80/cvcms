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
            <li>
                <a href="<?= base_url(route_to('admin_cache_clean')) ?>"
                   data-toggle="tooltip" data-placement="top" title="<?= lang('General.text.cache_clean')?>"
                   class="nav-link nav-link-lg">
                    <i class="fas fa-tachometer-alt"></i>
                </a>
            </li>
            <li class="dropdown dropdown-list-toggle">
                <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep">
                    <i class="far fa-envelope"></i>
                </a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header"><?= lang('Navbar.text.messages') ?>
                        <div class="float-right">
                            <a href="#"><?= lang('Navbar.text.mark_all_read') ?></a>
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-message">
                        <a href="#" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-avatar">
                                <img alt="image" src="<?= base_url('public/admin/img/avatar/avatar-1.png') ?>" class="rounded-circle">
                                <div class="is-online"></div>
                            </div>
                            <div class="dropdown-item-desc">
                                <b>Kusnaedi</b>
                                <p>Hello, Bro!</p>
                                <div class="time">10 Hours Ago</div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-footer text-center">
                        <a href="#">
                            <?= lang('Navbar.text.view_all') ?> <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </li>
            <li class="dropdown dropdown-list-toggle">
                <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
                    <i class="far fa-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header"><?= lang('Navbar.text.notifications') ?>
                        <div class="float-right">
                            <a href="#"><?= lang('Navbar.text.mark_all_read') ?></a>
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        <a href="#" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-icon bg-primary text-white">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Template update is available now!
                                <div class="time text-primary">2 Min Ago</div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-footer text-center">
                        <a href="#"><?= lang('Navbar.text.view_all') ?> <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="<?php //cve_language(true)->getFlag() ?>" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block"><?php // cve_language(true)->getTitle() ?></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <?php foreach (cve_language() as $lang): ?>
                        <!-- Canlıya geçince Language/changeLanguage fonksiyonu ile aktif edilecek -->
                        <a href="http://localhost/cms/<?= $lang->getCode() ?>/admin/dashboard" class="dropdown-item has-icon">
                            <img width="25" alt="" src="<?php //$lang->getFlag() ?>"> <?php // $lang->getTitle() ?>
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
                        <i class="far fa-user"></i> <?= lang('Navbar.text.profile') ?>
                    </a>
                    <a href="features-settings.html" class="dropdown-item has-icon">
                        <i class="fas fa-cog"></i> <?= lang('Navbar.text.setting') ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url(route_to('admin_logout')); ?>" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> <?= lang('Navbar.text.logout') ?>
                    </a>
                </div>
            </li>
        </ul>
    </nav>