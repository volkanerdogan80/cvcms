<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class Analytics extends BaseController
{

    protected $client;
    protected $viewId;
    protected $analytics;

    public function __construct()
    {
        $this->viewId = config('webmaster')->accountId;
        $this->client = new \Google_Client();
        $this->client->setAuthConfig(WRITEPATH . 'uploads/google-analytics-account.json');
        $this->client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $this->analytics = new \Google_Service_Analytics($this->client);
    }

    public function dashboard()
    {
        return view('admin/pages/analytics/dashboard');
    }

    public function getRealTimeVisitors(){

        if ($this->request->isAJAX()){
            try {
                $result = $this->analytics->data_realtime->get(
                    'ga:' . $this->viewId,
                    'rt:activeVisitors',
                    [
                        'dimensions' => 'rt:pagePath,rt:country,rt:city,rt:longitude,rt:latitude'
                    ]
                );

                return $this->response->setJSON([
                    'status' => true,
                    'message' => cve_admin_lang_path('General', 'realtime_visitor_info'),
                    'online' => $result->getTotalResults(),
                    'data' => $result->getRows(),
                ]);
            }catch (\Exception $exception){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'realtime_visitors_failure')
                ]);
            }
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors','invalid_request_type')
        ]);
    }
}