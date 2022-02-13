<?php

namespace Modules\Service\Config;

use CodeIgniter\Config\BaseConfig;

class Service extends BaseConfig
{

    public $menu = [
        [
            'title' => 'listing',
            'router' => 'admin_service_listing'
        ],
        [
            'title' => 'create',
            'router' => 'admin_service_create'
        ],
    ];

}