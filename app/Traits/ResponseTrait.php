<?php


namespace App\Traits;


trait ResponseTrait
{
    protected $response_status = null;
    protected $response_message = null;
    protected $response_data = [];
    protected $response_redirect = null;

    public function response($status = null, $message = null, $data = null, $view = null, $redirect = null)
    {
        $this->setArgs($status, $message, $data, $view, $redirect);

        if (is_request_type(REQUEST_API)){
            return $this->apiResponse();
        }else{
            return $this->webResponse();
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
            $message = $status['message'] ?? null;
            $data = $status['data'] ?? [];
            $redirect = $status['redirect'] ?? null;
            $status = $status['status'];
        }

        if (!$this->response_status){
            $this->setStatus($status);
        }

        if (!$this->response_message){
            $this->setMessage($message);
        }

        if (!$this->response_data){
            $this->setData($data);
        }

        if (!$this->response_redirect){
            $this->setRedirect($redirect);
        }
    }

    private function setMessage($message = null)
    {
        if ($message){
            $this->response_message = $message;
        }else{
            if ($this->response_status){
                $this->response_message = cve_admin_lang('Success', 'general_success');
            }else{
                $this->response_message = cve_admin_lang('Errors', 'general_failure');
            }
        }

    }

    private function setStatus($status = null)
    {
        if (!is_null($status)){
            if ($status){
                $this->response_status = 'success';
            }else{
                $this->response_status = 'error';
            }
        }else{
            $this->response_status = 'error';
        }
    }

    private function setData($data = null)
    {
        if ($data){
            $this->response_data = $data;
        }
    }

    private function setRedirect($redirect = null)
    {
        if ($redirect){
            $this->response_redirect = $redirect;
        }
    }
}