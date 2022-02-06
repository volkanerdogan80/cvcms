<?php print_r(cve_post_title());  ?>
<br>
<?php print_r(cve_user_name());  ?>
<br>
<?php

foreach (cve_post_categories() as $category){
    echo cve_cat_title($category);
}

?>
