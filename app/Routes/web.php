<?php

$routes->get('', 'Frontend\Home::index', ['as' => 'homepage']);
$routes->get('category/(:any)', 'Frontend\Category::index/$1', ['as' => 'category']);
$routes->get('search', 'Frontend\Search::index', ['as' => 'search']);
$routes->post('message/send', 'Frontend\Message::send', ['as' => 'message_send']);
$routes->post('content/like/(:num)', 'Frontend\Like::liked/$1', ['as' => 'content_like']);
$routes->post('content/vote/(:num)', 'Frontend\Rating::voted/$1', ['as' => 'content_vote']);
$routes->post('content/favorite/(:num)', 'Frontend\Favorite::favorite/$1', ['as' => 'content_favorite']);
$routes->post('content/comment/(:num)', 'Frontend\Comment::send/$1', ['as' => 'content_comment']);
$routes->post('newsletter/subscribe', 'Frontend\Newsletter::subscribe', ['as' => 'newsletter_subscribe']);
$routes->get('newsletter/unsubscribe/(:any)', 'Frontend\Newsletter::unsubscribe/$1', ['as' => 'newsletter_unsubscribe']);

$routes->get('language/change/(:alpha)', 'Frontend\Language::change/$1', ['as' => 'language_change']);

$routes->post('register', 'Frontend\Register::register', ['as' => 'register']);
$routes->post('login', 'Frontend\Login::login', ['as' => 'login']);
$routes->post('forgot-password', 'Frontend\Forgot::forgot', ['as' => 'forgot-password']);
$routes->get('logout', 'Frontend\Login::logout', ['as' => 'logout']);

$routes->get('(:any)', 'Frontend\Content::index/$1', ['as' => 'content']);