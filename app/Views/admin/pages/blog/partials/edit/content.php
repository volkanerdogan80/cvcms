<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php foreach (cve_language() as $key => $lang): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $key == 0 ? 'active' : ''; ?> "
                           id="<?= $lang->getCode(); ?>-tab"
                           data-toggle="tab"
                           href="#<?= $lang->getCode(); ?>"
                           role="tab"
                           aria-controls="<?= $lang->getCode(); ?>"
                           aria-selected="true">
                            <img width="20" src="<?= $lang->getFlag(); ?>">
                            <?= $lang->getTitle(); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <?php foreach (cve_language() as $key => $lang): ?>
                    <div class="tab-pane fade <?= $key == 0 ? 'show active' : ''; ?>" id="<?= $lang->getCode(); ?>" role="tabpanel" aria-labelledby="<?= $lang->getCode(); ?>-tab">
                        <div class="form-group">
                            <label class="col-form-label"><?= $lang->getTitle(); ?> <?= cve_admin_lang_path('Inputs', 'title') ?></label>
                            <input name="title[<?= $lang->getCode(); ?>]" value="<?= $blog->getTitle($lang->getCode()); ?>" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"><?= $lang->getTitle(); ?> <?= cve_admin_lang_path('Inputs', 'content') ?></label>
                            <textarea name="content[<?= $lang->getCode(); ?>]" class="form-control ckedtor" id="content-<?= $lang->getCode(); ?>" style="height: 150px"><?= $blog->getContent($lang->getCode()); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"><?= $lang->getTitle(); ?> <?= cve_admin_lang_path('Inputs', 'summary') ?></label>
                            <textarea name="description[<?= $lang->getCode(); ?>]" class="form-control" style="height: 100px"><?= $blog->getDescription($lang->getCode()); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"><?= $lang->getTitle(); ?> <?= cve_admin_lang_path('Inputs', 'keywords') ?></label>
                            <input name="keywords[<?= $lang->getCode(); ?>]" value="<?= $blog->getKeywords($lang->getCode()); ?>" type="text" class="form-control inputtags">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>