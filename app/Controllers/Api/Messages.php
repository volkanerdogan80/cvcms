<?php


namespace App\Controllers\Api;


use App\Controllers\BaseController;
use App\Traits\MessageTrait;
use App\Traits\ResponseTrait;

class Messages extends BaseController
{
    use MessageTrait;
    use ResponseTrait;

    public function listing($status = null)
    {
        $this->messageListing($status);
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'message_content_fetched'),
            'view' => 'admin/pages/message/listing',
            'data' => $this->view_data
        ]);
    }

    public function detail()
    {
        $this->messageDetail();
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'message_content_fetched'),
            'data' => [
                'message' => $this->message
            ]
        ]);
    }

    public function reply()
    {
        return $this->messageSend();
    }

    public function delete()
    {
        return $this->messageDelete();
    }

    public function undoDelete()
    {
        return $this->messageUndoDelete();

    }

    public function purgeDelete()
    {
        return $this->messagePurgeDelete();
    }

    public function markAllRead()
    {
        return $this->messageMarkAllRead();
    }

}