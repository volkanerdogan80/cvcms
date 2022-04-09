<?php if (is_comment_status()): ?>

    <article class="uk-comment uk-comment-primary">
        <form class="uk-grid-small uikit-comment-form" id="uikit-comment-form" uk-grid action="<?= cve_route('content_comment', cve_post_id()) ?>">
            <?= csrf_field(); ?>
            <div class="uk-width-1-2@s">
                <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Inputs', 'full_name'); ?></label>
                <div class="uk-form-controls">
                    <input value="<?= auth_user_name(); ?>" name="name" class="uk-input" id="form-stacked-text" type="text" placeholder="<?= cve_admin_lang('Inputs', 'full_name'); ?>..." required>
                </div>
            </div>
            <div class="uk-width-1-2@s">
                <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Input', 'email'); ?></label>
                <div class="uk-form-controls">
                    <input value="<?= auth_user_email(); ?>" name="email" class="uk-input" id="form-stacked-text" type="text" placeholder="<?= cve_admin_lang('Inputs', 'email'); ?>..." required>
                </div>
            </div>
            <div class="uk-width-1-1@s">
                <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Inputs', 'your_comment'); ?></label>
                <div class="uk-form-controls">
                    <textarea name="comment" class="uk-textarea" rows="5" placeholder="<?= cve_admin_lang('Inputs', 'your_comment'); ?>..." required></textarea>
                </div>
            </div>
            <div class="uk-width-1-1@s">
                <button type="submit" class="uk-button uk-button-primary uk-border-rounded uk-float-right"><?= cve_admin_lang('Buttons', 'send'); ?></button>
            </div>

        </form>
    </article>
<?php endif; ?>

