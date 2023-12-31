<?php $this->extend('admin/layout/main'); ?>

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
                                <h2><?= lang('AccountVerify.text.error_title'); ?></h2>
                                <p><?= lang('AccountVerify.text.error_content'); ?></p>
                                <b><?= lang('AccountVerify.text.error_content_2'); ?></b>
                                <b><?= lang('AccountVerify.text.why_title'); ?></b>
                                <ol style="text-align: left">
                                    <li><?= lang('AccountVerify.text.why_1'); ?></li>
                                    <li><?= lang('AccountVerify.text.why_1'); ?></li>
                                    <li><?= lang('AccountVerify.text.why_1'); ?></li>
                                </ol>
                                <a href="<?= base_url(route_to('admin_login')) ?>" class="btn btn-primary mt-4"><?= lang('AccountVerify.text.error_go_to_login'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section/>
<?php $this->endSection(); ?>