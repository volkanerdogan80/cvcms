<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= cve_title(); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>



<div class="container">
    <div class="jumbotron">
        <h1><?= cve_post_title() ?></h1>
        <p><?= cve_post_description() ?></p>
        <?= cmp_language_dropdown() ?>
    </div>
    <?= cmp_alert_message() ?>
    <div class="row">
        <div class="col-md-12">
            <?= cmp_favorite_button('1') ?>
            <?= cmp_like_button('1') ?>
            <?= cmp_comment_modal() ?>
            <?= cmp_login_modal() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9" style="margin: 10px 0px 10px">
            <?= cmp_user_score_panel() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <?= cmp_register_modal() ?>
            <p><?= cmp_comment_list(true) ?></p>
        </div>
    </div>

</div>

</body>
</html>