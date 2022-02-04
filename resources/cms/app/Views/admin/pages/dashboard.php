<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Blank Page</h1>
                </div>

                <?= $this->include('admin/layout/partials/errors'); ?>

                <div class="section-body">
                    <?= cve_single_image_picker('blog-image', 'image', 'blog-image-id'); ?>
                    <hr>
                    <?= cve_multi_image_picker('Resim Seç', 'images', 'images-list', 'btn-danger') ?>
                    <hr>
                    <?= cve_multi_image_area('images-list'); ?>
                </div>
            </section>
        </div>
<?php $this->endSection(); ?>