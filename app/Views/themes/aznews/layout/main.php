<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>News HTML-5 Template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?= cve_theme_public('img/favicon.ico'); ?>">

    <?= csrf_meta() ?>
    <!-- CSS here -->
    <link rel="stylesheet" href="<?= cve_theme_public('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= cve_theme_public('css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?= cve_theme_public('css/ticker-style.css'); ?>">
    <link rel="stylesheet" href="<?= cve_theme_public('css/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?= cve_theme_public('css/slicknav.css'); ?>">
    <link rel="stylesheet" href="<?= cve_theme_public('css/animate.min.css'); ?>">
    <link rel="stylesheet" href="<?= cve_theme_public('css/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?= cve_theme_public('css/fontawesome-all.min.css'); ?>">
    <link rel="stylesheet" href="<?= cve_theme_public('css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?= cve_theme_public('css/slick.css'); ?>">
    <link rel="stylesheet" href="<?= cve_theme_public('css/nice-select.css'); ?>">
    <link rel="stylesheet" href="<?= cve_theme_public('css/style.css'); ?>">

    <?php $this->renderSection('style') ?>
</head>
<body>

<?= $this->include('themes/aznews/include/header'); ?>

<main>
    <?php $this->renderSection('content') ?>
</main>

<?= $this->include('themes/aznews/include/footer'); ?>

<!-- All JS Custom Plugins Link Here here -->
<script src="<?= cve_theme_public('js/vendor/modernizr-3.5.0.min.js'); ?>"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="<?= cve_theme_public('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= cve_theme_public('js/popper.min.js'); ?>"></script>
<script src="<?= cve_theme_public('js/bootstrap.min.js'); ?>"></script>
<!-- Jquery Mobile Menu -->
<script src="<?= cve_theme_public('js/jquery.slicknav.min.js'); ?>"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="<?= cve_theme_public('js/owl.carousel.min.js'); ?>"></script>
<script src="<?= cve_theme_public('js/slick.min.js'); ?>"></script>
<!-- Date Picker -->
<script src="<?= cve_theme_public('js/gijgo.min.js'); ?>"></script>
<!-- One Page, Animated-HeadLin -->
<script src="<?= cve_theme_public('js/wow.min.js'); ?>"></script>
<script src="<?= cve_theme_public('js/animated.headline.js'); ?>"></script>
<script src="<?= cve_theme_public('js/jquery.magnific-popup.js'); ?>"></script>

<!-- Breaking New Pluging -->
<script src="<?= cve_theme_public('js/jquery.ticker.js'); ?>"></script>
<script src="<?= cve_theme_public('js/site.js'); ?>"></script>

<!-- Scrollup, nice-select, sticky -->
<script src="<?= cve_theme_public('js/jquery.scrollUp.min.js'); ?>"></script>
<script src="<?= cve_theme_public('js/jquery.nice-select.min.js'); ?>"></script>
<script src="<?= cve_theme_public('js/jquery.sticky.js'); ?>"></script>

<!-- contact js -->
<script src="<?= cve_theme_public('js/contact.js'); ?>"></script>
<script src="<?= cve_theme_public('js/jquery.form.js'); ?>"></script>
<script src="<?= cve_theme_public('js/jquery.validate.min.js'); ?>"></script>
<script src="<?= cve_theme_public('js/mail-script.js'); ?>"></script>
<script src="<?= cve_theme_public('js/jquery.ajaxchimp.min.js'); ?>"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="<?= cve_theme_public('js/plugins.js'); ?>"></script>
<script src="<?= cve_theme_public('js/main.js'); ?>"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<?php $this->renderSection('script') ?>

</body>
</html>