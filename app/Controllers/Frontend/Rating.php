<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\Traits\ResponseTrait;
use App\Models\RatingModel;

class Rating extends BaseController
{
    use ResponseTrait;

    protected $ratingModel;

    public function __construct()
    {
        $this->ratingModel = new RatingModel();
    }

    public function voted($content_id)
    {
        if ($this->request->getMethod() == 'post'){
            $vote = $this->request->getPost('vote');
            $remote_addr = $this->request->getIPAddress();

            if ($this->ratingModel->getContentIpControl($content_id, $remote_addr)){
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
                'message' => 'Değercelendirme başarılı bir şekilde yapıldı.',
                'data' => [
                    'ratingAvg' => $this->ratingModel->getContentVoteAvg($content_id)->vote,
                    'voteList' => $this->ratingModel->getContentVoteCount($content_id),
                ]
            ]);

        }

        return $this->response([
            'status' => false,
            'message' => 'Geçersiz istek türü'
        ]);

    }

}