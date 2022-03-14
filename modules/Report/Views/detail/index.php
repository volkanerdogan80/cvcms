<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $content->getTitle() ?></h1>
        </div>

        <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

        <div class="section-body">
            <div class="row">
                <?= $this->include(cve_module_view_path('Report','detail/content')); ?>
                <?= $this->include(cve_module_view_path('Report','detail/aside')); ?>
            </div>
        </div>
    </section>

</div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>

<script>
    CKEDITOR.replace( 'comment', {
        height: 300,
        filebrowserUploadUrl: "<?= base_url(route_to('admin_image_upload')); ?>"
    });

</script>

<script>
    $(".inputtags").tagsinput('items');
</script>

<?php $this->endSection(); ?>

