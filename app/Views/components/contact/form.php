<div class="uk-card <?= $shadow ? 'uk-card-default' : ''; ?> uk-card-body">
    <form class="uk-grid-small cve-contact-form" uk-grid>
        <?= csrf_field(); ?>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text">İsim Soyisim</label>
            <div class="uk-form-controls">
                <input name="name" class="uk-input" id="form-stacked-text" type="text" placeholder="İsim Soyisim...">
            </div>
        </div>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text">Eposta Adresi</label>
            <div class="uk-form-controls">
                <input name="email" class="uk-input" id="form-stacked-text" type="text" placeholder="Eposta Adresi...">
            </div>
        </div>
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="form-stacked-text">Konu</label>
            <div class="uk-form-controls">
                <input name="subject" class="uk-input" id="form-stacked-text" type="text" placeholder="Konu...">
            </div>
        </div>
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="form-stacked-text">Mesajınız</label>
            <div class="uk-form-controls">
                <textarea name="message" class="uk-textarea" rows="5" placeholder="Mesajınız..."></textarea>
            </div>
        </div>
        <div class="uk-width-1-1@s">
            <button type="submit" class="uk-button uk-button-primary uk-float-right">Gönder</button>
        </div>
    </form>
</div>


