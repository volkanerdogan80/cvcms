<?php

$routes->group('blog', ['namespace' => '\Modules\Blog\Controllers'], function ($routes){
    $routes->get('listing(:any)', 'Blog::listing$1', ['as' => 'admin_blog_listing']);
    $routes->match(['post', 'get'],'create', 'Blog::create', ['as' => 'admin_blog_create']);
    $routes->match(['get','post'], 'edit/(:num)', 'Blog::edit/$1', ['as' => 'admin_blog_edit']);
    $routes->post('status', 'Blog::status', ['as' => 'admin_blog_status']);
    $routes->post('delete', 'Blog::delete', ['as' => 'admin_blog_delete']);
    $routes->post('undo-delete', 'Blog::undoDelete', ['as' => 'admin_blog_undo_delete']);
    $routes->post('purge-delete', 'Blog::purgeDelete', ['as' => 'admin_blog_purge_delete']);
});