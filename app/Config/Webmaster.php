<?php


namespace Config;

use \CodeIgniter\Config\BaseConfig;

class Webmaster extends BaseConfig
{
    public $accountId = '';
    public $code = '';
    public $reCaptchaKey = '';

    public static $registrars = [
        'App\Controllers\Config'
    ];

}