<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4><?= cve_admin_lang('General', 'extra_fields'); ?></h4>
            <div class="card-header-action">
                <div class="btn-group dropleft">
                    <button style="border-radius: 5px !important;" class="btn btn-primary dropdown-toggle"
                            type="button" id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <?= cve_admin_lang('Buttons', 'add_extra_fields'); ?>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item new-field"
                           data-url="<?= base_url(route_to("admin_field_add")); ?>"
                           data-type="standard">
                            <?= cve_admin_lang('Buttons', 'fixed_fields'); ?>
                        </a>
                        <a class="dropdown-item new-field"
                           data-url="<?= base_url(route_to("admin_field_add")); ?>"
                           data-type="translation">
                            <?= cve_admin_lang('Buttons', 'language_option'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" id="custom-field">
            <?php foreach ($content->getAllField() as $fKey => $fValue): ?>

                <?php $random = random_string('alpha', 4); ?>
                <div class="custom-field">
                    <?php if (is_object($fValue)): ?>
                        <div class="custom-field">
                            <ul class="nav nav-tabs" style="border-bottom: 0px" id="myTab" role="tablist">
                                <?php foreach (cve_language() as $key => $lang): ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= $key == 0 ? 'active' : ''; ?> "
                                           id="<?= $lang->getCode(); ?>-tab"
                                           data-toggle="tab"
                                           href="#<?= $random; ?>-<?= $lang->getCode(); ?>"
                                           role="tab"
                                           aria-controls="<?= $random; ?>-<?= $lang->getCode(); ?>"
                                           aria-selected="true">
                                            <img width="20" src="<?= $lang->getFlag(); ?>">
                                            <?= $lang->getTitle(); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="form-group mt-3">
                                        <input name="field[<?= $random ?>][key]" value="<?= $fKey ?>" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="tab-content" id="myTabContent">
                                        <?php foreach (cve_language() as $key => $lang): ?>
                                            <div class="tab-pane fade <?= $key == 0 ? 'show active' : ''; ?>"
                                                 id="<?= $random; ?>-<?= $lang->getCode(); ?>"
                                                 role="tabpanel"
                                                 aria-labelledby="<?= $random; ?>-<?= $lang->getCode(); ?>-tab"
                                                 style="padding: 0px"
                                            >
                                                <div class="form-group mt-3">
                                                    <input name="field[<?= $random ?>][value][<?= $lang->getCode(); ?>]" value="<?= $content->getField($fKey, $lang->getCode()); ?>" type="text" class="form-control">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-md-1  mt-3">
                                    <button class="btn btn-danger btn-lg field-remove">
                                        <?= cve_admin_lang('Buttons', 'delete'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="custom-field">
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <input name="field[<?= $random; ?>][key]" value="<?= $fKey ?>" type="text" class="form-control">
                                </div>
                                <div class="col-md-8">
                                    <input name="field[<?= $random ?>][value]" value="<?= $fValue ?>" type="text" class="form-control">
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-danger btn-lg field-remove">
                                        <?= cve_admin_lang('Buttons', 'delete'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>