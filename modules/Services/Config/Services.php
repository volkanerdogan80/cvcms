<?php

namespace Modules\Services\Config;

use CodeIgniter\Config\BaseConfig;

class Services extends BaseConfig
{
    public $sidebar = [
        [
            'title' => 'listing',
            'router' => 'admin_service_listing',
        ],
        [
            'title' => 'create',
            'router' => 'admin_service_create'
        ],
    ];
}
