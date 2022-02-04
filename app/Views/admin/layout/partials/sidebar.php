<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url(route_to('admin_dashboard')); ?>">CMS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url(route_to('admin_dashboard')); ?>">CVE</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header"><?= cve_admin_lang_path('Sidebar', 'menus') ?></li>

            <li>
                <a class="nav-link" href="<?= base_url(route_to('admin_dashboard')); ?>">
                    <i class="fas fa-home"></i></i><span><?= cve_admin_lang_path('Sidebar', 'dashboard') ?></span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span><?= cve_admin_lang_path('Sidebar', 'groups') ?></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_group_listing', null)) ?>">
                            <?= cve_admin_lang_path('Sidebar', 'group_listing') ?>
                        </a>
                    </li>
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_group_create')); ?>">
                            <?= cve_admin_lang_path('Sidebar', 'group_create') ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-fire"></i><span><?= cve_admin_lang_path('Sidebar', 'users') ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_user_listing', null)) ?>">
                            <?= cve_admin_lang_path('Sidebar', 'user_listing') ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_user_create')); ?>">
                            <?= cve_admin_lang_path('Sidebar', 'user_create') ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-fire"></i>
                    <span>
                        <?= cve_admin_lang_path('Sidebar', 'blog') ?>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_blog_listing', null)) ?>">
                            <?= cve_admin_lang_path('Sidebar', 'blog_listing') ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_blog_create')) ?>">
                            <?= cve_admin_lang_path('Sidebar', 'blog_create') ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-copy"></i>
                    <span>
                        <?= cve_admin_lang_path('Sidebar', 'pages'); ?>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_page_listing', null)); ?>">
                            <?= cve_admin_lang_path('Sidebar', 'page_listing'); ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_page_create')) ?>">
                            <?= cve_admin_lang_path('Sidebar', 'page_create'); ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-fire"></i>
                    <span>
                        <?= cve_admin_lang_path('Sidebar', 'categories') ?>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_category_listing', null)) ?>">
                            <?= cve_admin_lang_path('Sidebar', 'category_listing') ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_category_create')); ?>">
                            <?= cve_admin_lang_path('Sidebar', 'category_create') ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-fire"></i>
                    <span>
                        <?= cve_admin_lang_path('Sidebar', 'media') ?>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_image_listing')); ?>">
                            <?= cve_admin_lang_path('Sidebar', 'images') ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">
                            <?= cve_admin_lang_path('Sidebar', 'videos') ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">
                            <?= cve_admin_lang_path('Sidebar', 'files') ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="nav-link" href="<?= base_url(route_to('admin_comment_listing', null)); ?>">
                    <i class="fas fa-comments"></i>
                    <span>
                        <?= cve_admin_lang_path('Sidebar', 'comments') ?>
                    </span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="<?= base_url(route_to('admin_menu_listing', null)); ?>">
                    <i class="fas fa-tools"></i><span><?= cve_admin_lang_path('Sidebar', 'menu_management')?></span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-globe"></i></i><span><?= cve_admin_lang_path('Sidebar', 'languages')?></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_language_listing', null)) ?>">
                            <?= cve_admin_lang_path('Sidebar', 'language_listing')?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_language_create')); ?>">
                            <?= cve_admin_lang_path('Sidebar', 'language_create')?>

                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url(route_to('admin_translation_listing')); ?>">
                            <?= cve_admin_lang_path('Sidebar', 'translation')?>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="nav-link" href="<?= base_url(route_to('admin_theme_listing')); ?>">
                    <i class="fas fa-tools"></i>
                    <span>
                        <?= cve_admin_lang_path('Sidebar', 'themes')?>
                    </span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="<?= base_url(route_to('admin_setting_home')); ?>">
                    <i class="fas fa-tools"></i><span><?= cve_admin_lang_path('Sidebar', 'settings')?></span>
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
                <i class="fas fa-rocket"></i> <?= cve_admin_lang_path('Sidebar', 'document')?>
            </a>
        </div>
    </aside>
</div>