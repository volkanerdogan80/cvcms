<?php


namespace Config;

use \CodeIgniter\Config\BaseConfig;

class Webmaster extends BaseConfig
{

    public $googleVerify = '';
    public $googleAnalytics = '';

    public $yandexVerify = '';
    public $yandexMetrika = '';

    public $accountId = '';

    public $code = '';

    public $reCaptchaKey = '';

    public static $registrars = [
        'App\Controllers\Config'
    ];

}