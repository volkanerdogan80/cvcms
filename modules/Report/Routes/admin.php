<?php
$routes->group('report', ['namespace' => '\Modules\Report\Controllers'],function ($routes){
    $routes->get('listing(:any)', 'Report::listing$1', ['as' => 'admin_report_listing']);
    $routes->match(['post', 'get'],'create', 'Report::create', ['as' => 'admin_report_create']);
    $routes->match(['get','post'], 'edit/(:num)', 'Report::edit/$1', ['as' => 'admin_report_edit']);
    $routes->post('status', 'Report::status', ['as' => 'admin_report_status']);
    $routes->post('delete', 'Report::delete', ['as' => 'admin_report_delete']);
    $routes->match(['post', 'get'],'detail/(:num)', 'Report::detail/$1', ['as' => 'admin_report_detail']);
    $routes->post('undo-delete', 'Report::undoDelete', ['as' => 'admin_report_undo_delete']);
    $routes->post('purge-delete', 'Report::purgeDelete', ['as' => 'admin_report_purge_delete']);
});
