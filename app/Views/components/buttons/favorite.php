<?php if($type === '1'): ?>
    <a class=' <?= is_favorite($content) ? 'cve-favorite-1d' : ''; ?> uk-button uk-button-default uk-border-rounded cve-favorite-1-button cve-favorite'>
      <span class='cve-favorite-1-icon'>
        <div class='cve-favorite-1-heart-animation-1'></div>
        <div class='cve-favorite-1-heart-animation-2'></div>
      </span> Favoriye Ekle ( <span class="cve-favorite-count"><?= cve_post_favorite($content); ?></span> )
    </a>

    <script>
        $('.cve-favorite-1-button').on('click', function(e) {
            $(this).toggleClass('cve-favorite-1d');
        });
    </script>
<?php endif; ?>

