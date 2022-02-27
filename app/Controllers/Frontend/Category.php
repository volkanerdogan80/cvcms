<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function index($slug)
    {
        $category = cve_category($slug);

        // TODO: Kullanıcıyı anasayfa değilde hata mesajı sayfasına yönlendir
        if (!is_theme_folder('category')) {
            return redirect('homepage');
        }

        // TODO: Kullanıcıyı anasayfa değilde hata mesajı sayfasına yönlendir
        if (!is_theme_file('category/' . cve_cat_module($category))) {
            return redirect('homepage');
        }

        return  cve_theme_view('category/' . cve_cat_module($category), [
            'category' => $category,
            'contents' => cve_cat_posts($category, 10, true)
        ]);
    }
}

