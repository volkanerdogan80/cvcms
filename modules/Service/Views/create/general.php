<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'status'); ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('General', 'active'); ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="status" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('General', 'passive'); ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input checked type="radio" name="status" value="<?= STATUS_PENDING ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('General', 'pending'); ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'comment_status') ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="comment_status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'active') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input checked type="radio" name="comment_status" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'passive') ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'social_media_share') ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="social" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('General', 'yes') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input checked type="radio" name="social" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('General', 'no') ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'send_notification') ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="notification" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('General', 'yes') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input checked type="radio" name="notification" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('General', 'no') ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'categories') ?></label>
                <select name="categories[]" class="form-control select2" multiple="" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id; ?>"><?= $category->getTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'related_content'); ?></label>
                <select name="similar[]" class="form-control select2" multiple="">
                    <?php foreach ($similar as $related): ?>
                        <option value="<?= $related->id; ?>"><?= $related->getTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'thumbnail'); ?></label>
                <br>
                <?= cve_single_image_picker('service-image', 'thumbnail', 'service-image-id'); ?>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'save'); ?></button>
        </div>
    </div>
</div>

