<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Traits\MessageTrait;
use App\Traits\ResponseTrait;

class Messages extends BaseController
{
    use ResponseTrait;
    use MessageTrait;

    public function listing($status = null)
    {
        $this->messageListing($status);
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'message_content_fetched'),
            'view' => PANEL_FOLDER . '/pages/message/listing',
            'data' => [
                'messages' => $this->view_data,
                'view' => view(PANEL_FOLDER . '/pages/message/partials/navbar-last-messages', $this->view_data),
                'length' => count($this->view_data)
            ]
        ]);
    }

    public function detail()
    {
        $this->messageDetail();
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'message_content_fetched'),
            'data' => [
                'view' => view(PANEL_FOLDER . '/pages/message/detail', [
                    'message' => $this->message
                ])
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