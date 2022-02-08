<aside class="single_sidebar_widget popular_post_widget">
    <h3 class="widget_title">Son Eklenenler</h3>
    <?php foreach (cve_recent_post(4, 'blog') as $content): ?>
        <div class="media post_item">
            <img src="<?= cve_post_thumbnail($content, '80x80'); ?>" alt="<?= cve_post_title($content); ?>">
            <div class="media-body">
                <a href="<?= cve_post_link($content); ?>">
                    <h3><?= cve_post_title($content); ?></h3>
                </a>
                <p><?= cve_post_created_at($content); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</aside>