<div class="firstbar">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="brand">
                    <a href="<?= cve_route('homepage') ?>">
                        <img src="<?= cve_site_header_logo(); ?>" alt="<?= cve_title() ?>">
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <form class="search" autocomplete="off" action="<?= cve_route('search') ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Type something here">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="ion-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="help-block">
                        <div>Popular:</div>
                        <ul>
                            <!-- TODO: Çeviri videosunda burayı dinamikleştirmiş. Çevirileri yaparken bakılacak  -->
                            <li><a href="<?= cve_keyword_link('HTML5') ?>">HTML5</a></li>
                            <li><a href="<?= cve_keyword_link('CSS3') ?>">CSS3</a></li>
                            <li><a href="<?= cve_keyword_link('Bootstrap') ?>">Bootstrap 3</a></li>
                            <li><a href="<?= cve_keyword_link('jQuery') ?>">jQuery</a></li>
                            <li><a href="<?= cve_keyword_link('AnguarJS') ?>">AnguarJS</a></li>
                        </ul>
                    </div>
                </form>
            </div>
            <?php if(!is_logged_in()): ?>
                <div class="col-md-3 col-sm-12 text-right">
                    <ul class="nav-icons">
                        <li>
                            <a href="<?= cve_post_link(config('theme')->register) ?>">
                                <i class="ion-person-add"></i>
                                <div>Register</div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= cve_post_link(config('theme')->login) ?>">
                                <i class="ion-person"></i>
                                <div>Login</div>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="col-md-3 col-sm-12 text-right">
                    <ul class="nav-icons">
                        <?php if(cve_permit_control('admin_login')): ?>
                            <li>
                                <a href="<?= cve_route('admin_dashboard') ?>">
                                    <i class="ion-android-desktop"></i><div>Admin Paneli</div>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?= cve_route('logout') ?>">
                                <i class="ion-android-exit"></i>
                                <div>Logout</div>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
