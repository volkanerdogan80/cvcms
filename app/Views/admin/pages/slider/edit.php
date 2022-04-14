<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>
                    <?= cve_admin_lang('General','now_editing'); ?>   <?= $sliders->getKey(); ?>
                </h1>
                <div class="section-header-breadcrumb">
                    <button data-url="<?= base_url(route_to('admin_slider_new_card')); ?>" type="button" class="btn btn-primary" id="new-slider">
                        <i class="fas fa-plus"></i>  <?= cve_admin_lang('Buttons','add_new_item'); ?>
                    </button>
                </div>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <form action="<?= current_url(); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="section-body" id="slider-item-list">

                    <?php if ($sliders->getValue()): ?>
                        <?= $this->include(PANEL_FOLDER . '/pages/slider/partials/edit-card'); ?>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons','update'); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<?= script_tag(PUBLIC_ADMIN_JS_PATH . 'slider.js'); ?>
<?php $this->endSection(); ?>