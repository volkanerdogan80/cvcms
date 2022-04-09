<?php


namespace App\Traits;


use App\Entities\MessageEntity;
use App\Libraries\EmailTo;
use App\Models\MessageModel;

trait MessageTrait
{
    public $view_data = [];
    public $message_id = null;
    public $message = null;

    public function messageListing($status = null)
    {
        $message_model = new MessageModel();
        $per_page = !$this->request->isAjax() ? 20 : 3;

        if ($status == 'deleted'){
            $this->view_data = $message_model->getMessagesByDeleted($per_page);
        }else{
            $this->view_data = $message_model->getMessagesByStatus(false, $per_page);
        }

        return $this->view_data;
    }

    public function messageDetail()
    {
        $message_model = new MessageModel();
        $this->message_id = $this->request->getPost('id');
        $this->message = $message_model->getMessageById($this->message_id, false, true);
        if (!$this->message){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'message_not_found')
            ]);
        }

        $message_model->update($this->message_id, [
            'status' => STATUS_READ
        ]);

        if ($message_model->errors()) {
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'message_mark_read_failure')
            ]);
        }
    }

    public function messageSend()
    {
        $message_model = new MessageModel();
        $this->message_id = $this->request->getPost('id');
        $reply = $this->request->getPost('reply');

        $name = auth_user_name() ?? $this->request->getPost('name');
        $email = auth_user_email() ?? $this->request->getPost('email');

        if ($this->message_id){
            $this->message = $message_model->find($this->message_id);
            $subject = cve_admin_lang('General', 'answer') . ' : ' . $this->message->getSubject();
        }else{
            $subject = $this->request->getPost('subject');
        }

        $message = $this->request->getPost('message') ?? $reply;
        $message_entity = new MessageEntity();
        $message_entity->setMessageId($this->message_id);
        $message_entity->setName($name);
        $message_entity->setEmail($email);
        $message_entity->setSubject($subject);
        $message_entity->setMessage($message);
        $message_entity->setStatus(STATUS_READ);

        if (!is_null($this->message_id)){
            $email_to = new EmailTo();
            $send =  $email_to->setEmail($this->message->getEmail())
                ->setSubject($this->message->getSubject())
                ->setTemplate($reply, true)
                ->send();

            if(!$send){
                return $this->response([
                    'status' => false,
                    'message' => cve_admin_lang('Errors','message_reply_failure')
                ]);
            }
        }

        $this->message_id = $message_model->insert($message_entity);

        if ($message_model->errors()) {
            return $this->response([
                'status' => false,
                'message' => $message_model->errors()
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'message_send_success')
        ]);
    }

    public function messageDelete()
    {
        $this->message_id = $this->request->getPost('id');
        $message_model = new MessageModel();
        $delete = $message_model->delete($this->message_id);

        if(!$delete){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'delete_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'delete_success')
        ]);
    }

    public function messageUndoDelete()
    {
        $this->message_id = $this->request->getPost('id');
        $message_model = new MessageModel();
        $update = $message_model->update($this->message_id, ['deleted_at' => null]);

        if(!$update){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'undo_delete_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'undo_delete_success')
        ]);
    }

    public function messagePurgeDelete()
    {
        $this->message_id = $this->request->getPost('id');
        $message_model = new MessageModel();
        $delete = $message_model->delete($this->message_id, true);

        if(!$delete){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'purge_delete_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'purge_delete_success')
        ]);
    }

    public function messageMarkAllRead()
    {
        if (!cve_permit_control('message_detail')){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'unauthorized_request')
            ]);
        }

        $message_model = new MessageModel();
        $message_model->where('status', STATUS_UNREAD)->update(null, [
            'status' => STATUS_READ
        ]);

        if ($message_model->errors()) {
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'message_mark_read_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'message_mark_read_success')
        ]);
    }
}