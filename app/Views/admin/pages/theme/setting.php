<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>"<?= $theme->getName(); ?>"  <?= cve_admin_lang_path('Theme', 'setting_page_title') ?></h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>

                    <?= $this->include('themes/'.$theme->getFolder().'/setting'); ?>

                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>