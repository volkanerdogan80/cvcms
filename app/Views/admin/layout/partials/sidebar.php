<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url(route_to('admin_dashboard')); ?>">CMS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url(route_to('admin_dashboard')); ?>">CVE</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header"><?= cve_admin_lang('Sidebar', 'menus') ?></li>

            <li class="clear-storage">
                <a class="nav-link" href="<?= base_url(route_to('admin_dashboard')); ?>">
                    <i class="fas fa-home"></i></i><span><?= cve_admin_lang('Sidebar', 'dashboard') ?></span>
                </a>
            </li>

            <li class="nav-item dropdown" id="group">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-users-cog"></i>
                    <span>
                        <?= cve_admin_lang('Sidebar', 'groups') ?>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_group_listing', null)) ?>">
                            <?= cve_admin_lang('Sidebar', 'group_listing') ?>
                        </a>
                    </li>
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_group_create')); ?>">
                            <?= cve_admin_lang('Sidebar', 'group_create') ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown" id="user">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-users"></i><span><?= cve_admin_lang('Sidebar', 'users') ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_user_listing', null)) ?>">
                            <?= cve_admin_lang('Sidebar', 'user_listing') ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_newsletter_listing')) ?>">
                            <?= cve_admin_lang('Sidebar', 'email_subscribers') ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_user_create')); ?>">
                            <?= cve_admin_lang('Sidebar', 'user_create') ?>
                        </a>
                    </li>
                </ul>
            </li>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/module-sidebar'); ?>

            <li class="nav-item dropdown" id="category">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-th-list"></i>
                    <span>
                        <?= cve_admin_lang('Sidebar', 'categories') ?>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_category_listing', null)) ?>">
                            <?= cve_admin_lang('Sidebar', 'category_listing') ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_category_create')); ?>">
                            <?= cve_admin_lang('Sidebar', 'category_create') ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown" id="media">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-folder-open"></i>
                    <span>
                        <?= cve_admin_lang('Sidebar', 'media') ?>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_image_listing')); ?>">
                            <?= cve_admin_lang('Sidebar', 'images') ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">
                            <?= cve_admin_lang('Sidebar', 'videos') ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">
                            <?= cve_admin_lang('Sidebar', 'files') ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="clear-storage">
                <a class="nav-link" href="<?= base_url(route_to('admin_comment_listing', null)); ?>">
                    <i class="fas fa-comments"></i>
                    <span>
                        <?= cve_admin_lang('Sidebar', 'comments') ?>
                    </span>
                </a>
            </li>
            <li class="clear-storage">
                <a class="nav-link" href="<?= base_url(route_to('admin_menu_listing', null)); ?>">
                    <i class="fas fa-tools"></i><span><?= cve_admin_lang('Sidebar', 'menu_management')?></span>
                </a>
            </li>
            <li class="nav-item dropdown" id="language">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-globe"></i><span><?= cve_admin_lang('Sidebar', 'languages')?></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_language_listing', null)) ?>">
                            <?= cve_admin_lang('Sidebar', 'language_listing')?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_language_create')); ?>">
                            <?= cve_admin_lang('Sidebar', 'language_create')?>

                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_translation_listing')); ?>">
                            <?= cve_admin_lang('Sidebar', 'translation')?>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="clear-storage">
                <a class="nav-link" href="<?= base_url(route_to('admin_slider_listing', null)); ?>">
                    <i class="far fa-images"></i>
                    <span>
                        <?= cve_admin_lang('Sidebar', 'sliders'); ?>
                    </span>
                </a>
            </li>
            <li class="clear-storage">
                <a class="nav-link" href="<?= base_url(route_to('admin_theme_listing')); ?>">
                    <i class="fab fa-gripfire"></i>
                    <span>
                        <?= cve_admin_lang('Sidebar', 'themes')?>
                    </span>
                </a>
            </li>

            <li class="clear-storage">
                <a class="nav-link" href="<?= base_url(route_to('admin_component_listing')); ?>">
                    <i class="fas fa-puzzle-piece"></i>
                    <span>
                       <?= cve_admin_lang('Sidebar', 'components')?>
                    </span>
                </a>
            </li>

            <li class="clear-storage">
                <a class="nav-link" href="<?= base_url(route_to('admin_setting_home')); ?>">
                    <i class="fas fa-tools"></i><span><?= cve_admin_lang('Sidebar', 'settings')?></span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Örnek</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="index-0.html">Örnek 1</a></li>
                    <li><a class="nav-link" href="index.html">Örnek 1</a></li>
                </ul>
            </li>

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> <?= cve_admin_lang('Sidebar', 'document')?>
            </a>
        </div>
    </aside>
</div>