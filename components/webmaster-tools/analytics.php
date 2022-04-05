<?php if (cve_component_setting('googleAnalytics')): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= cve_component_setting('googleAnalytics') ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?= cve_component_setting('googleAnalytics'); ?>');
    </script>
<?php endif; ?>

<?php if (cve_component_setting('yandexMetrika')): ?>
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(<?= cve_component_setting('yandexMetrika'); ?>, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            ecommerce:"dataLayer"
        });
    </script>
    <noscript>
        <div>
            <img src="https://mc.yandex.ru/watch/<?= cve_component_setting('yandexMetrika'); ?>" style="position:absolute; left:-9999px;" alt="" />
        </div>
    </noscript>
<?php endif; ?>
