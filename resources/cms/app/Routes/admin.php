<?php

$routes->group('admin', function ($routes){
    $routes->match(['get','post'],'login', 'Backend\Login::index', ['as' => 'admin_login']);
    $routes->get('logout', 'Backend\Login::logout', ['as' => 'admin_logout']);
    $routes->match(['get','post'],'register', 'Backend\Register::index', ['as' => 'admin_register']);
    $routes->match(['get','post'],'forgot-password', 'Backend\Forgot::index', ['as' => 'admin_forgot_password']);
    $routes->match(['get','post'],'reset-password', 'Backend\Forgot::resetPassword', ['as' => 'admin_reset_password']);
    $routes->get('permissions/failed', 'Backend\Permissions::error', ['as' => 'admin_permissions_error']);
    $routes->group('verification', function ($routes){
        $routes->get('account/(:segment)', 'Backend\Verification::account/$1', ['as' => 'admin_account_verify']);
        $routes->get('forgot-password/(:segment)', 'Backend\Verification::forgot/$1', ['as' => 'admin_forgot_verify']);
    });

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
    });

    $routes->group('setting', function ($routes){
        $routes->get('home', 'Backend\Settings::home', ['as' => 'admin_setting_home']);
        $routes->match(['get', 'post'],'site', 'Backend\Settings::site', ['as' => 'admin_setting_site']);
        $routes->match(['get', 'post'],'system', 'Backend\Settings::system', ['as' => 'admin_setting_system']);
        $routes->match(['get', 'post'],'email', 'Backend\Settings::email', ['as' => 'admin_setting_email']);
        $routes->match(['get', 'post'],'cache', 'Backend\Settings::cache', ['as' => 'admin_setting_cache']);
        $routes->match(['get', 'post'],'image', 'Backend\Settings::image', ['as' => 'admin_setting_image']);
        $routes->match(['get', 'post'],'webmaster', 'Backend\Settings::webmaster', ['as' => 'admin_setting_webmaster']);
        $routes->match(['get', 'post'],'firebase', 'Backend\Settings::firebase', ['as' => 'admin_setting_firebase']);
        $routes->match(['get', 'post'],'autoshare', 'Backend\Settings::autoshare', ['as' => 'admin_setting_autoshare']);
    });

    $routes->group('cache', function ($routes){
        $routes->get('clean', 'Backend\Cache::clean', ['as' => 'admin_cache_clean']);
    });

    $routes->group('share', function ($routes){
        $routes->match(['get', 'post'],'linkedin/callback', 'Backend\AutoShare::linkedInCallback', ['as' => 'admin_linkedin_callback']);
        $routes->match(['get', 'post'],'facebook/callback', 'Backend\AutoShare::facebookCallback', ['as' => 'admin_facebook_callback']);
        $routes->get('linkedin/test', 'Backend\AutoShare::linkedInTest', ['as' => 'admin_linkedin_test']);
        $routes->post('twitter', 'Backend\AutoShare::twitter', ['as' => 'admin_share_twitter']);
        $routes->post('linkedin', 'Backend\AutoShare::linkedIn', ['as' => 'admin_share_linkedin']);
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
    });

    $routes->group('blog', function ($routes){
        $routes->get('listing(:any)', 'Backend\Blog::listing$1', ['as' => 'admin_blog_listing']);
        $routes->match(['post', 'get'],'create', 'Backend\Blog::create', ['as' => 'admin_blog_create']);
        $routes->match(['get','post'], 'edit/(:num)', 'Backend\Blog::edit/$1', ['as' => 'admin_blog_edit']);
        $routes->post('status', 'Backend\Blog::status', ['as' => 'admin_blog_status']);
        $routes->post('delete', 'Backend\Blog::delete', ['as' => 'admin_blog_delete']);
        $routes->post('undo-delete', 'Backend\Blog::undoDelete', ['as' => 'admin_blog_undo_delete']);
        $routes->post('purge-delete', 'Backend\Blog::purgeDelete', ['as' => 'admin_blog_purge_delete']);
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
        $routes->get('change-language/(:alpha)', 'Backend\Language::changeLanguage/$1', ['as' => 'admin_language_change']);
    });

});



