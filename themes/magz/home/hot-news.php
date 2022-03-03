<div class="col-md-6 col-sm-6">
    <h1 class="title-col">
        Hot News
        <div class="carousel-nav" id="hot-news-nav">
            <div class="prev">
                <i class="ion-ios-arrow-left"></i>
            </div>
            <div class="next">
                <i class="ion-ios-arrow-right"></i>
            </div>
        </div>
    </h1>
    <div class="body-col vertical-slider" data-max="4" data-nav="#hot-news-nav" data-item="article">
        <?php foreach (cve_month_top_post(6,'blog') as $content): ?>
            <article class="article-mini">
                <div class="inner">
                    <figure>
                        <a href="<?= cve_post_link($content); ?>">
                            <img src="<?= cve_post_thumbnail($content, '80x57'); ?>" alt="<?= cve_post_title($content); ?>">
                        </a>
                    </figure>
                    <div class="padding">
                        <h1>
                            <a href="<?= cve_post_link($content); ?>">
                                <?= cve_post_title($content); ?>
                            </a>
                        </h1>
                        <div class="detail">
                            <div class="category">
                                <a href="<?= cve_cat_link($content, true); ?>">
                                    <?= cve_cat_title($content, true); ?>
                                </a>
                            </div>
                            <div class="time"><?= cve_post_created_at($content); ?></div>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</div>

