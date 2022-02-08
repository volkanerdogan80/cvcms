<?php $this->extend('themes/aznews/layout/main'); ?>

<?php $this->section('content'); ?>

<!-- Whats New Start -->
<section class="whats-news-area pt-50 pb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3><?= cve_cat_title(); ?></h3>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Nav Card -->
                        <div class="whats-news-caption">
                            <div class="row">
                                <?php $data = cve_cat_posts(cve_cat_id(), 4, true); ?>
                                <?php $contents = $data['contents']; ?>
                                <?php $pager = $data['pager']; ?>
                                <?php foreach ($contents as $content): ?>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-what-news mb-100">
                                            <div class="what-img">
                                                <img src="<?= cve_post_thumbnail($content, '360x335') ?>" alt="<?= cve_post_title($content); ?>">
                                            </div>
                                            <div class="what-cap">
                                                <span class="color1"><?= cve_cat_title(); ?></span>
                                                <h4>
                                                    <a href="<?= cve_post_link($content); ?>">
                                                        <?= cve_post_title($content); ?>
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- End Nav Card -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Section Tittle -->
                <div class="section-tittle mb-40">
                    <h3>Follow Us</h3>
                </div>
                <?= $this->include('themes/aznews/widget/social'); ?>
                <?= $this->include('themes/aznews/widget/sidebar-ads'); ?>
            </div>
        </div>
    </div>
</section>
<!-- Whats New End -->


<!--Start pagination -->
<div class="pagination-area pb-45 text-center">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="single-wrap d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <?= $pager->links('default', 'cms_pager'); ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End pagination  -->

<?php $this->endSection(); ?>
