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
                <input name="field[<?= $random ?>][key]" value="<?= @$key ?>" placeholder="<?= cve_admin_lang_path('Inputs', 'extra_field_key') ?>" type="text" class="form-control">
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
                            <input name="field[<?= $random ?>][value][<?= $lang->getCode(); ?>]" value="<?= @$value ?>" placeholder="<?= cve_admin_lang_path('Inputs', 'extra_field_value') ?>" type="text" class="form-control">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-1  mt-3">
            <button class="btn btn-danger btn-lg field-remove">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
</div>