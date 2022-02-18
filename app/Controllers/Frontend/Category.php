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
        if (!is_dir(cve_theme_file_path('category'))) {
            return redirect('homepage');
        }

        // TODO: Kullanıcıyı anasayfa değilde hata mesajı sayfasına yönlendir
        if (!file_exists(cve_theme_file_path('category/' . cve_cat_module($category) . '.php'))) {
            return redirect('homepage');
        }

        return  cve_view('category/' . cve_cat_module($category), [
            'category' => $category,
            //'contents' => cve_cat_posts($category, 20, true) // Burdan object olarak gittiğinden modelde explode sorunu veriyor. Oraya bir kontrol gerek
        ]);
    }
}

