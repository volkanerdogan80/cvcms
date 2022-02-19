<?php

function post_format()
{
    return [
        'standard' => [
            'name' => 'Standart Format',
            'custom_field' => []
        ],
        'video' => [
            'name' => 'Video Format',
            'custom_field' => [
                ['key' => 'youtube', 'lang' => false, 'value' => ''],
                ['key' => 'vimeo', 'lang' => false, 'value' => ''],
            ]
        ],
        'gallery' => [
            'name' => 'Galeri Format',
            'custom_field' => [
                ['key' => 'youtube', 'lang' => false, 'value' => ''],
                ['key' => 'vimeo', 'lang' => false, 'value' => ''],
            ]
        ],
        'download' => [
            'name' => 'Download Format',
            'custom_field' => [
                ['key' => 'download_url', 'lang' => false, 'value' => ''],
                ['key' => 'file_size', 'lang' => false, 'value' => ''],
            ]
        ]
    ];
}

function page_template()
{
    return [
        'default' => [
            'path' => 'page/default',
            'title' => 'Varsayılan Şablon'
        ],
        'contact' => [
            'path' => 'page/contact',
            'title' => 'İletişim Sayfa Şablonu'
        ],
        'login' => [
            'path' => 'auth/login',
            'title' => 'Giriş Sayfası Şablonu'
        ],
    ];
}

function email_template()
{
    return [
        'default_theme_account_verify' => [
            'path' =>  'email/account-verify',
            'title' => 'Varsayılan Hesap Doğrulama Şablonu'
        ]
    ];
}