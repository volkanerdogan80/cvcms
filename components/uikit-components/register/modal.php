<?php if (!is_logged_in()): ?>
    <button class="uk-button uk-button-link uk-border-rounded uk-margin-small-right"
            type="button"
            uk-toggle="target: #uikit-register-modal">
        <?= cve_admin_lang('Buttons', 'register'); ?>
    </button>
    <div id="uikit-register-modal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-background-muted">
            <h2 class="uk-modal-title"><?= cve_admin_lang('Auth', 'register'); ?></h2>
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <?= uikit_register_form(); ?>
        </div>
    </div>
<?php endif; ?>