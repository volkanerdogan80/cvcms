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
        $render = \Config\Services::renderer();
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
        return null;
    }
}

/**
 * Returns the group ID value of the user
 * @param null $user | ID, Email veya UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_group_id($user = null)
{
    if (is_null($user)){
        return cve_user()->getGroupID();
    }
    return cve_user($user)->getGroupID();
}

/**
 * Returns the group info value of the user
 * @param null $user | ID, Email or UserEntity Object
 * @param null $key | Group bilgileri içerisinden istenilen anahtar değer.
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_group($user = null, $key = null)
{
    if (is_null($user)){
        $group = cve_user()->withGroup();
    }
    $group =  cve_user($user)->withGroup();

    if (!is_null($key)){
        return $group->$key;
    }

    return $group;
}

/**
 * Returns the user's First Name
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_firstname($user = null)
{
    if (is_null($user)){
        return cve_user()->getFirstName();
    }
    return cve_user($user)->getFirstName();
}

/**
 * Returns the user's Last Name
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_surname($user = null)
{
    if (is_null($user)){
        return cve_user()->getSurName();
    }
    return cve_user($user)->getSurName();
}

/**
 * Returns the user's Full Name
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_name($user = null)
{
    if (is_null($user)){
        return cve_user()->getFullName();
    }
    return cve_user($user)->getFullName();
}

/**
 * Returns the user's Email
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_email($user = null)
{
    if (is_null($user)){
        return cve_user()->getEmail();
    }
    return cve_user($user)->getEmail();
}

/**
 * Returns the user's bio
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_bio($user = null)
{
    if (is_null($user)){
        return cve_user()->getBio();
    }
    return cve_user($user)->getBio();
}

/**
 * Returns the user's Status
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_status($user = null)
{
    if (is_null($user)){
        return cve_user()->getStatus();
    }
    return cve_user($user)->getStatus();
}

/**
 * Returns the user's Register Date
 * @param null $user | ID, Email or UserEntity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_user_created_at($user = null, $humanize = false)
{
    if (is_null($user)){
        return cve_user()->getCreatedAt($humanize);
    }
    return cve_user($user)->getCreatedAt($humanize);
}
