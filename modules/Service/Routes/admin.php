<?php

$routes->group('service', ['namespace' => '\Modules\Service\Controllers'], function ($routes) {
    $routes->get('listing(:any)', 'Service::listing$1', ['as' => 'admin_service_listing']);
    $routes->match(['post', 'get'], 'create', 'Service::create', ['as' => 'admin_service_create']);
    $routes->match(['get', 'post'], 'edit/(:num)', 'Service::edit/$1', ['as' => 'admin_service_edit']);
    $routes->post('status', 'Service::status', ['as' => 'admin_service_status']);
    $routes->post('delete', 'Service::delete', ['as' => 'admin_service_delete']);
    $routes->post('undo-delete', 'Service::undoDelete', ['as' => 'admin_service_undo_delete']);
    $routes->post('purge-delete', 'Service::purgeDelete', ['as' => 'admin_service_purge_delete']);
});
