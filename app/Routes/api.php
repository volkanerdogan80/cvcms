<?php

$routes->match(['get','post'], 'test', 'Api\Test::index', ['as' => 'api_test']);