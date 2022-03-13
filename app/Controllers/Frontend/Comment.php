<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Entities\CommentEntity;
use App\Models\CommentModel;
use App\Traits\ResponseTrait;

class Comment extends BaseController
{

    use ResponseTrait;

    protected $commentModel;
    protected $commentEntity;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->commentEntity = new CommentEntity();
    }

    public function send($content_id)
    {
        if ($this->request->getMethod() == 'post'){

            $name = session('userData.name') ? session('userData.name') : $this->request->getPost('name');
            $email = session('userData.email') ? session('userData.email') : $this->request->getPost('email');
            $comment = $this->request->getPost('comment');
            $comment_id = $this->request->getPost('comment_id') ? $this->request->getPost('comment_id') : null;

            $this->commentEntity->setName($name);
            $this->commentEntity->setEmail($email);
            $this->commentEntity->setComment($comment);
            $this->commentEntity->setCommentId($comment_id);
            $this->commentEntity->setContentId($content_id);
            $this->commentEntity->setStatus(STATUS_PENDING);

            $this->commentModel->insert($this->commentEntity);

            if($this->commentModel->errors()){
                return $this->response([
                    'status' => false,
                    'message' => $this->commentModel->errors()
                ]);            }


            return $this->response([
                'status' => true,
                'message' => 'Yorum başarılı bir şekilde gönderildi.'
            ]);
        }
        return $this->response(['status' => false, 'message' => 'Geçersiz istek türü']);
    }

}