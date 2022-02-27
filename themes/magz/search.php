<?php cve_theme_include('inc/head'); ?>
<?php cve_theme_include('inc/header'); ?>

<section class="search">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="search-result">
                    Search results for keyword "hello" found in 5,200 posts.
                </div>
                <div class="row">
                    <article class="col-md-12 article-list">
                        <div class="inner">
                            <figure>
                                <a href="single.html">
                                    <img src="<?= cve_theme_public('') ?>/images/news/img11.jpg">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="category">
                                        <a href="#">Film</a>
                                    </div>
                                    <time>December 19, 2016</time>
                                </div>
                                <h1><a href="single.html">Donec consequat arcu at ultrices sodales quam erat aliquet diam</a></h1>
                                <p>
                                    Donec consequat, arcu at ultrices sodales, quam erat aliquet diam, sit amet interdum libero nunc accumsan nisi.
                                </p>
                                <footer>
                                    <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>273</div></a>
                                    <a class="btn btn-primary more" href="single.html">
                                        <div>More</div>
                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                    </a>
                                </footer>
                            </div>
                        </div>
                    </article>
                    <article class="col-md-12 article-list">
                        <div class="inner">
                            <div class="badge">
                                Sponsored
                            </div>
                            <figure>
                                <a href="single.html">
                                    <img src="<?= cve_theme_public('') ?>/images/news/img02.jpg">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="category">
                                        <a href="#">Travel</a>
                                    </div>
                                    <time>December 18, 2016</time>
                                </div>
                                <h1><a href="single.html">Maecenas accumsan tortor ut velit pharetra mollis</a></h1>
                                <p>
                                    Maecenas accumsan tortor ut velit pharetra mollis. Proin eu nisl et arcu iaculis placerat sollicitudin ut est. In fringilla dui.
                                </p>
                                <footer>
                                    <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>4209</div></a>
                                    <a class="btn btn-primary more" href="single.html">
                                        <div>More</div>
                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                    </a>
                                </footer>
                            </div>
                        </div>
                    </article>
                    <article class="col-md-12 article-list">
                        <div class="inner">
                            <figure>
                                <a href="single.html">
                                    <img src="<?= cve_theme_public('') ?>/images/news/img03.jpg">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="category">
                                        <a href="#">Travel</a>
                                    </div>
                                    <time>December 16, 2016</time>
                                </div>
                                <h1><a href="single.html">Nulla facilisis odio quis gravida vestibulum Proin venenatis pellentesque arcu</a></h1>
                                <p>
                                    Nulla facilisis odio quis gravida vestibulum. Proin venenatis pellentesque arcu, ut mattis nulla placerat et.
                                </p>
                                <footer>
                                    <a href="#" class="love active"><i class="ion-android-favorite"></i> <div>302</div></a>
                                    <a class="btn btn-primary more" href="single.html">
                                        <div>More</div>
                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                    </a>
                                </footer>
                            </div>
                        </div>
                    </article>
                    <article class="col-md-12 article-list">
                        <div class="inner">
                            <figure>
                                <a href="single.html">
                                    <img src="<?= cve_theme_public('') ?>/images/news/img09.jpg">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="category">
                                        <a href="#">Healthy</a>
                                    </div>
                                    <time>December 16, 2016</time>
                                </div>
                                <h1><a href="single.html">Maecenas blandit ultricies lorem id tempor enim pulvinar at</a></h1>
                                <p>
                                    Maecenas blandit ultricies lorem, id tempor enim pulvinar at. Curabitur sit amet tortor eu ipsum lacinia malesuada. Etiam sed vulputate magna.
                                </p>
                                <footer>
                                    <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>783</div></a>
                                    <a class="btn btn-primary more" href="single.html">
                                        <div>More</div>
                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                    </a>
                                </footer>
                            </div>
                        </div>
                    </article>
                    <div class="col-md-12 text-center">
                        <ul class="pagination">
                            <li class="prev"><a href="#"><i class="ion-ios-arrow-left"></i></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">97</a></li>
                            <li class="next"><a href="#"><i class="ion-ios-arrow-right"></i></a></li>
                        </ul>
                        <div class="pagination-help-text">
                            Showing 8 results of 776 &mdash; Page 1
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php cve_theme_include('widgets/tab-recommended'); ?>
                <?php cve_theme_include('widgets/tab-top-read'); ?>
                <?php cve_theme_include('widgets/newsletter'); ?>
            </div>
        </div>
    </div>
</section>
<?php cve_theme_include('inc/footer'); ?>
