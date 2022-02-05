<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\ContentModel;

class Content extends BaseController
{

    public function index($slug)
    {
        $model = new ContentModel();
        return view('themes/'.cve_theme_folder().'/single/blog', [
            'content' => $model->where('slug', $slug)->first()
        ]);
    }

}