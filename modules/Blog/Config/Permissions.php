<?php

namespace Modules\Blog\Config;

use \CodeIgniter\Config\BaseConfig;

class Permissions extends BaseConfig
{
    public $list = [
        'blog_listing'          => 'Admin/Permissions.text.blog_listing',
        'blog_create'           => 'Admin/Permissions.text.blog_create',
        'blog_edit'             => 'Admin/Permissions.text.blog_edit',
        'blog_delete'           => 'Admin/Permissions.text.blog_delete',
        'blog_status'           => 'Admin/Permissions.text.blog_status',
        'blog_undo-delete'      => 'Admin/Permissions.text.blog_undo-delete',
        'blog_purge-delete'     => 'Admin/Permissions.text.blog_purge-delete',
        'admin_blog_edit_all'           => 'Admin/Permissions.text.admin_blog_edit_all',
        'admin_blog_listing_all'        => 'Admin/Permissions.text.admin_blog_listing_all',
        'admin_blog_status_all'         => 'Admin/Permissions.text.admin_blog_status_all',
        'admin_blog_delete_all'         => 'Admin/Permissions.text.admin_blog_delete_all',
        'admin_blog_undo_delete_all'    => 'Admin/Permissions.text.admin_blog_undo_delete_all',
        'admin_blog_purge_delete_all'   => 'Admin/Permissions.text.admin_blog_purge_delete_all',
    ];
}