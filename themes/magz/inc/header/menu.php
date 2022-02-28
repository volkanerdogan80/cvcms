<nav class="menu">
    <div class="container">
        <div class="brand">
            <a href="<?= cve_route('homepage') ?>">
                <img src="<?= cve_theme_public(''); ?>/images/logo.png" alt="Magz Logo">
            </a>
        </div>
        <div class="mobile-toggle">
            <a href="#" data-toggle="menu" data-target="#menu-list"><i class="ion-navicon-round"></i></a>
        </div>
        <div class="mobile-toggle">
            <a href="#" data-toggle="sidebar" data-target="#sidebar"><i class="ion-ios-arrow-left"></i></a>
        </div>
        <div id="menu-list">
            <ul class="nav-list" style="font-size: 18px;">
                <?= cve_menu('ust-menu', [
                    'menu_open' => '',
                    'menu_item' => '<li><a href="%s">%s</a></li>',
                    'menu_close' => '',
                    'child_open' => '<li class="dropdown magz-dropdown">',
                    'child_first_item' => '<a href="%s">%s <i class="ion-ios-arrow-right"></i></a>',
                    'child_open_item' => '<ul class="dropdown-menu">',
                    'child_item' => '<li><a href="%s">%s</a></li>',
                    'child_close_item' => '</ul>',
                    'child_close' => '</li>',
                    'deep_open' => '<li class="dropdown magz-dropdown">',
                    'deep_first_item' => '<a href="%s">%s <i class="ion-ios-arrow-right"></i></a>',
                    'deep_open_item' => '<ul class="dropdown-menu">',
                    'deep_item' => '<li><a href="%s">%s</a></li>',
                    'deep_close_item' => '</ul>',
                    'deep_close' => '</li>',
                ])
                ?>
                <?php if(is_logged_in()): ?>
                    <li class="dropdown magz-dropdown">
                        <a href="#">Hesabım <i class="ion-ios-arrow-right"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= cve_post_link(config('theme')->favorite) ?>"><i class="icon ion-heart"></i> Favorilerim</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= cve_route('logout') ?>"><i class="icon ion-log-out"></i> Logout</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="nav-list" style="float: right">
                <li class="dropdown magz-dropdown">
                    <a href="#">
                        <i class="cve-lang-dropdown-flag cve-lang-dropdown-flag-svg"
                           style="background: url('<?= cve_language(true)->getFlag(); ?>');background-size: cover;background-position: center center;">
                            <div id="germany"></div>
                        </i>
                        <?= cve_language(true)->getTitle(); ?>
                        <i class="ion-ios-arrow-right"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach (cve_language() as $lang): ?>
                            <li>
                                <a href="<?= cve_route('language_change', $lang->getCode()); ?>"
                                   class="uk-link-reset">
                                    <i class="cve-lang-dropdown-flag cve-lang-dropdown-flag-svg"
                                       style="float:initial; background: url('<?= $lang->getFlag(); ?>');background-size: cover;background-position: center center;">
                                        <div id="germany"></div>
                                    </i>
                                    <span class="active"><?= $lang->getTitle(); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
