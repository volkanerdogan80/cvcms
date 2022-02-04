<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'status'); ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input <?= $page->getStatus() == STATUS_ACTIVE ? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'active'); ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input <?= $page->getStatus() == STATUS_PASSIVE ? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'passive'); ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input <?= $page->getStatus() == STATUS_PENDING ? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_PENDING ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('General', 'pending'); ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'thumbnail'); ?></label>
                <br>
                <?= cve_single_image_picker('page-image', 'thumbnail', 'page-image-id', [
                    'image' => $page->withThumbnail() ? $page->withThumbnail()->getUrl('187x134') :  null,
                    'value' => $page->getThumbnail(),
                ]); ?>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'page_template_select'); ?></label>
                <select name="page_type" class="form-control select2">
                    <?php foreach ($template_list as $key => $value): ?>
                        <option <?= $key == $page->getPageType() ? 'selected' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'update'); ?></button>
        </div>
    </div>
</div>