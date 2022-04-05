<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?= cve_admin_lang('WebmasterSettings', 'google_settings'); ?></h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('WebmasterSettings', 'verify_key'); ?></label>
                    <div class="col-sm-12 col-md-8">
                        <input name="setting[googleVerify]" value="<?= cve_component_setting('googleVerify'); ?>" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('WebmasterSettings', 'tracking_code'); ?></label>
                    <div class="col-sm-12 col-md-8">
                        <input name="setting[googleAnalytics]" value="<?= cve_component_setting('googleAnalytics'); ?>" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4><?= cve_admin_lang('WebmasterSettings', 'yandex_settings'); ?></h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('WebmasterSettings', 'verify_key'); ?></label>
                    <div class="col-sm-12 col-md-8">
                        <input name="setting[yandexVerify]" value="<?= cve_component_setting('yandexVerify'); ?>" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('WebmasterSettings', 'tracking_code'); ?></label>
                    <div class="col-sm-12 col-md-8">
                        <input name="setting[yandexMetrika]" value="<?= cve_component_setting('yandexMetrika'); ?>" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'save'); ?></button>
    </div>
</div>

