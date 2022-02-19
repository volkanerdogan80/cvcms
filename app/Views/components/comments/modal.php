<?php if (is_post() && is_comment_status()): ?>

    <button class="uk-button uk-button-<?= $type; ?> uk-margin-small-right"
            type="button"
            uk-toggle="target: #cve-comment-modal">
        <?= $text; ?>
    </button>

    <div id="cve-comment-modal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-background-muted">
            <h2 class="uk-modal-title">Yorum Yap</h2>
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <?= cmp_comment_form(''); ?>
        </div>
    </div>
<?php endif; ?>
