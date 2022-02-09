<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\FavoriteModel;

class Favorite extends BaseController
{
    protected $favoriteModel;

    public function __construct()
    {
        $this->favoriteModel = new FavoriteModel();
    }

    public function favorite($content_id)
    {
        if ($this->request->getMethod() == 'get'){
            $fav_content = $this->favoriteModel
                ->where('user_id',session('userData.id'))
                ->where('content_id', $content_id)
                ->first();

            if ($fav_content){
                $this->favoriteModel->delete($fav_content->id);
                return redirect()->back()->with('success', 'Favorilerden başarılı bir şekilde kaldırıldı.');
            }

            $this->favoriteModel->insert([
                'content_id' => $content_id,
                'user_id' => session('userData.id')
            ]);

            if ($this->favoriteModel->errors()){
                return redirect()->back()->with('error', $this->favoriteModel->errors());
            }

            return redirect()->back()->with('success', 'İçerik Başarılı bir şekilde favorilere eklendi.');

        }
    }
}