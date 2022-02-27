<?php

namespace Modules\Report\Config;

use CodeIgniter\Config\BaseConfig;

class Menu extends BaseConfig
{
    public $sidebar = [
        [
            'title' => 'listing',
            'child' => [
                [
                    'title' => 'listing',
                    'router' => 'admin_report_listing',
                ],
                [
                    'title' => 'create',
                    'router' => 'admin_report_create'
                ]
            ]
        ]
    ];
}
