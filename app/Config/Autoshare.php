<?php


namespace app\Config;

use \CodeIgniter\Config\BaseConfig;

class Autoshare extends BaseConfig
{
    public $twitter = [
        'status'            => false,
        'apiKey'            => '',
        'apiKeySecret'      => '',
        'accessToken'       => '',
        'accessTokenSecret' => '',
        'callbackURL'       => '',
    ];

    public $facebook = [
        'status'        => false,
        'appId'         => '',
        'appSecret'     => '',
        'pageId'        => '',
        'permissions'   => 'pages_manage_posts',
        'accessToken'   => '',
        'callbackURL'   => '',
    ];

    public $linkedin = [
        'status'        => false,
        'appId'         => '',
        'appSecret'     => '',
        'accountId'     => '',
        'scopes'        => 'r_emailaddress r_liteprofile w_member_social',
        'accessToken'   => '',
        'callbackURL'   => '',
    ];

    public $pinterest = [

    ];

    public $medium = [

    ];

    public $googleMyBusiness = [

    ];

    public static $registrars = [
        'App\Controllers\Config'
    ];

}