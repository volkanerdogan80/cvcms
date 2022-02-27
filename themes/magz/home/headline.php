<div class="headline">
    <div class="nav" id="headline-nav">
        <a class="left carousel-control" role="button" data-slide="prev">
            <span class="ion-ios-arrow-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" role="button" data-slide="next">
            <span class="ion-ios-arrow-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="owl-carousel owl-theme" id="headline">
        <?php foreach (cve_random_post(['module' => 'blog']) as $content): ?>
        <div class="item">
            <a href="<?= cve_post_link($content) ?>">
                <!-- <div class="badge">Tip!</div> -->
                <?= cve_post_title($content) ?>
            </a>
        </div>
        <?php endforeach; ?>

    </div>
</div>

