<!----------------------------------------------------------------------------------------------------------------------
------------------------------------------------------MAIN SECTION------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------->

<!-- CSS style links, header, content area, footer, JS Links  -->

<!----------------------------------------------------------------------------------------------------------------------
    * These comments are reference for developers who creates or adds new themes for the future.
    * You can remove these on your theme.
    * But it must not removed from default folder since they would be used as reference by the other developers.
----------------------------------------------------------------------------------------------------------------------->

<!-- Example Usage: -->

<!-- CSS style sheet links (Common style sheets) -->
<link rel="stylesheet" href="<?= cve_theme_public('css/your_style.css'); ?>">
<link rel="stylesheet" href="<?= cve_theme_public('css/your_style1.css'); ?>">
<link rel="stylesheet" href="<?= cve_theme_public('css/your_style2.css'); ?>">

<!-- CSS style sheet links (Includes style links from other pages which use specific CSS styles) -->
<?php $this->renderSection('style') ?>

<!-- Header (Includes header section. path: 'themes/default/include/header') -->
<?= $this->include('themes/default/include/header'); ?>

<!-- Content Area (Includes header section [themes/default/index.php]) -->
<?php $this->renderSection('content') ?>

<!-- Footer (includes header section. path: 'themes/default/include/footer') -->
<?= $this->include('themes/default/include/footer'); ?>

<!-- JS links (Common JS files) -->
<script src="<?= cve_theme_public('js/your_script.js'); ?>"></script>
<script src="<?= cve_theme_public('js/your_script1.js'); ?>"></script>
<script src="<?= cve_theme_public('js/your_script2.js'); ?>"></script>

<!-- JS links (Includes JS links from other pages which use specific JS files) -->
<?php $this->renderSection('script') ?>



