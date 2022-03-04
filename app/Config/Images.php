<?php namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Images\Handlers\GDHandler;
use CodeIgniter\Images\Handlers\ImageMagickHandler;

class Images extends BaseConfig
{
	public $defaultHandler = 'gd';

	public $libraryPath = '/usr/local/bin/convert';

    public $thumbnail = [];

    public $compressor = 70;

    public $delete = 'all'; // all, original, db Seçenekler gelebilir.

    public $watermark = [
        'status' => false,
        'text' => 'localhost.com',
        'color' => '#ffffff',
        'opacity' => 0,
        'withShadow' => true,
        'fontSize' => 500,
        'hAlign' => 'center',
        'vAlign' => 'bottom'
    ];

    public $handlers = [
		'gd'      => GDHandler::class,
		'imagick' => ImageMagickHandler::class,
	];

    public static $registrars = [
        'App\Controllers\Config'
    ];

}
