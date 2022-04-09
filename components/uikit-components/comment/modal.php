<?php if (is_comment_status()): ?>

    <button class="uk-button uk-button-primary uk-border-rounded uk-margin-small-right"
            type="button"
            uk-toggle="target: #cve-comment-modal">
        <?= cve_admin_lang('Buttons', 'comment'); ?>
    </button>

    <div id="cve-comment-modal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-background-muted">
            <h2 class="uk-modal-title"><?= cve_admin_lang('Comments', 'comment'); ?></h2>
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <?= uikit_comment_form(); ?>
        </div>
    </div>
<?php endif; ?>
