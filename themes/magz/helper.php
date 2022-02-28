<?php

function post_format()
{
    return [
        'video' => [
            'name' => 'Video Format',
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
        'register' => [
            'path' => 'auth/register',
            'title' => 'Kayıt Sayfası Şablonu'
        ],
        'forgot' => [
            'path' => 'auth/forgot',
            'title' => 'Şifremi Unuttum Sayfası Şablonu'
        ],
        'favorite' => [
            'path' => 'account/favorite',
            'title' => 'Favori İçeriklerim Sayfası'
        ],
        'comments' => [
            'path' => 'account/comments',
            'title' => 'Yorum Yaptığım İçerikler Sayfası'
        ]
    ];
}

function email_template()
{
    return [];
}