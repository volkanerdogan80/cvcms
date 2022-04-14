<div class="input-group">
    <?php if (array_key_exists('prepend', $options)): ?>
        <div class="input-group-prepend">
            <div class="input-group-text">
                <?php if (substr($options['prepend'], 0, 1) == '<'): ?>
                    <?= $options['prepend']; ?>
                <?php else: ?>
                    <i class="<?= $options['prepend']; ?>"></i>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <input name="<?= dot_array_search('name', $options); ?>"
           value="<?= dot_array_search('value', $options); ?>"
           type="<?= dot_array_search('type', $options); ?>"
           class="form-control <?= dot_array_search('class', $options); ?>
           <?= $options['type'] == 'password' ? $options['name'] . '-pwstrength' : '' ?>"
           id="<?= dot_array_search('id', $options); ?>"
           style="<?= dot_array_search('style', $options); ?>"
           placeholder="<?= dot_array_search('placeholder', $options); ?>"
        <?= $options['type'] == 'password' ? 'data-indicator="'.$options['name'].'-pwindicator"' : '' ?>
        <?= dot_array_search('extra', $options); ?>
        <?= dot_array_search('data', $options); ?>
        <?= dot_array_search('required', $options); ?>
    >
    <?php if (array_key_exists('append', $options)): ?>
        <div class="input-group-append">
            <div class="input-group-text">
                <?php if (substr($options['append'], 0, 1) == '<'): ?>
                    <?= $options['append']; ?>
                <?php else: ?>
                    <i class="<?= $options['append']; ?>"></i>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php if ($options['type'] == 'password'): ?>
    <div id="<?= $options['name'].'-pwindicator'; ?>" class="<?= $options['name'].'-pwindicator'; ?>">
        <div class="bar"></div>
        <div class="label"></div>
    </div>
    <script>
        $(".<?= $options['name'] . '-pwstrength'; ?>").pwstrength();
    </script>
<?php endif; ?>
<?php if (isset($options['tags']) && $options['tags']): ?>
    <script>
        $("input[name=<?= $options['name']; ?>]").tagsinput('items');
    </script>
<?php endif; ?>
<?php if (isset($options['color']) && $options['color']): ?>
    <script>
        $("input[name=<?= dot_array_search('name', $options); ?>]").colorpicker({
            format: '<?= dot_array_search('format', $options); ?>'
        });
    </script>
<?php endif; ?>
