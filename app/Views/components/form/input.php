<input
    name="<?= dot_array_search('name', $options); ?>"
    value="<?= dot_array_search('value', $options); ?>"
    type="<?= dot_array_search('type', $options); ?>"
    class="form-control <?= dot_array_search('class', $options); ?>"
    id="<?= dot_array_search('id', $options); ?>"
    style="<?= dot_array_search('style', $options); ?>"
    placeholder="<?= dot_array_search('placeholder', $options); ?>"
    <?= dot_array_search('extra', $options); ?>
    <?= dot_array_search('data', $options); ?>
    <?= dot_array_search('required', $options); ?>
>