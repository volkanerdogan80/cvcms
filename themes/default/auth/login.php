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
        <h1>Giriş Sayfası</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p><?= cmp_login_form(false,true) ?></p>
        </div>
        <div class="col-md-6">
            <p><?= cmp_register_form(true) ?></p>
        </div>
        <div class="col-md-6">
            <p><?= cmp_forgot_form(true) ?></p>
        </div>
    </div>

</div>
</body>
</html>
