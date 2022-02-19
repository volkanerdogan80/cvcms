<div class="uk-card <?= $shadow ? 'uk-card-default' : ''; ?> uk-card-body">
    <form class="uk-grid-small" uk-grid action="<?= cve_route('register'); ?>" method="post">
        <?= csrf_field(); ?>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text">Adınız</label>
            <div class="uk-form-controls">
                <input name="first_name" class="uk-input" id="form-stacked-text" type="text" placeholder="Adınız..." required>
            </div>
        </div>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text">Soyadınız</label>
            <div class="uk-form-controls">
                <input name="sur_name" class="uk-input" id="form-stacked-text" type="text" placeholder="Soyadınız..." required>
            </div>
        </div>
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="form-stacked-text">Eposta Adresi</label>
            <div class="uk-form-controls">
                <input name="email" class="uk-input" id="form-stacked-text" type="text" placeholder="Eposta Adresi..." required>
            </div>
        </div>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text">Şifre</label>
            <div class="uk-form-controls">
                <input name="password" class="uk-input" id="form-stacked-text" type="password" placeholder="Şifre..." required>
            </div>
        </div>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text">Şifre Tekrar</label>
            <div class="uk-form-controls">
                <input name="password2" class="uk-input" id="form-stacked-text" type="password" placeholder="Şifre tekrar..." required>
            </div>
        </div>

        <div class="uk-width-3-4@s">
            <div class="uk-width-1-1@s">
                <label style="font-weight: 500">
                    <input name="contract" class="uk-checkbox" type="checkbox" required> Şartları ve Koşulları kabul ediyorum
                </label>
            </div>
            <div class="uk-width-1-1@s">
                <label style="font-weight: 500">
                    <input name="newsletter" class="uk-checkbox" type="checkbox" checked> Kampanya haberleri mail almak istiyorum
                </label>
            </div>
        </div>
        <div class="uk-width-1-4@s">
            <button type="submit" class="uk-button uk-button-primary uk-float-right">Kayıt Ol</button>
        </div>
    </form>
</div>



