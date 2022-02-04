<?php


namespace Config;

use \CodeIgniter\Config\BaseConfig;

class Permissions extends BaseConfig
{
    public $list = [
        'admin_login' => 'Permissions.text.admin_login',
        'group_listing' => 'Permissions.text.group_listing',
        'group_create' => 'Permissions.text.group_create',
        'group_edit' => 'Permissions.text.group_edit',
        'group_delete' => 'Permissions.text.group_delete',
        'group_undo-delete' => 'Permissions.text.group_undo-delete',
        'group_purge-delete' => 'Permissions.text.group_purge-delete',

        'user_listing' => 'Permissions.text.user_listing',
        'user_create' => 'Permissions.text.user_create',
        'user_edit' => 'Permissions.text.user_edit',
        'user_status' => 'Permissions.text.user_status',
        'user_delete' => 'Permissions.text.user_delete',
        'user_undo-delete' => 'Permissions.text.user_undo-delete',
        'user_purge-delete' => 'Permissions.text.user_purge-delete',

        'image_modal'   => 'Permissions.text.image_modal',
        'image_upload'  => 'Permissions.text.image_upload',
        'image_listing' => 'Permissions.text.image_listing',
        'image_delete'  => 'Permissions.text.image_delete',

        'setting_site'    => 'Permissions.text.setting_site',
        'setting_system'  => 'Permissions.text.setting_system',
        'setting_email'   => 'Permissions.text.setting_email',
        'setting_cache'   => 'Permissions.text.setting_cache',
        'setting_image'   => 'Permissions.text.setting_image',
        'setting_webmaster'   => 'Permissions.text.setting_webmaster',
        'setting_firebase'    => 'Permissions.text.setting_firebase',
        'setting_autoshare'   => 'Permissions.text.setting_autoshare',

        'category_listing'  => 'Permissions.text.category_list',
        'category_create'   => 'Permissions.text.category_create',
        'category_edit'     => 'Permissions.text.category_edit',
        'category_status'   => 'Permissions.text.category_status',

        'field_add'         => 'Permissions.text.field_add',

        'blog_listing'          => 'Permissions.text.blog_listing',
        'blog_create'           => 'Permissions.text.blog_create',
        'blog_edit'             => 'Permissions.text.blog_edit',
        'blog_delete'           => 'Permissions.text.blog_delete',
        'blog_status'           => 'Permissions.text.blog_status',
        'blog_undo-delete'      => 'Permissions.text.blog_undo-delete',
        'blog_purge-delete'     => 'Permissions.text.blog_purge-delete',
        'admin_blog_edit_all'           => 'Permissions.text.admin_blog_edit_all',
        'admin_blog_listing_all'        => 'Permissions.text.admin_blog_listing_all',
        'admin_blog_status_all'         => 'Permissions.text.admin_blog_status_all',
        'admin_blog_delete_all'         => 'Permissions.text.admin_blog_delete_all',
        'admin_blog_undo_delete_all'    => 'Permissions.text.admin_blog_undo_delete_all',
        'admin_blog_purge_delete_all'   => 'Permissions.text.admin_blog_purge_delete_all',

        'language_listing' => 'Permissions.text.language_listing',
        'language_create'  => 'Permissions.text.language_create',
        'language_edit'    => 'Permissions.text.language_edit',
        'language_delete'  => 'Permissions.text.language_delete',
        'language_status'  => 'Permissions.text.language_status',
        'language_default' => 'Permissions.text.language_default',
        'language_undo_delete'  => 'Permissions.text.language_undo_delete',
        'language_purge-delete' => 'Permissions.text.language_purge_delete',
    ];
}