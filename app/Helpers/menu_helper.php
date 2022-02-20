<?php

function get_menu($key){

    $model = new \App\Models\MenuModel();
    return cve_cache(cve_cache_name('get_menu', func_get_args()), function () use($model, $key){
        return $model->where('skey', $key)->first();
    });
}

function cve_menu($key, $params = []): ?string
{
    if ($menu = get_menu($key)){
        $library = new \App\Libraries\Menu($params);
        $library->generator($menu->getValue());
        return $library->render();
    }
    return null;
}
