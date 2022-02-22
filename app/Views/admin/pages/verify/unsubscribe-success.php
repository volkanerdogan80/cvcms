<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Newsletter', 'success'); ?></h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state">
                            <div class="empty-state-icon bg-success">
                                <i class="fas fa-check"></i>
                            </div>
                            <h2><?= cve_admin_lang('Newsletter', 'unsubscribe_success'); ?></h2>
                            <p><?= cve_admin_lang('Newsletter', 'unsubscribe_success_message'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>