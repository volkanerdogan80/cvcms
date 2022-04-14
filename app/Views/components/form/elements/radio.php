<div class="selectgroup w-100" id="radio-<?= dot_array_search('name', $options); ?>">
    <?php if (isset($options['options']['object'])): ?>

        <?php
            $opt_value = $options['options']['value'] ?? 'undefined';
            $opt_title = $options['options']['title'] ?? 'undefined';
        ?>

        <?php foreach ($options['options']['object'] as $key => $value): ?>
            <label class="selectgroup-item">
                <input type="radio"
                       id="<?= dot_array_search('id', $options['options']); ?>"
                       name="<?= dot_array_search('name', $options); ?>"
                       value="<?= $value->$opt_value ?? 'undefined'; ?>"
                       class="selectgroup-input <?= dot_array_search('class', $options['options']); ?>"
                       style="<?= dot_array_search('style', $options['options']); ?>"
                    <?= dot_array_search('required', $options); ?>
                    <?= isset($options['value']) && $options['value'] == $value->$opt_value ? 'checked' : ''; ?>
                >
                <span class="selectgroup-button">
                    <?= $value->$opt_title ?? 'undefined'; ?>
                </span>
            </label>
        <?php endforeach; ?>

    <?php elseif (isset($options['options']['ajax'])): ?>

    <?php else: ?>
        <?php foreach ($options['options'] as $key => $value): ?>
            <label class="selectgroup-item">
                <input type="radio"
                       id="<?= dot_array_search('id', $value); ?>"
                       name="<?= dot_array_search('name', $options); ?>"
                       value="<?= $value['value'] ?? 'undefined'; ?>"
                       class="selectgroup-input <?= dot_array_search('class', $value); ?>"
                       style="<?= dot_array_search('style', $value); ?>"
                    <?= dot_array_search('required', $options); ?>
                    <?= isset($options['value']) && $options['value'] == $value['value'] ? 'checked' : ''; ?>
                >
                <span class="selectgroup-button">
                    <?= $value['title'] ?? 'undefined'; ?>
                </span>
            </label>
        <?php endforeach; ?>

    <?php endif; ?>
</div>

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
            let opt_required = '<?= dot_array_search('required', $options); ?>';
            let opt_name = '<?= dot_array_search('name', $options); ?>';
            let items = response.data[key];
            let options = '';
            items.forEach(function (entry) {
                options += '<label class="selectgroup-item">' +
                '<input type="radio" id="'+opt_id+'" name="'+opt_name+'" value="' + entry[opt_value] + '" style="' + opt_style + '" class="selectgroup-input ' + opt_class + '" '+opt_required+'>'+
                '<span class="selectgroup-button">' + entry[opt_title] + '</span>'+
                '</label>';
            });
            $('#radio-'+opt_name).html(options);
        },
        error: function (xhr, opt, error) {
            console.log(error)
        }
    });
    <?php endif; ?>
</script>