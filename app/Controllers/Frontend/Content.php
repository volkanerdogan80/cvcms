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

        // TODO: İçerik bulunamadı için 404 sayfası hazırla
        if (!$content){
            return redirect('homepage');
        }

        $this->viewIncrease($content);

        if (cve_post_template($content)) {
            return $this->page($content);
        }

        return $this->single($content);
    }

    private function single($content)
    {
        // TODO: Kullanıcıyı anasayfa değilde hata mesajı sayfasına yönlendir
        if (!is_dir(cve_theme_file_path('single'))) {
            return redirect('homepage');
        }

        // TODO: Kullanıcıyı anasayfa değilde hata mesajı sayfasına yönlendir
        if (!file_exists(cve_theme_file_path('single/' . cve_post_module($content) . '.php'))) {
            return redirect('homepage');
        }

        return cve_view('single/' . cve_post_module($content), [
            'content' => $content
        ]);
    }

    private function page($content)
    {
        $page_template = cve_post_template($content);
        $page_template_list = page_template();

        // TODO: Kullanıcıyı anasayfa yerine hata mesajı sayfasına yönlendir
        if (!isset($page_template_list[$page_template])) {
            return redirect('homepage');
        }

        // TODO: Kullanıcıyı anasayfa yerine hata mesajı sayfasına yönlendir
        if (!file_exists(cve_theme_file_path($page_template_list[$page_template]['path'] . '.php'))) {
            return redirect('homepage');
        }

        return cve_view($page_template_list[$page_template]['path'], [
            'content' => $content
        ]);
    }

    private function viewIncrease($content)
    {
        $this->contentModel->update($content->id, ['views' => $content->getViews() + 1]);
    }
}