<div class="line top">
    <div>Just Another News</div>
</div>
<div class="row">
    <?php foreach (cve_recent_post(4, 'blog', null, 7) as $content): ?>
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
                    <p style="font-size: 14px;">
                        <?= cve_post_description($content); ?>
                    </p>
                    <footer>
                        <a data-count=".cve-<?= cve_post_id($content); ?>-content-like_count"
                           data-content="<?= cve_post_id($content); ?>"
                           href="#" class="love <?= is_liked() ? 'active' : ''; ?>">
                            <i class="ion-android-favorite<?= is_liked() ? '' : '-outline'; ?>"></i>
                            <div class="cve-<?= cve_post_id($content); ?>-content-like_count">
                                <?= cve_post_liked($content); ?>
                            </div>
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