<div class="uk-card <?= $shadow ? 'uk-card-default' : ''; ?> uk-card-body">
    <form class="uk-grid-small" action="<?= cve_route('login'); ?>" method="post" uk-grid>
        <?= csrf_field(); ?>
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="form-stacked-text">Eposta Adresi</label>
            <div class="uk-form-controls">
                <input name="email" class="uk-input" id="form-stacked-text" type="text" placeholder="Eposta Adresi...">
            </div>
        </div>
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="form-stacked-text">Şifre</label>
            <div class="uk-form-controls">
                <input name="password" class="uk-input" id="form-stacked-text" type="password" placeholder="Şifre...">
            </div>
        </div>

        <?php if ($is_modal): ?>
            <input type="hidden" name="is_modal" value="1">
        <?php endif; ?>
        <div class="uk-width-3-4@s">
            <button class="uk-button uk-button-link uk-margin-small-right"
                    type="button"
                    uk-toggle="target: #cve-forgot-modal">
                Şifremi Unuttum
            </button>
        </div>
        <div class="uk-width-1-4@s">
            <button type="submit" class="uk-button uk-button-primary uk-float-right">Giriş Yap</button>
        </div>
    </form>
    <?= cmp_forgot_modal('Şifremi Unuttum', false, false); ?>
</div>

