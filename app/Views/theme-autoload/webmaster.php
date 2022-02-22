<?php if (config('webmaster')->googleVerify): ?>
    <meta name="google-site-verification" content="<?= config('webmaster')->googleVerify ?>" />
<?php endif; ?>

<?php if (config('webmaster')->yandexVerify): ?>
    <meta name="yandex-verification" content="<?= config('webmaster')->yandexVerify ?>" />
<?php endif; ?>

<?php if (config('webmaster')->googleAnalytics): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= config('webmaster')->googleAnalytics ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?= config('webmaster')->googleAnalytics ?>');
    </script>
<?php endif; ?>

<?php if (config('webmaster')->yandexMetrika): ?>
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(<?= config('webmaster')->yandexMetrika ?>, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            ecommerce:"dataLayer"
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/<?= config('webmaster')->yandexMetrika ?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<?php endif; ?>

<?php if (config('webmaster')->code): ?>
    <?php  config('webmaster')->code; ?>
<?php endif; ?>
