<?php


namespace App\Controllers\Traits;


trait ResponseTrait
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
        if (isset($params['route'])){
            return redirect()->to(route_to($params['route']))->with($status, $params['message']);
        }
        return redirect()->back()->with($status, $params['message']);
    }
}
