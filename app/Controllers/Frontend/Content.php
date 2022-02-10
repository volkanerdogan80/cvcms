<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\ContentModel;

class Content extends BaseController
{
    protected $contentModel;

    public function __construct()
    {
        $this->contentModel = new ContentModel();
    }

    public function index($slug)
    {
        $content = cve_post($slug);
        $this->contentModel->update($content->id, ['views' => $content->getViews()+1]);

        if (cve_post_template($content)){
            return view('themes/' . cve_theme_folder() . '/page/' . cve_post_template($content),[
                'content' => $content
            ]);
        }

        return view('themes/' . cve_theme_folder() . '/single/' . cve_post_module($content),[
            'content' => $content
        ]);

    }
}