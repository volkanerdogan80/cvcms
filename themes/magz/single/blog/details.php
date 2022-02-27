<?php $category = cve_post_category(); ?>
<article class="article main-article">
    <header>
        <h1><?= cve_post_title() ?></h1>
        <ul class="details">
            <li><?= cve_post_created_at(null,true) ?></li>
            <li><a><?= cve_cat_title($category) ?></a></li>
            <li>By <a href="<?= cve_cat_link($category) ?>"><?= cve_post_author(null,'full_name') ?></a></li>
        </ul>
    </header>
    <div class="main">
        <div class="featured">
            <img src="<?= cve_post_thumbnail(null,'750x450') ?>">
        </div>
        <p style="font-size: 14px;"><?= cve_post_content() ?></p>
    </div>
    <footer>
        <div class="col">
            <ul class="tags">
                <?php foreach (cve_post_keywords(null, true) as $keyword): ?>
                    <li><a href="<?= cve_tag_link($keyword) ?>"><?= $keyword ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col">
            <?= cmp_like_button() ?>
            <?= cmp_favorite_button() ?>
        </div>
    </footer>
    <footer>
        <?= cmp_user_score_panel() ?>
    </footer>
</article>