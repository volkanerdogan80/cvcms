<?php
$routes->match(['get','post'],'login', 'Backend\Login::index', ['as' => 'admin_login']);
$routes->get('logout', 'Backend\Login::logout', ['as' => 'admin_logout']);
$routes->match(['get','post'],'register', 'Backend\Register::index', ['as' => 'admin_register']);
$routes->match(['get','post'],'forgot-password', 'Backend\Forgot::index', ['as' => 'admin_forgot_password']);
$routes->match(['get', 'post'], 'reset-password/(:segment)', 'Backend\Reset::index/$1', ['as' => 'admin_reset_password']);
$routes->get('permissions/failed', 'Backend\Permissions::error', ['as' => 'admin_permissions_error']);
$routes->get('verification/account/(:segment)', 'Backend\Verification::account/$1', ['as' => 'admin_account_verify']);

$routes->get('dashboard', 'Backend\Dashboard::index', ['as' => 'admin_dashboard']);

$routes->group('group', function ($routes){
    $routes->get('listing(:any)', 'Backend\Groups::listing$1', ['as' => 'admin_group_listing']);
    $routes->match(['get','post'], 'create', 'Backend\Groups::create', ['as' => 'admin_group_create']);
    $routes->match(['get','post'], 'edit/(:num)', 'Backend\Groups::edit/$1', ['as' => 'admin_group_edit']);
    $routes->post('delete', 'Backend\Groups::delete', ['as' => 'admin_group_delete']);
    $routes->post('undo-delete', 'Backend\Groups::undoDelete', ['as' => 'admin_group_undo_delete']);
    $routes->post('purge-delete', 'Backend\Groups::purgeDelete', ['as' => 'admin_group_purge_delete']);
});

$routes->group('user', function ($routes){
    $routes->get('listing(:any)', 'Backend\Users::listing$1', ['as' => 'admin_user_listing']);
    $routes->match(['get','post'], 'create', 'Backend\Users::create', ['as' => 'admin_user_create']);
    $routes->match(['get','post'], 'edit/(:num)', 'Backend\Users::edit/$1', ['as' => 'admin_user_edit']);
    $routes->post('status', 'Backend\Users::status', ['as' => 'admin_user_status']);
    $routes->post('delete', 'Backend\Users::delete', ['as' => 'admin_user_delete']);
    $routes->post('undo-delete', 'Backend\Users::undoDelete', ['as' => 'admin_user_undo_delete']);
    $routes->post('purge-delete', 'Backend\Users::purgeDelete', ['as' => 'admin_user_purge_delete']);
});

$routes->group('image', function ($routes){
    $routes->get('picker', 'Backend\Images::picker', ['as' => 'admin_image_picker']);
    $routes->post('upload', 'Backend\Images::upload', ['as' => 'admin_image_upload']);
    $routes->get('listing', 'Backend\Images::listing', ['as' => 'admin_image_listing']);
    $routes->post('delete', 'Backend\Images::delete', ['as' => 'admin_image_delete']);
    $routes->get('filter', 'Backend\Images::filterAjax', ['as' => 'admin_image_filter']);
});

$routes->group('setting', function ($routes){
    $routes->get('home', 'Backend\Settings::home', ['as' => 'admin_setting_home']);
    $routes->match(['get', 'post'],'site', 'Backend\Settings::site', ['as' => 'admin_setting_site']);
    $routes->match(['get', 'post'],'system', 'Backend\Settings::system', ['as' => 'admin_setting_system']);
    $routes->match(['get', 'post'],'email', 'Backend\Settings::email', ['as' => 'admin_setting_email']);
    $routes->match(['get', 'post'],'cache', 'Backend\Settings::cache', ['as' => 'admin_setting_cache']);
    $routes->match(['get', 'post'],'image', 'Backend\Settings::image', ['as' => 'admin_setting_image']);
    $routes->match(['get', 'post'],'sitemap', 'Backend\Settings::sitemap', ['as' => 'admin_setting_sitemap']);
    $routes->match(['get', 'post'],'webmaster', 'Backend\Settings::webmaster', ['as' => 'admin_setting_webmaster']);
    $routes->match(['get', 'post'],'firebase', 'Backend\Settings::firebase', ['as' => 'admin_setting_firebase']);
    $routes->match(['get', 'post'],'autoshare', 'Backend\Settings::autoshare', ['as' => 'admin_setting_autoshare']);
    $routes->match(['get', 'post'],'social', 'Backend\Settings::social', ['as' => 'admin_setting_social']);
    $routes->match(['get', 'post'],'contact', 'Backend\Settings::contact', ['as' => 'admin_setting_contact']);
});

$routes->group('cache', function ($routes){
    $routes->get('clean', 'Backend\Cache::clean', ['as' => 'admin_cache_clean']);
});

$routes->group('share', function ($routes){
    $routes->post('twitter', 'Backend\AutoShare::twitter', ['as' => 'admin_share_twitter']);
    $routes->post('facebook', 'Backend\AutoShare::facebook', ['as' => 'admin_share_facebook']);
    $routes->match(['get', 'post'],'facebook/callback', 'Backend\AutoShare::facebookCallback', ['as' => 'admin_facebook_callback']);
    $routes->get('facebook/test', 'Backend\AutoShare::facebookTest', ['as' => 'admin_facebook_test']);
    $routes->post('linkedin', 'Backend\AutoShare::linkedIn', ['as' => 'admin_share_linkedin']);
    $routes->match(['get', 'post'],'linkedin/callback', 'Backend\AutoShare::linkedInCallback', ['as' => 'admin_linkedin_callback']);
    $routes->get('linkedin/test', 'Backend\AutoShare::linkedInTest', ['as' => 'admin_linkedin_test']);
});

$routes->group('category', function ($routes){
    $routes->get('listing(:any)', 'Backend\Category::listing$1', ['as' => 'admin_category_listing']);
    $routes->match(['get', 'post'], 'create', 'Backend\Category::create', ['as' => 'admin_category_create']);
    $routes->match(['get','post'], 'edit/(:num)', 'Backend\Category::edit/$1', ['as' => 'admin_category_edit']);
    $routes->post('status', 'Backend\Category::status', ['as' => 'admin_category_status']);
    $routes->post('delete', 'Backend\Category::delete', ['as' => 'admin_category_delete']);
    $routes->post('undo-delete', 'Backend\Category::undoDelete', ['as' => 'admin_category_undo_delete']);
    $routes->post('purge-delete', 'Backend\Category::purgeDelete', ['as' => 'admin_category_purge_delete']);
});

$routes->group('field', function ($routes){
    $routes->get('add', 'Backend\CustomField::add', ['as' => 'admin_field_add']);
    $routes->get('post/format', 'Backend\CustomField::postFormat', ['as' => 'admin_post_format_add']);
});

$routes->group('language', function ($routes){
    $routes->get('listing(:any)', 'Backend\Language::listing$1', ['as' => 'admin_language_listing']);
    $routes->match(['get','post'], 'create', 'Backend\Language::create', ['as' => 'admin_language_create']);
    $routes->match(['get','post'], 'edit/(:num)', 'Backend\Language::edit/$1', ['as' => 'admin_language_edit']);
    $routes->post('status', 'Backend\Language::status', ['as' => 'admin_language_status']);
    $routes->post('default', 'Backend\Language::default', ['as' => 'admin_language_default']);
    $routes->post('delete', 'Backend\Language::delete', ['as' => 'admin_language_delete']);
    $routes->post('undo-delete', 'Backend\Language::undoDelete', ['as' => 'admin_language_undo_delete']);
    $routes->post('purge-delete', 'Backend\Language::purgeDelete', ['as' => 'admin_language_purge_delete']);
    $routes->get('change-language/(:alpha)', 'Backend\Language::change/$1', ['as' => 'admin_language_change']);
});

$routes->group('comment', function ($routes){
    $routes->get('listing(:any)', 'Backend\Comments::listing$1', ['as' => 'admin_comment_listing']);
    $routes->post('status', 'Backend\Comments::status', ['as' => 'admin_comment_status']);
    $routes->post('delete', 'Backend\Comments::delete', ['as' => 'admin_comment_delete']);
    $routes->get('reply-modal', 'Backend\Comments::replyModal', ['as' => 'admin_comment_reply_modal']);
    $routes->post('reply', 'Backend\Comments::reply', ['as' => 'admin_comment_reply']);
    $routes->get('edit-modal', 'Backend\Comments::editModal', ['as' => 'admin_comment_edit_modal']);
    $routes->post('edit', 'Backend\Comments::edit', ['as' => 'admin_comment_edit']);
    $routes->post('undo-delete', 'Backend\Comments::undoDelete', ['as' => 'admin_comment_undo_delete']);
    $routes->post('purge-delete', 'Backend\Comments::purgeDelete', ['as' => 'admin_comment_purge_delete']);
});

$routes->group('menu', function ($routes){
    $routes->get('listing(:any)', 'Backend\Menus::listing$1', ['as' => 'admin_menu_listing']);
    $routes->post('create', 'Backend\Menus::create', ['as' => 'admin_menu_create']);
    $routes->match(['get','post'], 'edit/(:num)', 'Backend\Menus::edit/$1', ['as' => 'admin_menu_edit']);
    $routes->post('delete', 'Backend\Menus::delete', ['as' => 'admin_menu_delete']);
    $routes->post('undo-delete', 'Backend\Menus::undoDelete', ['as' => 'admin_menu_undo_delete']);
    $routes->post('purge-delete', 'Backend\Menus::purgeDelete', ['as' => 'admin_menu_purge_delete']);
    $routes->post('select', 'Backend\Menus::getMenu', ['as' => 'admin_menu_select']);
});

$routes->group('message', function ($routes){
    $routes->get('listing(:any)', 'Backend\Messages::listing$1', ['as' => 'admin_message_listing']);
    $routes->post('detail', 'Backend\Messages::detail', ['as' => 'admin_message_detail']);
    $routes->post('mark-all-read', 'Backend\Messages::markAllRead', ['as' => 'admin_message_all_read']);
    $routes->post('reply', 'Backend\Messages::reply', ['as' => 'admin_message_reply']);
    $routes->post('delete', 'Backend\Messages::delete', ['as' => 'admin_message_delete']);
    $routes->post('undo-delete', 'Backend\Messages::undoDelete', ['as' => 'admin_message_undo_delete']);
    $routes->post('purge-delete', 'Backend\Messages::purgeDelete', ['as' => 'admin_message_purge_delete']);
});

$routes->group('translation', function ($routes){
    $routes->get('listing', 'Backend\Translation::listing', ['as' => 'admin_translation_listing']);
    $routes->post('folder-list', 'Backend\Translation::folderList', ['as' => 'admin_translation_folder_listing']);
    $routes->get('files/(:any)/(:any)', 'Backend\Translation::files/$1/$2', ['as' => 'admin_translation_files']);
    $routes->match(['get', 'post'],'translate/(:any)/(:any)/(:any)', 'Backend\Translation::translate/$1/$2/$3', ['as' => 'admin_translation_translate']);
});

$routes->group('theme', function ($routes){
    $routes->get('listing', 'Backend\Themes::listing', ['as' => 'admin_theme_listing']);
    $routes->get('active/(:any)', 'Backend\Themes::active/$1', ['as' => 'admin_theme_active']);
    $routes->get('delete/(:any)', 'Backend\Themes::delete/$1', ['as' => 'admin_theme_delete']);
    $routes->match(['get', 'post'],'setting', 'Backend\Themes::setting', ['as' => 'admin_theme_setting']);
});

$routes->group('newsletter', function ($routes){
    $routes->get('listing', 'Backend\Newsletter::listing', ['as' => 'admin_newsletter_listing']);
    $routes->post('unsubscribe/(:any)', 'Backend\Newsletter::unsubscribe/$1', ['as' => 'admin_newsletter_unsubscribe']);
});

$routes->group('firebase', function ($routes) {
    $routes->post('notification/send', 'Firebase::send', ['as' => 'admin_firebase_notification_send']);
});

$routes->group('analytics', function ($routes) {
    $routes->get('realtime', 'Backend\Analytics::realtime', ['as' => 'admin_analytics_realtime']);
    $routes->get('metrics', 'Backend\Analytics::metrics', ['as' => 'admin_analytics_metrics']);
    $routes->post('realtime/visitors', 'Backend\Analytics::getRealTimeVisitors', ['as' => 'admin_realtime_visitors']);
});

$routes->group('slider', function ($routes) {
    $routes->get('listing(:any)', 'Backend\Slider::listing$1', ['as' => 'admin_slider_listing']);
    $routes->post('create', 'Backend\Slider::create', ['as' => 'admin_slider_create']);
    $routes->match(['get', 'post'], 'edit/(:num)', 'Backend\Slider::edit/$1', ['as' => 'admin_slider_edit']);
    $routes->post('delete', 'Backend\Slider::delete', ['as' => 'admin_slider_delete']);
    $routes->post('undo-delete', 'Backend\Slider::undoDelete', ['as' => 'admin_slider_undo_delete']);
    $routes->post('purge-delete', 'Backend\Slider::purgeDelete', ['as' => 'admin_slider_purge_delete']);
    $routes->get('new-card', 'Backend\Slider::newCard', ['as' => 'admin_slider_new_card']);
    $routes->get('new-text', 'Backend\Slider::newText', ['as' => 'admin_slider_new_text']);
    $routes->get('new-button', 'Backend\Slider::newButton', ['as' => 'admin_slider_new_button']);
});




