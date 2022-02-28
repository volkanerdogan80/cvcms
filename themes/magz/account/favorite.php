<?php cve_theme_include('inc/head'); ?>
<?php cve_theme_include('inc/header'); ?>
<section class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ol class="breadcrumb">
                    <li><a href="<?= cve_route('homepage') ?>">Home</a></li>
                    <li class="active"><?= cve_post_title() ?></li>
                </ol>
                <h1 class="page-title"><?= cve_post_title() ?></h1>
                <p class="page-subtitle"><?= cve_post_description() ?></p>
                <div class="line thin"></div>
                <div class="page-description">
                    <?= cve_post_content() ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php cve_theme_include('inc/footer'); ?>
