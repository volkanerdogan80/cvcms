<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('Settings', 'cache_setting') ?></h1>

                <div class="section-header-breadcrumb">
                    <a href="<?= base_url(route_to('admin_cache_clean')) ?>" class="btn btn-primary"><i class="fas fa-tachometer-alt"></i> <?= cve_admin_lang_path('CacheSettings', 'clear_cache') ?></a>
                </div>

            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'html') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('html') ? 'checked' : ''; ?> type="radio" name="html" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'active') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('html') ? 'checked' : ''; ?> type="radio" name="html" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'passive') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'raw') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('raw') ? 'checked' : ''; ?> type="radio" name="raw" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'active') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('raw') ? 'checked' : ''; ?> type="radio" name="raw" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'passive') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'cache_period') ?></label>
                                <div class="col-sm-12 col-md-4">
                                    <label class="col-form-label"><?= cve_admin_lang_path('CacheSettings', 'html') ?> <?= cve_admin_lang_path('CacheSettings', 'period') ?></label>
                                    <input name="html_time" value="<?= $setting->getValue('html_time'); ?>" type="text" class="form-control" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label class="col-form-label"><?= cve_admin_lang_path('CacheSettings', 'raw') ?> <?= cve_admin_lang_path('CacheSettings', 'period') ?></label>
                                    <input name="raw_time" value="<?= $setting->getValue('raw_time'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'system') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('handler') == 'file' ? 'checked' : ''; ?> type="radio" name="handler" value="file" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('CacheSettings', 'file') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('handler') == 'memcached' ? 'checked' : ''; ?> type="radio" name="handler" value="memcached" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('CacheSettings', 'memcache') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('handler') == 'predis' ? 'checked' : ''; ?> type="radio" name="handler" value="predis" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('CacheSettings', 'predis') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('handler') == 'redis' ? 'checked' : ''; ?> type="radio" name="handler" value="redis" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('CacheSettings', 'redis') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('handler') == 'wincache' ? 'checked' : ''; ?> type="radio" name="handler" value="wincache" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('CacheSettings', 'wincache') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'prefix') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="prefix" value="<?= $setting->getValue('prefix'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= cve_admin_lang_path('CacheSettings', 'redis_settings') ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'host') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="redis[host]" value="<?= $setting->getValue('redis')->host; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'port') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="redis[port]" value="<?= $setting->getValue('redis')->port; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'password') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="redis[password]" value="<?= $setting->getValue('redis')->password; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'timeout') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="redis[timeout]" value="<?= $setting->getValue('redis')->timeout; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'database') ?>></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="redis[database]" value="<?= $setting->getValue('redis')->database; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= cve_admin_lang_path('CacheSettings', 'memcache_settings') ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'host') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="memcached[host]" value="<?= $setting->getValue('memcached')->host; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'port') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="memcached[port]" value="<?= $setting->getValue('memcached')->port; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'weight') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="memcached[weight]" value="<?= $setting->getValue('memcached')->weight; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('CacheSettings', 'raw') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('memcached')->raw ? 'checked' : ''; ?> type="radio" name="memcached[raw]" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'active') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('memcached')->raw ? 'checked' : ''; ?> type="radio" name="memcached[raw]" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'passive') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'update') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>