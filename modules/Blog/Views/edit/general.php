<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'status') ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input <?= $content->getStatus() == STATUS_ACTIVE ? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'active') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input <?= $content->getStatus() == STATUS_PENDING? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_PENDING?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'pending') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input <?= $content->getStatus() == STATUS_PASSIVE? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_PASSIVE?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'passive') ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'comment_status') ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input <?= $content->getCommentStatus() == STATUS_ACTIVE ? 'checked': '' ?> type="radio" name="comment_status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang('Buttons', 'active') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input <?= $content->getCommentStatus() == STATUS_PASSIVE ? 'checked': '' ?> type="radio" name="comment_status" value="<?= STATUS_PASSIVE?>" class="selectgroup-input" required>
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
                        <option <?= in_array($category->id, $content->getCategories()) ? 'selected': ''; ?> value="<?= $category->id; ?>"><?= $category->getTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'related_content') ?></label>
                <select name="similar[]" class="form-control select2" multiple="">
                    <?php foreach ($similar as $related): ?>
                        <option <?= in_array($related->id, $content->getSimilar()) ? 'selected': ''; ?> value="<?= $related->id; ?>"><?= $related->getTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'post_format') ?></label>
                <select data-url="<?= base_url(route_to('admin_post_format_add')) ?>" name="post_format" class="form-control select2 post_format">
                    <?php foreach (cve_content_format() as $key => $format): ?>
                        <option <?= $content->getPostFormat() == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $format['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang('Inputs', 'thumbnail') ?></label>
                <br>
                <?php if($content->thumbnail == 0 || is_null($content->thumbnail)){ ?>
                    <?= cve_single_image_picker('blog-image', 'thumbnail', 'blog-image-id'); ?>
                <?php }else{ ?>
                    <?= cve_single_image_picker('blog-image', 'thumbnail', 'blog-image-id', [
                        'image' => $content->withThumbnail() ? $content->withThumbnail()->getUrl('187x134') : null,
                        'value' => $content->getThumbnail()
                    ]); ?>
                <?php } ?>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'update') ?></button>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex">
            <h4><?= cve_admin_lang('Inputs', 'social_media_posts') ?></h4>
        </div>
        <div class="card-body">
            <?php foreach($content->withShare() as $social): ?>
                <div class="mb-4 mt-2">
                    <div class="text-small float-right font-weight-bold text-muted"><?= $content->withCount($social->social) ?></div>
                    <div class="font-weight-bold mb-1"><?= $social->social ?></div>
                    <div class="progress" data-height="3" style="height: 3px;">
                        <div class="progress-bar"
                             role="progressbar"
                             data-toggle="tooltip"
                             data-original-title="<?= $content->withCount($social->social) / $content->withCount() * 100 ?>%"
                             data-width="<?= $content->withCount($social->social) / $content->withCount() * 100 ?>%"
                             aria-valuenow="<?= $content->withCount($social->social) / $content->withCount() * 100 ?>"
                             aria-valuemin="0"
                             aria-valuemax="100"
                             style="width: 80%;"></div>
                    </div>
                </div>
            <?php endforeach; ?>
            <hr>
            <ul class="list-group">
                <li class=" d-flex justify-content-between align-items-center">
                    <?= cve_admin_lang('Inputs', 'total_shares') ?>
                    <span class="badge badge-primary badge-pill"><?= $content->withCount() != null ? $content->withCount() : 0 ?></span>
                </li>
            </ul>
        </div>
    </div>
</div>