<?php

$routes->get('', 'Frontend\Home::index', ['as' => 'homepage']);
$routes->get('(:any)', 'Frontend\Content::index/$1', ['as' => 'content']);
$routes->get('category/(:any)', 'Frontend\Category::index/$1', ['as' => 'category']);