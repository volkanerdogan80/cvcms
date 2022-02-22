<?= csrf_meta() ?>
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="">
<?php if (cve_post_id()): ?>
    <meta name="twitter:creator" content="<?= cve_user_twitter(cve_post_author()) ?>">
<?php endif; ?>
<meta name="twitter:title" content="<?= cve_title(); ?>">
<meta name="twitter:description" content="<?= cve_description(); ?>">
<meta name="twitter:image" content="<?= cve_thumbnail(); ?>">

<meta name="og:site_name" content="<?= cve_site_title(); ?>">
<meta name="og:locale" content="<?= cve_language(true)->getCode(); ?>">
<?php if (cve_post_id()): ?>
    <meta name="og:type" content="article" />
<?php else: ?>
    <meta name="og:type" content="website" />
<?php endif; ?>
<meta name="og:url" content="<?= cve_link(); ?>" />
<meta name="og:title" content="<?= cve_title(); ?>" />
<meta name="og:description" content="<?= cve_description(); ?>">
<meta name="og:image" content="<?= cve_thumbnail(); ?>"/>

<meta itemprop="name" content="<?= cve_title(); ?>">
<meta itemprop="description" content="<?= cve_description(); ?>">
<meta itemprop="image" content="<?= cve_thumbnail(); ?>">