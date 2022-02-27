<div class="col-md-8 text-left">
    <div class="row">
        <div class="col-md-12">
            <?php cve_theme_include('category/blog/breadcrumb'); ?>
            <h1 class="page-title">Category: <?= cve_cat_title() ?> </h1>
            <p class="page-subtitle"><small><?= cve_cat_description() ?></small> </p>
        </div>
    </div>
    <div class="line"></div>
    <div class="row">
        <?php foreach (cve_posts()['contents'] as $content): ?>
            <article class="col-md-12 article-list">
                <div class="inner">
                    <figure>
                        <a href="<?= cve_post_link($content) ?>">
                            <img src="<?= cve_post_thumbnail($content, '300x195') ?>" alt="<?= cve_post_title($content) ?>">
                        </a>
                    </figure>
                    <div class="details">
                        <div class="detail">
                            <div class="category">
                                <a href="<?= cve_cat_link() ?>"><?= cve_cat_title() ?></a>
                            </div>
                            <div class="time"><?= cve_post_created_at($content) ?></div>
                        </div>
                        <h1>
                            <a href="<?= cve_post_link($content) ?>">
                                <?= cve_post_title($content) ?>
                            </a>
                        </h1>
                        <p>
                            <?= cve_post_description($content) ?>
                        </p>
                        <footer>
                            <a href="#" class="love">
                                <i class="ion-android-favorite-outline"></i>
                                <div><?= cve_post_liked($content) ?></div>
                            </a>
                            <a class="btn btn-primary more" href="<?= cve_post_link($content) ?>">
                                <div>More</div>
                                <div><i class="ion-ios-arrow-thin-right"></i></div>
                            </a>
                        </footer>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
        <div class="col-md-12 text-center">
            <?= cve_posts()['pager']->links('default', 'cms_pager') ?>
        </div>
    </div>
</div>

