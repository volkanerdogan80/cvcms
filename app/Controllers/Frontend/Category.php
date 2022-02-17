<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function index($slug)
    {
        $category = cve_category($slug);

        return  cve_view('category/' . cve_cat_module($category), [
            'category' => $category
        ]);
    }
}