<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Controllers\Traits\ContentTrait;

class Blog extends BaseController
{
    use ContentTrait{
        ContentTrait::__construct as private __traitConstruct;
    }
    protected $module;
    protected $listing_all_permit;
    protected $edit_all_permit;
    protected $status_all_permit;
    protected $delete_all_permit;
    protected $undo_delete_all_permit;

    public function __construct()
    {
        $this->__traitConstruct();

        $this->module = config('system')->blog;
        $this->listing_all_permit = 'admin_blog_listing_all';
        $this->edit_all_permit = 'admin_blog_edit_all';
        $this->status_all_permit = 'admin_blog_status_all';
        $this->delete_all_permit = 'admin_blog_delete_all';
        $this->undo_delete_all_permit = 'admin_blog_undo_delete_all';
    }

    protected function createViewData()
    {
        return [
            'categories' => $this->categoryModel->where('module', $this->module)->findAll(),
            'blogs' => $this->contentModel->where('module', $this->module)->findAll(),
        ];
    }

    protected function editViewData($blog)
    {
        return [
            'categories' => $this->categoryModel->where('module', $this->module)->findAll(),
            'blogs' => $this->contentModel->where([
                'module'=> $this->module,
                'id !=' => $blog->id
            ])->findAll(),
            'blog' => $blog
        ];
    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'purge_delete_empty_fields')
                ]);
            }
            $blog = $this->contentModel->where('user_id !=', session('userData.id'))->find($data);
            if ($blog){
                if(!cve_permit_control('admin_blog_purge-delete_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'blog_purge_delete_failure')
                    ]);
                }
            }

            $purgeDelete = $this->contentModel->delete($data, true);
            if(!$purgeDelete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'purge_delete_failure')
                ]);
            }

            $this->contentModel->category('delete', $data);
            $this->contentModel->share('delete', $data);

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'purge_delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'purge_delete_failure')
        ]);
    }
}