<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Traits\CommentTrait;
use App\Traits\ResponseTrait;


class Comment extends BaseController
{
    use CommentTrait;
    use ResponseTrait;

    private $listing_all_permit = 'admin_comment_listing_all';
    private $reply_all_permit = 'admin_comment_reply_all';
    private $comment_edit_all = 'admin_comment_edit_all';
    private $comment_status_all = 'admin_comment_status_all';
    private $comment_undo_delete_all = 'admin_comment_undo_delete_all';
    private $comment_list = [];
    private $comment_reply = [];

    public function listing(string $status = null)
    {
        return $this->response([
            'status' => true,
            'message' => '',
            'data' => $this->commentListing($status),
            'view' => PANEL_FOLDER . '/pages/comment/listing'
        ]);
    }

    public function replyModal()
    {
        $comment_model = new CommentModel();
        return view(PANEL_FOLDER . '/pages/comment/reply-modal', [
            'comment' => $comment_model->find($this->request->getGet('id'))
        ]);
    }

    public function reply()
    {
        $comment_model = new CommentModel();
        $this->commentReply();
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'comment_create_success'),
            'data' => [
                'comment' => view(PANEL_FOLDER . '/pages/comment/reply-comment', [
                    'comment' => $this->comment_id ? $comment_model->find($this->comment_id) : null,
                    'level' => $this->level+1
                ])
            ],
        ]);
    }

    public function editModal()
    {
        $comment_model = new CommentModel();
        return view(PANEL_FOLDER . '/pages/comment/edit-modal', [
            'comment' => $comment_model->find($this->request->getGet('id'))
        ]);
    }

    public function edit()
    {
        return $this->commentEdit();
    }

    public function status()
    {
        return $this->commentStatus();
    }

    public function delete()
    {
        return $this->commentDelete();
    }

    public function undoDelete()
    {
        return $this->commentUndoDelete();
    }

    public function purgeDelete()
    {
        return $this->commentPurgeDelete();
    }
}