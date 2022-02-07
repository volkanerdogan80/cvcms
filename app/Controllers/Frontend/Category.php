<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function index($slug)
    {
        $model = new CategoryModel();

        return view('themes/default/category/blog', [
            'category' => $model->where('slug', $slug)->first()
        ]);
    }
}