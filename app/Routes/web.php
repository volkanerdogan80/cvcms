<?php

$routes->get('', 'Frontend\Home::index', ['as' => 'homepage']);
$routes->get('category/(:any)', 'Frontend\Category::index/$1', ['as' => 'category']);
$routes->post('comment/reply/(:num)', 'Frontend\Comment::reply/$1', ['as' => 'comment_reply']);
$routes->post('message/send', 'Frontend\Message::send', ['as' => 'message_send']);
$routes->post('content/like/(:num)', 'Frontend\Like::create/$1', ['as' => 'content_like']);
$routes->post('content/vote/(:num)', 'Frontend\Rating::vote/$1', ['as' => 'content_vote']);
$routes->get('content/favorite/(:num)', 'Frontend\Favorite::favorite/$1', ['as' => 'content_favorite']);
$routes->get('(:any)', 'Frontend\Content::index/$1', ['as' => 'content']);