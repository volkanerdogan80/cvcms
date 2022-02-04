<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('General', 'now_editing') ?> "<?= $language->getTitle(); ?>"</h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="post">
                    <?= csrf_field(); ?>
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
                                            <img width="30" src="<?= $lang->getFlag(); ?>">
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <?php foreach (cve_language() as $key => $lang): ?>
                                    <div class="tab-pane fade <?= $key == 0 ? 'show active' : ''; ?>" id="<?= $lang->getCode(); ?>" role="tabpanel" aria-labelledby="<?= $lang->getCode(); ?>-tab">
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= $lang->getTitle(); ?> <?= cve_admin_lang_path('Inputs', 'title') ?></label>
                                            <div class="col-sm-12 col-md-8">
                                                <input name="title[<?= $lang->getCode(); ?>]" value="<?= $language->getTitle($lang->getCode()); ?>" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('Inputs', 'country') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <select name="code" class="form-control select2">
                                        <?php foreach (cve_admin_lang_path('Language') as $key => $value): ?>
                                            <option <?= $language->getCode() == $key ? 'selected' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'update') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>