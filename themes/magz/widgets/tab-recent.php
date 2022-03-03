<?php
$recent_contents = cve_recent_post(4, 'blog');
$recent_contents_first = array_slice($recent_contents, 0, 1);
$recent_contents_other = array_slice($recent_contents, 1, 3);

$random_contents = cve_random_post(4, 'blog');
$random_contents_first = array_slice($random_contents, 0, 1);
$random_contents_other = array_slice($random_contents, 1, 3);
?>
<aside>
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="active">
            <a href="#recent" aria-controls="recent" role="tab" data-toggle="tab">
                <i class="ion-android-star-outline"></i> Son Eklenenler
            </a>
        </li>
        <li>
            <a href="#random" aria-controls="random" role="tab" data-toggle="tab">
                <i class="ion-ios-chatboxes-outline"></i> Sizin İçin Seçtiklerimiz
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="recent">
            <?php foreach ($recent_contents_first as $content): ?>
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
                                    <a href="<?= cve_cat_link($content, true) ?>">
                                        <?= cve_cat_title($content, true) ?>
                                    </a>
                                </div>
                            </div>
                            <h1>
                                <a href="<?= cve_post_link($content) ?>">
                                    <?= cve_post_title($content) ?>
                                </a>
                            </h1>
                            <p style="font-size: 14px;">
                                <?= cve_post_description($content) ?>
                            </p>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
            <div class="line"></div>
            <?php foreach ($recent_contents_other as $content): ?>
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
                                    <a href="<?= cve_cat_link($content, true) ?>">
                                        <?= cve_cat_title($content, true) ?>
                                    </a>
                                </div>
                                <div class="time"><?= cve_post_created_at($content) ?></div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="tab-pane comments" id="random">
            <?php foreach ($random_contents_first as $content): ?>
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
                                    <a href="<?= cve_cat_link($content, true) ?>">
                                        <?= cve_cat_title($content, true) ?>
                                    </a>
                                </div>
                            </div>
                            <h1>
                                <a href="<?= cve_post_link($content) ?>">
                                    <?= cve_post_title($content) ?>
                                </a>
                            </h1>
                            <p style="font-size: 14px;">
                                <?= cve_post_description($content) ?>
                            </p>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
            <div class="line"></div>
            <?php foreach ($random_contents_other as $content): ?>
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
                                    <a href="<?= cve_cat_link($content, true) ?>">
                                        <?= cve_cat_title($content, true) ?>
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

