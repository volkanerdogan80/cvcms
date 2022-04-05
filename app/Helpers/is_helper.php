<?php

/**
 * Checkes Login Status
 * @return bool
 */
function is_logged_in(): bool
{
    if (auth_user('is_login')){
        return true;
    }
    return false;
}

/**
 * Gönderilen parametre ile ilgili veya mevcut sayfa içerik mi bilgi verir
 * @param null $param | String, Int, Object olabilir
 * @return bool
 */
function is_post($param = null): bool
{
    if (cve_post_slug($param)){
        return true;
    }
    return false;
}

/**
 * Gönderilen parametre ile ilgili veya mevcut sayfa kategori mi bilgi verir
 * @param null $param | String, Int, Object olabilir
 * @return bool
 */
function is_category($param = null): bool
{
    if (cve_cat_slug($param)){
        return true;
    }
    return false;
}

/**
 * Gönderilen parametre veya mevcut sayfanın module değeri $module değişkine eşit mi diye sorgular
 * @param $module | Kontrol edilecek module
 * @param null $param | String, Int, Object olabilir
 * @return bool
 */
function is_post_module($module, $param = null): bool
{
    if (is_post($param) && cve_post_module($param) == $module){
        return true;
    }
    return false;
}

/**
 * Gönderilen parametre veya mevcut sayfanın module değeri $module değişkine eşit mi diye sorgular
 * @param $module | Kontrol edilecek module
 * @param null $param | String, Int, Object olabilir
 * @return bool
 */
function is_cat_module($module, $param = null): bool
{
    if (is_category($param) && cve_cat_module($param) == $module){
        return true;
    }
    return false;
}

/**
 * Gönderilen parametre veya mevcut sayfanın blog yazısı olup olmadığını kontrol eder
 * @param null $content | String, Int, Object olabilir
 * @return bool
 */
function is_blog($content = null): bool
{
    return is_post_module('blog', $content);
}

/**
 * Gönderilen parametre veya mevcut sayfanın sayfa yazısı olup olmadığını kontrol eder
 * @param null $content | String, Int, Object olabilir
 * @return bool
 */
function is_page($content = null)
{
    return is_post_module('page', $content);
}

/**
 * Gönderilen parametre veya mevcut sayfanın hizmet yazısı olup olmadığını kontrol eder
 * @param null $content | String, Int, Object olabilir
 * @return bool
 */
function is_service($content = null)
{
    return is_post_module('service', $content);
}

/**
 * Gönderilen parametre veya mevcut sayfadaki içeriğin yorumlara izin verip vermediğini kontrol eder
 * @param null $content | String, Int, Object olabilir
 * @return bool
 */
function is_comment_status($content = null): bool
{
    if (is_post($content) && cve_post_comment_status($content)){
        return true;
    }
    return false;
}

/**
 * Gönderilen parametre veya mevcut sayfadaki içeriğin $format değişkende gelen bir değeri var mı kontrol eder
 * @param string $format | Kontrol edilecek format değeri
 * @param null $content | String, Int, Object olabilir
 * @return bool
 */
function is_post_format(string $format, $content = null): bool
{
    if (is_post($content) && cve_post_format($content) == $format){
        return true;
    }
    return false;
}

/**
 * Gönderilen parametre veya mevcut sayfadaki içeriğin $lang değişkende gelen dil kodu ile ilgili içeriği var mı kontrol eder
 * @param string $lang | Dil kodu
 * @param null $content | String, Int, Object olabilir
 * @return bool
 */
function is_post_lang(string $lang, $content = null): bool
{
    if (is_post($content) && cve_post_title($content, $lang)){
        return true;
    }
    return false;
}

/**
 * Gönderilen parametre veya mevcut sayfadaki kategorinin $lang değişkende gelen dil kodu ile ilgili içeriği var mı kontrol eder
 * @param string $lang | Dil kodu
 * @param null $category  | String, Int, Object olabilir
 * @return bool
 */
function is_category_lang(string $lang, $category = null): bool
{
    if (is_category($category) && cve_cat_title($category, $lang)){
        return true;
    }
    return false;
}

/**
 * Parametrede ki değer ile ilgili bir kullanıcı var mı kontrol eder.
 * @param null $param | String, Int, Object olabilir
 * @return bool
 */
function is_user($param = null): bool
{
    if (cve_user_email($param)){
        return true;
    }
    return false;
}

/**
 * Kullanıcı durumu aktif mi montrol eder
 * @param null $user | String, Int, Object olabilir
 * @return bool
 */
function is_user_active($user = null): bool
{
    if (cve_user_status($user) == STATUS_ACTIVE){
        return true;
    }
    return false;
}

/**
 * Kullanıcı durumu pasif mi montrol eder
 * @param null $user | String, Int, Object olabilir
 * @return bool
 */
function is_user_passive($user = null): bool
{
    if (cve_user_status($user) == STATUS_PASSIVE){
        return true;
    }
    return false;
}

/**
 * Kullanıcı durumu beklemede mi montrol eder
 * @param null $user | String, Int, Object olabilir
 * @return bool
 */
function is_user_pending($user = null): bool
{
    if (cve_user_status($user) == STATUS_PENDING){
        return true;
    }
    return false;
}

/**
 * Sistem kurulmuş mu kontrol eder
 * @return mixed
 */
function is_system_install()
{
    return config('system')->install;
}

/**
 * Site bakım modunda mı kontrol eder
 * @return mixed
 */
function is_maintenance()
{
    return config('system')->maintenance;
}

/**
 * Kayıt sistemi açık mı kontrol eder
 * @return mixed
 */
function is_register()
{
    return config('system')->register;
}

/**
 * Login Sistemi açık mı kontrol eder
 * @return mixed
 */
function is_login()
{
    return config('system')->login;
}

/**
 * Eposta doğrulama sistemi açık mı kontrol eder
 * @return mixed
 */
function is_email_verify()
{
    return config('system')->emailVerify;

}

function is_theme_file($path = null){
    if (file_exists(cve_theme_file($path))){
        return true;
    }
    return false;
}

function is_theme_folder($path = null){
    if (is_dir(cve_theme_file($path, true))){
        return true;
    }
    return false;
}

function is_favorite($content = null){

    if (!is_logged_in()){
        return false;
    }

    $model = new \App\Models\FavoriteModel();

    $user_id = session('userData.id');
    $content_id = cve_post_id($content);

    $control = cve_cache(cve_cache_name('user_favorite_control', [
        'user_id' => $user_id,
        'content_id' => $content_id,
    ]), function () use($model, $content_id){
        return $model->getFavoriteControlByUserId($content_id);
    });

    if ($control){
        return true;
    }
    return false;
}

function is_liked($content = null){
    $model = new \App\Models\LikeModel();
    $content_id = cve_post_id($content);
    $remote_addr = service('request')->getIPAddress();

    $control = cve_cache(cve_cache_name('user_liked_control', [
        'remote_addr' => $remote_addr,
        'content_id' => $content_id,
    ]), function () use($model, $content_id, $remote_addr){
        return $model->getLikeControlByRemoteAddr($content_id, $remote_addr);
    });

    if ($control){
        return true;
    }
    return false;
}

function is_rating($content = null){
    $model = new \App\Models\RatingModel();
    $content_id = cve_post_id($content);
    $remote_addr = service('request')->getIPAddress();

    $control = cve_cache(cve_cache_name('user_rating_control', [
        'remote_addr' => $remote_addr,
        'content_id' => $content_id,
    ]), function () use($model, $content_id, $remote_addr){
        return $model->getRatingControlByRemoteAddr($content_id, $remote_addr);
    });

    if ($control){
        return $control->vote;
    }
    return false;
}

function is_product_post(): bool
{
    if (is_post() && cve_post_module() == 'product'){
        return true;
    }
    return false;
}

function is_request_type($type = REQUEST_API): bool
{
    if (isset(\Config\Services::request()->type) && \Config\Services::request()->type == $type){
        return true;
    }
    return false;
}

function is_file_extension($file, $ext = null)
{
    $parse = parse_url($file, PHP_URL_PATH);
    $extension = pathinfo($parse, PATHINFO_EXTENSION);
    if (is_null($ext)){
        return $extension;
    }

    if ($ext == $extension){
        return true;
    }
    return false;
}