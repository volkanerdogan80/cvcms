<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Settings', 'mail_setting') ?></h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('EmailSettings', 'protocol') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('protocol') == 'mail' ? 'checked' : ''; ?> type="radio" name="protocol" value="mail" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('EmailSettings', 'mail') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('protocol') == 'sendmail' ? 'checked' : ''; ?> type="radio" name="protocol" value="sendmail" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('EmailSettings', 'sendmail') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('protocol') == 'smtp' ? 'checked' : ''; ?> type="radio" name="protocol" value="smtp" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('EmailSettings', 'smtp') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('EmailSettings', 'from_email') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="fromEmail" value="<?= $setting->getValue('fromEmail'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('EmailSettings', 'from_name') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="fromName" value="<?= $setting->getValue('fromName'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('EmailSettings', 'smtp_host') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="SMTPHost" value="<?= $setting->getValue('SMTPHost'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('EmailSettings', 'smtp_user') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="SMTPUser" value="<?= $setting->getValue('SMTPUser'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('EmailSettings', 'smtp_password') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="SMTPPass" value="<?= $setting->getValue('SMTPPass'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('EmailSettings', 'smtp_port') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="SMTPPort" value="<?= $setting->getValue('SMTPPort'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('EmailSettings', 'smtp_crypto') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('SMTPCrypto') == 'tls' ? 'checked' : ''; ?> type="radio" name="SMTPCrypto" value="tls" class="selectgroup-input">
                                            <span class="selectgroup-button">TLS</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('SMTPCrypto') == 'ssl' ? 'checked' : ''; ?> type="radio" name="SMTPCrypto" value="ssl" class="selectgroup-input">
                                            <span class="selectgroup-button">SSL</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('EmailSettings', 'mail_type') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('mailType') == 'html' ? 'checked' : ''; ?> type="radio" name="mailType" value="html" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('EmailSettings', 'html') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('mailType') == 'text' ? 'checked' : ''; ?> type="radio" name="mailType" value="text" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('EmailSettings', 'text') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= cve_admin_lang('EmailSettings', 'theme_settings') ?></h4>
                        </div>
                        <div class="card-body">
                            <?php foreach (config('email')->template as $tkey => $tvalue): ?>
                                <?php $isSelected = config('email')->template[$tkey]; ?>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('EmailSettings', $tkey); ?></label>
                                    <div class="col-sm-12 col-md-8">
                                        <select name="template[<?= $tkey; ?>]" class="form-control select2">
                                            <?php foreach (cve_email_template() as $key => $value): ?>
                                                <option <?= $isSelected == $key ? 'selected': ''; ?> value="<?= $key; ?>"><?= $value['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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