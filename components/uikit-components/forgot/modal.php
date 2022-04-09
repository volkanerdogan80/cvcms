
<?php if ($button): ?>
<button class="uk-button uk-button-link uk-border-rounded uk-margin-small-right"
        type="button"
        uk-toggle="target: #uikit-forgot-modal">
    <?= cve_admin_lang('Buttons', 'forgot_password'); ?>
</button>
<?php endif; ?>

<div id="uikit-forgot-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-background-muted">
        <h2 class="uk-modal-title"><?= cve_admin_lang('Auth', 'forgot_password'); ?></h2>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <?= uikit_forgot_form(); ?>
    </div>
</div>