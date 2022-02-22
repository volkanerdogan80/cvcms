<?php

namespace Modules\Page\Config;

use \CodeIgniter\Config\BaseConfig;

class Permissions extends BaseConfig
{
    public $list = [
        'page_listing' => 'Admin/Permissions.text.page_listing',
        'page_create' => 'Admin/Permissions.text.page_create',
        'page_edit' => 'Admin/Permissions.text.page_edit',
        'page_status' => 'Admin/Permissions.text.page_status',
        'page_delete' => 'Admin/Permissions.text.page_delete',
        'page_undo-delete' => 'Admin/Permissions.text.page_undo-delete',
        'page_purge-delete' => 'Admin/Permissions.text.page_purge-delete',
        'admin_page_edit_all' => 'Admin/Permissions.text.admin_page_edit_all',
        'admin_page_listing_all' => 'Admin/Permissions.text.admin_page_listing_all',
        'admin_page_status_all' => 'Admin/Permissions.text.admin_page_status_all',
        'admin_page_delete_all' => 'Admin/Permissions.text.admin_page_delete_all',
        'admin_page_undo_delete_all' => 'Admin/Permissions.text.admin_page_undo_delete_all',
        'admin_page_purge_delete_all' => 'Admin/Permissions.text.admin_page_purge_delete_all',
    ];
}