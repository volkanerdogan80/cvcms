<?php

/**
 * @param null $key | Column name requested from DB .
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_active_theme($key = null)
{
    $model = new \App\Models\ThemeModel();
    $theme = cve_cache('active_theme', function () use($model){
        return $model->where('status', STATUS_ACTIVE)->first();
    });

    if (!is_null($key)){
        if (isset($theme->$key)){
            return $theme->$key;
        }
        return null;
    }
    return $theme;
}

/**
 * Returns active Theme Name
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_theme_name()
{
    return cve_active_theme('name');
}

/**
 * Returns active Theme Folder Name
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_theme_folder()
{
    return cve_active_theme('folder');
}

/**
 * Returns developer's web address
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_theme_web()
{
    return cve_active_theme('web');
}

/**
 * Returns developer's email address
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_theme_email()
{
    return cve_active_theme('email');
}

/**
 * Returns developer's name
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_theme_author()
{
    return cve_active_theme('author');
}

/**
 * @param null $path | The file url to be used in the public folder.
 * @return string
 */
function cve_theme_public($path = null): string
{
    return base_url('public/' . cve_theme_folder() . '/' . $path);
}

/**
 * @param null $path | The file path to be used in the public folder.
 * @return string
 */
function cve_theme_public_path($path = null): string
{
    return APPPATH . 'public/' . cve_theme_folder() . '/' . $path;
}

require_once APPPATH . 'Views/themes/' . cve_theme_folder() . '/helper.php';