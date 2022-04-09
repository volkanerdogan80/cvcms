<?php

$routes->match(['get','post'], 'test', 'Api\Test::index', ['as' => 'api_test']);

$routes->post('login', 'Api\Login::index', ['as' => 'api_login']);
$routes->post('register', 'Api\Register::index', ['as' => 'api_register']);
$routes->post('forgot-password', 'Api\Forgot::index', ['as' => 'api_forgot']);
$routes->post('verification/account', 'Api\Verification::account', ['as' => 'api_account_verify']);
$routes->post('reset-password', 'Api\Reset::index', ['as' => 'api_reset_password']);
$routes->group('cache', function ($routes) {
    $routes->get('clean', 'Api\Cache::clean', ['as' => 'api_cache_clean']);
});
$routes->group('user', function ($routes) {
    $routes->get('listing(:any)', 'Api\Users::listing$1', ['as' => 'api_user_listing']);
    $routes->post('create', 'Api\Users::create', ['as' => 'api_user_create']);
    $routes->post('edit/(:num)', 'Api\Users::edit/$1', ['as' => 'api_user_edit']);
    $routes->post('status', 'Api\Users::status', ['as' => 'api_user_status']);
    $routes->post('delete', 'Api\Users::delete', ['as' => 'api_user_delete']);
    $routes->post('undo-delete', 'Api\Users::undoDelete', ['as' => 'api_user_undo_delete']);
    $routes->post('purge-delete', 'Api\Users::purgeDelete', ['as' => 'api_user_purge_delete']);
});
$routes->group('group', function ($routes) {
    $routes->get('listing(:any)', 'Api\Groups::listing$1', ['as' => 'api_group_listing']);
    $routes->match(['get', 'post'], 'create', 'Api\Groups::create', ['as' => 'api_group_create']);
    $routes->match(['get', 'post'], 'edit/(:num)', 'Api\Groups::edit/$1', ['as' => 'api_group_edit']);
    $routes->post('delete', 'Api\Groups::delete', ['as' => 'api_group_delete']);
    $routes->post('undo-delete', 'Api\Groups::undoDelete', ['as' => 'api_group_undo_delete']);
    $routes->post('purge-delete', 'Api\Groups::purgeDelete', ['as' => 'api_group_purge_delete']);
});
$routes->group('category', function ($routes) {
    $routes->get('listing(:any)', 'Api\Category::listing$1', ['as' => 'api_category_listing']);
    $routes->match(['get', 'post'], 'create', 'Api\Category::create', ['as' => 'api_category_create']);
    $routes->match(['get', 'post'], 'edit/(:num)', 'Api\Category::edit/$1', ['as' => 'api_category_edit']);
    $routes->post('status', 'Api\Category::status', ['as' => 'api_category_status']);
    $routes->post('delete', 'Api\Category::delete', ['as' => 'api_category_delete']);
    $routes->post('undo-delete', 'Api\Category::undoDelete', ['as' => 'api_category_undo_delete']);
    $routes->post('purge-delete', 'Api\Category::purgeDelete', ['as' => 'api_category_purge_delete']);
});
$routes->group('comment', function ($routes) {
    $routes->get('listing(:any)', 'Api\Comment::listing$1', ['as' => 'api_comment_listing']);
    $routes->post('status', 'Api\Comment::status', ['as' => 'api_comment_status']);
    $routes->post('delete', 'Api\Comment::delete', ['as' => 'api_comment_delete']);
    $routes->get('reply-modal', 'Api\Comment::replyModal', ['as' => 'api_comment_reply_modal']);
    $routes->post('reply', 'Api\Comment::reply', ['as' => 'api_comment_reply']);
    $routes->get('edit-modal', 'Api\Comment::editModal', ['as' => 'api_comment_edit_modal']);
    $routes->post('edit', 'Api\Comment::edit', ['as' => 'api_comment_edit']);
    $routes->post('undo-delete', 'Api\Comment::undoDelete', ['as' => 'api_comment_undo_delete']);
    $routes->post('purge-delete', 'Api\Comment::purgeDelete', ['as' => 'api_comment_purge_delete']);
});
$routes->group('message', function ($routes) {
    $routes->get('listing(:any)', 'Api\Messages::listing$1', ['as' => 'api_message_listing']);
    $routes->post('detail', 'Api\Messages::detail', ['as' => 'api_message_detail']);
    $routes->post('mark-all-read', 'Api\Messages::markAllRead', ['as' => 'api_message_all_read']);
    $routes->post('reply', 'Api\Messages::reply', ['as' => 'api_message_reply']);
    $routes->post('delete', 'Api\Messages::delete', ['as' => 'api_message_delete']);
    $routes->post('undo-delete', 'Api\Messages::undoDelete', ['as' => 'api_message_undo_delete']);
    $routes->post('purge-delete', 'Api\Messages::purgeDelete', ['as' => 'api_message_purge_delete']);
});
$routes->group('component', function ($routes) {
    $routes->get('listing', 'Api\Component::listing', ['as' => 'api_component_listing']);
    $routes->get('active/(:any)', 'Api\Component::active/$1', ['as' => 'api_component_active']);
    $routes->get('passive/(:any)', 'Api\Component::passive/$1', ['as' => 'api_component_passive']);
    $routes->get('delete/(:any)', 'Api\Component::delete/$1', ['as' => 'api_component_delete']);
    $routes->match(['get', 'post'], 'setting', 'Api\Component::setting', ['as' => 'api_component_setting']);
});