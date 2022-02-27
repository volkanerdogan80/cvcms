<?php

namespace Modules\Report\Config;

use \CodeIgniter\Config\BaseConfig;

class Permissions extends BaseConfig
{
    public $list = [
        'report_listing' => 'Admin/Permissions.text.report_listing',
        'report_create' => 'Admin/Permissions.text.report_create',
        'report_edit' => 'Admin/Permissions.text.report_edit',
        'report_status' => 'Admin/Permissions.text.report_status',
        'report_delete' => 'Admin/Permissions.text.report_delete',
        'report_undo-delete' => 'Admin/Permissions.text.report_undo-delete',
        'report_purge-delete' => 'Admin/Permissions.text.report_purge-delete',
        'admin_report_edit_all' => 'Admin/Permissions.text.admin_report_edit_all',
        'admin_report_listing_all' => 'Admin/Permissions.text.admin_report_listing_all',
        'admin_report_status_all' => 'Admin/Permissions.text.admin_report_status_all',
        'admin_report_delete_all' => 'Admin/Permissions.text.admin_report_delete_all',
        'admin_report_undo_delete_all' => 'Admin/Permissions.text.admin_report_undo_delete_all',
        'admin_report_purge_delete_all' => 'Admin/Permissions.text.admin_report_purge_delete_all',
    ];
}