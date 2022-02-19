<?php if (!session()->isLogin): ?>
    <button class="uk-button uk-button-<?= $type; ?> uk-margin-small-right"
            type="button"
            uk-toggle="target: #cve-register-modal">
        <?= $text; ?>
    </button>
    <div id="cve-register-modal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-background-muted">
            <h2 class="uk-modal-title">Kayıt Ol</h2>
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <?= cmp_register_form(); ?>
        </div>
    </div>
<?php endif; ?>
