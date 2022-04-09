<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Traits\CommentTrait;
use App\Traits\ResponseTrait;
use App\Entities\CommentEntity;
use App\Models\CommentModel;

class Comment extends BaseController
{
    use CommentTrait;
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
        return $this->commentSend($content_id);
    }

}