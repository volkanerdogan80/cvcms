<?php

return [
    'version' => '1.0.0',
    'name' => 'Webmaster Araçları',
    'author' => 'Volkan Erdoğan',
    'web' => 'https://cvmuhendislik.com',
    'email' => 'volkanerdogan80@gmail.com',
    'description' => 'CVCMS için geliştirilmiş webmaster araçları componenti.',
    'head' => [
        'webmaster-verification' => cve_component_file('webmaster-tools/verification')
    ],
    'footer' => [
        'webmaster-analytics' => cve_component_file('webmaster-tools/analytics')
    ],
    'style' => [],
    'script' => [],
];
