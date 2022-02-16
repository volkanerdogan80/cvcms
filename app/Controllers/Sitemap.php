<?php


namespace App\Controllers;


use App\Models\CategoryModel;
use App\Models\ContentModel;

class Sitemap extends BaseController
{

    protected $categoryModel;
    protected $contentModel;
    protected $activeModules;
    public static $PERPAGE = 500;

    public function __construct()
    {
        $this->contentModel = new ContentModel();
        $this->categoryModel = new CategoryModel();
        $this->activeModules = $this->activeModules();
    }

    public function listing()
    {
        $countContent = [];

        if(count($this->activeModules) > 0){
            $category = $this->categoryModel->whereIn('module', $this->activeModules)->countAllResults();

            foreach ($this->activeModules as $module){
                $count = $this->contentModel->where('module', $module)->countAllResults();
                $countContent = array_merge($countContent, [
                    $module => $count / self::$PERPAGE
                ]);
            }
            $countContent = array_merge($countContent, [
                'category' => $category / self::$PERPAGE
            ]);
        }

        $this->response->setHeader('Content-Type', 'application/xml');
        return view( PANEL_FOLDER . '/sitemap/listing', [
            'list' => $countContent
        ]);
    }

    public function generate($module, $page = 1)
    {

        if ($module == 'category'){
            $content = $this->categoryModel->whereIn('module', $this->activeModules)->paginate(self::$PERPAGE, 'default', $page);
        }else{
            $content = $this->contentModel->where('module', $module)->paginate(self::$PERPAGE, 'default', $page);
        }

        $this->response->setHeader('Content-Type', 'application/xml');
        return view(PANEL_FOLDER . '/sitemap/generate', [
            'contents' => $content,
            'defaultLocale' => $this->request->getDefaultLocale()
        ]);

    }

    private function activeModules()
    {
        $activeModules = [];

        foreach (config('sitemap')->modules as $key => $module) {
            if ($module['status']) {
                array_push($activeModules, $key);
            }
        }

        return $activeModules;
    }

}