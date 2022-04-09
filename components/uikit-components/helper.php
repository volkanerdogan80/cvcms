<?php

function uikit_contact_form(){
    return cve_component_view('uikit-components/contact/form');
}

function uikit_comment_list(){
    return cve_component_view('uikit-components/comment/list');
}

function uikit_comment_form(){
    return cve_component_view('uikit-components/comment/form');
}

function uikit_comment_modal(){
    return cve_component_view('uikit-components/comment/modal');
}

function uikit_favorite_button(){
    return cve_component_view('uikit-components/button/favorite');
}

function uikit_like_button(){
    return cve_component_view('uikit-components/button/like');
}

function uikit_user_score_panel(){
    return cve_component_view('uikit-components/score/score-1');
}

function uikit_alert_message(){
    return cve_component_view('uikit-components/alert/alert-1');
}

function uikit_login_form(){
    return cve_component_view('uikit-components/login/form');
}

function uikit_login_modal(){
    return cve_component_view('uikit-components/login/modal');
}

function uikit_register_form(){
    return cve_component_view('uikit-components/register/form');
}

function uikit_register_modal(){
    return cve_component_view('uikit-components/register/modal');
}

function uikit_forgot_form(){
    return cve_component_view('uikit-components/forgot/form');
}

function uikit_forgot_modal($button = true){
    return cve_component_view('uikit-components/forgot/modal', [
        'button' => $button
    ]);
}