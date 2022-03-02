<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\Traits\ResponseTrait;
use App\Models\FavoriteModel;

class Favorite extends BaseController
{
    use ResponseTrait;

    protected $favoriteModel;

    public function __construct()
    {
        $this->favoriteModel = new FavoriteModel();
    }

    public function favorite()
    {
        if(!is_logged_in()){
            return $this->response(['status' => false, 'message' => 'Lütfen giriş yaparak tekrar deneyiniz.']);
        }
        if ($this->request->getMethod() == 'post'){

            $content_id = $this->request->getPost('id');

            if ($favorite = $this->favoriteModel->getUserFavoriteControl($content_id)){
                $this->favoriteModel->delete($favorite->id);
                return $this->response([
                    'status' => true,
                    'message' => 'Favorilerden başarılı bir şekilde kaldırıldı.',
                    'data' => [
                        'favoriteCount' => $this->favoriteModel->getFavoriteCount($content_id)
                    ]
                ]);
            }

            $this->favoriteModel->insert([
                'content_id' => $content_id,
                'user_id' => session('userData.id')
            ]);

            if ($this->favoriteModel->errors()){
                return $this->response([
                    'status' => false,
                    'message' => $this->favoriteModel->errors()
                ]);
            }

            return $this->response([
                'status' => true,
                'message' => 'İçerik Başarılı bir şekilde favorilere eklendi.',
                'data' => [
                    'favoriteCount' => $this->favoriteModel->getFavoriteCount($content_id)
                ]
            ]);

        }

        return $this->response(['status' => false, 'message' => 'Geçersiz istek türü']);
    }
}