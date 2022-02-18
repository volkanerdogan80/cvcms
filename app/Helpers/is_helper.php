<?php

function is_post()
{
    if (cve_post_id()){
        return true;
    }
    return false;
}

function is_blog_post()
{
    if (is_post() && cve_post_module() == 'blog'){
        return true;
    }
    return false;
}

function is_page_post()
{
    if (is_post() && cve_post_module() == 'blog'){
        return true;
    }
    return false;
}

function is_service_post()
{
    if (is_post() && cve_post_module() == 'service'){
        return true;
    }
    return false;
}

function is_product_post()
{
    if (is_post() && cve_post_module() == 'product'){
        return true;
    }
    return false;
}
