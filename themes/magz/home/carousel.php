<div class="owl-carousel owl-theme slide" id="featured">
    <?php
    $limit = isset(config('theme')->slider_count) ? config('theme')->slider_count : 4;
    $module = isset(config('theme')->slider_module) ? config('theme')->slider_module : 'blog';
    $category = isset(config('theme')->slider_category) ? implode(',', config('theme')->slider_category) : null;
    ?>
    <?php foreach (cve_recent_post(['limit' => $limit, 'module' => $module, 'category' => $category]) as $content): ?>
        <?php $category = cve_post_category($content); ?>
        <div class="item">
            <article class="featured">
                <div class="overlay"></div>
                <figure>
                    <img src="<?= cve_post_thumbnail($content, '750x550'); ?>" alt="<?= cve_post_title($content); ?>">
                </figure>
                <div class="details">
                    <div class="category">
                        <a href="<?= cve_cat_link($category); ?>">
                            <?= cve_cat_title($category); ?>
                        </a>
                    </div>
                    <h1>
                        <a href="<?= cve_post_link($content); ?>">
                            <?= cve_post_title($content); ?>
                        </a>
                    </h1>
                    <div class="time">
                        <?= cve_post_created_at($content); ?>
                    </div>
                </div>
            </article>
        </div>
    <?php endforeach; ?>
</div>

