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

    public $headerLogo = 'public/admin/img/default/header-logo.png';

    public $footerLogo = 'public/admin/img/default/footer-logo.png';

    public $mobileLogo = 'public/admin/img/default/mobile-logo.png';

    public $favicon    = 'public/admin/img/default/favicon.png';

    public static $registrars = [
        'App\Controllers\Config'
    ];

}