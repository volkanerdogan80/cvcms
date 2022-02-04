<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('Sidebar', 'translation'); ?></h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4><?= cve_admin_lang_path('Translation', 'language_select'); ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="list-group">
                                    <?php foreach (cve_language() as $key => $lang): ?>
                                        <a href="javascript:void(0)"
                                           data-url="<?= base_url(route_to('admin_translation_folder_listing')); ?>"
                                           data-lang="<?= $lang->getCode(); ?>"
                                           class="list-group-item list-group-item-action language_select">
                                            <img style="margin-right: 15px" width="30" src="<?= $lang->getFlag(); ?>" alt="">
                                            <?= $lang->getTitle(); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4><?= cve_admin_lang_path('Translation', 'folder_select'); ?></h4>
                            </div>
                            <div class="card-body" id="folder_list">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>

<?= script_tag('public/admin/js/translation.js'); ?>

<?php $this->endSection(); ?>
