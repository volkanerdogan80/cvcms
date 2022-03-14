<?php

function auth_user($key = null)
{
    $request = \Config\Services::request();
    if (is_null($key)){
        return $request->user;
    }

    if (isset($request->user) && isset($request->user->$key)){
        return $request->user->$key;
    }

    return null;
}

function auth_user_id()
{
    return auth_user('id');
}

function auth_user_name()
{
    return auth_user('name');
}

function auth_user_email()
{
    return auth_user('email');
}

function auth_user_phone()
{
    return auth_user('phone');
}

function auth_user_identity()
{
    return auth_user('identity');
}

function auth_user_group()
{
    return auth_user('group');
}

function auth_user_permissions()
{
    return auth_user('permissions');
}
