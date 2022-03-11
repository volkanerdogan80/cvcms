<?php


namespace App\Traits;


trait ResponseTrait
{
    protected $response_status = false;
    protected $response_message = null;
    protected $response_data = [];
    protected $response_redirect;

    public function response($status = null, $message = null, $data = null, $redirect = null)
    {
        if (!is_null($status)){
            $this->setArgs($status, $message, $data, $redirect);
        }

        $this->setMessage();
        $this->setStatus();

        if ($this->request->type == REQUEST_WEB){
            return $this->webResponse();
        }else{
            return $this->apiResponse();
        }
    }

    public function webResponse()
    {
        if ($this->request->isAjax()){
            return $this->ajaxResponse();
        }else{
            return $this->redirectResponse();
        }
    }

    public function apiResponse()
    {
        return $this->response->setJSON([
            'status' => $this->response_status,
            'message' => $this->response_message,
            'data' => $this->response_data
        ]);
    }

    public function ajaxResponse()
    {
        return $this->response->setJSON([
            'status' => $this->response_status,
            'message' => $this->response_message,
            'data' => $this->response_data
        ]);
    }

    public function redirectResponse()
    {
        if (!$this->response_redirect){
            return redirect()->back()->withInput()->with($this->response_status, $this->response_message);
        }
        return redirect()->to(base_url($this->response_redirect))->withInput()->with($this->response_status, $this->response_message);
    }

    private function setArgs($status, $message, $data, $redirect)
    {
        if (is_array($status)){
            $this->response_status = $status['status'];
            $this->response_message = $status['message'] ?? null;
            $this->response_data = $status['data'] ?? [];
            $this->response_redirect = $status['redirect'] ?? null;
        }else{
            $this->response_status = $status;
            $this->response_message = $message;
            $this->response_data = !is_null($data) ? $data : [];
            $this->response_redirect = $redirect;
        }
    }

    private function setMessage()
    {
        if (!$this->response_message){
            if ($this->response_status){
                $this->response_message = cve_admin_lang('Success', 'general_success');
            }else{
                $this->response_message = cve_admin_lang('Errors', 'general_failure');
            }
        }
    }

    private function setStatus()
    {
        if (!$this->response_status){
            $this->response_status = 'error';
        }else{
            $this->response_status = 'success';
        }
    }
}