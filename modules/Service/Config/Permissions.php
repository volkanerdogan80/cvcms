<?php

namespace Modules\Service\Config;

use \CodeIgniter\Config\BaseConfig;

class Permissions extends BaseConfig
{
    public  $list = [
        'service_listing' => 'Admin/Permissions.text.service_listing',
        'service_create' => 'Admin/Permissions.text.service_create',
        'service_edit' => 'Admin/Permissions.text.service_edit',
        'service_status' => 'Admin/Permissions.text.service_status',
        'service_delete' => 'Admin/Permissions.text.service_delete',
        'service_undo-delete' => 'Admin/Permissions.text.service_undo-delete',
        'service_purge-delete' => 'Admin/Permissions.text.service_purge-delete',
        'admin_service_edit_all' => 'Admin/Permissions.text.admin_service_edit_all',
        'admin_service_listing_all' => 'Admin/Permissions.text.admin_service_listing_all',
        'admin_service_status_all' => 'Admin/Permissions.text.admin_service_status_all',
        'admin_service_delete_all' => 'Admin/Permissions.text.admin_service_delete_all',
        'admin_service_undo_delete_all' => 'Admin/Permissions.text.admin_service_undo_delete_all',
        'admin_service_purge_delete_all' => 'Admin/Permissions.text.admin_service_purge_delete_all',
    ];
}