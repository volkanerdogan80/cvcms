<?php

return [
    'version' => '1.0.0',
    'name' => 'UIKIT CSS Bileşenleri',
    'author' => 'Volkan Erdoğan',
    'web' => 'https://cvmuhendislik.com',
    'email' => 'volkanerdogan80@gmail.com',
    'description' => 'UIKIT css ile geliştirilmiş bileşenler.',
    'head' => [
        'uikit' => cve_component_public('uikit-components/public/css/uikit.min.css'),
        'uikit-like' => cve_component_public('uikit-components/public/css/like.css'),
        'uikit-favorite' => cve_component_public('uikit-components/public/css/favorite.css'),
        'uikit-score' => cve_component_public('uikit-components/public/css/score.css'),
    ],
    'footer' => [
        'uikit' => cve_component_public('uikit-components/public/js/uikit.js'),
        'uikit-icon' => cve_component_public('uikit-components/public/js/uikit-icons.min.js'),
        'uikit-contact' => cve_component_public('uikit-components/public/js/contact.js'),
        'uikit-comment' => cve_component_public('uikit-components/public/js/comment.js'),
        'uikit-like' => cve_component_public('uikit-components/public/js/like.js'),
        'uikit-favorite' => cve_component_public('uikit-components/public/js/favorite.js'),
        'uikit-score' => cve_component_public('uikit-components/public/js/score.js'),
    ],
    'style' => [],
    'script' => [],
];