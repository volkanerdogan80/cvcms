<?php

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
