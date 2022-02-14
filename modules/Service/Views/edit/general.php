<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'status'); ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input <?= $content->getStatus() == STATUS_ACTIVE ? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'active'); ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input <?= $content->getStatus() == STATUS_PASSIVE ? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'passive'); ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input <?= $content->getStatus() == STATUS_PENDING ? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_PENDING ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'pending'); ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'comment_status'); ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input <?= $content->getCommentStatus() == STATUS_ACTIVE ? 'checked': '' ?> type="radio" name="comment" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'active'); ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input <?= $content->getCommentStatus() == STATUS_PASSIVE ? 'checked': '' ?> type="radio" name="comment" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'passive'); ?></span>
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
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'categories'); ?></label>
                <select name="categories[]" class="form-control select2" multiple="">
                    <?php foreach ($categories as $category): ?>
                        <option <?= in_array($category->id, $content->getCategories()) ? 'selected': ''; ?> value="<?= $category->id; ?>"><?= $category->getTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'related_content'); ?></label>
                <select name="similar[]" class="form-control select2" multiple="">
                    <?php foreach ($similar as $related): ?>
                        <option <?= in_array($related->id, $content->getSimilar()) ? 'selected': ''; ?> value="<?= $related->id; ?>"><?= $related->getTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'thumbnail'); ?></label>
                <br>
                <?= cve_single_image_picker('page-image', 'thumbnail', 'page-image-id', [
                    'image' => $content->withThumbnail() ? $content->withThumbnail()->getUrl('187x134') :  null,
                    'value' => $content->getThumbnail(),
                ]); ?>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'update'); ?></button>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex">
            <h4><?= cve_admin_lang_path('Inputs', 'social_media_posts') ?></h4>
        </div>
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    <?php foreach ($content->withShare() as $social): ?>
                        <li class="list-group-item list-group-item-success"><?= $social->social ?> <?= cve_admin_lang_path('Blog', 'shared'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>