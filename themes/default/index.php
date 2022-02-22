<?php cve_theme_include('inc/head') ?>
<div class="container">
    <div class="jumbotron">
        <h1>Ana Sayfa</h1>
    </div>
    <?= cmp_alert_message() ?>

    <div class="row">
        <div class="col-md-9">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= cmp_bootstrap_multilevel_menu('eticaret-baslik') ?>
        </div>
    </div>

</div>
</body>
</html>