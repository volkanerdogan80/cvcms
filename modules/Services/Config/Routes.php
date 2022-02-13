<?php

$routes->group('service', ['namespace' => '\Modules\Services\Controllers'], function ($routes){
    $routes->get('listing', 'Service::listing', ['admin_service_listing']);
});

