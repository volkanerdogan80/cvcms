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

function cve_tree_menu($data, $item)
{
    if (isset($item->children)){
        echo view(PANEL_FOLDER . '/pages/menu/partials/item', [
            'partial' => 'child-start',
            'menu' => $data,
            'item' => $item
        ]);
        foreach ($item->children as $child) {
            cve_tree_menu($data, $child);
        }
        echo view(PANEL_FOLDER . '/pages/menu/partials/item', [
            'partial' => 'child-end',
        ]);
    }else{
        echo view(PANEL_FOLDER . '/pages/menu/partials/item', [
            'partial' => 'item',
            'menu' => $data,
            'item' => $item
        ]);
    }
}