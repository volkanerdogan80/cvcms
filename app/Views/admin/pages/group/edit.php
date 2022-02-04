<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('General', 'now_editing') ?> "<?= $group->getTitle() ?>"</h1>
            </div>
            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card author-box card-primary">
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
                            <form action="<?= current_url(); ?>" method="POST">
                                <div class="card-body">
                                    <?= csrf_field() ?>
                                    <div class="tab-content" id="myTabContent">
                                        <?php foreach (cve_language() as $key => $lang): ?>
                                            <div class="tab-pane fade <?= $key == 0 ? 'show active' : ''; ?>" id="<?= $lang->getCode(); ?>" role="tabpanel" aria-labelledby="<?= $lang->getCode(); ?>-tab">
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= $lang->getTitle(); ?> <?= cve_admin_lang_path('Inputs', 'group_title') ?></label>
                                                    <div class="col-sm-12 col-md-8">
                                                        <input value="<?= $group->getTitle($lang->getCode()) ?>"
                                                               name="title[<?= $lang->getCode(); ?>]"
                                                               type="text"
                                                               class="form-control"
                                                                <?= $group->getSlug() == DEFAULT_ADMIN_GROUP ? 'disabled' : '' ?>
                                                               required
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="section-title mt-0"><?= cve_admin_lang_path('TableHeaders', 'group_permit') ?></div>
                                        <ul class="list-group">
                                            <?php foreach (config('permissions')->list as $pkey => $pvalue): ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?= lang($pvalue); ?>
                                                    <span class="badge badge-pill">
                                                            <label class="custom-switch mt-2">
                                                                <input type="checkbox" name="permission[<?= $pkey ?>]"
                                                                        class="custom-switch-input"
                                                                        <?= $group->getSlug() == DEFAULT_ADMIN_GROUP ? 'disabled' : '' ?>
                                                                        <?= $group->permitControl($pkey) ? 'checked' : ''; ?>
                                                                >
                                                                <span class="custom-switch-indicator"></span>
                                                            </label>
                                                        </span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button <?= $group->getSlug() == DEFAULT_ADMIN_GROUP ? 'disabled' : '' ?> type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'update') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>