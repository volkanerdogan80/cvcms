<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\RatingModel;
use App\Traits\ResponseTrait;

class Rating extends BaseController
{
    use ResponseTrait;

    protected $ratingModel;

    public function __construct()
    {
        $this->ratingModel = new RatingModel();
    }

    public function voted()
    {
        if ($this->request->getMethod() == 'post'){
            $content_id = $this->request->getPost('id');
            $vote = $this->request->getPost('vote');
            $remote_addr = $this->request->getIPAddress();

            if ($this->ratingModel->getRatingControlByRemoteAddr($content_id, $remote_addr)){
                return $this->response([
                    'status' => false,
                    'message' => 'Bu içeriğe daha önce oy vermişsiniz.'
                ]);
            }

            $this->ratingModel->insert([
                'content_id' => $content_id,
                'remote_addr' => $remote_addr,
                'vote' => $vote
            ]);

            if ($this->ratingModel->errors()){
                return $this->response([
                    'status' => false,
                    'message' => $this->ratingModel->errors()
                ]);
            }

            return $this->response([
                'status' => true,
                'message' => 'Derecelendirme başarılı bir şekilde yapıldı.',
                'data' => [
                    'ratingAvg' => $this->ratingModel->getRatingAvgByContentId($content_id),
                    'voteList' => $this->ratingModel->getRatingCountByContentID($content_id),
                ]
            ]);
        }

        return $this->response([
            'status' => false,
            'message' => 'Geçersiz istek türü'
        ]);

    }

}