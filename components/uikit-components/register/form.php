<div class="uk-card uk-card-default uk-card-body">
    <form class="uk-grid-small" uk-grid action="<?= cve_route('register'); ?>" method="post">
        <?= csrf_field(); ?>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Inputs', 'first_name'); ?></label>
            <div class="uk-form-controls">
                <input name="first_name" class="uk-input" id="form-stacked-text" type="text" placeholder="<?= cve_admin_lang('Inputs', 'first_name'); ?>..." required>
            </div>
        </div>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Inputs', 'sur_name'); ?></label>
            <div class="uk-form-controls">
                <input name="sur_name" class="uk-input" id="form-stacked-text" type="text" placeholder="<?= cve_admin_lang('Inputs', 'last_name'); ?>..." required>
            </div>
        </div>
        <div class="uk-width-1-1@s">
            <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Inputs', 'email'); ?></label>
            <div class="uk-form-controls">
                <input name="email" class="uk-input" id="form-stacked-text" type="text" placeholder="<?= cve_admin_lang('Inputs', 'email'); ?>..." required>
            </div>
        </div>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Inputs', 'password'); ?></label>
            <div class="uk-form-controls">
                <input name="password" class="uk-input" id="form-stacked-text" type="password" placeholder="<?= cve_admin_lang('Inputs', 'password'); ?>..." required>
            </div>
        </div>
        <div class="uk-width-1-2@s">
            <label class="uk-form-label" for="form-stacked-text"><?= cve_admin_lang('Input', 'password2'); ?></label>
            <div class="uk-form-controls">
                <input name="password2" class="uk-input" id="form-stacked-text" type="password" placeholder="<?= cve_admin_lang('Inputs', 'password2'); ?>..." required>
            </div>
        </div>

        <div class="uk-width-3-4@s">
            <div class="uk-width-1-1@s">
                <label style="font-weight: 500">
                    <input name="contract" class="uk-checkbox" type="checkbox" required> <?= cve_admin_lang('Inputs', 'contract'); ?>
                </label>
            </div>
            <div class="uk-width-1-1@s">
                <label style="font-weight: 500">
                    <input name="newsletter" class="uk-checkbox" type="checkbox" checked> <?= cve_admin_lang('Inputs', 'newsletter'); ?>
                </label>
            </div>
        </div>
        <div class="uk-width-1-4@s">
            <button type="submit" class="uk-button uk-button-primary uk-float-right uk-border-rounded"><?= cve_admin_lang('Buttons', 'register'); ?></button>
        </div>
    </form>
</div>


