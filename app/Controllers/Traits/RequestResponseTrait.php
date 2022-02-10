<?php


namespace App\Controllers\Traits;


trait RequestResponseTrait
{
    public function response($params)
    {
        if ($this->request->isAjax()){
            return $this->response->setJSON([
                'status' => $params['status'],
                'message' => $params['message'],
                'data' => $params['data'] ?? []
            ]);
        }

        $status = $params['status'] ? 'success' : 'error';
        return redirect()->back()->with($status, $params['message']);
    }
}
