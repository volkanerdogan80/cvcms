<?php

$routes->get('', 'Frontend\Home::index', ['as' => 'homepage']);
$routes->get('category/(:any)', 'Frontend\Category::index/$1', ['as' => 'category']);
$routes->post('comment/reply/(:num)', 'Frontend\Comment::reply/$1', ['as' => 'comment_reply']);
$routes->post('message/send', 'Frontend\Message::send', ['as' => 'message_send']);
$routes->post('content/like/(:num)', 'Frontend\Like::liked/$1', ['as' => 'content_like']);
$routes->post('content/vote/(:num)', 'Frontend\Rating::voted/$1', ['as' => 'content_vote']);
$routes->post('content/favorite/(:num)', 'Frontend\Favorite::favorite/$1', ['as' => 'content_favorite']);
$routes->post('newsletter/subscribe', 'Frontend\Newsletter::subscribe', ['as' => 'newsletter_subscribe']);
$routes->get('newsletter/unsubscribe/(:any)', 'Frontend\Newsletter::unsubscribe/$1', ['as' => 'newsletter_unsubscribe']);
$routes->get('(:any)', 'Frontend\Content::index/$1', ['as' => 'content']);