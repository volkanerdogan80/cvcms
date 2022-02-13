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

    //TODO: Bu alan multi modül sisteminde gerekli değil ama birden fazla modül alıp aynı yerden yönetmek isteyenler için kullanışlı olabilir şimdilik dursun
    /*public $blog = 'blog';
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
    ];*/

    public static $registrars = [
        'App\Controllers\Config'
    ];

}