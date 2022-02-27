<div class="line">
    <div>Latest News</div>
</div>
<div class="row">
    <?php foreach (cve_recent_post(3, 'blog', null, 4) as $content): ?>
        <?php $category = cve_post_category($content); ?>
        <article class="col-md-12 article-list">
            <div class="inner">
                <figure>
                    <a href="<?= cve_post_link($content); ?>">
                        <img src="<?= cve_post_thumbnail($content, '300x195'); ?>" alt="<?= cve_post_title($content); ?>">
                    </a>
                </figure>
                <div class="details">
                    <div class="detail">
                        <div class="category">
                            <a href="<?= cve_cat_link($category); ?>"><?= cve_cat_title($category); ?></a>
                        </div>
                        <div class="time"><?= cve_post_created_at($content); ?></div>
                    </div>
                    <h1>
                        <a href="<?= cve_post_link($content); ?>">
                            <?= cve_post_title($content); ?>
                        </a>
                    </h1>
                    <p>
                        <?= cve_post_description($content); ?>
                    </p>
                    <footer>
                        <a href="#" class="love">
                            <i class="ion-android-favorite-outline"></i>
                            <div><?= cve_post_liked($content); ?></div>
                        </a>
                        <a class="btn btn-primary more" href="<?= cve_post_link($content); ?>">
                            <div>More</div>
                            <div><i class="ion-ios-arrow-thin-right"></i></div>
                        </a>
                    </footer>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</div>

