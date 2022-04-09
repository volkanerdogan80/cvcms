<?php if (is_post()): ?>

    <a data-url="<?= cve_route('content_favorite'); ?>"
       data-content="<?= cve_post_id(); ?>"
       class='<?= is_favorite() ? 'animation-favorited' : ''; ?>
       uk-button uk-button-default uk-border-rounded animation-favorite-button animation-favorite'>
      <span class='animation-favorite-icon'>
        <div class='animation-favorite-heart-animation-1'></div>
        <div class='animation-favorite-heart-animation-2'></div>
      </span>
        <?= cve_admin_lang('Buttons', 'favorite'); ?>
        ( <span class="animation-<?= cve_post_id(); ?>-content-favorite-count"><?= cve_post_favorite(); ?></span> )
    </a>

<?php endif; ?>
