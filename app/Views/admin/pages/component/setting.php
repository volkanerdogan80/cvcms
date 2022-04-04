<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Component Ayarları</h1>
        </div>

        <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

        <div class="section-body">
            <form action="<?= current_url(); ?>" method="post">
                <?= csrf_field(); ?>
                <?php require_once(COMPONENTS_PATH. $folder .'/setting.php'); ?>
            </form>
        </div>
    </section>
</div>
<?php $this->endSection(); ?>
