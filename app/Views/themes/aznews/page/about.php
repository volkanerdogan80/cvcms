<!-- Hakkımızda Sayfası Şablonu -->

<?php $this->extend('themes/aznews/layout/main'); ?>

<?php $this->section('content'); ?>

<div class="about-area">
    <div class="container">
        <!-- Hot Aimated News Tittle-->
        <div class="row">
            <div class="col-lg-12">
                <div class="trending-tittle">
                    <strong>Trending now</strong>
                    <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                    <div class="trending-animated">
                        <ul id="js-news" class="js-hidden">
                            <li class="news-item">Bangladesh dolor sit amet, consectetur adipisicing elit.</li>
                            <li class="news-item">Spondon IT sit amet, consectetur.......</li>
                            <li class="news-item">Rem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <!-- Trending Tittle -->
                <div class="about-right mb-90">
                    <div class="about-img">
                        <img src="<?= cve_post_thumbnail(['size' => '750x362'])?>" alt="<?= cve_post_title(); ?>">
                    </div>
                    <div class="section-tittle mb-30 pt-30">
                        <h3>About Us</h3>
                    </div>
                    <div class="about-prea">
                        <?= cve_post_content(); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <?= $this->include('themes/aznews/widget/social'); ?>
                <?= $this->include('themes/aznews/widget/sidebar-ads'); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
