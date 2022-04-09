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
        <?= language_change_dropdown(); ?>
    </div>
    <?php uikit_alert_message() ?>
    <div class="row">
        <div class="col-md-12">
            <?= uikit_favorite_button() ?>
            <?= uikit_like_button() ?>
            <?= uikit_comment_modal() ?>
            <?= uikit_login_modal() ?>
            <?= uikit_register_modal() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9" style="margin: 10px 0 10px">
            <?= uikit_user_score_panel() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <?= uikit_comment_form(); ?>
            <?= uikit_comment_list(); ?>
        </div>
    </div>

</div>

</body>
</html>