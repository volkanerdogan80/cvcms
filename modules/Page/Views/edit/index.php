<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= cve_admin_lang_path('General', 'now_editing'); ?> " <?= $content->getTitle(); ?> " </h1>
        </div>

        <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

        <div class="section-body">
            <form action="<?= current_url(); ?>" method="post">
                <?= csrf_field();  ?>
                <div class="row">
                    <?= $this->include(cve_module_view('Service','edit/content')); ?>
                    <?= $this->include(cve_module_view('Service','edit/general')); ?>
                    <?= $this->include(cve_module_view('Service','edit/custom-field')); ?>
                    <?= $this->include(cve_module_view('Service','edit/gallery')); ?>
                </div>
            </form>
        </div>
    </section>
</div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>

<script>
    <?php foreach (cve_language() as $key => $lang): ?>
    CKEDITOR.replace( 'content-<?= $lang->getCode(); ?>', {
        height: 300,
        filebrowserUploadUrl: "<?= base_url(route_to('admin_image_upload')); ?>"
    });
    <?php endforeach; ?>

</script>

<script>
    $(".inputtags").tagsinput('items');
</script>

<?php $this->endSection(); ?>