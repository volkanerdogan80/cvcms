<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\RatingModel;

class Rating extends BaseController
{
    protected $ratingModel;

    public function __construct()
    {
        $this->ratingModel = new RatingModel();
    }

    public function vote($content_id)
    {
        if ($this->request->getMethod() == 'post'){
            $vote = $this->request->getPost('vote');

            $this->ratingModel->insert([
                'content_id' => $content_id,
                'remote_addr' => $this->request->getIPAddress(),
                'vote' => $vote
            ]);

            if ($this->ratingModel->errors()){
                return redirect()->back()->with('error', $this->ratingModel->errors());
            }

            return redirect()->back()->with('success', 'Değercelendirme başarılı bir şekilde yapıldı.');
        }

        return redirect()->back()->with('error', 'Geçersiz istek türü');
    }

}