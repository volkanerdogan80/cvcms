<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('Settings', 'webmaster_setting') ?></h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= cve_admin_lang_path('WebmasterSettings', 'google_settings') ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('WebmasterSettings', 'verify_key') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="googleVerify" value="<?= $setting->getValue('googleVerify'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('WebmasterSettings', 'tracking_code') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="googleAnalytics" value="<?= $setting->getValue('googleAnalytics'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= cve_admin_lang_path('WebmasterSettings', 'yandex_settings') ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('WebmasterSettings', 'verify_key') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="yandexVerify" value="<?= $setting->getValue('yandexVerify'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('WebmasterSettings', 'tracking_code') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="yandexMetrika" value="<?= $setting->getValue('yandexMetrika'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Özel Kod</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Kod</label>
                                <div class="col-sm-12 col-md-10">
                                    <textarea name="code" class="codeeditor"><?= $setting->getValue('code'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'save'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>