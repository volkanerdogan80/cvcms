<aside>
    <h1 class="aside-title">Popular <a href="#" class="all">See All <i class="ion-ios-arrow-right"></i></a></h1>
    <div class="aside-body">
        <?php foreach (cve_most_read_post(6, 'blog') as $content): ?>
            <article class="article-mini">
                <div class="inner">
                    <figure>
                        <a href="<?= cve_post_link($content); ?>">
                            <img src="<?= cve_post_thumbnail($content, '80x60'); ?>" alt="<?= cve_post_title($content); ?>">
                        </a>
                    </figure>
                    <div class="padding">
                        <h1><a href="<?= cve_post_link($content); ?>"><?= cve_post_title($content); ?></a></h1>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</aside>

