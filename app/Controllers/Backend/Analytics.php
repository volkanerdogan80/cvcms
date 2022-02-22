<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class Analytics extends BaseController
{

    protected $client;
    protected $viewId;
    protected $analytics;
    private $startDate;
    private $endDate;
    private $pageTitle;

    public function __construct()
    {
        $this->viewId = config('webmaster')->accountId;
        $this->client = new \Google_Client();
        $this->client->setAuthConfig(WRITEPATH . 'uploads/google-analytics-account.json');
        $this->client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $this->analytics = new \Google_Service_Analytics($this->client);
        $this->pageTitle = cve_admin_lang('Analytics', 'last_30_days');

    }

    public function realtime()
    {
        return view(PANEL_FOLDER . '/pages/analytics/realtime');
    }

    public function metrics()
    {

        $this->startDate = '30daysAgo';
        $this->endDate = 'today';

        $getDateFilter = $this->request->getGet('dateFilter');
        $dateFilter = explode(' - ', $getDateFilter);
        $dateFilter = count($dateFilter) > 1 ? $dateFilter : null;
        if (!is_null($dateFilter)){
            $this->startDate = $dateFilter[0];
            $this->endDate = $dateFilter[1];
            $this->pageTitle = $getDateFilter; // TODO $dateFilter[0] ile $dateFilter[1] arasındaki içerikler yazılabilir.
        }

        return view('admin/pages/analytics/metrics', [
            'visitors' => $this->getVisitors()->getRows(),
            'referral' => $this->getReferral()->getRows(),
            'browser' => $this->getBrowser()->getRows(),
            'operating' => $this->getOperatingSystem()->getRows(),
            'keywords' => $this->getKeywords()->getRows(),
            'topContent' => $this->getTopContent()->getRows(),
            'dateFilter' => $getDateFilter,
            'page_title' => $this->pageTitle
        ]);
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
                    'message' => cve_admin_lang('General', 'realtime_visitor_info'),
                    'online' => $result->getTotalResults(),
                    'data' => $result->getRows(),
                ]);
            }catch (\Exception $exception){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'realtime_visitors_failure')
                ]);
            }
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors','invalid_request_type')
        ]);
    }

    private function getVisitors()
    {
        try {
            return $this->analytics->data_ga->get(
                'ga:' . $this->viewId,
                $this->startDate,
                $this->endDate,
                'ga:users,ga:sessions,ga:pageviews,ga:pageviewsPerSession,ga:bounceRate,ga:newUsers',
                [
                    'dimensions' => 'ga:date',
                    'sort' => '-ga:date'
                ]
            );
        }catch (\Exception $exception){
            return [];
        }
    }

    private function getReferral()
    {
        try {
            return $this->analytics->data_ga->get(
                'ga:' . $this->viewId,
                $this->startDate,
                $this->endDate,
                'ga:users,ga:pageviews,ga:pageviewsPerSession',
                [
                    'dimensions' => 'ga:source',
                    'filters' => 'ga:medium==referral',
                    'sort' => '-ga:users'
                ]
            );
        }catch (\Exception $exception){
            return [];
        }
    }

    private function getBrowser()
    {
        try {
            return $this->analytics->data_ga->get(
                'ga:' . $this->viewId,
                $this->startDate,
                $this->endDate,
                'ga:users',
                [
                    'dimensions' => 'ga:browser',
                    'sort' => '-ga:users'
                ]
            );
        }catch (\Exception $exception){
            return [];
        }
    }

    private function getOperatingSystem()
    {
        try {
            return $this->analytics->data_ga->get(
                'ga:' . $this->viewId,
                $this->startDate,
                $this->endDate,
                'ga:users',
                [
                    'dimensions' => 'ga:operatingSystem',
                    'sort' => '-ga:users'
                ]
            );
        }catch (\Exception $exception){
            return [];
        }
    }

    private function getKeywords()
    {
        try {
            return $this->analytics->data_ga->get(
                'ga:' . $this->viewId,
                $this->startDate,
                $this->endDate,
                'ga:users',
                [
                    'dimensions' => 'ga:keyword',
                    'sort' => '-ga:users'
                ]
            );
        }catch (\Exception $exception){
            return [];
        }
    }

    private function getTopContent()
    {
        try {
            return $this->analytics->data_ga->get(
                'ga:' . $this->viewId,
                $this->startDate,
                $this->endDate,
                'ga:users,ga:pageviews,ga:uniquePageviews',
                [
                    'dimensions' => 'ga:pagePath',
                    'sort' => '-ga:pageviews'
                ]
            );
        }catch (\Exception $exception){
            return [];
        }
    }
}