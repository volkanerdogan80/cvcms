<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\ContentModel;

class Search extends BaseController
{
    public function index()
    {
        $search = $this->request->getGet('q');
        if ($search){
            $model = new ContentModel();
            $contents = cve_cache(sprintf("%s_%s", 'search_', $search), function () use($model, $search){
                return $model->search($search, 20);
            });
            return cve_view('search', $contents);
        }

        // TODO: Kullanıcıyı anasayfa değilde hata mesajı sayfasına yönlendir
        return  redirect('homepage');
    }
}
