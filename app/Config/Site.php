<?php


namespace Config;

use \CodeIgniter\Config\BaseConfig;

class Site extends BaseConfig
{

    public $title = [
        'tr' => 'CVE Blog Başlık',
        'en' => 'CVE Blog English Title',
    ];

    public $description = [
        'tr' => 'CVE Blog Açıklama',
        'en' => 'CVE Blog English Description',
    ];

    public $keywords = [
        'tr' => 'cms,cve,blog,php,codeigniter4',
        'en' => 'cms,blog,post,eng,ci4,codeigniter',
    ];

    public $headerLogo = PUBLIC_ADMIN_IMAGE_PATH . 'default/header-logo.png';

    public $footerLogo = PUBLIC_ADMIN_IMAGE_PATH . 'default/footer-logo.png';

    public $mobileLogo = PUBLIC_ADMIN_IMAGE_PATH . 'default/mobile-logo.png';

    public $favicon    = PUBLIC_ADMIN_IMAGE_PATH . 'default/favicon.png';

    public static $registrars = [
        'App\Controllers\Config'
    ];

}