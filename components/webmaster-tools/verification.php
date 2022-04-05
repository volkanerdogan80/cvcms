<?php if (cve_component_setting('googleVerify')): ?>
    <meta name="google-site-verification" content="<?= cve_component_setting('googleVerify'); ?>" />
<?php endif; ?>

<?php if (cve_component_setting('yandexVerify')): ?>
    <meta name="yandex-verification" content="<?= cve_component_setting('yandexVerify'); ?>" />
<?php endif; ?>
