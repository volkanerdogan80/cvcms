<?php

namespace Modules\Page\Config;

use CodeIgniter\Config\BaseConfig;

class Page extends BaseConfig
{
    public $menu = [
        [
            'title' => 'listing',
            'router' => 'admin_page_listing',
        ],
        [
            'title' => 'create',
            'router' => 'admin_page_create'
        ],
    ];
}
