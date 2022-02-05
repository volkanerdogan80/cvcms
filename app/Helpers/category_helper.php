<?php

function get_category($params)
{
    $model = new \App\Models\CategoryModel();
    return cve_cache(cve_cache_name('get_category', $params), function () use ($model, $params){
        return $model->where('status', STATUS_ACTIVE)->where($params)->first();
    });
}

function get_categories($params)
{
    $model = new \App\Models\CategoryModel();
    return cve_cache(cve_cache_name('get_category', $params), function () use ($model, $params){
        return $model->where('status', STATUS_ACTIVE)->where($params)->findAll();
    });
}

function cve_category($content = null)
{
    if (is_null($content)){
        $render = \Config\Services::renderer();
        return $render->getData()['category'];
    }

    if (is_object($content)){
        return $content;
    }elseif(is_string($content)){
        return get_category(['slug' => $content]);
    }elseif(is_numeric($content) || is_integer($content)){
        return get_category(['id' => $content]);
    }else{
        return null;
    }
}

function cve_categories($module)
{
    return get_categories(['module' => $module]);
}

function cve_cat_id($content = null)
{
    if (is_null($content)){
        return cve_category()->id;
    }
    return cve_category($content)->id;
}

function cve_cat_parent_id($content = null)
{
    if (is_null($content)){
        return cve_category()->getParentId();
    }
    return cve_category($content)->getParentId();
}

function cve_cat_slug($content = null)
{
    if (is_null($content)){
        return cve_category()->getSlug();
    }
    return cve_category($content)->getSlug();
}

function cve_cat_title($content = null)
{
    if (is_null($content)){
        return cve_category()->getTitle();
    }
    return cve_category($content)->getTitle();
}

function cve_cat_description($content = null)
{
    if (is_null($content)){
        return cve_category()->getDescription();
    }
    return cve_category($content)->getDescription();
}

function cve_cat_keywords($content = null)
{
    if (is_null($content)){
        return cve_category()->getKeywords();
    }
    return cve_category($content)->getKeywords();
}

function cve_cat_image_id($content = null)
{
    if (is_null($content)){
        return cve_category()->getImage();
    }
    return cve_category($content)->getImage();
}

function cve_cat_image($content = null, $size = null)
{
    if (is_null($content)){
        return cve_category()->withImage()->getUrl($size);
    }
    return cve_category($content)->withImage()->getUrl($size);
}

function cve_cat_link($content = null)
{
    return base_url(route_to('category', cve_cat_slug($content)));
}

function cve_cat_posts($category, $limit = 10, $pager = false)
{
    $params = func_get_args();
    if (is_array($category)) {
        $params = $category;
        $limit = isset($params['limit']) ? $params['limit'] : 10;
        $category = isset($params['category']) ? $params['category'] : null;
        $pager = isset($params['pager']) ? $params['pager'] : false;
    }

    $model = new \App\Models\ContentModel();

    $posts = cve_cache(cve_cache_name('cat_posts', $params), function () use ($model, $category, $limit){
        return $model->getCategoryContent($category, $limit);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

function cve_cat_tree($module = null, $parent_id = 0, $add = '-', $data = [])
{
    $params = ['parent_id' => $parent_id];
    !is_null($module) ? $params['module'] = $module : null;

    $categories = get_categories($params);

    foreach ($categories as $category){
        $title = cve_cat_parent_id($category) != 0 ? $add . ' ' . cve_cat_title($category) : cve_cat_title($category);
        $data[] = [
            'id' => cve_cat_id($category),
            'parent_id' => cve_cat_parent_id($category),
            'title' => $title,
            'slug' => cve_cat_slug($category),
            'link' => cve_cat_link($category)
        ];
        $data = cve_cat_tree($module, cve_cat_id($category), $add . $add, $data);
    }
    return $data;
}

function cve_cat_dropdown(){}

function cve_cat_selectbox($params = [])
{
    $name = $params['name'] ?? null;
    $class = $params['class'] ?? null;
    $id = $params['id'] ?? null;
    $module = $params['module'] ?? null;
    $parent_id = $params['parent_id'] ?? 0;
    $add = $params['add'] ?? '-';

    echo "<select name='".$name."' class='".$class."' id='".$id."'>";
    foreach (cve_cat_tree($module, $parent_id, $add) as $item) {
        echo "<option value='".$item['id']."'>".$item['title']."</option>";
    }
    echo "</select>";
}

function cve_cat_list(){}
