<?php
function cve_active_components()
{
    $model = new \App\Models\ComponentModel();
    return cve_cache('active_components', function () use($model){
        return $model->getComponentsByStatus();
    });
}

function cve_component_setting($params = null)
{
    $setting = json_decode(json_encode(config('component')), true);
    if (is_null($params)) {
        return $setting;
    }
    return dot_array_search($params, $setting);
}

function cve_component_include($path)
{
    include (cve_component_file($path));
}

function cve_component_public($path = null): string
{
    return base_url(COMPONENTS_FOLDER . $path);
}

function cve_component_file($path = null, $folder = false): string
{
    $file_path = COMPONENTS_PATH . $path;
    if (!$folder){
        $file_ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_path = empty($file_ext) ? $file_path . '.php' : $file_path;
    }
    return $file_path;
}

function cve_component_head()
{
    $head = [];
    foreach (cve_active_components() as $comp_key => $comp_value){
        if (is_dir(cve_component_file($comp_value->getFolder(), true))){
            $file = cve_component_file($comp_value->getFolder() . '/info');
            if (file_exists($file)){
                $info = include($file);
                if (isset($info['style'])){
                    $head = array_merge($head, $info['style']);
                }
                if (isset($info['head'])){
                    $head = array_merge($head, $info['head']);
                }
            }
        }
    }
    return $head;
}

function cve_component_footer()
{
    $footer = [];
    foreach (cve_active_components() as $comp_key => $comp_value){
        if (is_dir(cve_component_file($comp_value->getFolder(), true))){
            $file = cve_component_file($comp_value->getFolder() . '/info');
            if (file_exists($file)){
                $info = include($file);
                if (isset($info['script'])){
                    $footer = array_merge($footer, $info['script']);
                }
                if (isset($info['footer'])){
                    $footer = array_merge($footer, $info['footer']);
                }
            }
        }
    }
    return $footer;
}

foreach (cve_active_components() as $comp_key => $comp_value){
    if (is_dir(cve_component_file($comp_value->getFolder(), true))){
        $file = cve_component_file($comp_value->getFolder() . '/helper');
        if (file_exists($file)){
            require_once $file;
        }
    }
}

/* Silinecek Başlangıç */


function cmp_bootstrap_multilevel_menu($key)
{
    return view('components/menu/bootstrap-4-multilevel', [
        'key' => $key
    ]);
}
/* Silinecek Bitiş */