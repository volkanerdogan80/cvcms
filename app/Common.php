<?php
use CodeIgniter\Config\Factories;

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */
//TODO: Paylaşımcı sunucuda ki sorunu gidermek için kullandık. Yayına alınca sorun varsa buraya bakılacak.
function config(string $name, bool $getShared = true)
{
    return Factories::config(ucfirst($name), ['getShared' => $getShared]);
}

function module_config($module, $config){
    $moduleConfig = '\Modules\\' . ucfirst($module) . '\Config\\' . ucfirst($config);
    return new $moduleConfig();
}

function permissions(){
    $permit_list = config('permissions')->list;
    foreach (cve_module_list() as $module){
        $permit_list = array_merge($permit_list, module_config($module, 'permissions')->list);
    }
    return $permit_list;
}

function recurse_copy($src,$dst)
{
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

function delete_directory($dirname)
{
    if (is_dir($dirname))
        $dir_handle = opendir($dirname);
    if (!isset($dir_handle))
        return false;
    while($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
            else
                delete_directory($dirname.'/'.$file);
        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
}