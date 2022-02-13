<?php
$routes->group('page', ['namespace' => '\Modules\Page\Controllers'],function ($routes){
    $routes->get('listing(:any)', 'Page::listing$1', ['as' => 'admin_page_listing']);
    $routes->match(['post', 'get'],'create', 'Page::create', ['as' => 'admin_page_create']);
    $routes->match(['get','post'], 'edit/(:num)', 'Page::edit/$1', ['as' => 'admin_page_edit']);
    $routes->post('status', 'Page::status', ['as' => 'admin_page_status']);
    $routes->post('delete', 'Page::delete', ['as' => 'admin_page_delete']);
    $routes->post('undo-delete', 'Page::undoDelete', ['as' => 'admin_page_undo_delete']);
    $routes->post('purge-delete', 'Page::purgeDelete', ['as' => 'admin_page_purge_delete']);
});