<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\LikeModel;
use App\Traits\ResponseTrait;

class Like extends BaseController
{
    use ResponseTrait;

    protected $likeModel;

    public function __construct()
    {
        $this->likeModel = new LikeModel();
    }

    public function liked()
    {
        if ($this->request->getMethod() == 'post'){

            $content_id = $this->request->getPost('id');
            $remote_addr = $this->request->getIPAddress();

            if ($this->likeModel->getLikeControlByRemoteAddr($content_id, $remote_addr)){
                return $this->response(['status' => false, 'message' => 'Daha önce bu içeriği beğenmişsiniz.']);
            }

            $this->likeModel->insert([
                'content_id' => $content_id,
                'remote_addr' => $this->request->getIPAddress()
            ]);

            if ($this->likeModel->errors()){
                return $this->response(['status' => false, 'message' => $this->likeModel->errors(),]);
            }

            return $this->response([
                'status' => true,
                'message' => 'İçerik başarılı bir şekilde beğenildi.',
                'data' => [
                    'likeCount' => $this->likeModel->getLikeCountByContentId($content_id)
                ]
            ]);
        }

        return $this->response(['status' => false, 'message' => 'Geçersiz istek türü']);
    }

}