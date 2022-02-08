<?php

$routes->get('', 'Frontend\Home::index', ['as' => 'homepage']);
$routes->get('category/(:any)', 'Frontend\Category::index/$1', ['as' => 'category']);
$routes->post('comment/reply/(:num)', 'Frontend\Comment::reply/$1', ['as' => 'comment_reply']);
$routes->post('message/send', 'Frontend\Message::send', ['as' => 'message_send']);
$routes->get('(:any)', 'Frontend\Content::index/$1', ['as' => 'content']);