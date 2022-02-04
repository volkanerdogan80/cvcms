<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url(route_to('admin_dashboard')); ?>">CMS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url(route_to('admin_dashboard')); ?>">CVE</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header"><?= lang('sidebar.text.menus'); ?></li>

            <li>
                <a class="nav-link" href="<?= base_url(route_to('admin_dashboard')); ?>">
                    <i class="fas fa-fire"></i><span><?= lang('Sidebar.text.dashboard') ?></span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span><?= lang('Sidebar.text.group_management') ?></span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_group_listing', null)) ?>"><?= lang('Sidebar.text.group_list') ?></a></li>
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_group_create')); ?>"><?= lang('Sidebar.text.add_new_group') ?></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span><?= lang('Sidebar.text.user_management') ?></span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_user_listing', null)) ?>"><?= lang('Sidebar.text.user_list') ?></a></li>
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_user_create')); ?>"><?= lang('Sidebar.text.add_new_user') ?></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span><?= lang('Sidebar.text.blog_management') ?></span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_blog_listing', null)) ?>"><?= lang('Sidebar.text.blog_list') ?></a></li>
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_blog_create')) ?>"><?= lang('Sidebar.text.add_new_blog') ?></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span><?= lang('Sidebar.text.category_management') ?></span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_category_listing', null)) ?>"><?= lang('Sidebar.text.category_list') ?></a></li>
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_category_create')); ?>"><?= lang('Sidebar.text.add_new_category') ?></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span><?= lang('Sidebar.text.media_management') ?></span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_image_listing')); ?>"><?= lang('Sidebar.text.images') ?></a></li>
                    <li><a class="nav-link" href="#"><?= lang('Sidebar.text.videos') ?></a></li>
                    <li><a class="nav-link" href="#"><?= lang('Sidebar.text.files') ?></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span><?= lang('Sidebar.text.language_management') ?></span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_language_listing', null)) ?>"><?= lang('Sidebar.text.language_list') ?></a></li>
                    <li><a class="nav-link" href="<?= base_url(route_to('admin_language_create')); ?>"><?= lang('Sidebar.text.add_new_language') ?></a></li>
                    <li><a class="nav-link" href="#">Çeviri Yönetimi</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Örnek</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="index-0.html">Örnek 1</a></li>
                    <li><a class="nav-link" href="index.html">Örnek 1</a></li>
                </ul>
            </li>

            <li>
                <a class="nav-link" href="<?= base_url(route_to('admin_setting_home')); ?>">
                    <i class="fas fa-tools"></i><span>Ayarlar</span>
                </a>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> <?= lang('sidebar.text.doc'); ?>
            </a>
        </div>
    </aside>
</div>