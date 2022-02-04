<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= lang('settings.text.cache_setting'); ?></h1>

                <div class="section-header-breadcrumb">
                    <a href="<?= base_url(route_to('admin_cache_clean')) ?>" class="btn btn-primary"><?= lang('General.text.cache_clean')?></a>
                </div>

            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.html'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('html') ? 'checked' : ''; ?> type="radio" name="html" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.active'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('html') ? 'checked' : ''; ?> type="radio" name="html" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.passive'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.raw'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('raw') ? 'checked' : ''; ?> type="radio" name="raw" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.active'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('raw') ? 'checked' : ''; ?> type="radio" name="raw" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.passive'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.cache_times'); ?></label>
                                <div class="col-sm-12 col-md-4">
                                    <label class="col-form-label"><?= lang('input.text.html'); ?> <?= lang('input.text.time'); ?></label>
                                    <input name="html_time" value="<?= $setting->getValue('html_time'); ?>" type="text" class="form-control" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label class="col-form-label"><?= lang('input.text.raw'); ?> <?= lang('input.text.time'); ?></label>
                                    <input name="raw_time" value="<?= $setting->getValue('raw_time'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('settings.text.system'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('handler') == 'file' ? 'checked' : ''; ?> type="radio" name="handler" value="file" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.file'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('handler') == 'memcached' ? 'checked' : ''; ?> type="radio" name="handler" value="memcached" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('settings.text.memcache'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('handler') == 'predis' ? 'checked' : ''; ?> type="radio" name="handler" value="predis" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('settings.text.predis'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('handler') == 'redis' ? 'checked' : ''; ?> type="radio" name="handler" value="redis" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('settings.text.redis'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('handler') == 'wincache' ? 'checked' : ''; ?> type="radio" name="handler" value="wincache" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('settings.text.wincache'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.prefix'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="prefix" value="<?= $setting->getValue('prefix'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Redis Ayarları</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.host'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="redis[host]" value="<?= $setting->getValue('redis')->host; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.port'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="redis[port]" value="<?= $setting->getValue('redis')->port; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.password'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="redis[password]" value="<?= $setting->getValue('redis')->password; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.time_out'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="redis[timeout]" value="<?= $setting->getValue('redis')->timeout; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.database'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="redis[database]" value="<?= $setting->getValue('redis')->database; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>MemCache Ayarları</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.host'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="memcached[host]" value="<?= $setting->getValue('memcached')->host; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.port'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="memcached[port]" value="<?= $setting->getValue('memcached')->port; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.weight'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="memcached[weight]" value="<?= $setting->getValue('memcached')->weight; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.raw'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('memcached')->raw ? 'checked' : ''; ?> type="radio" name="memcached[raw]" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.active'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('memcached')->raw ? 'checked' : ''; ?> type="radio" name="memcached[raw]" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.passive'); ?></span>
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