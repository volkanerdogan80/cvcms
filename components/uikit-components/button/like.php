<?php if (is_post()): ?>

<a data-url="<?= cve_route('content_like'); ?>"
   data-content="<?= cve_post_id(); ?>"
   class='<?= is_liked() ? 'animation-liked' : ''; ?>
   uk-button uk-button-default uk-border-rounded animation-like-button animation-like'>
      <span class='animation-like-icon'>
        <div class='animation-like-heart-animation-1'></div>
        <div class='animation-like-heart-animation-2'></div>
      </span>
    <?= cve_admin_lang('Buttons', 'like') ?>
    ( <span class="animation-<?= cve_post_id(); ?>-content-like-count"><?= cve_post_liked(); ?></span> )
</a>

<?php endif; ?>
