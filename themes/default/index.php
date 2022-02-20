<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= cve_title(); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" type="text/javascript"></script></head>
<body>
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