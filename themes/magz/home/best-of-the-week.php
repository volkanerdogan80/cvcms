<section class="best-of-the-week">
    <div class="container">
        <h1>
            <div class="text">Best Of The Week</div>
            <div class="carousel-nav" id="best-of-the-week-nav">
                <div class="prev">
                    <i class="ion-ios-arrow-left"></i>
                </div>
                <div class="next">
                    <i class="ion-ios-arrow-right"></i>
                </div>
            </div>
        </h1>
        <div class="owl-carousel owl-theme carousel-1">
            <?php
            $limit = isset(config('theme')->top_week_count) ? config('theme')->top_week_count : 6;
            $module = isset(config('theme')->top_week_module) ? config('theme')->top_week_module : 'blog';
            $category = isset(config('theme')->top_week_category) ? implode(',', config('theme')->top_week_category) : null;
            ?>
            <?php foreach (cve_week_top_post(['limit' => $limit, 'module' => $module, 'category' => $category]) as $content): ?>
                <article class="article">
                    <div class="inner">
                        <figure>
                            <a href="<?= cve_post_link($content); ?>">
                                <img src="<?= cve_post_thumbnail($content, '270x175'); ?>"
                                     alt="<?= cve_post_title($content); ?>">
                            </a>
                        </figure>
                        <div class="padding">
                            <div class="detail">
                                <div class="time"><?= cve_post_created_at($content); ?></div>
                                <div class="category">
                                    <a href=" <?= cve_cat_link($content, true); ?>">
                                        <?= cve_cat_title($content, true); ?>
                                    </a>
                                </div>
                            </div>
                            <h2>
                                <a href="<?= cve_post_link($content); ?>">
                                    <?= cve_post_title($content); ?>
                                </a>
                            </h2>
                            <p><?= cve_post_description($content); ?></p>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

