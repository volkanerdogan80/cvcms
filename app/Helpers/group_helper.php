<?php

/**
 * Fetches a group information from the database.
 * @param $params | Conditions to send as DB query.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function get_group($params){
    $model = new \App\Models\GroupModel();
    return cve_cache(cve_cache_name('get_group', $params), function () use ($model, $params){
        return $model->where($params)->first();
    });
}

/**
 * Fetches all group information from the database.
 * @param $params | DB sorgu olarak gidecek koşullar.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function get_groups($params){
    $params = array_merge($params, ['status' => STATUS_ACTIVE]);
    $model = new \App\Models\GroupModel();
    return cve_cache(cve_cache_name('get_groups', $params), function () use ($model, $params){
        return $model->where($params)->findAll();
    });
}

/**
 * Returns Group Info
 * @param null $user | ID, Email or GroupsEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_group($group = null){
    if (is_null($group)){
        $render = \Config\Services::themeRenderer();
        if (isset($render->getData()['user'])){
            return $render->getData()['user'];
        }elseif($post = cve_post_author()){
            return $post;
        }elseif($category = cve_cat_user()) {
            return $category;
        }
    }

    if (is_object($group)){
        return $group;
    }elseif(is_string($group)){
        return get_group(['slug' => $group]);
    }elseif(is_numeric($group) || is_integer($group)){
        return get_group(['id' => $group]);
    }else{
        return null;
    }
}

/**
 * Returns Group ID
 * @param null $user | ID, Email or GroupsEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_group_id($group = null){
    if ($data = cve_group($group)){
        return $data->id;
    }
    return null;
}

/**
 * Returns Group Title
 * @param null $user | ID, Email or GroupsEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_group_title($group = null){
    if ($data = cve_group($group)){
        return $data->getTitle();
    }
    return null;
}

/**
 * Returns Group Premissions
 * @param null $user | ID, Email or GroupsEntity Object
 * @return array
 */
function cve_group_permissions($group = null){
    if ($data = cve_group($group)){
        return $data->getPermit();
    }
    return null;
}

/**
 * Returns the group creation date
 * @param null $user | ID, Email or GroupsEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_group_created_at($group = null, $humanize = false){
    if ($data = cve_group($group)){
        return $data->getCreatedAt($humanize);
    }
    return null;
}

/**
 * The group returns the updated date
 * @param null $user | ID, Email or GroupsEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_group_updated_at($group = null, $humanize = false){
    if ($data = cve_group($group)){
        return $data->getUpdatedAt($humanize);
    }
    return null;
}
