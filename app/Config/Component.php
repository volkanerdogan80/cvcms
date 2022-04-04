<?php


namespace Config;

use CodeIgniter\Config\BaseConfig;

class Component extends BaseConfig
{
    public static $registrars = [
        'App\Controllers\Config'
    ];
}