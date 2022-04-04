<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Entities\ComponentEntity;
use App\Models\ComponentModel;
use App\Traits\ComponentTrait;
use App\Traits\ResponseTrait;

class Component extends BaseController
{
    use ComponentTrait;
    use ResponseTrait;

    public function listing()
    {
        return view(PANEL_FOLDER . '/pages/component/listing', $this->componentListing());
    }

    public function active($folder)
    {
        return $this->componentActive($folder);
    }

    public function passive($folder)
    {
        return $this->componentPassive($folder);
    }

    public function delete($folder)
    {
        return $this->componentDelete($folder);
    }

    public function setting($folder)
    {
        $component_model = new ComponentModel();
        $component_entity = new ComponentEntity();
        if($this->request->getMethod() == 'post'){
            if (!cve_permit_control('admin_component_setting_update')){
                return $this->response([
                    'status' => false,
                    'message' => 'Component ayarlarını değiştirme yetkiniz bulunmamakta.'
                ]);
            }
            $component = $component_model->getComponentByFolder($folder);
            $setting = $this->request->getPost('setting');
            $component_entity->setId($component->id);
            $component_entity->setSetting($setting);

            $component_model->update($component->id, $component_entity);

            if ($component_model->errors()){
                return $this->response([
                    'status' => false,
                    'message' => $component_model->errors()
                ]);
            }

            return $this->response([
                'status' => true,
                'message' => 'Component ayarları başarılı bir şekilde değiştirildi.'
            ]);
        }

        return view(PANEL_FOLDER . "/pages/component/setting", [
            'folder' => $folder
        ]);
    }
}
