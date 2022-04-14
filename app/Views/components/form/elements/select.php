<select name="<?= dot_array_search('name', $options); ?>"
        class="form-control select2 <?= dot_array_search('class', $options); ?>"
        id="<?= dot_array_search('id', $options); ?>"
        style="<?= dot_array_search('style', $options); ?>"
    <?= dot_array_search('extra', $options); ?>
    <?= dot_array_search('data', $options); ?>
    <?= dot_array_search('required', $options); ?>
    <?= dot_array_search('multiple', $options); ?>
>
    <?php if (isset($options['options']['object'])): ?>

        <?php
        $opt_value = $options['options']['value'] ?? 'undefined';
        $opt_title = $options['options']['title'] ?? 'undefined';
        ?>

        <?php foreach ($options['options']['object'] as $key => $value): ?>
            <option value="<?= $value->$opt_value ?? 'undefined'; ?>"
                    class="<?= dot_array_search('class', $options['options']); ?>"
                    id="<?= dot_array_search('id', $options['options']); ?>"
                    style="<?= dot_array_search('style', $options['options']); ?>"
                <?= isset($options['value']) && $options['value'] == $value->$opt_value ? 'selected' : ''; ?>
            >
                <?= $value->$opt_title ?? 'undefined'; ?>
            </option>
        <?php endforeach; ?>
    <?php elseif (isset($options['options']['ajax'])): ?>

    <?php else: ?>

        <?php foreach ($options['options'] as $key => $value): ?>
            <option id="<?= dot_array_search('id', $value); ?>"
                    class="<?= dot_array_search('class', $value); ?>"
                    value="<?= $value['value'] ?? 'undefined'; ?>"
                    style="<?= dot_array_search('style', $value); ?>"
                <?= isset($options['value']) && $options['value'] == $value['value'] ? 'selected' : ''; ?>
            >
                <?= $value['title'] ?? 'undefined'; ?>
            </option>
        <?php endforeach; ?>

    <?php endif; ?>
</select>


<script>
    <?php if (isset($options['options']['ajax'])): ?>
    $.ajax("<?= $options['options']['ajax']; ?>", {
        type: 'GET',
        data: {},
        success: function (response) {
            let key = '<?= $options['options']['item']; ?>';
            let opt_value = '<?= dot_array_search('value', $options['options']); ?>';
            let opt_title = '<?= dot_array_search('title', $options['options']); ?>';
            let opt_class = '<?= dot_array_search('class', $options['options']); ?>';
            let opt_id = '<?= dot_array_search('id', $options['options']); ?>';
            let opt_style = '<?= dot_array_search('style', $options['options']); ?>';
            let items = response.data[key];
            let options = '';
            items.forEach(function (entry) {
                options += '<option class="' + opt_class + '" id="' + opt_id + '" style="' + opt_style + '" value="' + entry[opt_value] + '">' + entry[opt_title] + '</option>';
            });
            $('select[name=<?= dot_array_search('name', $options); ?>]').html(options);
        },
        error: function (xhr, opt, error) {
            console.log(error)
        }
    });
    <?php endif; ?>
</script>