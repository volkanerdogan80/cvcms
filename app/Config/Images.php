<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Images extends BaseConfig
{
	public $defaultHandler = 'gd';

	public $libraryPath = '/usr/local/bin/convert';

    public $defaultThumbnail = ['187x134'];

    public $compressor = 50;

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
		'gd'      => \CodeIgniter\Images\Handlers\GDHandler::class,
		'imagick' => \CodeIgniter\Images\Handlers\ImageMagickHandler::class,
	];

    public static $registrars = [
        'App\Controllers\Config'
    ];

}
