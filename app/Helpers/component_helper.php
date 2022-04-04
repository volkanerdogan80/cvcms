<?php
function cve_active_components()
{
    $model = new \App\Models\ComponentModel();
    return cve_cache('active_components', function () use($model){
        return $model->getComponentsByStatus();
    });
}

function cve_component_include($path)
{
    require_once (cve_component_file($path));
}

function cve_component_public($path = null): string
{
    return base_url(COMPONENTS_FOLDER . $path);
}

function cve_component_file($path = null, $folder = false): string
{
    $file_path = COMPONENTS_PATH . $path;
    if (!$folder){
        $file_ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_path = empty($file_ext) ? $file_path . '.php' : $file_path;
    }
    return $file_path;
}

foreach (cve_active_components() as $comp_key => $comp_value){
    if (is_dir(cve_component_file($comp_value->getFolder(), true))){
        $file = cve_component_file($comp_value->getFolder() . '/helper');
        if (file_exists($file)){
            require_once $file;
        }
    }
}

function cmp_comment_list($form = false): string
{
    return view('components/comments/list', [
        'form' => $form
    ]);
}

function cmp_comment_form($id ='cve-comment-form')
{
    return view('components/comments/form', ['id' => $id]);
}

function cmp_comment_modal($text = 'Comment', $type = 'primary'){
    return view('components/comments/modal', [
        'text' => $text,
        'type' => $type
    ]);
}

function cmp_contact_form($shadow = false){
    return view('components/contact/form', [
        'shadow' => $shadow
    ]);
}

function cmp_login_form($is_modal = false, $shadow = false){
    return view('components/auth/login/form', [
        'shadow' => $shadow,
        'is_modal' => $is_modal
    ]);
}

function cmp_login_modal($login_text = 'Login', $logout_text = 'Logout', $type = 'primary'){
    return view('components/auth/login/modal', [
        'login_text' => $login_text,
        'logout_text' => $logout_text,
        'type' => $type
    ]);
}

function cmp_register_form($shadow = false){
    return view('components/auth/register/form', [
        'shadow' => $shadow
    ]);
}

function cmp_register_modal($text = 'Register', $type = 'primary'){
    return view('components/auth/register/modal', [
        'text' => $text,
        'type' => $type
    ]);
}

function cmp_forgot_form($shadow = false){
    return view('components/auth/forgot/form', [
        'shadow' => $shadow
    ]);
}

function cmp_forgot_modal($text = 'Forgot Password?', $type = 'link', $button = true){
    return view('components/auth/forgot/modal', [
        'text' => $text,
        'type' => $type,
        'button' => $button
    ]);
}

function cmp_favorite_button($type = '1', $content = null){
    return view('components/buttons/favorite', [
        'type' => $type,
        'content' => $content
    ]);
}

function cmp_like_button($type = '1', $content = null){
    return view('components/buttons/like', [
        'type' => $type,
        'content' => $content
    ]);
}

function cmp_user_score_panel($content = null, $shadow = false){
    return view('components/rating/user-score-panel', [
        'content' => $content,
        'shadow' => $shadow
    ]);
}

function cmp_alert_message(){
    return view('components/other/alert');
}

function cmp_language_dropdown(){
    return view('components/language/dropdown');
}

function cmp_bootstrap_multilevel_menu($key)
{
    return view('components/menu/bootstrap-4-multilevel', [
        'key' => $key
    ]);
}