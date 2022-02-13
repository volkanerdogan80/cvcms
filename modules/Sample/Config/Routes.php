<?php

$routes->group('sample', ['namespace' => '\Modules\Sample\Controllers'], function ($routes){
    $routes->get('listing', 'Sample::listing', ['admin_sample_listing']);
});

