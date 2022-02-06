<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\ContentModel;

class Home extends BaseController
{

    public function index()
    {
        $model = new ContentModel();

        return view('themes/default/single/blog', [
            'content' => $model->first()
        ]);
    }

}