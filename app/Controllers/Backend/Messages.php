<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Entities\MessageEntity;
use App\Libraries\EmailTo;
use App\Models\MessageModel;

class Messages extends BaseController
{
    protected $messageModel;
    protected $messageEntity;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
        $this->messageEntity = new MessageEntity();
    }

    public function listing($status = null)
    {
        if ($this->request->isAJAX()){
            $message = $this->messageModel
                ->where('status', STATUS_UNREAD)
                ->orderBy('created_at', 'DESC')
                ->paginate(3);

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'message_content_fetched'),
                'data' => view(PANEL_FOLDER . '/pages/message/partials/navbar-last-messages', [
                    'messages' => $message,
                ]),
                'unread' => count($message)
            ]);
        }

        if ($status == 'deleted'){
            $messages = $this->messageModel
                ->where('message_id', null)
                ->onlyDeleted()
                ->orderBy('created_at', 'DESC')
                ->paginate(25);
        }else{
            $messages = $this->messageModel
                ->where('message_id', null)
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }

        return view(PANEL_FOLDER . '/pages/message/listing',[
            'messages' => $messages,
            'pager' => $this->messageModel->pager
        ]);
    }

    public function delete()
    {
        if ($this->request->isAJAX()){
            $id = $this->request->getPost('id');

            $delete = $this->messageModel->delete($id);

            if(!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'delete_success')
            ]);

        }
        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'invalid_request_type')
        ]);

    }

    public function undoDelete()
    {
        if($this->request->isAJAX()){
            $id = $this->request->getPost('id');

            $update = $this->messageModel->update($id, ['deleted_at' => null]);

            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'undo_delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'undo_delete_success')
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'invalid_request_type')
        ]);

    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $id = $this->request->getPost('id');

            $delete = $this->messageModel->delete($id, true);

            if(!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'purge_delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'purge_delete_success')
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'invalid_request_type')
        ]);
    }

    public function detail()
    {
        if($this->request->isAJAX()) {

            $id = $this->request->getPost('id');
            $message = $this->messageModel->withDeleted()->find($id);

            if (!$message){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'message_not_found')
                ]);
            }

            $this->messageModel->update($id, [
                'status' => STATUS_READ
            ]);

            if ($this->messageModel->errors()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'message_mark_read_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'message_content_fetched'),
                'data' => view(PANEL_FOLDER . '/pages/message/detail', [
                    'message' => $message
                ])
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'invalid_request_type')
        ]);
    }

    public function reply()
    {
        if ($this->request->isAJAX()){
            $id = $this->request->getPost('id');
            $message = $this->messageModel->find($id);
            $reply = $this->request->getPost('reply');

            $this->messageEntity->setMessageId($message->id);
            $this->messageEntity->setName(session('userData.name'));
            $this->messageEntity->setEmail(session('userData.email'));
            $this->messageEntity->setSubject($message->getSubject());
            $this->messageEntity->setMessage($reply);
            $this->messageEntity->setStatus(STATUS_READ);

            $email = new EmailTo();

            $to = $email->setCustomUser($message->getEmail())->customMessage($message->getSubject(), $reply)->send();
            if(!$to){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'email_send_failure')
                ]);
            }

            $this->messageModel->insert($this->messageEntity);

            if ($this->messageModel->errors()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'message_send_db_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'message_send_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'invalid_request_type')
        ]);

    }
    //TODO: MarkUnread() metodu eklenecek.
    public function markAllRead()
    {
        if($this->request->isAJAX()){

            if (!cve_permit_control('message_detail')){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'message_auth_failure')
                ]);
            }

            $this->messageModel->where('status', STATUS_UNREAD)->update(null, [
                'status' => STATUS_READ
            ]);

            if ($this->messageModel->errors()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'message_mark_read_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'message_mark_read_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'invalid_request_type')
        ]);
    }
}