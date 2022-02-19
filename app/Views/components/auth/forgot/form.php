<div class="uk-card <?= $shadow ? 'uk-card-default' : ''; ?> uk-card-body">
    <form class="uk-grid-small" action="<?= cve_route('forgot-password'); ?>" method="post" uk-grid>
        <?= csrf_field(); ?>
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="form-stacked-text">Eposta Adresi</label>
            <div class="uk-form-controls">
                <input name="email" class="uk-input" id="form-stacked-text" type="text" placeholder="Eposta Adresi..." required>
            </div>
        </div>

        <div class="uk-width-1-1@s">
            <button type="submit" class="uk-button uk-button-primary uk-float-right">Şifre Sıfırlama Maili Gönder</button>
        </div>
    </form>
</div>

