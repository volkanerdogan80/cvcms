<?php

namespace Modules\Service\Config;

use CodeIgniter\Config\BaseConfig;

class Menu extends BaseConfig
{

    public $sidebar = [
        [
            'title' => 'listing',
            'child' => [
                [
                    'title' => 'listing',
                    'router' => 'admin_service_listing'
                ],
                [
                    'title' => 'create',
                    'router' => 'admin_service_create'
                ]
            ]
        ]
    ];

}
