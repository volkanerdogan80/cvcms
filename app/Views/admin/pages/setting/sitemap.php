<?php $this->extend('admin/layout/main'); ?>
<?php $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= cve_admin_lang_path('Settings', 'sitemap_setting') ?></h1>
        </div>

        <?= $this->include('admin/layout/partials/errors'); ?>

        <div class="section-body">
            <form action="<?php current_url(); ?>" method="post">
                <?= csrf_field(); ?>
                <?php foreach (config('system')->modules as $key => $module): ?>
                    <?php if($module): ?>
                        <div class="card">
                            <div class="card-header">
                                <h4><?= cve_admin_lang_path('Modules', $key) ?> <?= cve_admin_lang_path('SitemapSettings', 'sitemap') ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('General', 'status') ?></label>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input <?= !is_null($setting) && $setting->getValue($key, true)['status'] ? 'checked' : ''; ?> type="radio" name="<?= $key ?>[status]" value="1" class="selectgroup-input">
                                                <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'active') ?></span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input <?= !is_null($setting) && !$setting->getValue($key, true)['status'] ? 'checked' : ''; ?> type="radio" name="<?= $key ?>[status]" value="0" class="selectgroup-input">
                                                <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'passive') ?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('SitemapSettings', 'priority') ?></label>
                                    <div class="col-sm-12 col-md-8">
                                        <select name="<?= $key ?>[priority]" class="form-control select2">
                                            <?php foreach (range(0,1, 0.1) as $range): ?>
                                                <option <?= !is_null($setting) && $setting->getValue($key, true)['priority'] == $range . "" ? 'selected' : ''; ?> value="<?= $range ?>"><?= $range ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('SitemapSettings', 'changeFreq') ?></label>
                                    <div class="col-sm-12 col-md-8">
                                        <select name="<?= $key ?>[changefreq]" class="form-control select2">
                                            <option <?= !is_null($setting) && $setting->getValue($key, true)['changefreq'] == 'always' ? 'selected' : ''; ?> value="always"><?= cve_admin_lang_path('SitemapSettings', 'always') ?></option>
                                            <option <?= !is_null($setting) && $setting->getValue($key, true)['changefreq'] == 'hourly' ? 'selected' : ''; ?> value="hourly"><?= cve_admin_lang_path('SitemapSettings', 'hourly') ?></option>
                                            <option <?= !is_null($setting) && $setting->getValue($key, true)['changefreq'] == 'daily' ? 'selected' : ''; ?> value="daily"><?= cve_admin_lang_path('SitemapSettings', 'daily') ?></option>
                                            <option <?= !is_null($setting) && $setting->getValue($key, true)['changefreq'] == 'weekly' ? 'selected' : ''; ?> value="weekly"><?= cve_admin_lang_path('SitemapSettings', 'weekly') ?></option>
                                            <option <?= !is_null($setting) && $setting->getValue($key, true)['changefreq'] == 'monthly' ? 'selected' : ''; ?> value="monthly"><?= cve_admin_lang_path('SitemapSettings', 'monthly') ?></option>
                                            <option <?= !is_null($setting) && $setting->getValue($key, true)['changefreq'] == 'yearly' ? 'selected' : ''; ?> value="yearly"><?= cve_admin_lang_path('SitemapSettings', 'yearly') ?></option>
                                            <option <?= !is_null($setting) && $setting->getValue($key, true)['changefreq'] == 'never' ? 'selected' : ''; ?> value="never"><?= cve_admin_lang_path('SitemapSettings', 'never') ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="card">
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'update') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<?php $this->endSection(); ?>
