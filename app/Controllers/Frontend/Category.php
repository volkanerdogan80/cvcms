<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;

class Category extends BaseController
{
    public function index($slug)
    {
        print_r($slug);
    }
}
