<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Entities\MenuEntity;
use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Models\MenuModel;

class Menus extends BaseController
{
    protected $menuModel;
    protected $menuEntity;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->menuEntity = new MenuEntity();
    }

    public function listing(string $status = null)
    {

        if(!is_null($status)){
            $menus = $this->menuModel->onlyDeleted()->paginate(10);
        }else{
            $menus = $this->menuModel->paginate(10);
        }


        return view(PANEL_FOLDER . '/pages/menu/listing',[
            'menus' => $menus,
            'pager' => $this->menuModel->pager
        ]);
    }
    //TODO: Yeni menü eklenince svalue boş geliyor bu nedenle hata veriyor. Ayrıca kategori ya da içerik boş olunca da hata veriyor. Kontrol eklenecek
    public function create()
    {
        $name = $this->request->getPost('name');

        $this->menuEntity->setKey($name);
        $this->menuEntity->setValue();

        $this->menuModel->insert($this->menuEntity);

        if($this->menuModel->errors()){
            return redirect()->back()->with('error', $this->menuModel->errors());
        }

        return redirect()->back()->with('success', cve_admin_lang_path('Success', 'create_success'));

    }

    public function edit(int $id)
    {
        if ($this->request->getMethod() == 'post'){
            $name = $this->request->getPost('name');
            $menu = $this->request->getPost('menu');

            $this->menuEntity->setId($id);
            $this->menuEntity->setKey($name);
            $this->menuEntity->setValue($menu);

            $this->menuModel->update($id, $this->menuEntity);

            if($this->menuModel->errors()){
                return redirect()->back()->with('error', $this->menuModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang_path('Success', 'update_success'));

        }

        return view(PANEL_FOLDER . '/pages/menu/edit', [
            'data' => $this->menuModel->find($id)
        ]);
    }

    public function delete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $delete = $this->menuModel->delete($data);

            if(!$delete){
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
            'message' => cve_admin_lang_path('Errors', 'delete_failure')
        ]);
    }

    public function undoDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $update = $this->menuModel->update($data, ['deleted_at' => null]);

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
            'message' => cve_admin_lang_path('Errors', 'undo_delete_failure')
        ]);

    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $purgeDelete = $this->menuModel->delete($data, true);
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
            'message' => cve_admin_lang_path('Errors', 'purge_delete_failure')
        ]);
    }

    public function getMenu()
    {
        $module = $this->request->getPost('module');
        $type = $this->request->getPost('type');

        if ($type == 'category'){
            $model = new CategoryModel();
        }elseif($type == 'content'){
            $model = new ContentModel();
        }

        return $this->response->setJSON([
            'status' => true,
            'message' => cve_admin_lang_path('Success', 'menu_contents_fetched'),
            'data' => view(PANEL_FOLDER . '/pages/menu/partials/option', [
                'data' => $model->where('module', $module)->findAll(),
            ]),
            'type' => $type
        ]);
    }
}