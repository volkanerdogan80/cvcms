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
    public $registerPage = null;
    public $loginPage = null;
    public $forgotPage = null;

    public $install =false;

    public $perPageList = [];

    public static $registrars = [
        'App\Controllers\Config'
    ];

}