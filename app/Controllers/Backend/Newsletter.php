<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Controllers\Traits\NewsletterTrait;

class Newsletter extends BaseController
{

    use NewsletterTrait;

    public function listing()
    {
        $getDateFilter = $this->request->getGet('dateFilter');
        $dateFilter = explode(' - ', $getDateFilter);
        $dateFilter = count($dateFilter) > 1 ? $dateFilter : null;

        $perPage = $this->request->getGet('per_page');
        $perPage = !empty($perPage) ? $perPage : 20;

        $search = $this->request->getGet('search');
        $search = !empty($search) ? $search : null;

        $data = [
            'perPage' => $perPage,
            'dateFilter' => $getDateFilter,
            'search' => $search,
        ];

        $getModel = $this->newsletterModel->getListing($search, $dateFilter, $perPage);

        $data = array_merge($data, $getModel);

        return view(PANEL_FOLDER . '/pages/newsletter/listing', $data);
    }

}