<?php $this->extend('themes/aznews/layout/main'); ?>

<?php $this->section('content'); ?>

<!-- Trending Area Start -->
<div class="trending-area fix">
    <div class="container">
        <div class="trending-main">
            <!-- Trending Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending-tittle">
                        <strong>En Son Bloglar</strong>
                        <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                        <div class="trending-animated">
                            <ul id="js-news" class="js-hidden">
                                <?php foreach (cve_random_post(5,'blog') as $key => $value): ?>
                                <li class="news-item">
                                    <a href="<?= cve_post_link($value) ?>">
                                        <?= cve_post_title($value) ?>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <?php foreach (cve_recent_post(1, 'blog') as $key => $value): ?>
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                    <img src="<?= cve_post_thumbnail($value, '750x400') ?>" alt="<?= cve_post_title($value) ?>">
                                <div class="trend-top-cap">
                                    <span><?= cve_cat_title(cve_post_category($value)) ?></span>
                                    <h2>
                                        <a href="<?= cve_post_link($value) ?>">
                                            <?= cve_post_title($value) ?>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- Trending Bottom -->
                    <div class="trending-bottom">
                        <div class="row">
                            <?php foreach (cve_recent_post([
                                    'module' => 'blog', 'limit' => 3, 'offset' => 1
                            ]) as $key => $value): ?>
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <img src="<?= cve_post_thumbnail($value, '240x160') ?>" alt="<?= cve_post_title($value) ?>">
                                        </div>
                                        <div class="trend-bottom-cap">
                                            <span class="color1"><?= cve_cat_title(cve_post_category($value)) ?></span>
                                            <h4>
                                                <a href="<?= cve_post_link($value) ?>">
                                                    <?= cve_post_title($value) ?>
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
                <!-- Riht content -->
                <div class="col-lg-4">
                    <?php foreach (cve_recent_post([
                        'module' => 'blog', 'limit' => 5, 'offset' => 4
                    ]) as $key => $value): ?>
                        <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="<?= cve_post_thumbnail($value, '120x100') ?>" alt="<?= cve_post_title($value) ?>">
                            </div>
                            <div class="trand-right-cap">
                                <span class="color1"><?= cve_cat_title(cve_post_category($value)) ?></span>
                                <h4><a href="<?= cve_post_link($value) ?>"><?= cve_post_title($value) ?></a></h4>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Trending Area End -->
<!--   Weekly-News start -->
<div class="weekly-news-area pt-50">
    <div class="container">
        <div class="weekly-wrapper">
            <!-- section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle mb-30">
                        <h3>Mobil Haberler</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="weekly-news-active dot-style d-flex dot-style">
                        <?php foreach (cve_recent_post(4, 'blog', null, '3') as $key => $value): ?>
                            <div class="weekly-single">
                                <div class="weekly-img">
                                    <img src="<?= cve_post_thumbnail($value, '360x420') ?>" alt="<?= cve_post_title($value) ?>">
                                </div>
                                <div class="weekly-caption">
                                    <span class="color1"><?= cve_cat_title(cve_post_category($value)) ?></span>
                                    <h4>
                                        <a href="<?= cve_post_link($value) ?>">
                                            <?= cve_post_title($value) ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Weekly-News -->
<!-- Whats New Start -->
<section class="whats-news-area pt-50 pb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3>Kategoriler</h3>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="properties__button">
                            <!--Nav Button  -->
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Tümü</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Oyunlar</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Haberler</a>
                                    <a class="nav-item nav-link" id="nav-last-tab" data-toggle="tab" href="#nav-last" role="tab" aria-controls="nav-contact" aria-selected="false">Mobil</a>
                                    <a class="nav-item nav-link" id="nav-Sports" data-toggle="tab" href="#nav-nav-Sport" role="tab" aria-controls="nav-contact" aria-selected="false">E-Ticaret</a>
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Nav Card -->
                        <div class="tab-content" id="nav-tabContent">
                            <!-- card one -->
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        <?php foreach (cve_recent_post(4, 'blog') as $key => $value): ?>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img src="<?= cve_post_thumbnail($value, '360x335') ?>" alt="<?= cve_post_title($value) ?>">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1"><?= cve_cat_title(cve_post_category($value)) ?></span>
                                                        <h4>
                                                            <a href="<?= cve_post_link($value) ?>">
                                                                <?= cve_post_title($value) ?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Card two -->
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        <?php foreach (cve_recent_post(4, 'blog', null, '1') as $key => $value): ?>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img src="<?= cve_post_thumbnail($value, '360x335') ?>" alt="<?= cve_post_title($value) ?>">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1"><?= cve_cat_title(cve_post_category($value)) ?></span>
                                                        <h4>
                                                            <a href="<?= cve_post_link($value) ?>">
                                                                <?= cve_post_title($value) ?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                            <!-- Card three -->
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        <?php foreach (cve_recent_post(4, 'blog', null, '2') as $key => $value): ?>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img src="<?= cve_post_thumbnail($value, '360x335') ?>" alt="<?= cve_post_title($value) ?>">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1"><?= cve_cat_title(cve_post_category($value)) ?></span>
                                                        <h4>
                                                            <a href="<?= cve_post_link($value) ?>">
                                                                <?= cve_post_title($value) ?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                            <!-- card fure -->
                            <div class="tab-pane fade" id="nav-last" role="tabpanel" aria-labelledby="nav-last-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        <?php foreach (cve_recent_post(4, 'blog', null, '3') as $key => $value): ?>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img src="<?= cve_post_thumbnail($value, '360x335') ?>" alt="<?= cve_post_title($value) ?>">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1"><?= cve_cat_title(cve_post_category($value)) ?></span>
                                                        <h4>
                                                            <a href="<?= cve_post_link($value) ?>">
                                                                <?= cve_post_title($value) ?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                            <!-- card Five -->
                            <div class="tab-pane fade" id="nav-nav-Sport" role="tabpanel" aria-labelledby="nav-Sports">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        <?php foreach (cve_recent_post(4, 'blog', null, '4') as $key => $value): ?>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img src="<?= cve_post_thumbnail($value, '360x335') ?>" alt="<?= cve_post_title($value) ?>">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1"><?= cve_cat_title(cve_post_category($value)) ?></span>
                                                        <h4>
                                                            <a href="<?= cve_post_link($value) ?>">
                                                                <?= cve_post_title($value) ?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Nav Card -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- New Poster -->
                <div class="news-poster d-none d-lg-block">
                    <img src="<?= cve_theme_public() ?>/img/news/news_card.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Whats New End -->
<!--   Weekly2-News start -->
<div class="weekly2-news-area  weekly2-pading gray-bg">
    <div class="container">
        <div class="weekly2-wrapper">
            <!-- section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle mb-30">
                        <h3>Bu Hafta En Çok Okunanlar</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="weekly2-news-active dot-style d-flex dot-style">
                        <?php foreach (cve_week_top_post(5,'blog') as $key => $value): ?>
                            <div class="weekly2-single">
                                <div class="weekly2-img">
                                    <img src="<?= cve_post_thumbnail($value, '263x170') ?>" alt="<?= cve_post_title($value) ?>">
                                </div>
                                <div class="weekly2-caption">
                                    <span class="color1"><?= cve_cat_title(cve_post_category($value)) ?></span>
                                    <span class="color3"><?= cve_post_view($value) ?> <i class="fas fa-eye"></i> </span>
                                    <h4>
                                        <a href="<?= cve_post_link($value) ?>">
                                            <?= cve_post_title($value) ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Weekly-News -->
<!-- Start Youtube -->
<div class="youtube-area video-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="video-items-active">
                    <div class="video-items text-center">
                        <iframe src="https://www.youtube.com/embed/DR96WhvrDY4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="video-items text-center">
                        <iframe  src="https://www.youtube.com/embed/V-4uvdOaszM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="video-items text-center">
                        <iframe src="https://www.youtube.com/embed/RdQYEb4WuX0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    </div>
                    <div class="video-items text-center">
                        <iframe src="https://www.youtube.com/embed/a0Fm0ajxi9o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    </div>
                    <div class="video-items text-center">
                        <iframe src="https://www.youtube.com/embed/vrU0Odr3_4Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-info">
            <div class="row">
                <div class="col-lg-6">
                    <div class="video-caption">
                        <div class="top-caption">
                            <span class="color1">Youtube Videoları</span>
                        </div>
                        <div class="bottom-caption">
                            <h2>CV Mühendislik</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ipsum dolor sit. Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ipsum dolor sit. Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ipsum dolor sit lorem ipsum dolor sit.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ipsum dolor sit. Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ipsum dolor sit. Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ipsum dolor sit lorem ipsum dolor sit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="testmonial-nav text-center">
                        <div class="single-video">
                            <iframe  src="https://www.youtube.com/embed/DR96WhvrDY4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <div class="video-intro">
                                <h4>Joey & Phoebe being an ICONIC duo</h4>
                            </div>
                        </div>
                        <div class="single-video">
                            <iframe  src="https://www.youtube.com/embed/V-4uvdOaszM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <div class="video-intro">
                                <h4>DÜNYANIN EN ÇOK OYNANAN ŞAMPİYONU !! YASUO'DAN BİLE POPÜLER !! QUADRA !! | Ogün Demirci</h4>
                            </div>
                        </div>
                        <div class="single-video">
                            <iframe src="https://www.youtube.com/embed/RdQYEb4WuX0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <div class="video-intro">
                                <h4>TIMARHANEDE BU HAFTA 38 - SOYGUN VAR!</h4>
                            </div>
                        </div>
                        <div class="single-video">
                            <iframe src="https://www.youtube.com/embed/a0Fm0ajxi9o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <div class="video-intro">
                                <h4>Superman Finally Kills the Joker Scene [Earth-22] [No BGM] | Injustice</h4>
                            </div>
                        </div>
                        <div class="single-video">
                            <iframe src="https://www.youtube.com/embed/vrU0Odr3_4Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <div class="video-intro">
                                <h4>Friends: Ross Meets Rachel's New Date Russ (Season 2 Clip) | TBS</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Start youtube -->
<!--  Recent Articles start -->
<div class="recent-articles">
    <div class="container">
        <div class="recent-wrapper">
            <!-- section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle mb-30">
                        <h3>Oyun Haberleri</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="recent-active dot-style d-flex dot-style">
                        <?php foreach (cve_recent_post(['limit' => 4, 'module' => 'blog', 'category' => '1']) as $key => $value): ?>
                            <div class="single-recent mb-100">
                                <div class="what-img">
                                    <img src="<?= cve_post_thumbnail($value, '360x335') ?>" alt="<?= cve_post_title($value) ?>">
                                </div>
                                <div class="what-cap">
                                    <span class="color1"><?= cve_cat_title(cve_post_category($value)) ?></span>
                                    <h4>
                                        <a href="<?= cve_post_link($value) ?>">
                                            <?= cve_post_title($value) ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Recent Articles End -->
<?php $this->endSection(); ?>
