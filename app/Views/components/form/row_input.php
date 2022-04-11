<div class="form-group row mb-4">
    <label id="<?= dot_array_search('id', $label); ?>"
           class="col-form-label text-md-right col-12 col-md-2 col-lg-2 <?= dot_array_search('class', $label); ?>"
           style="<?= dot_array_search('style', $label); ?>"
        <?= dot_array_search('extra', $label); ?>
        <?= dot_array_search('data', $label); ?>
    >
        <?= dot_array_search('title', $label); ?>
    </label>
    <div class="col-sm-12 col-md-9">
        <?= admin_input($input); ?>
    </div>
</div>