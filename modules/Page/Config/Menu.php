<?php

namespace Modules\Page\Config;

use CodeIgniter\Config\BaseConfig;

class Menu extends BaseConfig
{
    public $sidebar = [
        [
            'title' => 'listing',
            'child' => [
                [
                    'title' => 'listing',
                    'router' => 'admin_page_listing',
                ],
                [
                    'title' => 'create',
                    'router' => 'admin_page_create'
                ]
            ]
        ]
    ];
}
