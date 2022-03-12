<?php

$routes->match(['get','post'], 'test', 'Api\Test::index', ['as' => 'api_test']);

$routes->post('login', 'Api\Login::index', ['as' => 'api_login']);