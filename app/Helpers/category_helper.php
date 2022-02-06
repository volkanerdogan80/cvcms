<?php

/**
 * Returns the requested category from the database
 * @param $params | Query conditions to add in Where
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function get_category($params)
{
    $model = new \App\Models\CategoryModel();
    return cve_cache(cve_cache_name('get_category', $params), function () use ($model, $params){
        return $model->where('status', STATUS_ACTIVE)->where($params)->first();
    });
}

/**
 * Returns the requested categories from the database
 * @param $params | Query conditions to add in Where
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function get_categories($params)
{
    $model = new \App\Models\CategoryModel();
    return cve_cache(cve_cache_name('get_categories', $params), function () use ($model, $params){
        return $model->where('status', STATUS_ACTIVE)->where($params)->findAll();
    });
}

/**
 * Checks the parameter sent as content, if there is, it gets it from the render, if not, it gets it from the DB.
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_category($category = null)
{
    if (is_null($category)){
        $render = \Config\Services::renderer();
        if (isset($render->getData()['category'])){
            return $render->getData()['category'];
        }elseif($category = cve_post_category()){
            return $category;
        }
    }

    if (is_object($category)){
        return $category;
    }elseif(is_string($category)){
        return get_category(['slug' => $category]);
    }elseif(is_numeric($category) || is_integer($category)){
        return get_category(['id' => $category]);
    }else{
        return null;
    }
}

/**
 * These methods are written for use by developers. They send requests to the get_categories method.
 * @param $module
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_categories($module)
{
    return get_categories(['module' => $module]);
}

/**
 * Returns the ID value of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_id($category = null)
{
    if (is_null($category)){
        return cve_category()->id;
    }
    return cve_category($category)->id;
}

/**
 * Returns the Parent ID value of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_parent_id($category = null)
{
    if (is_null($category)){
        return cve_category()->getParentId();
    }
    return cve_category($category)->getParentId();
}

/**
 * Returns Parent Information to the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_parent($category = null, $key = null)
{
    if (is_null($category)){
        $category = cve_category()->withParent();
    }else{
        $category = cve_category($category)->withParent();
    }

    if (!is_null($key)){
        return $category->$key;
    }
    return $category;
}

/**
 * Returns the children of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_child($category = null)
{
    return get_categories(['parent_id' => cve_cat_id($category)]);
}

/**
 * Returns the slug value of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_slug($category = null)
{
    if (is_null($category)){
        return cve_category()->getSlug();
    }
    return cve_category($category)->getSlug();
}

/**
 * Returns the Title of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_title($category = null)
{
    if (is_null($category)){
        return cve_category()->getTitle();
    }
    return cve_category($category)->getTitle();
}

/**
 * Returns the Description of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_description($category = null)
{
    if (is_null($category)){
        return cve_category()->getDescription();
    }
    return cve_category($category)->getDescription();
}

/**
 * Returns the Keywords of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_keywords($category = null)
{
    if (is_null($category)){
        return cve_category()->getKeywords();
    }
    return cve_category($category)->getKeywords();
}

/**
 * Returns the Image ID of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_image_id($category = null)
{
    if (is_null($category)){
        return cve_category()->getImage();
    }
    return cve_category($category)->getImage();
}

/**
 * Returns the Image Info of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @param null $size | Getirilecek olan resim boyutları
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_image($category = null, $size = null)
{
    if (is_null($category)){
        return cve_category()->withImage()->getUrl($size);
    }
    return cve_category($category)->withImage()->getUrl($size);
}

/**
 * Creates a link for the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_link($category = null)
{
    return base_url(route_to('category', cve_cat_slug($category)));
}

/**
 * Returns the module value of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_module($category = null)
{
    if (is_null($category)){
        return cve_category()->getModule();
    }
    return cve_category($category)->getModule();
}

/**
 * Returns creator ID of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_user_id($category = null)
{
    if (is_null($category)){
        return cve_category()->getUserId();
    }
    return cve_category($category)->getUserId();
}

/**
 * Returns creator Info of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @param null $key | Data key value requested from contact information
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_user($category = null, $key = null)
{
    if (is_null($category)){
        $user = cve_category()->withUser();
    }else{
        $user = cve_category($category)->withUser();
    }

    if (!is_null($key)){
        return $user->$key;
    }

    return $user;
}

/**
 * Returns category creation date
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_created_at($category = null, $humanize = false)
{
    if (is_null($category)){
        return cve_category()->getCreatedAt($humanize);
    }
    return cve_category($category)->getCreatedAt($humanize);
}

/**
 * Returns category update date
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_updated_at($category = null, $humanize = false)
{
    if (is_null($category)){
        return cve_category()->getUpdatedAt($humanize);
    }
    return cve_category($category)->getUpdatedAt($humanize);
}

/**
 * Returns the contents of the category sent in the parameter
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_posts($category, $limit = 10, $pager = false)
{
    $params = func_get_args();
    if (is_array($category)) {
        $params = $category;
        $limit = $params['limit'] ?? 10;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
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

/**
 * It returns the categories in the database as an array in accordance with the tree structure.
 * @param null $module | Specifies the module to fetch the categories
 * @param int $parent_id | Initial category ID value
 * @param string $add | Indicates parent category(s) status. Returns the parent category by placing this separator in front of the category titles.
 * @param array $data | Array to which category information is added
 * @return array|mixed
 */
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

/**
 * Returns the categories in the database as a select box
 * @param array $params | name, class, id, module, parent_id, add değeri yer alabilir
 */
function cve_cat_selectbox(array $params = [])
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

function cve_cat_dropdown(){}

function cve_cat_list(){}