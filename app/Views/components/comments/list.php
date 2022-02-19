<?php if (is_post() && is_comment_status()): ?>
    <?php foreach (cve_post_comments() as $comment): ?>
        <article class="uk-comment uk-comment-primary uk-card-hover" style="margin-left: <?= $comment->level*60; ?>px">
            <header class="uk-comment-header">
                <div class="uk-grid-medium uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <img class="uk-comment-avatar" src="<?= base_url('http://localhost/public/admin/img/avatar/avatar_girl.png'); ?>" width="80" height="80" alt="">
                    </div>
                    <div class="uk-width-expand">
                        <h4 class="uk-comment-title uk-margin-remove">
                            <?= cve_comment_name($comment); ?>
                        </h4>
                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                            <li><?= cve_comment_created_at($comment); ?></li>
                            <li>
                                <button data-id="<?= $comment->id?>" data-name="<?= $comment->name; ?>" class="uk-button uk-button-link cve-comment-reply">
                                    Cevapla
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <div class="uk-comment-body">
                <p><?= cve_comment_comment($comment); ?></p>
            </div>
        </article>
    <?php endforeach; ?>

    <hr class="uk-divider-icon">

    <?php if ($form): ?>
        <?= cmp_comment_form(); ?>
    <?php endif; ?>

<?php endif; ?>
