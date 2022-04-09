<?php if (is_logged_in()): ?>
    <a class="uk-button uk-button-primary uk-border-rounded uk-margin-small-right" href="<?= cve_route('logout'); ?>">
        <?= cve_admin_lang('Buttons', 'logout'); ?>
    </a>
<?php else: ?>
    <button class="uk-button uk-button-primary uk-border-rounded uk-margin-small-right"
            type="button"
            uk-toggle="target: #uikit-login-modal">
        <?= cve_admin_lang('Buttons', 'login'); ?>
    </button>
<?php endif; ?>

<div id="uikit-login-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-background-muted">
        <h2 class="uk-modal-title"><?= cve_admin_lang('Auth', 'login'); ?></h2>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <?= uikit_login_form(); ?>
    </div>
</div>