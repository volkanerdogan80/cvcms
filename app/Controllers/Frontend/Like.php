<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\LikeModel;

class Like extends BaseController
{

    protected $likeModel;

    public function __construct()
    {
        $this->likeModel = new LikeModel();
    }

    public function create($content_id)
    {
        if ($this->request->getMethod() == 'post'){
            $this->likeModel->create([
                'content_id' => $content_id,
                'remote_addr' => $this->request->getIPAddress()
            ]);

            if ($this->likeModel->errors()){
                return redirect()->back()->with('error', $this->likeModel->errors());
            }

            return redirect()->back()->with('success', 'İçerik başarılı bir şekilde beğenildi.');
        }

        return redirect()->back()->with('error', 'Geçersiz istek türü');
    }

}