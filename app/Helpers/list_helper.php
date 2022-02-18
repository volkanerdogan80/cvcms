<?php
/**
 * Fetches random content
 * @param int $limit Limits number of contents as int or an array which includes parameters [limit, module,category,pager]
 * @param null $module The module to fetch the contents
 * @param null $category The category or categories to which the content will be fetched
 * @param false $pager Paging system active/inactive
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_random_post($limit = 10, $module = null, $format = null,  $category = null, bool $pager = false)
{
    $model = new \App\Models\ContentModel();
    $params = func_get_args();

    if (is_array($limit)) {
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $format = $params['format'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }

    $posts = cve_cache(cve_cache_name('random_content', $params), function () use ($model, $module, $format,$limit, $category){
        return $model->getRandom($module, $format, $limit, $category);
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
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_recent_post($limit = 10, $module = null,$format = null,  $offset = null, $category = null, bool $pager = false)
{
    $model = new \App\Models\ContentModel();
    $params = func_get_args();

    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $format = $params['format'] ?? null;
        $category = $params['category'] ?? null;
        $offset = $params['offset'] ?? null;
        $pager = $params['pager'] ?? false;
    }

    $posts = cve_cache(cve_cache_name('recent_content', $params), function () use ($model, $module, $format, $offset, $limit, $category){
        return $model->getRecent($module, $format, $limit, $offset, $category);
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
function cve_week_top_post($limit = 10, $module = null, $format = null,  $category = null, bool $pager = false)
{
    $params = func_get_args();
    $model = new \App\Models\ContentModel();

    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $format = $params['format'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }


    $posts = cve_cache(cve_cache_name('week_top_view', $params), function () use ($model, $format, $module, $limit, $category){
        return $model->getWeekTop($module, $format, $limit, $category);
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
function cve_month_top_post($limit = 10, $module = null, $format = null,  $category = null, bool $pager = false)
{
    $model = new \App\Models\ContentModel();
    $params = func_get_args();

    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $format = $params['format'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }


    $posts = cve_cache(cve_cache_name('month_top_view', $params), function () use ($model, $module, $format, $limit, $category){
        return $model->getMonthTop($module, $format, $limit, $category);
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
function cve_most_read_post($limit = 10, $module = null,$format = null,  $category = null, bool $pager = false)
{
    $model = new \App\Models\ContentModel();
    $params = func_get_args();

    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $format = $params['format'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }


    $posts = cve_cache(cve_cache_name('most_read_view', $params), function () use ($model, $module, $format, $limit, $category){
        return $model->getMostRead($module, $format, $limit, $category);
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
function cve_most_commented_post($limit = 10, $module = null, $format = null,  $category = null, bool $pager = false)
{
    $model = new \App\Models\ContentModel();
    $params = func_get_args();

    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $format = $params['format'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }


    $posts = cve_cache(cve_cache_name('most_commented_view', $params), function () use ($model, $module, $format, $limit, $category){
        return $model->getMostComment($module, $format, $limit, $category);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

/**
 * Returns most liked contents
 * @param int $limit Limits number of contents as int or an array which includes parameters [limit, module,category,pager]
 * @param null $module The module which contents get fetched
 * @param null $category Category/Categories  which contents get fetched
 * @param false $pager Paging system active/inactive
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_top_liked_post($limit = 10, $module = null, $format = null, $category = null, $pager = false)
{
    $params = func_get_args();
    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $format = $params['format'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }

    $model = new \App\Models\ContentModel();

    $posts = cve_cache(cve_cache_name('month_top_post', $params), function () use ($model, $module, $format, $limit, $category){
        return $model->getTopLiked($module, $format, $limit, $category);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

/**
 * Returns most favorite contents
 * @param int $limit Limits number of contents as int or an array which includes parameters [limit, module,category,pager]
 * @param null $module The module which contents get fetched
 * @param null $category Category/Categories  which contents get fetched
 * @param false $pager Paging system active/inactive
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_top_favorite_post($limit = 10, $module = null, $format = null, $category = null, $pager = false)
{
    $params = func_get_args();
    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $format = $params['format'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }

    $model = new \App\Models\ContentModel();

    $posts = cve_cache(cve_cache_name('month_top_post', $params), function () use ($model, $module, $format, $limit, $category){
        return $model->getTopFavorite($module, $format, $limit, $category);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

/**
 * Returns most voted contents
 * @param int $limit Limits number of contents as int or an array which includes parameters [limit, module,category,pager]
 * @param null $module The module which contents get fetched
 * @param null $category Category/Categories  which contents get fetched
 * @param false $pager Paging system active/inactive
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_top_voted_post($limit = 10, $module = null, $format = null, $category = null, $pager = false)
{
    $params = func_get_args();
    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $format = $params['format'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }

    $model = new \App\Models\ContentModel();

    $posts = cve_cache(cve_cache_name('month_top_post', $params), function () use ($model, $module, $format, $limit, $category){
        return $model->getTopVoted($module, $format, $limit, $category);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

/**
 * Returns contents with the highest average rating
 * @param int $limit Limits number of contents as int or an array which includes parameters [limit, module,category,pager]
 * @param null $module The module which contents get fetched
 * @param null $category Category/Categories  which contents get fetched
 * @param false $pager Paging system active/inactive
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_top_rating_post($limit = 10, $module = null, $format = null, $category = null, $pager = false)
{
    $params = func_get_args();
    if(is_array($limit)){
        $params = $limit;
        $limit = $params['limit'] ?? 10;
        $module = $params['module'] ?? null;
        $format = $params['format'] ?? null;
        $category = $params['category'] ?? null;
        $pager = $params['pager'] ?? false;
    }

    $model = new \App\Models\ContentModel();

    $posts = cve_cache(cve_cache_name('month_top_post', $params), function () use ($model, $module, $format, $limit, $category){
        return $model->getTopRating($module, $format, $limit, $category);
    });

    if ($pager){
        return $posts;
    }

    return $posts['contents'];
}

function cve_author_list($group = null, $limit = 20, $pager = false){
    $params = func_get_args();
    if(is_array($group)){
        $params = $group;
        $group = $params['group'] ?? null;
        $limit = $params['limit'] ?? 20;
        $pager = $params['pager'] ?? false;
    }

    $group_id = cve_group_id($group);

    $model = new \App\Models\UserModel();
    return cve_cache(cve_cache_name('group_user_list_', $params), function () use($model, $group_id, $pager, $limit){
        return $model->getGroupUsers($group_id, $pager, $limit);
    });
}

function cve_user_posts($user = null, $limit = 20, $pager = false, $module = null, $category = null ,$format = null){

    $params = func_get_args();
    if(is_array($user)){
        $params = $user;
        $user = $params['user'] ?? null;
        $module = $params['module'] ?? null;
        $category = $params['category'] ?? null;
        $format = $params['format'] ?? null;
        $limit = $params['limit'] ?? 20;
        $pager = $params['pager'] ?? false;
    }

    $model = new \App\Models\ContentModel();

    $user_id = cve_user_id($user);

    return cve_cache(cve_cache_name('user_posts', $params), function () use($model, $user_id, $limit, $pager, $module, $category, $format) {
        return $model->getUserContent($user_id, $limit, $pager, $module, $category, $format);
    });
}

function cve_user_favorite_posts($user = null, $limit = 20, $pager = false, $module = null, $category = null ,$format = null){

    $params = func_get_args();
    if(is_array($user)){
        $params = $user;
        $user = $params['user'] ?? null;
        $module = $params['module'] ?? null;
        $category = $params['category'] ?? null;
        $format = $params['format'] ?? null;
        $limit = $params['limit'] ?? 20;
        $pager = $params['pager'] ?? false;
    }

    $model = new \App\Models\ContentModel();

    $user_id = cve_user_id($user);

    return cve_cache(cve_cache_name('user_favorite_posts', $params), function () use($model, $user_id, $limit, $pager, $module, $category, $format) {
        return $model->getUserFavoriteContent($user_id, $limit, $pager, $module, $category, $format);
    });
}