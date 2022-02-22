<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Sidebar', 'settings') ?></h1>
            </div>
            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'site_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'site_content') ?></p>
                                <a href="<?= base_url(route_to('admin_setting_site')); ?>" class="card-cta">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-power-off"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'system_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'system_content') ?></p>
                                <a href="<?= base_url(route_to('admin_setting_system')); ?>" class="card-cta">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-id-card-alt"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'contact_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'contact_content') ?></p>
                                <a href="<?= base_url(route_to('admin_setting_contact')); ?>" class="card-cta text-primary">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'mail_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'mail_content') ?></p>
                                <a href="<?= base_url(route_to('admin_setting_email')); ?>" class="card-cta">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'cache_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'cache_content') ?></p>
                                <a href="<?= base_url(route_to('admin_setting_cache')); ?>" class="card-cta">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'image_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'image_content') ?></p>
                                <a href="<?= base_url(route_to('admin_setting_image')); ?>" class="card-cta">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'sitemap_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'sitemap_content') ?></p>
                                <a href="<?= base_url(route_to('admin_setting_sitemap')); ?>" class="card-cta text-primary">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'webmaster_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'webmaster_content') ?></p>
                                <a href="<?= base_url(route_to('admin_setting_webmaster')); ?>" class="card-cta text-primary">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'firebase_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'firebase_content') ?></p>
                                <a href="<?= base_url(route_to('admin_setting_firebase')); ?>" class="card-cta text-primary">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-share-square"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'autoshare_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'autoshare_content') ?></p>
                                <a href="<?= base_url(route_to('admin_setting_autoshare')); ?>" class="card-cta text-primary">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'social_media_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'social_media_content') ?></p>
                                <a href="<?= base_url(route_to('admin_setting_social')); ?>" class="card-cta text-primary">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= cve_admin_lang('Settings', 'theme_setting') ?></h4>
                                <p><?= cve_admin_lang('Settings', 'theme_setting_content') ?></p>
                                <a href="<?= base_url(route_to('admin_theme_setting')); ?>" class="card-cta text-primary">
                                    <?= cve_admin_lang('Settings', 'change_btn') ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>