<?php
/* Includes modules helper to the system automatically */
if (is_dir(ROOTPATH.'modules')) {
    $modulesPath = ROOTPATH.'modules/';
    $modules = scandir($modulesPath);

    foreach ($modules as $module) {
        if ($module === '.' || $module === '..') continue;
        if (is_dir($modulesPath) . '/' . $module) {
            $helpersPath = $modulesPath . $module . '/Helpers';
            if (is_dir($helpersPath)){
                $helpers = scandir($helpersPath);
                foreach ($helpers as $helper) {
                    if ($helper === '.' || $helper === '..') continue;
                    $helperPath = $helpersPath . '/' . $helper;
                    if (file_exists($helperPath)) {
                        require($helperPath);
                    } else {
                        continue;
                    }
                }
            }
        }
    }
}