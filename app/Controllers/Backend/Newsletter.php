<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\NewsletterModel;
use App\Traits\NewsletterTrait;
use App\Traits\ResponseTrait;

class Newsletter extends BaseController
{
    use ResponseTrait;
    use NewsletterTrait;

    public function listing()
    {
        $getDateFilter = $this->request->getGet('dateFilter');
        $dateFilter = explode(' - ', $getDateFilter);
        $dateFilter = count($dateFilter) > 1 ? $dateFilter : null;

        $perPage = $this->request->getGet('perPage');
        $perPage = !empty($perPage) ? $perPage : 20;

        $search = $this->request->getGet('search');
        $search = !empty($search) ? $search : null;

        $data = [
            'perPage' => $perPage,
            'dateFilter' => $getDateFilter,
            'search' => $search,
        ];

        $newsletter_model = new NewsletterModel();
        $getModel = $newsletter_model->getListing($search, $dateFilter, $perPage);

        $data = array_merge($data, $getModel);

        return view(PANEL_FOLDER . '/pages/newsletter/listing', $data);
    }


}