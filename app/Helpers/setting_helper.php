<?php

function cve_site_title()
{
    $locale = service('request')->getLocale();
    return config('site')->title[$locale];
}

function cve_site_description()
{
    $locale = service('request')->getLocale();
    return config('site')->description[$locale];
}

function cve_site_keywords()
{
    $locale = service('request')->getLocale();
    return config('site')->keywords[$locale];
}

function cve_site_header_logo()
{
    return base_url(config('site')->headerLogo);
}

function cve_site_footer_logo()
{
    return base_url(config('site')->footerLogo);
}

function cve_site_mobile_logo()
{
    return base_url(config('site')->mobileLogo);
}

function cve_site_favicon()
{
    return base_url(config('site')->favicon);
}

function cve_theme_setting($key = null)
{
    if (is_null($key)){
        return config('theme');
    }
    if (isset(config('theme')->$key)){
        return config('theme')->$key;
    }
    return null;
}