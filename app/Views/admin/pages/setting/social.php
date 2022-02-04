<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('Settings', 'social_media_setting') ?></h1>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card">
                        <div class="card-body">
                            <?php foreach (config('social') as $key => $value): ?>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= ucfirst($key); ?></label>
                                    <div class="col-sm-12 col-md-8">
                                        <input name="social[<?= $key; ?>]" value="<?= $setting->getValue($key); ?>" type="text" class="form-control">
                                    </div>
                                    <label style="padding-top: 0px" class="col-form-label text-md-left col-12 col-md-2 col-lg-2">
                                        <a href="<?= $setting->getValue($key); ?>" target="_blank" class="btn btn-icon icon-left">
                                            <img width="25" src="<?= base_url(PUBLIC_ADMIN_IMAGE_PATH . 'social/' . $key . '.svg'); ?>" alt="<?= ucfirst($key); ?>">
                                        </a>
                                    </label>
                                </div>
                            <?php endforeach; ?>
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