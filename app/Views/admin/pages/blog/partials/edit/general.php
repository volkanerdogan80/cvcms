<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Blogs', 'publication_status') ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input <?= $blog->getStatus() == STATUS_ACTIVE ? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'active') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input <?= $blog->getStatus() == STATUS_PENDING? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_PENDING?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'pending') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input <?= $blog->getStatus() == STATUS_PASSIVE? 'checked': '' ?> type="radio" name="status" value="<?= STATUS_PASSIVE?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'passive') ?></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Blogs', 'comment_status') ?></label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input <?= $blog->getCommentStatus() == STATUS_ACTIVE ? 'checked': '' ?> type="radio" name="comment_status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'active') ?></span>
                    </label>
                    <label class="selectgroup-item">
                        <input <?= $blog->getCommentStatus() == STATUS_PASSIVE ? 'checked': '' ?> type="radio" name="comment_status" value="<?= STATUS_PASSIVE?>" class="selectgroup-input" required>
                        <span class="selectgroup-button"><?= cve_admin_lang_path('Buttons', 'passive') ?></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'categories') ?></label>
                <select name="categories[]" class="form-control select2" multiple="" required>
                    <?php foreach ($categories as $category): ?>
                        <option <?= in_array($category->id, $blog->getCategories()) ? 'selected': ''; ?> value="<?= $category->id; ?>"><?= $category->getTitle(); ?></option>
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
                <?php if($blog->thumbnail == 0 || is_null($blog->thumbnail)){ ?>
                    <?= cve_single_image_picker('blog-image', 'thumbnail', 'blog-image-id'); ?>
                <?php }else{ ?>
                    <?= cve_single_image_picker('blog-image', 'thumbnail', 'blog-image-id', [
                        'image' => $blog->withThumbnail() ? $blog->withThumbnail()->getUrl('187x134') : null,
                        'value' => $blog->getThumbnail()
                    ]); ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label"><?= cve_admin_lang_path('Inputs', 'related_content') ?></label>
                <select name="similar[]" class="form-control select2" multiple="">
                    <?php foreach ($blogs as $s_blog): ?>
                        <option <?= in_array($s_blog->id, $blog->getSimilar()) ? 'selected': ''; ?> value="<?= $s_blog->id; ?>"><?= $s_blog->getTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'update') ?></button>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex">
            <h4><?= cve_admin_lang_path('Blogs', 'social_media_posts') ?></h4>
        </div>
        <div class="card-body">
            <?php foreach($blog->withShare() as $social): ?>
                <div class="mb-4 mt-2">
                    <div class="text-small float-right font-weight-bold text-muted"><?= $blog->withCount($social->social) ?></div>
                    <div class="font-weight-bold mb-1"><?= $social->social ?></div>
                    <div class="progress" data-height="3" style="height: 3px;">
                        <div class="progress-bar"
                             role="progressbar"
                             data-toggle="tooltip"
                             data-original-title="<?= $blog->withCount($social->social) / $blog->withCount() * 100 ?>%"
                             data-width="<?= $blog->withCount($social->social) / $blog->withCount() * 100 ?>%"
                             aria-valuenow="<?= $blog->withCount($social->social) / $blog->withCount() * 100 ?>"
                             aria-valuemin="0"
                             aria-valuemax="100"
                             style="width: 80%;"></div>
                    </div>
                </div>
            <?php endforeach; ?>
            <hr>
            <ul class="list-group">
                <li class=" d-flex justify-content-between align-items-center">
                    <?= cve_admin_lang_path('Blogs', 'total_shares') ?>
                    <span class="badge badge-primary badge-pill"><?= $blog->withCount() != null ? $blog->withCount() : 0 ?></span>
                </li>
            </ul>
        </div>
    </div>
</div>