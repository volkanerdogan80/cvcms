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
        <h1>Bootstrap Tutorial</h1>
    </div>
    <div class="row">
        <div class="col-md-9">
            <p><?= cmp_comment_modal('Gönder', null, 'danger') ?></p>
            <p><?= cmp_comment_list(true) ?></p>
        </div>
    </div>

</div>

</body>
</html>