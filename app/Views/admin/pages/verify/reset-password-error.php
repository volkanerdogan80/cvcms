<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>

    <section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-times"></i>
                            </div>
                            <h2><?= cve_admin_lang_path('Errors', 'something_went_wrong') ?></h2>
                            <p>
                                <?= cve_admin_lang_path('Errors', 'reset_password_failure') ?>
                            </p>
                            <b><?= cve_admin_lang_path('Auth', 'why_title') ?></b>
                            <ol style="text-align: left">
                                <li><?= cve_admin_lang_path('Auth', 'why_reset_timeout') ?></li>
                                <li><?= cve_admin_lang_path('Auth', 'why_reset_key') ?></li>
                            </ol>
                            <a href="<?= base_url(route_to('admin_forgot_password')); ?>" class="btn btn-primary mt-4">
                                <?= cve_admin_lang_path('Buttons', 'go_to_forgot_pass') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section/>
<?php $this->endSection(); ?>