<?php if (is_comment_status()): ?>
    <?php foreach (cve_post_comments() as $comment): ?>
        <?php if(cve_comment_status($comment) == STATUS_ACTIVE): ?>
            <article class="uk-comment uk-comment-primary" style="margin-left: <?= $comment->level * 60; ?>px">
                <header class="uk-comment-header">
                    <div class="uk-grid-medium uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-comment-avatar"
                                 src="<?= base_url(PUBLIC_ADMIN_IMAGE_PATH . 'avatar/comment-icon.png'); ?>" width="80"
                                 height="80" alt="">
                        </div>
                        <div class="uk-width-expand">
                            <h4 class="uk-comment-title uk-margin-remove">
                                <?= cve_comment_name($comment); ?>
                            </h4>
                            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                <li><?= cve_comment_created_at($comment); ?></li>
                                <li>
                                    <button data-id="<?= $comment->id ?>"
                                            data-name="<?= $comment->name; ?>"
                                            class="uk-button uk-button-link uikit-comment-reply">
                                        <?= cve_admin_lang('Buttons', 'reply') ?>
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
        <?php endif; ?>
    <?php endforeach; ?>
    <hr class="uk-divider-icon">
<?php endif; ?>
