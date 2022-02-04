<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= lang('settings.text.title'); ?></h1>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= lang('settings.text.site_setting'); ?></h4>
                                <p><?= lang('settings.text.site_content'); ?></p>
                                <a href="<?= base_url(route_to('admin_setting_site')); ?>" class="card-cta"><?= lang('settings.text.change_btn'); ?> <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-power-off"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= lang('settings.text.system_setting'); ?></h4>
                                <p><?= lang('settings.text.system_content'); ?></p>
                                <a href="<?= base_url(route_to('admin_setting_system')); ?>" class="card-cta"><?= lang('settings.text.change_btn'); ?> <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= lang('settings.text.mail_setting'); ?></h4>
                                <p><?= lang('settings.text.mail_content'); ?></p>
                                <a href="<?= base_url(route_to('admin_setting_email')); ?>" class="card-cta"><?= lang('settings.text.change_btn'); ?> <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= lang('settings.text.cache_setting'); ?></h4>
                                <p><?= lang('settings.text.cache_content'); ?></p>
                                <a href="<?= base_url(route_to('admin_setting_cache')); ?>" class="card-cta"><?= lang('settings.text.change_btn'); ?> <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= lang('settings.text.image_setting'); ?></h4>
                                <p><?= lang('settings.text.image_content'); ?></p>
                                <a href="<?= base_url(route_to('admin_setting_image')); ?>" class="card-cta"><?= lang('settings.text.change_btn'); ?> <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= lang('settings.text.sitemap_setting'); ?></h4>
                                <p><?= lang('settings.text.sitemap_content'); ?></p>
                                <a href="features-setting-detail.html" class="card-cta text-primary"><?= lang('settings.text.change_btn'); ?> <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= lang('settings.text.webmaster_setting'); ?></h4>
                                <p><?= lang('settings.text.webmaster_content'); ?></p>
                                <a href="<?= base_url(route_to('admin_setting_webmaster')); ?>" class="card-cta text-primary"><?= lang('settings.text.change_btn'); ?> <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= lang('settings.text.firebase_setting'); ?></h4>
                                <p><?= lang('settings.text.firebase_content'); ?></p>
                                <a href="<?= base_url(route_to('admin_setting_firebase')); ?>" class="card-cta text-primary"><?= lang('settings.text.change_btn'); ?> <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-share-square"></i>
                            </div>
                            <div class="card-body">
                                <h4><?= lang('settings.text.autoshare_setting'); ?></h4>
                                <p><?= lang('settings.text.autoshare_content'); ?></p>
                                <a href="<?= base_url(route_to('admin_setting_autoshare')); ?>" class="card-cta text-primary"><?= lang('settings.text.change_btn'); ?> <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>