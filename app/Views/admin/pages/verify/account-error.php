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
                                <h2><?= cve_admin_lang('Errors', 'verification_failure') ?></h2>
                                <p><?= cve_admin_lang('Errors', 'verification_failure_msg') ?></p>
                                <b><?= cve_admin_lang('Auth', 'why_title') ?></b>
                                <ol style="text-align: left">
                                    <li><?= cve_admin_lang('Auth', 'why_verify_key') ?></li>
                                    <li><?= cve_admin_lang('Auth', 'why_verify_already') ?></li>
                                    <li><?= cve_admin_lang('Auth', 'why_account_suspend') ?></li>
                                </ol>
                                <a href="<?= base_url(route_to('admin_login')) ?>" class="btn btn-primary mt-4"><?= cve_admin_lang('Buttons', 'go_to_login_page') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section/>
<?php $this->endSection(); ?>


