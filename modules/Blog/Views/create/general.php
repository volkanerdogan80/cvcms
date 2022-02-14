<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'status') ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'active') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="status" value="<?= STATUS_PENDING ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'pending') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input checked type="radio" name="status" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'passive') ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'comment_status') ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input checked type="radio" name="comment_status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'active') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="comment_status" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'passive') ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'social_media_share') ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="social" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'yes') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input checked type="radio" name="social" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'no') ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'send_notification') ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="notification" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'yes') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input checked type="radio" name="notification" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'no') ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'categories') ?></label>
                <select name="categories[]" class="form-control select2" multiple="" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id; ?>"><?= $category->getTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'related_content') ?></label>
                <select name="similar[]" class="form-control select2" multiple="">
                    <?php foreach ($similar as $related): ?>
                        <option value="<?= $related->id; ?>"><?= $related->getTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">Post Format</label>
                <select data-url="<?= base_url(route_to('admin_post_format_add')) ?>" name="post_format" class="form-control select2 post_format">
                    <?php foreach (post_format() as $key => $format): ?>
                        <option value="<?= $key ?>"><?= $format['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'thumbnail') ?></label>
                <br>
                <?= cve_single_image_picker('blog-image', 'thumbnail', 'blog-image-id'); ?>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'save') ?></button>
        </div>
    </div>
</div>

