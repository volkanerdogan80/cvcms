<?php

return [
    'version' => '1.0.0',
    'name' => 'Whatsapp Mesaj Butonu',
    'author' => 'Volkan Erdoğan',
    'web' => 'https://cvmuhendislik.com',
    'email' => 'volkanerdogan80@gmail.com',
    'description' => 'CVCMS için geliştirilmiş whatsapp mesaj butonu.',
    'head' => [
        'fly-whatsapp-button-css' => cve_component_public('fly-whatsapp-button/public/fly-whatsapp-button.css'),
        'fly-whatsapp-button-js' => cve_component_public('fly-whatsapp-button/public/fly-whatsapp-button.js'),
    ],
    'footer' => [
        'fly-whatsapp-button-code' => cve_component_file('fly-whatsapp-button/index.php')
    ],
    'style' => [],
    'script' => [],
];