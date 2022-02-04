<?php
/**
 * Fetches random content
 * @param int $limit Limits number of contents as int or an array which includes parameters [limit, module,category,pager]
 * @param null $module The module to fetch the contents
 * @param null $category The category or categories to which the content will be fetched
 * @param false $pager Paging system active/inactive
 * @param string $sort_by
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_random_content(int $limit = 10, $module = null, $category = null, bool $pager = false)
{
    $model = new \App\Models\ContentModel();
    $params = func_get_args();

    if (is_array($limit)) {
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }

    $posts = cve_cache(cve_cache_name('random_content', $params), function () use ($model, $module, $limit, $category){
        return $model->getRandom($module, $limit, $category);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

/** Fetches recently added content
 * Fetches random content or recently added contents due to sort_by variable(RANDOM for random content, null for recently added)
 * @param int $limit Limits number of contents as int or an array which includes parameters [limit, module,category,pager]
 * @param null $module The module to fetch the contents
 * @param null $category The category or categories to which the content will be fetched
 * @param false $pager Paging system active/inactive
 * @param string $sort_by
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_recent_content(int $limit = 10, $module = null, $category = null, bool $pager = false)
{
    $model = new \App\Models\ContentModel();
    $params = func_get_args();

    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }

    $posts = cve_cache(cve_cache_name('recent_content', $params), function () use ($model, $module, $limit, $category){
        return $model->getRecent($module, $limit, $category);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

/**
 * Fetches the week's top contents
 * @param int $limit Limits number of contents as int or an array which includes parameters [limit, module,category,pager]
 * @param null $module The module to fetch the contents
 * @param null $category The category or categories to which the content will be fetched
 * @param false $pager Paging system active/inactive
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_week_top_view(int $limit = 10, $module = null, $category = null, bool $pager = false)
{
    $params = func_get_args();
    $model = new \App\Models\ContentModel();

    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }


    $posts = cve_cache(cve_cache_name('week_top_view', $params), function () use ($model, $module, $limit, $category){
        return $model->getWeekTop($module, $limit, $category);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

/**
 * Fetches the month's top contents
 * @param int $limit Limits number of contents as int or an array which includes parameters [limit, module,category,pager]
 * @param null $module The module to fetch the contents
 * @param null $category The category or categories to which the content will be fetched
 * @param false $pager Paging system active/inactive
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_month_top_view(int $limit = 10, $module = null, $category = null, bool $pager = false)
{
    $model = new \App\Models\ContentModel();
    $params = func_get_args();

    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }


    $posts = cve_cache(cve_cache_name('month_top_view', $params), function () use ($model, $module, $limit, $category){
        return $model->getMonthTop($module, $limit, $category);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

/**
 * Fetches the top contents
 * @param int $limit Limits number of contents as int or an array which includes parameters [limit, module,category,pager]
 * @param null $module The module to fetch the contents
 * @param null $category The category or categories to which the content will be fetched
 * @param false $pager Paging system active/inactive
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_most_read_view(int $limit = 10, $module = null, $category = null, bool $pager = false)
{
    $model = new \App\Models\ContentModel();
    $params = func_get_args();

    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }


    $posts = cve_cache(cve_cache_name('most_read_view', $params), function () use ($model, $module, $limit, $category){
        return $model->getMostRead($module, $limit, $category);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

/**
 * Fetches the most commented content
 * @param int $limit Limits number of contents as int or an array which includes parameters [limit, module,category,pager]
 * @param null $module The module to fetch the contents
 * @param null $category The category or categories to which the content will be fetched
 * @param false $pager Paging system active/inactive
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_most_commented_view(int $limit = 10, $module = null, $category = null, bool $pager = false)
{
    $model = new \App\Models\ContentModel();
    $params = func_get_args();

    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }


    $posts = cve_cache(cve_cache_name('most_commented_view', $params), function () use ($model, $module, $limit, $category){
        return $model->getMostComment($module, $limit, $category);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

function cve_most_liked(){}

function cve_most_favorite(){}