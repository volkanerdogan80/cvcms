<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state" data-height="400">
                            <div class="empty-state-icon bg-success">
                                <i class="fas fa-check"></i>
                            </div>
                            <h2><?= cve_admin_lang_path('Success', 'email_send_success') ?></h2>
                            <p>
                                <?= cve_admin_lang_path('Success', 'reset_email_success') ?>
                            </p>
                            <a href="<?= base_url(route_to('admin_login')); ?>" class="btn btn-primary mt-4">
                                <?= cve_admin_lang_path('Auth', 'login') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section/>
<?php $this->endSection(); ?>