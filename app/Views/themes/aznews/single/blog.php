<?php $this->extend('themes/aznews/layout/main'); ?>

<?php $this->section('content'); ?>

<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <div class="feature-img">
                        <img class="img-fluid" src="<?= cve_post_thumbnail(['size' => '750x375']); ?>"
                             alt="<?= cve_post_title(); ?>">
                    </div>
                    <div class="blog_details">
                        <h2><?= cve_post_title(); ?></h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li>
                                <i class="fa fa-list"></i>
                                <?php foreach (cve_post_categories() as $category): ?>
                                    <a href="<?= cve_cat_link($category); ?>"><?= cve_cat_title($category); ?> - </a>
                                <?php endforeach; ?>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-comments"></i>
                                    <?= cve_post_comment_count(); ?>
                                    Yorum
                                </a>
                            </li>
                        </ul>
                        <p class="excert">
                            <?= cve_post_description(); ?>
                        </p>
                        <?= cve_post_content(); ?>
                    </div>
                </div>
                <div class="navigation-top">
                    <div class="d-sm-flex justify-content-between text-center">
                        <button type="button" class="btn btn-primary cve-liked">Beğen ( <span class="cve-like-count">0</span> )</button>
                        <button type="button" class="btn btn-primary cve-favorite">Favorilere Ekle ( <span class="cve-favorite-count">0</span> )</button>
                    </div>
                    <hr>
                    <div class="d-sm-flex justify-content-between text-center">
                        <button type="button" class="btn-primary cve-voted" data-vote="1">1 Puan ( <span class="cve-1-vote">0</span> )</button>
                        <button type="button" class="btn-primary cve-voted" data-vote="2">2 Puan ( <span class="cve-2-vote">0</span> )</button>
                        <button type="button" class="btn-primary cve-voted" data-vote="3">3 Puan ( <span class="cve-3-vote">0</span> )</button>
                        <button type="button" class="btn-primary cve-voted" data-vote="4">4 Puan ( <span class="cve-4-vote">0</span> )</button>
                        <button type="button" class="btn-primary cve-voted" data-vote="5">5 Puan ( <span class="cve-5-vote">0</span> )</button>
                    </div>
                    <hr>
                    <div class="d-sm-flex justify-content-between text-center">
                        <button type="button" class="btn-primary cve-voted" data-vote="6">6 Puan ( <span class="cve-6-vote">0</span> )</button>
                        <button type="button" class="btn-primary cve-voted" data-vote="7">7 Puan ( <span class="cve-7-vote">0</span> )</button>
                        <button type="button" class="btn-primary cve-voted" data-vote="8">8 Puan ( <span class="cve-8-vote">0</span> )</button>
                        <button type="button" class="btn-primary cve-voted" data-vote="9">9 Puan ( <span class="cve-9-vote">0</span> )</button>
                        <button type="button" class="btn-primary cve-voted" data-vote="10">10 Puan ( <span class="cve-10-vote">0</span> )</button>
                    </div>
                    <hr>
                    <h4>Ortalama: <span class="cve-vote-avg">4</span></h4>
                    <div class="navigation-area">
                        <div class="row">
                            <div
                                    class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                <div class="thumb">
                                    <a href="#">
                                        <img class="img-fluid" src="<?= cve_theme_public() ?>/img/post/preview.png"
                                             alt="">
                                    </a>
                                </div>
                                <div class="arrow">
                                    <a href="#">
                                        <span class="lnr text-white ti-arrow-left"></span>
                                    </a>
                                </div>
                                <div class="detials">
                                    <p>Prev Post</p>
                                    <a href="#">
                                        <h4>Space The Final Frontier</h4>
                                    </a>
                                </div>
                            </div>
                            <div
                                    class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                <div class="detials">
                                    <p>Next Post</p>
                                    <a href="#">
                                        <h4>Telescopes 101</h4>
                                    </a>
                                </div>
                                <div class="arrow">
                                    <a href="#">
                                        <span class="lnr text-white ti-arrow-right"></span>
                                    </a>
                                </div>
                                <div class="thumb">
                                    <a href="#">
                                        <img class="img-fluid" src="<?= cve_theme_public() ?>/img/post/next.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-author">
                    <div class="media align-items-center">
                        <img src="<?= cve_theme_public('img/blog/author.png') ?>"
                             alt="<?= cve_post_author(['key' => 'fullname']); ?>">
                        <div class="media-body">
                            <a href="#">
                                <h4><?= cve_post_author(['key' => 'fullname']); ?></h4>
                            </a>
                            <p><?= cve_post_author(['key' => 'bio']); ?></p>
                        </div>
                    </div>
                </div>
                <div class="comments-area">
                    <h4><?= cve_post_comment_count(); ?> Yorumlar</h4>
                    <?php foreach (cve_post_comments() as $comment): ?>
                        <div data-id="<?= cve_comment_id($comment); ?>" class="comment-list"
                             style="margin-left: <?= cve_comment_level($comment, 50); ?>px">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="<?= cve_theme_public('img/comment/comment_1.png') ?>" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            <?= cve_comment_comment($comment); ?>
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    <a href="#"><?= cve_comment_name($comment); ?></a>
                                                </h5>
                                                <p class="date"><?= cve_comment_created_at($comment, true); ?></p>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="javascript:void(0)"
                                                   class="btn-reply text-uppercase cve-comment-reply"
                                                   data-id="<?= cve_comment_id($comment) ?>"
                                                   data-name="<?= cve_comment_name($comment); ?>">
                                                    Cevapla
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="comment-form">
                    <h4>Yorum Yap</h4>
                    <form class="cve-comment-form" method="post" action="<?= cve_comment_form_action(); ?>">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                              <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                        placeholder="Yorumunuzu Yazın"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text"
                                           placeholder="İsim Soyisim">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email"
                                           placeholder="Eposta Adresi">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="button button-contactForm btn_1 boxed-btn">Yorumu Gönder
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <?= $this->include('themes/aznews/widget/search'); ?>
                    <?= $this->include('themes/aznews/widget/blog_categories'); ?>
                    <?= $this->include('themes/aznews/widget/popular_post'); ?>
                    <?= $this->include('themes/aznews/widget/tag_cloud'); ?>
                    <?= $this->include('themes/aznews/widget/newsletter'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<script>
    $('.btn-reply').click(function () {
        let comment_id = $(this).closest('.comment-list').data('id');
        $('#comment_id').val(comment_id);
    });
</script>
<?php $this->endSection(); ?>
