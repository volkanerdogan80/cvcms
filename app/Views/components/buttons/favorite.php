<?php if($type === '1'): ?>
    <a data-count="cve-<?= cve_post_id($content); ?>-content-favorite-count" data-content="<?= cve_post_id($content); ?>" class=' <?= is_favorite($content) ? 'cve-favorite-1d' : ''; ?> uk-button uk-button-default uk-border-rounded cve-favorite-1-button cve-favorite'>
      <span class='cve-favorite-1-icon'>
        <div class='cve-favorite-1-heart-animation-1'></div>
        <div class='cve-favorite-1-heart-animation-2'></div>
      </span> ( <span class="cve-<?= cve_post_id($content); ?>-content-favorite-count"><?= cve_post_favorite($content); ?></span> )
    </a>

    <script>
        $('.cve-favorite-1-button').on('click', function(e) {
            $(this).toggleClass('cve-favorite-1d');
        });
    </script>
<?php endif; ?>


