<script>
    let routes = {
        newsletter_subscribe: '<?= base_url(route_to('newsletter_subscribe')); ?>',
        message_send: '<?= base_url(route_to('message_send')); ?>',
        firebase_token: '<?= base_url(route_to('firebase_token_create')); ?>'
    }
    let message = {
        comment_reply: 'isimli kişiye cevap veriyorsunuz.',
    }
</script>

<?php if(is_post()): ?>
    <script>
        routes.content_comment = '<?= base_url(route_to('content_comment', cve_post_id()))?>';
    </script>
<?php endif; ?>

<script>
    routes.content_vote = '<?= cve_route('content_vote'); ?>';
    routes.content_like = '<?= cve_route('content_like'); ?>';
    routes.content_favorite = '<?= cve_route('content_favorite'); ?>';
</script>

<script src="<?= base_url(PUBLIC_ADMIN_JS_PATH . 'theme.js') ?>"></script>
<script src="<?= base_url(PUBLIC_ADMIN_JS_PATH . 'uikit.min.js'); ?>"></script>
<script src="<?= base_url(PUBLIC_ADMIN_JS_PATH . 'uikit-icons.min.js'); ?>"></script>
<?php foreach (cve_component_footer() as $key => $value): ?>
<?php if (is_file_extension($value, 'css')): ?>
<link rel="stylesheet" href="<?= $value; ?>">
<?php elseif (is_file_extension($value, 'js')): ?>
<script src="<?= $value; ?>"></script>
<?php elseif (is_file_extension($value, 'php')): ?>
<?php include_once($value); ?>
<?php endif; ?>
<?php endforeach; ?>
<div id="cve-snackbar"></div>
