<?php

/**
 * Returns the requested user infos from the database
 * @param $params | DB conditions to be sent as a query to the database.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function get_user($params){
    $model = new \App\Models\UserModel();
    return cve_cache(cve_cache_name('get_user', $params), function () use ($model, $params){
        return $model->where($params)->first();
    });
}

/**
 * Returns User Info
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user($user = null)
{
    if (is_null($user)){
        $render = \Config\Services::themeRenderer();
        if (isset($render->getData()['user'])){
            return $render->getData()['user'];
        }elseif($post = cve_post_author()){
            return $post;
        }elseif($category = cve_cat_user()) {
            return $category;
        }
    }

    if (is_object($user)){
        return $user;
    }elseif(is_string($user)){
        return get_user(['email' => $user]);
    }elseif(is_numeric($user) || is_integer($user)){
        return get_user(['id' => $user]);
    }else{
        return null; // TODO: Duruma göre aktif kullanıcının session bilgisi de döndürülebilir.
    }
}

/**
 * Returns the group ID value of the user
 * @param null $user | ID, Email veya UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_group_id($user = null)
{
    if ($data = cve_user($user)){
        return $data->getGroupID();
    }
    return null;
}

/**
 * Returns the group info value of the user
 * @param null $user | ID, Email or UserEntity Object
 * @param null $key | Group bilgileri içerisinden istenilen anahtar değer.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_group($user = null, $key = null)
{
    if ($data = cve_user($user)){
        if (!is_null($key)){
            return $data->withGroup()->$key;
        }
        return $data->withGroup();
    }else{
        return null;
    }
}

/**
 * Returns the user's First Name
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_firstname($user = null)
{
    if ($data = cve_user($user)){
        return $data->getFirstName();
    }
    return null;
}

/**
 * Returns the user's Last Name
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_surname($user = null)
{
    if ($data = cve_user($user)){
        return $data->getSurName();
    }
    return null;
}

/**
 * Returns the user's Full Name
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_name($user = null)
{
    if ($data = cve_user($user)){
        return $data->getFullName();
    }
    return null;
}

/**
 * Returns the user's Email
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_email($user = null)
{
    if ($data = cve_user($user)){
        return $data->getEmail();
    }
    return null;
}

/**
 * Returns the user's bio
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_bio($user = null)
{
    if ($data = cve_user($user)){
        return $data->getBio();
    }
    return null;
}

/**
 * Returns the user's Status
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_status($user = null)
{
    if ($data = cve_user($user)){
        return $data->getStatus();
    }
    return null;
}

/**
 * Returns the user's Register Date
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_created_at($user = null, $humanize = false)
{
    if ($data = cve_user($user)){
        return $data->getCreatedAt($humanize);
    }
    return null;
}