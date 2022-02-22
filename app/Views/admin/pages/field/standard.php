<div class="custom-field">
    <div class="row mb-4">
        <div class="col-md-3">
            <input name="field[<?= $random ?>][key]" value="<?= @$key ?>" placeholder="<?= cve_admin_lang('Inputs', 'extra_field_key') ?>" type="text" class="form-control">
        </div>
        <div class="col-md-8">
            <input name="field[<?= $random ?>][value]" value="<?= @$value ?>" placeholder="<?= cve_admin_lang('Inputs', 'extra_field_value') ?>" type="text" class="form-control">
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger btn-lg field-remove">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
</div>