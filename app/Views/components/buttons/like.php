<?php if($type === '1'): ?>
    <a class=' <?= is_liked($content) ? 'cve-like-1d' : ''; ?> uk-button uk-button-default uk-border-rounded cve-like-1-button cve-liked'>
      <span class='cve-like-1-icon'>
        <div class='cve-like-1-heart-animation-1'></div>
        <div class='cve-like-1-heart-animation-2'></div>
      </span>( <span class="cve-like-count"><?= cve_post_liked($content); ?></span> )
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

