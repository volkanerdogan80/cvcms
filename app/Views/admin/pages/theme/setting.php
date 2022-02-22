<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>"<?= $theme->getName(); ?>"  <?= cve_admin_lang('Theme', 'setting_page_title') ?></h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>

                    <?php require_once(THEMES_PATH. $theme->getFolder() .'/setting.php'); ?>

                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>