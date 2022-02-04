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

    public static $registrars = [
        'App\Controllers\Config'
    ];

}