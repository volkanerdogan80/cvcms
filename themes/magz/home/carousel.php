<div class="owl-carousel owl-theme slide" id="featured">
    <?php foreach (cve_most_read_post(['limit' => 4, 'module' => 'blog']) as $content): ?>
    <?php $category = cve_post_category($content); ?>
        <div class="item">
            <article class="featured">
                <div class="overlay"></div>
                <figure>
                    <img src="<?= cve_post_thumbnail($content,'750x550'); ?>" alt="<?= cve_post_title(); ?>">
                </figure>
                <div class="details">
                    <div class="category">
                        <a href="<?= cve_cat_link($category); ?>">
                            <?= cve_cat_title($category); ?>
                        </a>
                    </div>
                    <h1>
                        <a href="<?= cve_post_link($content); ?>">
                            <?= cve_post_title(); ?>
                        </a>
                    </h1>
                    <div class="time"><?= cve_post_created_at($content); ?></div>
                </div>
            </article>
        </div>
    <?php endforeach; ?>
</div>

