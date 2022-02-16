<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('Settings', 'sitemap_setting'); ?></h1>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">

                <div class="card">
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">
                                <?= cve_admin_lang_path('SitemapSettings', 'access_route'); ?>
                            </label>
                            <div class="col-sm-12 col-md-8">
                                <input value="<?= base_url(route_to('sitemap.listing')); ?>" name="sur_name" type="text" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="<?php current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
                    <?php foreach (cve_module_list() as $module): ?>
                        <div class="card">
                            <div class="card-header">
                                <h4><?= cve_admin_lang_path('Modules', strtolower($module)) ?> <?= cve_admin_lang_path('SitemapSettings', 'sitemap'); ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('Inputs', 'status'); ?></label>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input <?= isset($setting->getValue($module, true)['status']) && $setting->getValue($module, true)['status'] ? 'checked' : ''; ?> type="radio" name="<?= $module ?>[status]" value="1" class="selectgroup-input">
                                                <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'active'); ?></span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input <?= isset($setting->getValue($module, true)['status']) &&  !$setting->getValue($module, true)['status'] ? 'checked' : ''; ?> type="radio" name="<?= $module ?>[status]" value="0" class="selectgroup-input">
                                                <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'passive'); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('SitemapSettings', 'priority'); ?></label>
                                    <div class="col-sm-12 col-md-8">
                                        <select name="<?= $module ?>[priority]" class="form-control select2">
                                            <?php foreach (range(0,1, 0.1) as $range): ?>
                                                <option <?= isset($setting->getValue($module, true)['priority']) && $setting->getValue($module, true)['priority'] == $range . "" ? 'selected' : ''; ?> value="<?= $range ?>"><?= $range ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('SitemapSettings', 'changeFreq'); ?></label>
                                    <div class="col-sm-12 col-md-8">
                                        <select name="<?= $module ?>[changefreq]" class="form-control select2">
                                            <option <?= isset($setting->getValue($module, true)['changefreq']) && $setting->getValue($module, true)['changefreq'] == 'always' ? 'selected' : ''; ?> value="always">
                                                <?= cve_admin_lang_path('SitemapSettings', 'always'); ?>
                                            </option>
                                            <option <?= isset($setting->getValue($module, true)['changefreq']) && $setting->getValue($module, true)['changefreq'] == 'hourly' ? 'selected' : ''; ?> value="hourly">
                                                <?= cve_admin_lang_path('SitemapSettings', 'hourly'); ?>
                                            </option>
                                            <option <?= isset($setting->getValue($module, true)['changefreq']) && $setting->getValue($module, true)['changefreq'] == 'daily' ? 'selected' : ''; ?> value="daily">
                                                <?= cve_admin_lang_path('SitemapSettings', 'daily'); ?>
                                            </option>
                                            <option <?= isset($setting->getValue($module, true)['changefreq']) && $setting->getValue($module, true)['changefreq'] == 'weekly' ? 'selected' : ''; ?> value="weekly">
                                                <?= cve_admin_lang_path('SitemapSettings', 'weekly'); ?>
                                            </option>
                                            <option <?= isset($setting->getValue($module, true)['changefreq']) && $setting->getValue($module, true)['changefreq'] == 'monthly' ? 'selected' : ''; ?> value="monthly">
                                                <?= cve_admin_lang_path('SitemapSettings', 'monthly'); ?>
                                            </option>
                                            <option <?= isset($setting->getValue($module, true)['changefreq']) && $setting->getValue($module, true)['changefreq'] == 'yearly' ? 'selected' : ''; ?> value="yearly">
                                                <?= cve_admin_lang_path('SitemapSettings', 'yearly'); ?>
                                            </option>
                                            <option <?= isset($setting->getValue($module, true)['changefreq']) && $setting->getValue($module, true)['changefreq'] == 'never' ? 'selected' : ''; ?> value="never">
                                                <?= cve_admin_lang_path('SitemapSettings', 'never'); ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="card">
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'save'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>
