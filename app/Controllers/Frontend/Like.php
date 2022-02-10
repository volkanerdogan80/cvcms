<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\Traits\RequestResponseTrait;
use App\Models\LikeModel;

class Like extends BaseController
{

    use RequestResponseTrait;

    protected $likeModel;

    public function __construct()
    {
        $this->likeModel = new LikeModel();
    }

    public function liked($content_id)
    {
        if ($this->request->getMethod() == 'post'){

            $control = $this->likeModel->where([
                'content_id' => $content_id,
                'remote_addr' => $this->request->getIPAddress()
            ])->first();

            if ($control){
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
                    'likeCount' => $this->likeModel->where('content_id', $content_id)->countAllResults()
                ]
            ]);
        }

        return $this->response(['status' => false, 'message' => 'Geçersiz istek türü']);
    }

}