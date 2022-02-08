<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function index($slug)
    {
        $category = cve_category($slug);

        return view('themes/' . cve_theme_folder() . '/category/' . cve_cat_module($category), [
            'category' => $category
        ]);
    }
}