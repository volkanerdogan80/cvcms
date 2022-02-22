<?php

namespace Modules\Blog\Config;

use CodeIgniter\Config\BaseConfig;

class Menu extends BaseConfig
{
    public $sidebar = [
        [
            'title' => 'listing',
            'child' => [
                [
                    'title' => 'listing',
                    'router' => 'admin_blog_listing',
                ],
                [
                    'title' => 'create',
                    'router' => 'admin_blog_create'
                ],
            ]
        ]
    ];

}

