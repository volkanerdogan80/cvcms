<?php


namespace Config;

use \CodeIgniter\Config\BaseConfig;

class Permissions extends BaseConfig
{
    public $list = [
        'user_login'    => 'Admin/Permissions.text.user_login',
        'admin_login'   => 'Admin/Permissions.text.admin_login',
        'group_listing' => 'Admin/Permissions.text.group_listing',
        'group_create'  => 'Admin/Permissions.text.group_create',
        'group_edit'    => 'Admin/Permissions.text.group_edit',
        'group_delete'  => 'Admin/Permissions.text.group_delete',
        'group_undo-delete'     => 'Admin/Permissions.text.group_undo-delete',
        'group_purge-delete'    => 'Admin/Permissions.text.group_purge-delete',

        'user_listing'      => 'Admin/Permissions.text.user_listing',
        'user_create'       => 'Admin/Permissions.text.user_create',
        'user_edit'         => 'Admin/Permissions.text.user_edit',
        'user_status'       => 'Admin/Permissions.text.user_status',
        'user_delete'       => 'Admin/Permissions.text.user_delete',
        'user_undo-delete'  => 'Admin/Permissions.text.user_undo-delete',
        'user_purge-delete' => 'Admin/Permissions.text.user_purge-delete',

        'image_modal'   => 'Admin/Permissions.text.image_modal',
        'image_upload'  => 'Admin/Permissions.text.image_upload',
        'image_listing' => 'Admin/Permissions.text.image_listing',
        'image_delete'  => 'Admin/Permissions.text.image_delete',

        'setting_site'    => 'Admin/Permissions.text.setting_site',
        'setting_system'  => 'Admin/Permissions.text.setting_system',
        'setting_email'   => 'Admin/Permissions.text.setting_email',
        'setting_cache'   => 'Admin/Permissions.text.setting_cache',
        'setting_image'   => 'Admin/Permissions.text.setting_image',
        'setting_sitemap' => 'Admin/Permissions.text.setting_sitemap',
        'setting_webmaster'   => 'Admin/Permissions.text.setting_webmaster',
        'setting_firebase'    => 'Admin/Permissions.text.setting_firebase',
        'setting_autoshare'   => 'Admin/Permissions.text.setting_autoshare',
        'setting_social'      => 'Admin/Permissions.text.setting_social',
        'setting_contact'     => 'Admin/Permissions.text.setting_contact',

        'category_listing'  => 'Admin/Permissions.text.category_listing',
        'category_create'   => 'Admin/Permissions.text.category_create',
        'category_edit'     => 'Admin/Permissions.text.category_edit',
        'category_status'   => 'Admin/Permissions.text.category_status',

        'field_add'         => 'Admin/Permissions.text.field_add',
        'share_twitter'     => 'Admin/Permissions.text.share_twitter',
        'share_facebook'    => 'Admin/Permissions.text.share_facebook',
        'share_linkedin'    => 'Admin/Permissions.text.share_linkedin',


        'language_listing' => 'Admin/Permissions.text.language_listing',
        'language_create'  => 'Admin/Permissions.text.language_create',
        'language_edit'    => 'Admin/Permissions.text.language_edit',
        'language_delete'  => 'Admin/Permissions.text.language_delete',
        'language_status'  => 'Admin/Permissions.text.language_status',
        'language_default' => 'Admin/Permissions.text.language_default',
        'language_undo_delete'  => 'Admin/Permissions.text.language_undo_delete',
        'language_purge-delete' => 'Admin/Permissions.text.language_purge_delete',

        'comment_listing'   => 'Admin/Permissions.text.comment_listing',
        'comment_status'    => 'Admin/Permissions.text.comment_status',
        'comment_delete'    => 'Admin/Permissions.text.comment_delete',
        'comment_reply'     => 'Admin/Permissions.text.comment_reply',
        'comment_edit'      => 'Admin/Permissions.text.comment_reply',
        'comment_undo_delete'       => 'Admin/Permissions.text.comment_reply',
        'comment_purge_delete'      => 'Admin/Permissions.text.comment_purge_delete',
        'admin_comment_listing_all' => 'Admin/Permissions.text.admin_comment_listing_all',
        'admin_comment_status_all'  => 'Admin/Permissions.text.admin_comment_status_all',
        'admin_comment_delete_all'  => 'Admin/Permissions.text.admin_comment_delete_all',
        'admin_comment_reply_all'   => 'Admin/Permissions.text.admin_comment_reply_all',
        'admin_comment_undo_delete_all' => 'Admin/Permissions.text.admin_comment_undo_delete_all',
        'admin_comment_purge_delete_all' => 'Admin/Permissions.text.admin_comment_purge_delete_all',
        'admin_comment_edit_all' => 'Admin/Permissions.text.admin_comment_edit_all',

        'menu_listing'  => 'Admin/Permissions.text.menu_listing',
        'menu_edit'     => 'Admin/Permissions.text.menu_edit',
        'menu_create'   => 'Admin/Permissions.text.menu_create',
        'menu_delete'   => 'Admin/Permissions.text.menu_delete',
        'menu_undo-delete'  => 'Admin/Permissions.text.menu_undo-delete',
        'menu_purge-delete' => 'Admin/Permissions.text.menu_purge-delete',

        'message_listing' => 'Admin/Permissions.text.message_listing',
        'message_detail' => 'Admin/Permissions.text.message_detail',
        'message_reply'  => 'Admin/Permissions.text.message_reply',
        'message_delete' => 'Admin/Permissions.text.message_delete',
        'message_undo-delete' => 'Admin/Permissions.text.message_undo-delete',
        'message_purge-delete' => 'Admin/Permissions.text.message_purge-delete',

        'translation_listing' => 'Admin/Permissions.text.translation_listing',
        'translation_files' => 'Admin/Permissions.text.translation_files',
        'translation_translate' => 'Admin/Permissions.text.translation_translate',

        'theme_listing' => 'Admin/Permissions.text.theme_listing',
        'theme_delete' => 'Admin/Permissions.text.theme_delete',
        'theme_active' => 'Admin/Permissions.text.theme_active',
        'theme_setting' => 'Admin/Permissions.text.theme_setting',
        'admin_theme_setting_update' => 'Admin/Permissions.text.admin_theme_setting_update',

        'newsletter_listing' => 'Admin/Permissions.text.newsletter_listing',
        'newsletter_unsubscribe' => 'Admin/Permissions.text.newsletter_unsubscribe',

        'admin_firebase_notification_send' => 'Admin/Permissions.text.admin_firebase_notification_send',

        'analytics_realtime' => 'Admin/Permissions.text.analytics_realtime',
        'analytics_metrics' => 'Admin/Permissions.text.analytics_metrics',

        'slider_listing' => 'Admin/Permissions.text.slider_listing',
        'slider_create' => 'Admin/Permissions.text.slider_create',
        'slider_edit' => 'Admin/Permissions.text.slider_edit',
        'slider_delete' => 'Admin/Permissions.text.slider_delete',
        'slider_undo-delete' => 'Admin/Permissions.text.slider_undo-delete',
        'slider_purge-delete' => 'Admin/Permissions.text.slider_purge-delete',
    ];
}