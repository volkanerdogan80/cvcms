<?php $this->extend('admin/layout/main'); ?>

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
                            <h2><?= lang('ResetPasswordVerify.text.success_title') ?></h2>
                            <p>
                                <?= lang('ResetPasswordVerify.text.success_content') ?>
                            </p>
                            <a href="<?= base_url(route_to('admin_login')); ?>" class="btn btn-primary mt-4">
                                <?= lang('ResetPasswordVerify.text.success_button') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section/>
<?php $this->endSection(); ?>