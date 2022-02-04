<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('Settings', 'image_setting') ?></h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('ImageSettings', 'library') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('defaultHandler') == 'gd' ? 'checked' : ''; ?> type="radio" name="defaultHandler" value="gd" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('ImageSettings', 'gd') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('defaultHandler') == 'imagick' ? 'checked' : ''; ?> type="radio" name="defaultHandler" value="imagick" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('ImageSettings', 'imagick') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('ImageSettings', 'delete_type') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('delete') == 'all' ? 'checked' : ''; ?> type="radio" name="delete" value="all" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('ImageSettings', 'all') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('delete') == 'original' ? 'checked' : ''; ?> type="radio" name="delete" value="original" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('ImageSettings', 'original') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('delete') == 'db' ? 'checked' : ''; ?> type="radio" name="delete" value="db" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('ImageSettings', 'database') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('ImageSettings', 'compression') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="compressor" value="<?= $setting->getValue('compressor'); ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('ImageSettings', 'thumbnail_size') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="thumbnail" value="<?= $setting->getValue('thumbnail'); ?>" type="text" class="form-control inputtags">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= cve_admin_lang_path('ImageSettings', 'watermark_settings') ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('General', 'status') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('watermark')->status ? 'checked' : ''; ?> type="radio" name="watermark[status]" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'active') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('watermark')->status ? 'checked' : ''; ?> type="radio" name="watermark[status]" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'passive') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('ImageSettings', 'text') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="watermark[text]" value="<?= $setting->getValue('watermark')->text; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('ImageSettings', 'text_color') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="watermark[color]" value="<?= $setting->getValue('watermark')->color; ?>" type="text" class="form-control colorpickerinput" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('ImageSettings', 'text_size') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="watermark[fontSize]" value="<?= $setting->getValue('watermark')->fontSize; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('ImageSettings', 'opacity') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="watermark[opacity]" value="<?= $setting->getValue('watermark')->opacity; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('ImageSettings', 'shading') ?>></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="watermark[withShadow]" value="<?= $setting->getValue('watermark')->withShadow; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('ImageSettings', 'vAlign') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('watermark')->vAlign == 'top' ? 'checked' : ''; ?> type="radio" name="watermark[vAlign]" value="top" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('ImageSettings', 'top') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('watermark')->vAlign ==  'middle' ? 'checked' : ''; ?> type="radio" name="watermark[vAlign]" value="middle" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('ImageSettings', 'middle') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('watermark')->vAlign == 'bottom' ? 'checked' : ''; ?> type="radio" name="watermark[vAlign]" value="bottom" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('ImageSettings', 'bottom') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.hAlign'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('watermark')->hAlign == 'left' ? 'checked' : ''; ?> type="radio" name="watermark[hAlign]" value="left" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('ImageSettings', 'left') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('watermark')->hAlign == 'center' ? 'checked' : ''; ?> type="radio" name="watermark[hAlign]" value="center" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('ImageSettings', 'center') ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('watermark')->hAlign == 'right' ? 'checked' : ''; ?> type="radio" name="watermark[hAlign]" value="right" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= cve_admin_lang_path('ImageSettings', 'right') ?></span>
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


<?php $this->section('script'); ?>

<script>
    $(".inputtags").tagsinput('items');
</script>
<script>
    $(".colorpickerinput").colorpicker({
        format: 'hex',
        component: '.input-group-append',
    });
</script>

<?php $this->endSection(); ?>