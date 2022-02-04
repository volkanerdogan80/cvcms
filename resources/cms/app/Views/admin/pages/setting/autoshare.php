<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= lang('settings.text.autoshare_setting'); ?></h1>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= lang('Settings.text.twitter_setting')?></h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Durum</label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('twitter')->status ? 'checked' : ''; ?> type="radio" name="twitter[status]" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.active'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('twitter')->status ? 'checked' : ''; ?> type="radio" name="twitter[status]" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.passive'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.api_key'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="twitter[apiKey]" value="<?= $setting->getValue('twitter')->apiKey; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.api_secret_key'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="twitter[apiKeySecret]" value="<?= $setting->getValue('twitter')->apiKeySecret; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.access_token'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="twitter[accessToken]" value="<?= $setting->getValue('twitter')->accessToken; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.access_token_secret'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="twitter[accessTokenSecret]" value="<?= $setting->getValue('twitter')->accessTokenSecret; ?>" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= lang('Settings.text.facebook_setting')?></h4>
                            <div class="card-header-action">
                                <?php if (true): ?>
                                    <a href="<?= $facebook_login; ?>" class="btn btn-primary">Bağlan</a>
                                <?php else: ?>
                                    <a href="#" class="btn btn-success"><?= $facebook_profile->name; ?></a>
                                <?php endif; ?>
                                <a href="#" class="btn btn-danger"><?= lang('settings.text.testing'); ?></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.status'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('facebook')->status ? 'checked' : ''; ?> type="radio" name="facebook[status]" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.active'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('facebook')->status ? 'checked' : ''; ?> type="radio" name="facebook[status]" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.passive'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.app_id'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[appId]" value="<?= $setting->getValue('facebook')->appId; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.app_secret'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[appSecret]" value="<?= $setting->getValue('facebook')->appSecret; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.page_id'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[pageId]" value="<?= $facebook_profile ? $facebook_profile->page_id : ''; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.permissions'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[permissions]" value="<?= config('autoshare')->facebook['permissions']; ?>" type="text" class="form-control inputtags">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.access_token'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[accessToken]" value="<?= session('facebookAccessToken') ? session('facebookAccessToken') : $setting->getValue('facebook')->accessToken; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.callback_url'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="facebook[callbackURL]" value="<?= base_url(route_to('admin_facebook_callback'))?>" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= lang('Settings.text.linkedin_setting')?></h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success">Volkan Erdoğan</a>
                                <a href="#" class="btn btn-danger"><?= lang('settings.text.testing'); ?></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.status'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('linkedin')->status ? 'checked' : ''; ?> type="radio" name="linkedin[status]" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.active'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('linkedin')->status ? 'checked' : ''; ?> type="radio" name="linkedin[status]" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.passive'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.app_id'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[appId]" value="<?= $setting->getValue('linkedin')->appId; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.app_secret'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[appSecret]" value="<?= $setting->getValue('linkedin')->appSecret; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.account_id'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[accountId]" value="<?= $setting->getValue('linkedin')->accountId; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.permissions'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[scopes]" value="<?= $setting->getValue('linkedin')->scopes; ?>" type="text" class="form-control inputtags">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.access_token'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[accessToken]" value="" disabled type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.callback_url'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="linkedin[callbackURL]" value="<?= base_url(route_to('admin_setting_autoshare'))?>" disabled type="text" class="form-control">
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

<?php $this->section('script'); ?>

<script>
    $(".inputtags").tagsinput('items');
</script>

<?php $this->endSection(); ?>
