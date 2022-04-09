<?php


namespace App\Controllers\Api;

use \App\Controllers\BaseController;
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
    private $comment_delete_all = 'admin_comment_delete_all';
    private $comment_undo_delete_all = 'admin_comment_undo_delete_all';
    private $comment_purge_delete_all = 'admin_comment_purge_delete_all';
    private $comment_list = [];
    private $comment_reply = [];

    public function listing($status = null)
    {
        return $this->response([
            'status' => true,
            'message' => '',
            'data' => $this->commentListing($status)
        ]);
    }

    public function reply()
    {
        $this->commentReply();
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'comment_create_success'),
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