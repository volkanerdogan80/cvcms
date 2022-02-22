<?php

namespace App\Controllers;

use App\Models\FirebaseModel;

class Firebase extends BaseController
{

    protected $firebase;

    public function __construct(){
        $this->firebase = new \App\Libraries\Firebase();
    }

    public function index()
    {
        $this->response->setHeader('Content-Type', 'application/javascript');
        return view('theme-autoload/firebase-messaging-sw');
    }

    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        if ($this->request->isAJAX()){
            $model = new FirebaseModel();
            $model->insert([
                'token' => $this->request->getPost('token')
            ]);
        }
    }


    public function send()
    {
        if ($this->request->isAJAX())
        {
            $send = $this->firebase->setToken()->setContent([
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'click_action' => $this->request->getPost('click_action'),
            ])->send();

            if ($send){
                return $this->response->setJSON([
                    'status' => true,
                    'message' => cve_admin_lang('Success', 'notification_success')
                ]);
            }

            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'notification_send_failure')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'invalid_request_type')
        ]);
    }
}
