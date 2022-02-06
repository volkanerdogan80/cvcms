<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	// Makes reading things below nicer,
	// and simpler to change out script that's used.
	public $aliases = [
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'IsLoggedIn' => \App\Filters\IsLoggedIn::class,
        'IsPermission' => \App\Filters\IsPermission::class,
        'ReCaptcha' => \App\Filters\ReCaptcha::class
	];

	// Always applied before every request
	public $globals = [
		'before' => [
            'honeypot' => [
			    'except' => [
                    '*/' . PANEL_FOLDER . '/*'
                ]
            ],
			'csrf' => [
                'except' => [
                    '*/' . PANEL_FOLDER . '/image/upload'
                ]
            ]
		],
		'after'  => [
            //'toolbar',
            'honeypot' => [
                'except' => [
                    '*/' . PANEL_FOLDER . '/*'
                ]
            ]
        ]
	];

	// Works on all of a particular HTTP method
	// (GET, POST, etc) as BEFORE filters only
	//     like: 'post' => ['CSRF', 'throttle'],
	public $methods = [];

	// List filter aliases and any before/after uri patterns
	// that they should run on, like:
	//    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
	public $filters = [
	    'IsLoggedIn' => [
	        'before' => [
                '*/' . PANEL_FOLDER . '/*'
            ]
        ],
        'IsPermission' => [
            'before' => [
                '*/' . PANEL_FOLDER . '/*'
            ]
        ],
        'ReCaptcha' => [
            'before' => [
                '*/'. PANEL_FOLDER . '/login',
                '*/'. PANEL_FOLDER . '/register',
                '*/'. PANEL_FOLDER . '/forgot-password'
            ]
        ]
    ];

    public $stopAuth = [
        'login',
        'register',
        'forgot-password',
        'reset-password',
        'verification'
    ];

}
