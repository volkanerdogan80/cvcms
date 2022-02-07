<?php

/**
 * Returns the title of the current page, if exist otherwise returns site title
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_title()
{
    if ($title = cve_post_title()){
        return $title;
    }elseif($title = cve_cat_title()){
        return $title;
    }else{
        $locale = service('request')->getLocale();
        return config('site')->title[$locale];
    }
}

/**
 * Returns the description of the current page, if exist otherwise returns site description
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_description()
{
    if ($desc = cve_post_description()){
        return $desc;
    }elseif($desc = cve_cat_description()){
        return $desc;
    }else{
        $locale = service('request')->getLocale();
        return config('site')->description[$locale];
    }
}

/**
 * Returns the keywords of the current page, if exist otherwise keywords site title
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_keywords()
{
    if ($keywords = cve_post_keywords()){
        return $keywords;
    }elseif($keywords = cve_cat_keywords()){
        return $keywords;
    }else{
        $locale = service('request')->getLocale();
        return config('site')->keywords[$locale];
    }
}

/**
 * Generates a link to the content sent as a parameter or returns the site homepage link
 * @param null $params | Category ID, Category Slug, Category Entity Object
 * Content ID, Content Slug Content Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|string|null
 */
function cve_link($params = null)
{
    if (cve_post($params)){
        return cve_post_link($params);
    }elseif(cve_category($params)){
        return  cve_cat_link($params);
    }else{
        return base_url(route_to('homepage'));
    }
}

/**
 * Returns content image which is sent as a parameter if exist. Otherwise returns site logo
 * @param null $params | Category ID, Category Slug, Category Entity Object
 * @param null $size | Image dimensions eg: 187x142
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|string|null
 */
function cve_thumbnail($params = null, $size = null)
{
    if ($image = cve_post($params)){
        return cve_post_thumbnail($params, $size);
    }elseif($image = cve_category($params)){
        return cve_cat_image($params, $size);
    }else{
        return base_url(config('site')->headerLogo);
    }
}