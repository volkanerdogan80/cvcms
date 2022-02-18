<?php

function cve_site_title()
{
    $locale = service('request')->getLocale();
    return config('site')->title[$locale];
}

function cve_site_header_logo()
{
    return base_url(config('site')->headerLogo);
}