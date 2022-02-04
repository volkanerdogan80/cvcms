<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= lang('settings.text.mail_setting'); ?></h1>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.protocol'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('protocol') == 'mail' ? 'checked' : ''; ?> type="radio" name="protocol" value="mail" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('settings.text.mail'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('protocol') == 'sendmail' ? 'checked' : ''; ?> type="radio" name="protocol" value="sendmail" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('settings.text.sendmail'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('protocol') == 'smtp' ? 'checked' : ''; ?> type="radio" name="protocol" value="smtp" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('settings.text.smtp'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.from_email'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="fromEmail" value="<?= $setting->getValue('fromEmail'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.from_name'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="fromName" value="<?= $setting->getValue('fromName'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.smtp_host'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="SMTPHost" value="<?= $setting->getValue('SMTPHost'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.smtp_user'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="SMTPUser" value="<?= $setting->getValue('SMTPUser'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.smtp_password'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="SMTPPass" value="<?= $setting->getValue('SMTPPass'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.smtp_port'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="SMTPPort" value="<?= $setting->getValue('SMTPPort'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.smtp_crypto'); ?></label>
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
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.mail_type'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('mailType') == 'html' ? 'checked' : ''; ?> type="radio" name="mailType" value="html" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.html'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('mailType') == 'text' ? 'checked' : ''; ?> type="radio" name="mailType" value="text" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.text'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-block btn-lg"><?= lang('settings.text.save_btn'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>