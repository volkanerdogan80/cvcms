<?php
    $related_content = cve_post_similar();
    if(!$related_content){
        $related_category = cve_post_category();
        $related_content = cve_random_post(['limit' => 2, 'category' => cve_cat_id($related_category)]);
    }
?>


<div class="line"><div>You May Also Like</div></div>
<div class="row">
    <?php foreach ($related_content as $content): ?>
    <?php $category = cve_post_category($content) ?>
        <article class="article related col-md-6 col-sm-6 col-xs-12">
            <div class="inner">
                <figure>
                    <a href="<?= cve_post_link($content) ?>">
                        <img src="<?= cve_post_thumbnail($content, '360x250') ?>" alt="<?= cve_post_created_at($content) ?>">
                    </a>
                </figure>
                <div class="padding">
                    <h2>
                        <a href="<?= cve_post_link($content) ?>">
                            <?= cve_post_created_at($content) ?>
                        </a>
                    </h2>
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

