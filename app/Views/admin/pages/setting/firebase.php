<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Settings', 'firebase_setting') ?></h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('General', 'status') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('status') ? 'checked' : ''; ?> type="radio" name="status" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'active') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('status') ? 'checked' : ''; ?> type="radio" name="status" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'passive') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('FirebaseSettings', 'server_key') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="serverKey" value="<?= $setting->getValue('serverKey'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('FirebaseSettings', 'api_key') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="apiKey" value="<?= $setting->getValue('apiKey'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('FirebaseSettings', 'auth_domain') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="authDomain" value="<?= $setting->getValue('authDomain'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('FirebaseSettings', 'database_url') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="databaseURL" value="<?= $setting->getValue('databaseURL'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('FirebaseSettings', 'project_id') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="projectId" value="<?= $setting->getValue('projectId'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('FirebaseSettings', 'storage_bucket') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="storageBucket" value="<?= $setting->getValue('storageBucket'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('FirebaseSettings', 'messaging_sender_id') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="messagingSenderId" value="<?= $setting->getValue('messagingSenderId'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('FirebaseSettings', 'app_id') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="appId" value="<?= $setting->getValue('appId'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('FirebaseSettings', 'measurement_id') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="measurementId" value="<?= $setting->getValue('measurementId'); ?>" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'update') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>