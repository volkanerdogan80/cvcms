<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class System extends BaseConfig
{

    public $maintenance = false;

    public $register = true;

    public $login = true;

    public $emailVerify = true;

    public $defaultGroup = 2;

    public $perPageList = [10];

    public $blog = 'blog';
    public $page = 'page';
    public $services = 'services';
    public $projects = 'projects';
    public $ecommerce = 'ecommerce';

    public $modules = [
        'blog' => true,
        'page' => true,
        'services' => false,
        'projects' => false,
        'ecommerce' => false
    ];

    public static $registrars = [
        'App\Controllers\Config'
    ];

}