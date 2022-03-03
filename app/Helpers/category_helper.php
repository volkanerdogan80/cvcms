<?php

/**
 * Veritabanında kategori verilerini getirir
 * @param $params | Where içerisinde eklenecek sorgu koşulları
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
 * Veritabanında kategorileri verilerini getirir
 * @param $params | Where içerisinde eklenecek sorgu koşulları
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
 * Content olarak gönderilmiş olan parametreyi kontrol eder varsa render dan alır yoksa DB'den getirir
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_category($category = null)
{
    if (is_null($category)){
        $render = \Config\Services::themeRenderer();
        if (isset($render->getData()['category'])){
            return $render->getData()['category'];
        }elseif($category = cve_post_category()){
            return $category;
        }
    }

    if (is_object($category)){
        return $category;
    }elseif(is_numeric($category) || is_integer($category)){
        return get_category(['id' => $category]);
    }elseif(is_string($category)){
        return get_category(['slug' => $category]);
    }else{
        return null;
    }
}

/**
 * Bu metotlar geliştiriciler tarafından kullanılması için yazılmıştır get_categories metotuna istek atar.
 * @param null $module
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_categories($module = null)
{
    $params = !is_array($module) ? ['module' => $module] : $module;
    return get_categories($params);
}

/**
 * Parametrede gönderilen kategoriye ait ID değerini döner
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_id($params = null, bool $isContent = false)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            return $data->id;
        }
        return null;
    }

    if ($data = cve_post_category($params)){
        return $data->id;
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriye ait Parent ID değerini döner
 * @param null $params | slug, id, CategoryEntity Object
 *  @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_parent_id($params = null, bool $isContent = false)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            return $data->getParentId();
        }
        return null;
    }

    if ($data = cve_post_category($params)){
        return $data->getParentId();
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriye Parent Bilgilerini döner
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_parent($params = null, bool $isContent = false)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            $parent_id = $data->getParentId();
            if ($parent_id !== 0){
                return cve_category($parent_id);
            }
            return null;
        }
    }

    if ($data = cve_post_category($params)){
        $parent_id = $data->getParentId();
        if ($parent_id !== 0){
            return cve_category($parent_id);
        }
        return null;
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriye ait çocukları döner
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_child($category = null)
{
    $model = new \App\Models\CategoryModel();
    $category_id = cve_cat_id($category);
    return cve_cache(cve_cache_name('cve_cat_child_', $category_id), function () use ($model, $category_id){
        return $model->getCategoriesByParentId($category_id);
    });
}

/**
 * Parametrede gönderilen kategoriye ait slug değerini döner
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_slug($params = null, bool $isContent = false)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            return $data->getSlug();
        }
        return null;
    }

    if ($data = cve_post_category($params)){
        return $data->getSlug();
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriye ait Başlığı döner
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_title($params = null, bool $isContent = false, $lang = null)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            return $data->getTitle($lang);
        }
        return null;
    }

    if ($data = cve_post_category($params)){
        return $data->getTitle($lang);
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriye ait Açıklamayı döner
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_description($params = null, bool $isContent = false)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            return $data->getDescription();
        }
        return null;
    }

    if ($data = cve_post_category($params)){
        return $data->getDescription();
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriye ait Anahtar kelimeleri döner
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_keywords($params = null, bool $isContent = false)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            return $data->getKeywords();
        }
        return null;
    }

    if ($data = cve_post_category($params)){
        return $data->getKeywords();
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriye ait resim ID değerini döner
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_image_id($params = null, bool $isContent = false)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            return $data->getImage();
        }
        return null;
    }

    if ($data = cve_post_category($params)){
        return $data->getImage();
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriye ait resim bilgilerini döner
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @param null $size | Getirilecek olan resim boyutları
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_image($params = null, bool $isContent = false, $size = null)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            if($image = $data->withImage()){    // TODO: withImage'den kurtul
                return $image->getUrl($size);
            }
        }
        return null;
    }

    if ($data = cve_post_category($params)){
        if($image = $data->withImage()){       // TODO: withImage'den kurtul
            return $image->getUrl($size);
        }
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriye ait link oluşturur
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_link($params = null, bool $isContent = false)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            return base_url(route_to('category', $data->getSlug()));
        }
        return null;
    }

    if ($data = cve_post_category($params)){
        return base_url(route_to('category', $data->getSlug()));
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriye ait module değerini döner
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_module($params = null, bool $isContent = false)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            return $data->getModule();
        }
        return null;
    }

    if ($data = cve_post_category($params)){
        return $data->getModule();
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriyi oluşturan kişi ID değerini döner
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_author_id($params = null, bool $isContent = false)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            return $data->getUserId();
        }
        return null;
    }

    if ($data = cve_post_category($params)){
        return $data->getUserId();
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriyi oluşturan kişi bilgilerini döner
 * @param null $params | slug, id, CategoryEntity Object
 * @param false $isContent | $param ile gelen verinin bir içerik olup olmadığını kontrol eder.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_author($params = null, bool $isContent = false)
{
    if (!$isContent){
        if ($data = cve_category($params)){
            $user_id = $data->getUserId();
            return cve_user($user_id);
        }
    }

    if ($data = cve_post_category($params)){
        $user_id = $data->getUserId();
        return cve_user($user_id);
    }
    return null;
}

/**
 * Parametrede gönderilen kategori oluşturulma tarihini döner
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_created_at($category = null, $humanize = false)
{
    if ($data = cve_category($category)){
        return $data->getCreatedAt($humanize);
    }
    return null;
}

/**
 * Parametrede gönderilen kategori göncellenme tarihini döner
 * @param null $category | slug, id, CategoryEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_cat_updated_at($category = null, $humanize = false)
{
    if ($data = cve_category($category)){
        return $data->getUpdatedAt($humanize);
    }
    return null;
}

/**
 * Parametrede gönderilen kategoriye ait içerikleri döner
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
    $category_id = cve_cat_id($category);
    $posts = cve_cache(cve_cache_name('cat_posts', $params), function () use ($model, $category_id, $limit){
        return $model->getContentsByCategoryId($category_id, $limit);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

/**
 * Veritabanında ki kategorileri array olarak ağaç yapısına uygun olarak döner
 * @param null $module | Hangi module ait kategoriler getirilecekse modül belirtilir
 * @param int $parent_id | Başlangıç kategori ID değeri
 * @param string $add | Kategori başlıklarını ötemek için kullanılan ayraç
 * @param array $data | Kategori bilgilerinin eklendiği dizi
 * @return array|mixed
 */
function cve_cat_tree($module = null, $parent_id = 0, $add = '-', $data = [])
{
    $params = ['parent_id' => $parent_id];
    if (!is_null($module))
        $params['module'] = $module;

    $categories = cve_categories($params);

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
 * Veritabanında ki kategorileri selectbox içersiinde döner
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