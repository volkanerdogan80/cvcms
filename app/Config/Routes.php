<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Frontend\Home::index');
$routes->get('sitemap.xml', 'Sitemap::listing', ['as' => 'sitemap.listing']);
$routes->get('sitemap-(:any)-(:num).xml', 'Sitemap::generate/$1/$2', ['as' => 'sitemap.generate']);

$routes->get('firebase-messaging-sw.js', 'Firebase::index');
$routes->post('firebase/token/create', 'Firebase::create', ['as' => 'firebase_token_create']);
$routes->get('{locale}/test', 'Home::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

if (file_exists(APPPATH . 'Routes/install.php'))
{
    require APPPATH . 'Routes/install.php';
}

$routes->group('{locale}', function ($routes){

    if (file_exists(APPPATH . 'Routes/admin.php'))
    {
        $routes->group('admin', function ($routes){
            require APPPATH . 'Routes/admin.php';

            if (is_dir(ROOTPATH.'modules')) {
                $modulesPath = ROOTPATH.'modules/';
                $modules = scandir($modulesPath);

                foreach ($modules as $module) {
                    if ($module === '.' || $module === '..') continue;
                    if (is_dir($modulesPath) . '/' . $module) {
                        $routesPath = $modulesPath . $module . '/Routes/admin.php';
                        if (file_exists($routesPath)) {
                            require($routesPath);
                        } else {
                            continue;
                        }
                    }
                }
            }

        });
    }

    if (file_exists(APPPATH . 'Routes/api.php'))
    {
        $routes->group('api', function ($routes){
            require APPPATH . 'Routes/api.php';

            if (is_dir(ROOTPATH.'modules')) {
                $modulesPath = ROOTPATH.'modules/';
                $modules = scandir($modulesPath);

                foreach ($modules as $module) {
                    if ($module === '.' || $module === '..') continue;
                    if (is_dir($modulesPath) . '/' . $module) {
                        $routesPath = $modulesPath . $module . '/Routes/api.php';
                        if (file_exists($routesPath)) {
                            require($routesPath);
                        } else {
                            continue;
                        }
                    }
                }
            }

        });
    }

    if (file_exists(APPPATH . 'Routes/web.php'))
    {
        if (is_dir(ROOTPATH.'modules')) {
            $modulesPath = ROOTPATH.'modules/';
            $modules = scandir($modulesPath);

            foreach ($modules as $module) {
                if ($module === '.' || $module === '..') continue;
                if (is_dir($modulesPath) . '/' . $module) {
                    $routesPath = $modulesPath . $module . '/Routes/web.php';
                    if (file_exists($routesPath)) {
                        require($routesPath);
                    } else {
                        continue;
                    }
                }
            }
        }

        require APPPATH . 'Routes/web.php';
    }
});

