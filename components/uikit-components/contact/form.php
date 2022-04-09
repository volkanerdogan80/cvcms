<div class="uk-card uk-card-default uk-card-body">
    <form class="uk-grid-small uikit-contact-form" uk-grid action="<?= cve_route('message_send'); ?>">
        <?= csrf_field(); ?>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Inputs', 'full_name'); ?></label>
            <div class="uk-form-controls">
                <input value="<?= auth_user_name(); ?>" name="name" class="uk-input" id="form-stacked-text" type="text" placeholder="<?= cve_admin_lang('Inputs', 'full_name'); ?>..." required>
            </div>
        </div>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Inputs', 'email'); ?></label>
            <div class="uk-form-controls">
                <input value="<?= auth_user_email(); ?>" name="email" class="uk-input" id="form-stacked-text" type="text" placeholder="<?= cve_admin_lang('Inputs', 'email'); ?>..." required>
            </div>
        </div>
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Inputs', 'subject'); ?></label>
            <div class="uk-form-controls">
                <input name="subject" class="uk-input" id="form-stacked-text" type="text" placeholder="<?= cve_admin_lang('Inputs', 'subject'); ?>..." required>
            </div>
        </div>
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Inputs', 'message'); ?></label>
            <div class="uk-form-controls">
                <textarea name="message" class="uk-textarea" rows="5" placeholder="<?= cve_admin_lang('Inputs', 'message'); ?>..." required></textarea>
            </div>
        </div>
        <div class="uk-width-1-1@s">
            <button type="submit" class="uk-button uk-button-primary uk-border-rounded uk-float-right"><?= cve_admin_lang('Buttons', 'send'); ?></button>
        </div>
    </form>
</div>


