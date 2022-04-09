<?= csrf_meta() ?>
<link rel="stylesheet" href="<?= base_url(PUBLIC_ADMIN_CSS_PATH . 'theme.css'); ?>">
<?php foreach (cve_component_head() as $key => $value): ?>
<?php if (is_file_extension($value, 'css')): ?>
<link rel="stylesheet" href="<?= $value; ?>">
<?php elseif (is_file_extension($value, 'js')): ?>
<script src="<?= $value; ?>"></script>
<?php elseif (is_file_extension($value, 'php')): ?>
<?php include_once($value); ?>
<?php endif; ?>
<?php endforeach; ?>
