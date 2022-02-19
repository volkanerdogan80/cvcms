<?php if (is_post() && is_comment_status()): ?>
    <article class="uk-comment uk-comment-primary">
        <form class="uk-grid-small cve-comment-form" id="<?= $id ?>" uk-grid method="post">
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
                <label class="uk-form-label" for="form-stacked-text">Yorumunuz</label>
                <div class="uk-form-controls">
                    <textarea name="comment" class="uk-textarea" rows="5" placeholder="Yorumunuz..."></textarea>
                </div>
            </div>
            <div class="uk-width-1-1@s">
                <button type="submit" class="uk-button uk-button-primary uk-float-right">Gönder</button>
            </div>
        </form>
    </article>
<?php endif; ?>

