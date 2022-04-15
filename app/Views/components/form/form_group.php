<div class="form-group">
    <label id="<?= dot_array_search('id', $label); ?>"
           class="col-form-label <?= dot_array_search('class', $label); ?>"
           style="<?= dot_array_search('style', $label); ?>"
        <?= dot_array_search('extra', $label); ?>
        <?= dot_array_search('data', $label); ?>
    >
        <?= dot_array_search('title', $label); ?>
    </label>
    <?= $html; ?>
</div>