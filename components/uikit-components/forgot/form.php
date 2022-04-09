<div class="uk-card uk-card-body">
    <form class="uk-grid-small" action="<?= cve_route('forgot-password'); ?>" method="post" uk-grid>
        <?= csrf_field(); ?>
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Inputs', 'email'); ?></label>
            <div class="uk-form-controls">
                <input name="email" class="uk-input" id="form-stacked-text" type="text" placeholder="<?= cve_admin_lang('Inputs', 'email'); ?>..." required>
            </div>
        </div>
        <div class="uk-width-1-1@s uk-margin-small-top">
            <button type="submit" class="uk-button uk-button-primary uk-float-right uk-border-rounded"><?= cve_admin_lang('Buttons', 'send_reset_mail'); ?></button>
        </div>
    </form>
</div>


