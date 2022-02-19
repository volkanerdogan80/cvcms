<?php if (session()->isLogin): ?>
    <a class="uk-button uk-button-<?= $type; ?> uk-margin-small-right" href="<?= cve_route('logout'); ?>">
        <?= $logout_text; ?>
    </a>
<?php else: ?>
    <button class="uk-button uk-button-<?= $type; ?> uk-margin-small-right"
            type="button"
            uk-toggle="target: #cve-login-modal">
        <?= $login_text; ?>
    </button>
<?php endif; ?>

<div id="cve-login-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-background-muted">
        <h2 class="uk-modal-title">Giriş Yap</h2>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <?= cmp_login_form(true, false); ?>
    </div>
</div>
