<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= lang('Permissions.text.section_title'); ?></h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-times"></i>
                            </div>
                            <h2><?= cve_admin_lang_path('Permissions', 'error_title') ?></h2>
                            <p><?= cve_admin_lang_path('Permissions', 'error_content') ?></p>
                            <b><?= cve_admin_lang_path('Permissions', 'error_content_2') ?></b>
                            <div class="clearfix mb-3"></div>
                            <a href="#" class="btn btn-outline-success btn-block btn-lg"><b><i class="fas fa-home"></i> <?= cve_admin_lang_path('Buttons', 'go_to_dashboard') ?></b></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>