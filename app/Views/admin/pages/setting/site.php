<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('Settings', 'site_setting') ?></h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <?php foreach (cve_language() as $key => $lang): ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?= $key == 0 ? 'active' : ''; ?> "
                                               id="<?= $lang->getCode(); ?>-tab"
                                               data-toggle="tab"
                                               href="#<?= $lang->getCode(); ?>"
                                               role="tab"
                                               aria-controls="<?= $lang->getCode(); ?>"
                                               aria-selected="true">
                                                <img width="20" src="<?= $lang->getFlag(); ?>">
                                                <?= $lang->getTitle(); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <form action="<?= current_url(); ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <?php foreach (cve_language() as $key => $lang): ?>
                                        <!-- TODO: cve_lang_data() yeni dil eklenince sorun çıkarıyor. Site setting sayfası hata veriyor -->
                                            <div class="tab-pane fade <?= $key == 0 ? 'show active' : ''; ?>" id="<?= $lang->getCode(); ?>" role="tabpanel" aria-labelledby="<?= $lang->getCode(); ?>-tab">
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= $lang->getTitle(); ?> <?= cve_admin_lang_path('SiteSettings', 'site_title') ?></label>
                                                    <div class="col-sm-12 col-md-8">
                                                        <input name="title[<?= $lang->getCode(); ?>]" value="<?= cve_lang_data($setting->getValue('title'), $lang->getCode()); ?>" type="text" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= $lang->getTitle(); ?> <?= cve_admin_lang_path('SiteSettings', 'site_description') ?></label>
                                                    <div class="col-sm-12 col-md-8">
                                                        <textarea name="description[<?= $lang->getCode(); ?>]" style="height: 150px" type="text" class="form-control" required><?= cve_lang_data($setting->getValue('description'), $lang->getCode()); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= $lang->getTitle(); ?> <?= cve_admin_lang_path('SiteSettings', 'site_keywords') ?></label>
                                                    <div class="col-sm-12 col-md-8">
                                                        <input name="keywords[<?= $lang->getCode(); ?>]" value="<?= cve_lang_data($setting->getValue('keywords'), $lang->getCode()); ?>" type="text" class="form-control inputtags">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('SiteSettings', 'header_logo') ?></label>
                                        <div class="col-sm-12 col-md-8">
                                            <div id="header-image-preview" class="image-preview" style="background-repeat: no-repeat;background-image: url(<?= base_url($setting->getValue('headerLogo'))?>);background-size: contain;background-position: center center;">
                                                <label for="image-upload" id="header-image-label"><?= cve_admin_lang_path('SiteSettings', 'image_select') ?></label>
                                                <input type="file" name="headerLogo" id="header-image-upload" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('SiteSettings', 'footer_logo') ?></label>
                                        <div class="col-sm-12 col-md-8">
                                            <div id="footer-image-preview" class="image-preview" style="background-repeat: no-repeat;background-image: url(<?= base_url($setting->getValue('footerLogo'))?>);background-size: contain;background-position: center center;">
                                                <label for="image-upload" id="footer-image-label"><?= cve_admin_lang_path('SiteSettings', 'image_select') ?></label>
                                                <input type="file" name="footerLogo" id="footer-image-upload" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('SiteSettings', 'mobile_logo') ?></label>
                                        <div class="col-sm-12 col-md-8">
                                            <div id="mobile-image-preview" class="image-preview" style="background-repeat: no-repeat;background-image: url(<?= base_url($setting->getValue('mobileLogo'))?>);background-size: contain;background-position: center center;">
                                                <label for="image-upload" id="mobile-image-label"><?= cve_admin_lang_path('SiteSettings', 'image_select') ?></label>
                                                <input type="file" name="mobileLogo" id="mobile-image-upload" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('SiteSettings', 'favicon') ?></label>
                                        <div class="col-sm-12 col-md-8">
                                            <div id="favicon-image-preview" class="image-preview" style="background-repeat: no-repeat;background-image: url(<?= base_url($setting->getValue('favicon'))?>);background-size: contain;background-position: center center;">
                                                <label for="image-upload" id="favicon-image-label"><?= cve_admin_lang_path('SiteSettings', 'image_select') ?></label>
                                                <input type="file" name="favicon" id="favicon-image-upload" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'update') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>

<script>
    $(".inputtags").tagsinput('items');
</script>

<script>
    $.uploadPreview({
        input_field: "#header-image-upload",   // Default: .image-upload
        preview_box: "#header-image-preview",  // Default: .image-preview
        label_field: "#header-image-label",    // Default: .image-label
        label_default: "Resim Seç",   // Default: Choose File
        label_selected: "Resmi Değiştir",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
    });

    $.uploadPreview({
        input_field: "#footer-image-upload",   // Default: .image-upload
        preview_box: "#footer-image-preview",  // Default: .image-preview
        label_field: "#footer-image-label",    // Default: .image-label
        label_default: "Resim Seç",   // Default: Choose File
        label_selected: "Resmi Değiştir",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
    });

    $.uploadPreview({
        input_field: "#mobile-image-upload",   // Default: .image-upload
        preview_box: "#mobile-image-preview",  // Default: .image-preview
        label_field: "#mobile-image-label",    // Default: .image-label
        label_default: "Resim Seç",   // Default: Choose File
        label_selected: "Resmi Değiştir",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
    });

    $.uploadPreview({
        input_field: "#favicon-image-upload",   // Default: .image-upload
        preview_box: "#favicon-image-preview",  // Default: .image-preview
        label_field: "#favicon-image-label",    // Default: .image-label
        label_default: "Resim Seç",   // Default: Choose File
        label_selected: "Resmi Değiştir",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
    });
</script>

<?php $this->endSection(); ?>
