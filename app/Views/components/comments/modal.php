<?php if (is_post() && is_comment_status()): ?>

    <?php if ($type == 'link'): ?>
        <button class="uk-button uk-button-<?= $color; ?> uk-margin-small-right"
                type="button"
                uk-toggle="target: #cve-comment-modal">
            <?= $text; ?>
        </button>
    <?php else: ?>
        <button class="uk-button uk-button-<?= $color; ?> uk-margin-small-right"
                type="button"
                uk-toggle="target: #cve-comment-modal">
            <?= $text; ?>
        </button>
    <?php endif; ?>

    <div id="cve-comment-modal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-background-muted">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <?= cmp_comment_form(''); ?>
        </div>
    </div>
<?php endif; ?>
