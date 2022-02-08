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
