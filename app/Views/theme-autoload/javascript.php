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
        routes.content_like = '<?= base_url(route_to('content_like', cve_post_id())); ?>';
        routes.content_favorite = '<?= base_url(route_to('content_favorite', cve_post_id())); ?>';
        routes.content_vote = '<?= base_url(route_to('content_vote', cve_post_id())); ?>';
        routes.content_comment = '<?= base_url(route_to('content_comment', cve_post_id()))?>';
    </script>
<?php endif; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="<?= base_url(PUBLIC_ADMIN_JS_PATH . 'theme.js') ?>"></script>
<script src="<?= base_url(PUBLIC_ADMIN_JS_PATH . 'uikit.min.js'); ?>"></script>
<script src="<?= base_url(PUBLIC_ADMIN_JS_PATH . 'uikit-icons.min.js'); ?>"></script>

<div id="cve-snackbar"></div>
