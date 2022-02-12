<script>
    let routes = {
        newsletter_subscribe: '<?= base_url(route_to('newsletter_subscribe')); ?>',
        message_send: '<?= base_url(route_to('message_send')); ?>'
    }
    let message = {
        comment_reply: 'isimli kişiye cevap veriyorsunuz.',
    }
</script>

<?php if($id = cve_post_id()): ?>
    <script>
        routes.content_like = '<?= base_url(route_to('content_like', $id)); ?>';
        routes.content_favorite = '<?= base_url(route_to('content_favorite', $id)); ?>';
        routes.content_vote = '<?= base_url(route_to('content_vote', $id)); ?>';
        routes.content_comment = '<?= base_url(route_to('content_comment', $id))?>';
    </script>
<?php endif; ?>

<script src="<?= base_url(PUBLIC_ADMIN_JS_PATH . 'theme.js') ?>"></script>

<div id="cve-snackbar"></div>
