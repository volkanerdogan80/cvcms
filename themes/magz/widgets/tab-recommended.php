<?php
$top_liked_contents = cve_top_liked_post(4, 'blog');
$top_liked_contents_first = array_slice($top_liked_contents, 0, 1);
$top_liked_contents_other = array_slice($top_liked_contents, 1, 3);

$top_comment_contents = cve_most_commented_post(4, 'blog');
$top_comment_contents_first = array_slice($top_comment_contents, 0, 1);
$top_comment_contents_other = array_slice($top_comment_contents, 1, 3);
?>
<aside>
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="active">
            <a href="#top-liked" aria-controls="top-liked" role="tab" data-toggle="tab">
                <i class="ion-android-star-outline"></i> En Çok Beğenilenler
            </a>
        </li>
        <li>
            <a href="#top-comments" aria-controls="top-comments" role="tab" data-toggle="tab">
                <i class="ion-ios-chatboxes-outline"></i> En Çok Yorumlananlar
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="top-liked">
            <?php foreach ($top_liked_contents_first as $content): ?>
                <?php $category = cve_post_category($content); ?>
                <article class="article-fw">
                    <div class="inner">
                        <figure>
                            <a href="<?= cve_post_link($content) ?>">
                                <img src="<?= cve_post_thumbnail($content, '318x178'); ?>"
                                     alt="<?= cve_post_title($content) ?>">
                            </a>
                        </figure>
                        <div class="details">
                            <div class="detail">
                                <div class="time"><?= cve_post_created_at($content) ?></div>
                                <div class="category">
                                    <a href="<?= cve_cat_link($category) ?>">
                                        <?= cve_cat_title($category) ?>
                                    </a>
                                </div>
                            </div>
                            <h1>
                                <a href="<?= cve_post_link($content) ?>">
                                    <?= cve_post_title($content) ?>
                                </a>
                            </h1>
                            <p>
                                <?= cve_post_description($content) ?>
                            </p>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
            <div class="line"></div>
            <?php foreach ($top_liked_contents_other as $content): ?>
                <?php $category = cve_post_category($content); ?>
                <article class="article-mini">
                    <div class="inner">
                        <figure>
                            <a href="<?= cve_post_link($content) ?>">
                                <img src="<?= cve_post_thumbnail($content, '80x60'); ?>"
                                     alt="<?= cve_post_title($content) ?>">
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
        <div class="tab-pane comments" id="top-comments">
            <?php foreach ($top_comment_contents_first as $content): ?>
                <?php $category = cve_post_category($content); ?>
                <article class="article-fw">
                    <div class="inner">
                        <figure>
                            <a href="<?= cve_post_link($content) ?>">
                                <img src="<?= cve_post_thumbnail($content, '318x178'); ?>"
                                     alt="<?= cve_post_title($content) ?>">
                            </a>
                        </figure>
                        <div class="details">
                            <div class="detail">
                                <div class="time"><?= cve_post_created_at($content) ?></div>
                                <div class="category">
                                    <a href="<?= cve_cat_link($category) ?>">
                                        <?= cve_cat_title($category) ?>
                                    </a>
                                </div>
                            </div>
                            <h1>
                                <a href="<?= cve_post_link($content) ?>">
                                    <?= cve_post_title($content) ?>
                                </a>
                            </h1>
                            <p>
                                <?= cve_post_description($content) ?>
                            </p>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
            <div class="line"></div>
            <?php foreach ($top_comment_contents_other as $content): ?>
                <?php $category = cve_post_category($content); ?>
                <article class="article-mini">
                    <div class="inner">
                        <figure>
                            <a href="<?= cve_post_link($content) ?>">
                                <img src="<?= cve_post_thumbnail($content, '80x60'); ?>"
                                     alt="<?= cve_post_title($content) ?>">
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
    </div>
</aside>

