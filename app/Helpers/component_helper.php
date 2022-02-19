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

function cmp_comment_modal($text = 'Yorum Yap', $type = null, $color = 'primary'){
    return view('components/comments/modal', [
        'text' => $text,
        'type' => $type,
        'color' => $color
    ]);
}

function cmp_contact_form($shadow = false){
    return view('components/contact/form', [
        'shadow' => $shadow
    ]);
}