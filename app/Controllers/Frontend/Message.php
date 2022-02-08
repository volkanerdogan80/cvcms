<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Entities\MessageEntity;
use App\Models\MessageModel;

class Message extends BaseController
{
    protected $messageModel;
    protected $messageEntity;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
        $this->messageEntity = new MessageEntity();
    }

    public function send()
    {
        if ($this->request->getMethod() == 'post'){
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $subject = $this->request->getPost('subject');
            $message = $this->request->getPost('message');

            $this->messageEntity->setName($name);
            $this->messageEntity->setEmail($email);
            $this->messageEntity->setMessage($message);
            $this->messageEntity->setSubject($subject);

            $this->messageModel->insert($this->messageEntity);

            if ($this->messageModel->errors()){
                return redirect()->back()->with('error', $this->messageModel->errors());
            }

            return redirect()->back()->with('success', 'Mesaj başarılı bir şekilde iletildi.');

        }
    }
}