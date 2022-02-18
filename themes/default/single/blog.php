<html>
<head>
    <title><?= cve_title(); ?></title>
</head>
<body>
<p><?= cve_post_title() ?></p>

<?php
    foreach (cve_post_keywords(null,true) as $keyword){
        echo cve_tag_link($keyword);
    }

?>
</body>
</html>