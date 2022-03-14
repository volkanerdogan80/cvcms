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
        'ApiAuth' => \App\Filters\ApiAuth::class,
        'UserData' => \App\Filters\UserData::class,
        'ReCaptcha' => \App\Filters\ReCaptcha::class,
        'ThemeJavascript' => \App\Filters\ThemeJavascript::class,
        'ThemeStyle' => \App\Filters\ThemeStyle::class,
        'ThemeWebmaster' => \App\Filters\ThemeWebmaster::class,
        'ThemeFirebase' => \App\Filters\ThemeFirebase::class,
        'ThemeMeta' => \App\Filters\ThemeMeta::class,
        'ThemeRichSnippet' => \App\Filters\ThemeRichSnippet::class,
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
                    '*/' . PANEL_FOLDER . '/image/upload',
                    '*/api/*'
                ]
            ],
            'UserData' => [
                'except' => [
                    '*/api/*'
                ]
            ]
		],
		'after'  => [
            //'toolbar',
            'honeypot' => [
                'except' => [
                    '*/' . PANEL_FOLDER . '/*'
                ]
            ],
            'ThemeJavascript' => [
                'except' => [
                    '*/' . PANEL_FOLDER . '/*',
                    'install/*',
                ]
            ],
            'ThemeStyle' => [
                'except' => [
                    '*/' . PANEL_FOLDER . '/*',
                    'install/*',
                ]
            ],
            'ThemeWebmaster' => [
                'except' => [
                    '*/' . PANEL_FOLDER . '/*',
                    'install/*',
                ]
            ],
            'ThemeFirebase' => [
                'except' => [
                    '*/' . PANEL_FOLDER . '/*',
                    'install/*',
                ]
            ],
            'ThemeMeta' => [
                'except' => [
                    '*/' . PANEL_FOLDER . '/*',
                    'install/*',
                ]
            ],
            'ThemeRichSnippet' => [
                'except' => [
                    '*/' . PANEL_FOLDER . '/*',
                    'install/*',
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
        'ApiAuth' => [
            'before' => [
                '*/api/*',
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
