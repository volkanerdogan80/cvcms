<?php

$routes->match(['get','post'], 'test', 'Api\Test::index', ['as' => 'api_test']);

$routes->post('login', 'Api\Login::index', ['as' => 'api_login']);
$routes->post('register', 'Api\Register::index', ['as' => 'api_register']);
$routes->post('forgot-password', 'Api\Forgot::index', ['as' => 'api_forgot']);
$routes->post('verification/account', 'Api\Verification::account', ['as' => 'api_account_verify']);
$routes->post('reset-password', 'Api\Reset::index', ['as' => 'api_reset_password']);

$routes->group('component', function ($routes) {
    $routes->get('listing', 'Api\Component::listing', ['as' => 'api_component_listing']);
    $routes->get('active/(:any)', 'Api\Component::active/$1', ['as' => 'api_component_active']);
    $routes->get('passive/(:any)', 'Api\Component::passive/$1', ['as' => 'api_component_passive']);
    $routes->get('delete/(:any)', 'Api\Component::delete/$1', ['as' => 'api_component_delete']);
    $routes->match(['get', 'post'], 'setting', 'Api\Component::setting', ['as' => 'api_component_setting']);
});