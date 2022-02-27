<?php
    $sidebar_recent_posts = cve_recent_post(4, 'blog');
    $sidebar_recent_posts_first = array_slice($sidebar_recent_posts, 0 ,1);
    $sidebar_recent_posts_other = array_slice($sidebar_recent_posts, 1,3);
?>
<aside>
    <h1 class="aside-title">Recent Post</h1>
    <div class="aside-body">
        <?php foreach ($sidebar_recent_posts_first as $content): ?>
        <?php $category = cve_post_category($content); ?>
            <article class="article-fw">
                <div class="inner">
                    <figure>
                        <a href="<?= cve_post_link($content) ?>">
                            <img src="<?= cve_post_thumbnail($content, '360x178') ?>" alt="<?= cve_post_title($content) ?>">
                        </a>
                    </figure>
                    <div class="details">
                        <h1>
                            <a href="<?= cve_post_link($content) ?>">
                                <?= cve_post_title($content) ?>
                            </a>
                        </h1>
                        <p>
                            <?= cve_post_description($content) ?>
                        </p>
                        <div class="detail">
                            <div class="time"><?= cve_post_created_at($content) ?></div>
                            <div class="category">
                                <a href="<?= cve_cat_link($category) ?>">
                                    <?= cve_cat_title($category) ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
        <div class="line"></div>
        <?php foreach ($sidebar_recent_posts_other as $content): ?>
            <?php $category = cve_post_category($content); ?>
            <article class="article-mini">
                <div class="inner">
                    <figure>
                        <a href="<?= cve_post_link($content) ?>">
                            <img src="<?= cve_post_thumbnail($content, '80x60') ?>" alt="<?= cve_post_title($content) ?>">
                        </a>
                    </figure>
                    <div class="padding">
                        <h1>
                            <a href="<?= cve_post_link($content) ?>">
                                <?= cve_post_title($content) ?>
                            </a>
                        </h1>
                        <div class="detail">
                            <div class="category">
                                <a href="<?= cve_cat_link($category) ?>">
                                    <?= cve_cat_title($category) ?>
                                </a>
                            </div>
                            <div class="time"><?= cve_post_created_at($content) ?></div>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</aside>

