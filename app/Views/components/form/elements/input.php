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
           value="<?= dot_array_search('value.0', $options); ?>"
           type="<?= dot_array_search('type', $options); ?>"
           class="form-control <?= dot_array_search('class', $options); ?>
           <?= dot_array_search('date', $options); ?>
           <?= dot_array_search('datetime', $options); ?>
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
<?php if ($options['tags']): ?>
    <script>
        $("input[name=<?= $options['name']; ?>]").tagsinput('items');
    </script>
<?php endif; ?>
<?php if ($options['color']): ?>
    <script>
        $("input[name=<?= dot_array_search('name', $options); ?>]").colorpicker({
            format: '<?= dot_array_search('format', $options); ?>'
        });
    </script>
<?php endif; ?>
<?php if ($options['daterange']): ?>
    <script>
        $("input[name=<?= dot_array_search('name', $options); ?>]").daterangepicker({
            locale: {
                format: '<?= dot_array_search('format', $options); ?>',
                cancelLabel: '<?= cve_admin_lang('Buttons', 'clear'); ?>',
                applyLabel: '<?= cve_admin_lang('Buttons', 'apply'); ?>',
                customRangeLabel: '<?= cve_admin_lang('Buttons', 'custom_range'); ?>',
                daysOfWeek: [
                    '<?= cve_admin_lang('General', 'su'); ?>',
                    '<?= cve_admin_lang('General', 'mo'); ?>',
                    '<?= cve_admin_lang('General', 'tu'); ?>',
                    '<?= cve_admin_lang('General', 'we'); ?>',
                    '<?= cve_admin_lang('General', 'th'); ?>',
                    '<?= cve_admin_lang('General', 'fr'); ?>',
                    '<?= cve_admin_lang('General', 'sa'); ?>',

                ],
                monthNames: [
                    '<?= cve_admin_lang('General', 'jan'); ?>',
                    '<?= cve_admin_lang('General', 'feb'); ?>',
                    '<?= cve_admin_lang('General', 'mar'); ?>',
                    '<?= cve_admin_lang('General', 'apr'); ?>',
                    '<?= cve_admin_lang('General', 'may_sh'); ?>',
                    '<?= cve_admin_lang('General', 'jun'); ?>',
                    '<?= cve_admin_lang('General', 'jul'); ?>',
                    '<?= cve_admin_lang('General', 'aug'); ?>',
                    '<?= cve_admin_lang('General', 'sep'); ?>',
                    '<?= cve_admin_lang('General', 'oct'); ?>',
                    '<?= cve_admin_lang('General', 'nov'); ?>',
                    '<?= cve_admin_lang('General', 'dec'); ?>'

                ]
            },
            <?= $options['time'] ? 'timePicker: true,' : 'timePicker: false,' ?>
            timePicker24Hour: true,
            autoApply: false,
            drops: '<?= dot_array_search('drops', $options); ?>',
            opens: '<?= dot_array_search('opens', $options); ?>',
            alwaysShowCalendars: true,
            ranges: {
                '<?= cve_admin_lang('General', 'today'); ?>': [moment(), moment()],
                '<?= cve_admin_lang('General', 'yesterday'); ?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '<?= cve_admin_lang('General', 'last_7_days'); ?>': [moment().subtract(6, 'days'), moment()],
                '<?= cve_admin_lang('General', 'last_30_days'); ?>': [moment().subtract(29, 'days'), moment()],
                '<?= cve_admin_lang('General', 'this_month'); ?>': [moment().startOf('month'), moment().endOf('month')],
                '<?= cve_admin_lang('General', 'last_month'); ?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });
        <?php if ($options['value']): ?>
            $("input[name=<?= dot_array_search('name', $options); ?>]").val('<?= dot_array_search('value', $options); ?>');
        <?php endif; ?>
    </script>
<?php endif; ?>