<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Sitemap extends BaseConfig
{

    public $modules     = [];

    public static $registrars = [
        'App\Controllers\Config'
    ];

}