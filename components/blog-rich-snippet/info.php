<?php

return [
    'version' => '1.0.0',
    'name' => 'Blog Rich Snippet',
    'author' => 'Volkan Erdoğan',
    'web' => 'https://cvmuhendislik.com',
    'email' => 'volkanerdogan80@gmail.com',
    'description' => 'Google’da karşımıza çıkan başlık, URL ve açıklama kısmı',
    'head' => [
        'blog-rich-snippet' => cve_component_file('blog-rich-snippet/index')
    ],
    'footer' => [],
    'style' => [],
    'script' => [],
];
