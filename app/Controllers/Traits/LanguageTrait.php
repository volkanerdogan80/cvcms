<?php

namespace App\Controllers\Traits;


use CodeIgniter\HTTP\URI;

trait LanguageTrait
{
    public function change($lang)
    {
        $uri = new URI(previous_url());
        $segments = $uri->getSegments();
        $segments[0] = $lang; // kök dizin değişince segment[0] olmalı yoksa çalışmaz!!
        $query = $uri->getQuery();
        $new_uri = implode('/', $segments);
        $new_uri = $query ? $new_uri . '?'. $query : $new_uri;
        return redirect()->to(base_url($new_uri));
    }
}
