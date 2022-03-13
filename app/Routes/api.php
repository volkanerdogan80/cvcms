<?php

$routes->match(['get','post'], 'test', 'Api\Test::index', ['as' => 'api_test']);

$routes->post('login', 'Api\Login::index', ['as' => 'api_login']);
$routes->post('register', 'Api\Register::index', ['as' => 'api_register']);
$routes->post('forgot-password', 'Api\Forgot::index', ['as' => 'api_forgot']);
$routes->post('verification/account', 'Api\Verification::account', ['as' => 'api_account_verify']);
$routes->post('reset-password', 'Api\Reset::index', ['as' => 'api_reset_password']);