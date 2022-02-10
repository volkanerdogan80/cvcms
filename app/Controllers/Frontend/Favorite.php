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

    public function favorite($content_id)
    {
        if ($this->request->getMethod() == 'post'){
            $favorite = $this->favoriteModel
                ->where('user_id',session('userData.id'))
                ->where('content_id', $content_id)
                ->first();

            if ($favorite){
                $this->favoriteModel->delete($favorite->id);
                return $this->response([
                    'status' => true,
                    'message' => 'Favorilerden başarılı bir şekilde kaldırıldı.',
                    'data' => [
                        'favoriteCount' => $this->favoriteModel->where('content_id', $content_id)->countAllResults()
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
                    'favoriteCount' => $this->favoriteModel->where('content_id', $content_id)->countAllResults()
                ]
            ]);

        }

        return $this->response(['status' => false, 'message' => 'Geçersiz istek türü']);
    }
}