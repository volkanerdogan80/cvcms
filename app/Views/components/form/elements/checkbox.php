<div class="selectgroup selectgroup-pills" id="<?= dot_array_search('name', $options); ?>-checkbox">
    <?php if (isset($options['options']['object'])): ?>

        <?php
            $opt_value = $options['options']['value'] ?? 'undefined';
            $opt_title = $options['options']['title'] ?? 'undefined';
        ?>

        <?php foreach ($options['options']['object'] as $key => $value): ?>
            <label class="selectgroup-item">
                <input type="checkbox"
                       name="<?= dot_array_search('name', $options); ?>"
                       value="<?= $value->$opt_value ?? 'undefined'; ?>"
                       class="selectgroup-input"
                    <?= in_array($value->$opt_value, $options['value']) ? 'checked' : ''; ?>
                >
                <span class="selectgroup-button"><?= $value->$opt_title ?? 'undefined'; ?></span>
            </label>
        <?php endforeach; ?>


    <?php elseif (isset($options['options']['ajax'])): ?>

    <?php else: ?>

        <?php foreach ($options['options'] as $key => $value): ?>
            <label class="selectgroup-item">
                <input type="checkbox"
                       name="<?= dot_array_search('name', $options); ?>"
                       value="<?= dot_array_search('value', $value); ?>"
                       class="selectgroup-input"
                    <?= in_array($value['value'], $options['value']) ? 'checked' : ''; ?>
                >
                <span class="selectgroup-button">
                    <?= dot_array_search('title', $value); ?>
                </span>
            </label>
        <?php endforeach; ?>

    <?php endif; ?>
</div>

<?php if (isset($options['options']['ajax'])): ?>
    <script>
        $.ajax("<?= $options['options']['ajax']; ?>", {
            type: 'GET',
            data: {},
            success: function (response) {
                let key = '<?= $options['options']['item']; ?>';
                let value = <?= json_encode($options['value']); ?>;
                let opt_name = '<?= dot_array_search('name', $options); ?>';
                let opt_value = '<?= dot_array_search('value', $options['options']); ?>';
                let opt_title = '<?= dot_array_search('title', $options['options']); ?>';
                let items = response.data[key];
                let options = '';
                items.forEach(function (entry) {
                    let checked_control = value.filter(val_item => val_item === entry[opt_value] )
                    let opt_checked = checked_control.length > 0 ? 'checked' : '';
                    options += '<label class="selectgroup-item">'+
                        '<input type="checkbox" name="'+opt_name+'" value="'+entry[opt_value]+'" class="selectgroup-input" '+opt_checked+'>'+
                       '<span class="selectgroup-button">'+entry[opt_title]+'</span>'+
                '</label>';
                });
                $('#<?= dot_array_search('name', $options); ?>-checkbox').html(options);
            },
            error: function (xhr, opt, error) {
                console.log(error)
            }
        });
    </script>
<?php endif; ?>