<?php if($type === '1'): ?>
    <a data-content="<?= cve_post_id($content) ?>" class=' <?= is_liked($content) ? 'cve-like-1d' : ''; ?> uk-button uk-button-default uk-border-rounded cve-like-1-button cve-liked'>
      <span class='cve-like-1-icon'>
        <div class='cve-like-1-heart-animation-1'></div>
        <div class='cve-like-1-heart-animation-2'></div>
      </span>( <span class="cve-<?= cve_post_id($content) ?>-content-like-count"><?= cve_post_liked($content); ?></span> )
    </a>

    <script>
        $('.cve-like-1-button').on('click', function(e) {
            let classControl = $(this).hasClass('cve-like-1d');
            if (!classControl){
                $(this).toggleClass('cve-like-1d');
            }
        });
    </script>
<?php endif; ?>

