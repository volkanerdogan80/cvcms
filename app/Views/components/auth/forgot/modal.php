<?php if($button): ?>
    <button class="uk-button uk-button-<?= $type; ?> uk-margin-small-right"
            type="button"
            uk-toggle="target: #cve-forgot-modal">
        <?= $text; ?>
    </button>
<?php endif; ?>

<div id="cve-forgot-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-background-muted">
        <h2 class="uk-modal-title">Şifremi Unuttum</h2>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <?= cmp_forgot_form(); ?>
    </div>
</div>
