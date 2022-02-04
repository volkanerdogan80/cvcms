<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Entities\ContentEntity;
use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Models\ThemeModel;
use App\Models\UserModel;

class Page extends BaseController
{

    protected $userModel;
    protected $contentModel;
    protected $contentEntity;
    protected $module;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->contentModel = new ContentModel();
        $this->contentEntity = new ContentEntity();
        $this->module = config('system');
    }

    public function listing(string $status = null)
    {
        $getDateFilter = $this->request->getGet('dateFilter');
        $dateFilter = explode(' - ', $getDateFilter);
        $dateFilter = count($dateFilter) > 1 ? $dateFilter : null;

        $perPage = $this->request->getGet('perpage');
        $perPage = !empty($perPage) ? $perPage : 20;

        $search = $this->request->getGet('search');
        $search = !empty($search) ? $search : null;

        $user = $this->request->getGet('user');
        $user = !empty($user) ? $user : null;
        if (!cve_permit_control('admin_page_listing_all')){
            $user = session('userData.id');
        }

        $data = [
            'users' => $this->userModel->findAll(),
            'user' => $user,
            'perPage' => $perPage,
            'dateFilter' => $getDateFilter,
            'search' => $search,
        ];

        $getModel = $this->contentModel->getListing($this->module->page, $status, $user, null, $search, $dateFilter, $perPage);

        $data = array_merge($data, $getModel);

        return view(PANEL_FOLDER . '/pages/page/listing', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() == 'post'){
            $field = [];
            $getField = $this->request->getPost('field');
            if (isset($getField)){
                foreach ($this->request->getPost('field') as $key => $value){
                    $field[$value['key']] = $value['value'];
                }
            }
            $field = count($field) > 0 ? $field : null;

            $this->contentEntity->setModule($this->module->page);
            $this->contentEntity->setUserId();
            $this->contentEntity->setTitle($this->request->getPost('title'));
            $this->contentEntity->setSlug();
            $this->contentEntity->setDescription($this->request->getPost('description'));
            $this->contentEntity->setContent($this->request->getPost('content'));
            $this->contentEntity->setKeywords($this->request->getPost('keywords'));
            $this->contentEntity->setThumbnail($this->request->getPost('thumbnail'));
            $this->contentEntity->setGallery($this->request->getPost('gallery'));
            $this->contentEntity->setViews();
            $this->contentEntity->setField($field);
            $this->contentEntity->setStatus($this->request->getPost('status'));
            $this->contentEntity->setPageType($this->request->getPost('page_type'));
            $this->contentEntity->setSimilar();
            $this->contentEntity->setCommentStatus();

            $insertID = $this->contentModel->insert($this->contentEntity);

            if($this->contentModel->errors()){
                return redirect()->back()->with('error', $this->contentModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang_path('Success', 'create_success'));

        }
        return view(PANEL_FOLDER . '/pages/page/create', [
            'template_list' => $this->getPageTemplate()
        ]);
    }

    public function edit($id)
    {
        $page = $this->contentModel->find($id);
        if ($page->getUserId() != session('userData.id')){
            if(!cve_permit_control('admin_blog_edit_all')){
                return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'unauthorized_request'));
            }
        }

        if ($this->request->getMethod() == 'post') {
            $field = [];
            $getField = $this->request->getPost('field');
            if (isset($getField)){
                foreach ($this->request->getPost('field') as $key => $value){
                    $field[$value['key']] = $value['value'];
                }
            }
            $field = count($field) > 0 ? $field : null;

            $this->contentEntity->setId($id);
            $this->contentEntity->setModule($this->module->page);
            $this->contentEntity->setUserId();
            $this->contentEntity->setTitle($this->request->getPost('title'));
            $this->contentEntity->setSlug();
            $this->contentEntity->setDescription($this->request->getPost('description'));
            $this->contentEntity->setContent($this->request->getPost('content'));
            $this->contentEntity->setKeywords($this->request->getPost('keywords'));
            $this->contentEntity->setThumbnail($this->request->getPost('thumbnail'));
            $this->contentEntity->setGallery($this->request->getPost('gallery'));
            $this->contentEntity->setViews();
            $this->contentEntity->setField($field);
            $this->contentEntity->setPageType($this->request->getPost('page_type'));
            $this->contentEntity->setCommentStatus();
            $this->contentEntity->setSimilar();

            $this->contentModel->update($id, $this->contentEntity);

            if($this->contentModel->errors()){
                return redirect()->back()->with('error', $this->contentModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang_path('Success', 'update_success'));
        }

        return view(PANEL_FOLDER . '/pages/page/edit', [
            'page' => $page,
            'template_list' => $this->getPageTemplate()
        ]);
    }
    
    public function status()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'change_status_empty_fields')
                ]);
            }
            $status = $this->request->getPost('status');

            $page = $this->contentModel->where('user_id !=', session('userData.id'))->find($data);
            if ($page){
                if(!cve_permit_control('admin_page_status_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'page_status_failure')
                    ]);
                }
            }

            $update = $this->contentModel->update($data, ['status' => $status]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'status_change_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'status_change_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors','invalid_request_type')
        ]);
    }

    public function delete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'delete_empty_fields')
                ]);
            }
            $data = !is_array($data) ? [$data] : $data;

            $page = $this->contentModel->where('user_id !=', session('userData.id'))->find($data);
            if ($page){
                if(!cve_permit_control('admin_page_delete_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'page_delete_failure')
                    ]);
                }
            }

            $delete = $this->contentModel->delete($data);
            if (!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors','invalid_request_type')
        ]);
    }

    public function undoDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'restore_empty_fields')
                ]);
            }
            $page = $this->contentModel->where('user_id !=', session('userData.id'))->find($data);
            if ($page){
                if(!cve_permit_control('admin_page_undo-delete_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'page_undo_delete_failure')
                    ]);
                }
            }

            $update = $this->contentModel->update($data, ['deleted_at' => null]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'undo_delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'undo_delete_success')
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors','invalid_request_type')
        ]);

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
            $page = $this->contentModel->where('user_id !=', session('userData.id'))->find($data);
            if ($page){
                if(!cve_permit_control('admin_page_purge-delete_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'page_purge_delete_failure')
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

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'purge_delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors','invalid_request_type')
        ]);
    }

    private function getPageTemplate()
    {
        helper('filesystem');
        $themeModel = new ThemeModel();
        $active_theme = $themeModel->where('status', STATUS_ACTIVE)->first();

        $find_folder = directory_map(APPPATH . 'Views/themes/'.$active_theme->getFolder().'/page');
        $template_list = [];
        foreach ($find_folder as $key => $value){
            $get_file = file_get_contents(APPPATH. 'Views/themes/'.$active_theme->getFolder().'/page/' . $value);
            preg_match_all('#<!-- (.*?) -->#', $get_file, $find);
            $file_name = str_replace('.php', '', $value);
            $template_name = $find[1][0];
            $template_list[$file_name] = $template_name;
        }

        return $template_list;
    }
}