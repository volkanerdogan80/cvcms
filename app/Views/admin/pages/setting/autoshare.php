<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Settings', 'autoshare_setting') ?></h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>
            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= cve_admin_lang('AutoShare', 'twitter_setting') ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('General', 'status') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('twitter')->status ? 'checked' : ''; ?> type="radio" name="twitter[status]" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'active') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('twitter')->status ? 'checked' : ''; ?> type="radio" name="twitter[status]" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'passive') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'api_key') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="twitter[apiKey]" value="<?= $setting->getValue('twitter')->apiKey; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'api_secret_key') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="twitter[apiKeySecret]" value="<?= $setting->getValue('twitter')->apiKeySecret; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'access_token') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="twitter[accessToken]" value="<?= $setting->getValue('twitter')->accessToken; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'access_token_secret') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="twitter[accessTokenSecret]" value="<?= $setting->getValue('twitter')->accessTokenSecret; ?>" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= cve_admin_lang('AutoShare', 'facebook_setting') ?></h4>
                            <div class="card-header-action">
                                <?php if (is_null($facebook_profile)): ?>
                                    <a href="<?= $facebook_login ?>" class="btn btn-primary"><?= cve_admin_lang('AutoShare', 'connect') ?></a>
                                <?php else: ?>
                                    <a href="#" class="btn btn-success"><?= $facebook_profile->name ?></a>
                                <?php endif; ?>
                                <a href="<?= base_url(route_to('admin_facebook_test')); ?>" class="btn btn-danger"><?= cve_admin_lang('AutoShare', 'test') ?></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('General', 'status') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('facebook')->status ? 'checked' : ''; ?> type="radio" name="facebook[status]" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'active') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('facebook')->status ? 'checked' : ''; ?> type="radio" name="facebook[status]" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'passive') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'app_id') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[appId]" value="<?= $setting->getValue('facebook')->appId; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'app_secret') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[appSecret]" value="<?= $setting->getValue('facebook')->appSecret; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'page_id') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[pageId]" value="<?= $facebook_profile ? $facebook_profile->page_id : ''; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'permissions') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[permissions]" value="<?= config('autoshare')->facebook['permissions']; ?>" type="text" class="form-control inputtags">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'access_token') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[accessToken]" value="<?= session('facebookAccessToken') ? session('facebookAccessToken') : $setting->getValue('facebook')->accessToken; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"></label><?= cve_admin_lang('AutoShare', 'callback_url') ?>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[callbackURL]" value="<?= base_url(route_to('admin_facebook_callback'))?>" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= cve_admin_lang('AutoShare', 'linkedin_setting') ?></h4></label>
                            <div class="card-header-action">
                                <?php if(is_null($linkedin_profile)): ?>
                                    <a target="_blank" href="<?= $linkedin_login ?>" class="btn btn-primary"><?= cve_admin_lang('AutoShare', 'connect') ?></a></label>
                                <?php else: ?>
                                    <a href="#" class="btn btn-success"><?= $linkedin_profile->name ?></a>
                                <?php endif; ?>
                                <a href="<?= base_url(route_to('admin_linkedin_test')); ?>" class="btn btn-danger"><?= cve_admin_lang('AutoShare', 'test') ?></a></label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('General', 'status') ?></label></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('linkedin')->status ? 'checked' : ''; ?> type="radio" name="linkedin[status]" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'active') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('linkedin')->status ? 'checked' : ''; ?> type="radio" name="linkedin[status]" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'passive') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'app_id') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[appId]" value="<?= $setting->getValue('linkedin')->appId; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'app_secret') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[appSecret]" value="<?= $setting->getValue('linkedin')->appSecret; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'account_id') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[accountId]" value="<?= $linkedin_profile ? $linkedin_profile->accountId : '' ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'permissions') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[scopes]" value="<?= config('autoshare')->linkedin['scopes'] ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'access_token') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[accessToken]" value="<?= session('linkedinAccessToken') ? session('linkedinAccessToken') : $setting->getValue('linkedin')->accessToken; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('AutoShare', 'callback_url') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[callbackURL]" value="<?= base_url(route_to('admin_linkedin_callback'))?>" type="text" class="form-control">
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

<?php $this->section('script'); ?>

<script>
    $(".inputtags").tagsinput('items');
</script>

<?php $this->endSection(); ?>
