<?php


namespace App\Traits;


use App\Entities\ComponentEntity;
use App\Models\ComponentModel;

trait ComponentTrait
{
    public $view_data = [];
    public $component = null;
    public $component_folder = null;

    public function componentListing()
    {
        $component_model = new ComponentModel();
        $actives = $component_model->getComponentsByStatus();
        $components = directory_map(COMPONENTS_PATH);
        foreach ($components as $ckey => $cvalue){
            $components[$ckey]['status'] = STATUS_PASSIVE;
            $folder = str_replace('\\', '', $ckey);
            foreach ($actives as $akey => $avalue){
                if ($avalue->getFolder() == $folder){
                    $components[$ckey]['status'] = STATUS_ACTIVE;
                }
            }
        }

        $this->view_data = [
            'components' => $components
        ];
        return $this->view_data;
    }

    public function componentActive($folder)
    {
        $this->component_folder = $folder;
        $component_model = new ComponentModel();
        $component = $component_model->getComponentByFolder($this->component_folder, false);

        if ($component){
            $component_model->update($component->id, ['status' => STATUS_ACTIVE]);
        }else{
            $component_entity = new ComponentEntity();
            $file = include COMPONENTS_PATH . $this->component_folder . '/info.php';
            $component_entity->setFolder($this->component_folder);
            $component_entity->setName($file['name']);
            $component_entity->setAuthor($file['author']);
            $component_entity->setWeb($file['web']);
            $component_entity->setEmail($file['email']);
            $component_entity->setStatus(STATUS_ACTIVE);
            $component_entity->setSetting([]);
            $component_model->insert($component_entity);
        }

        if ($component_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $component_model->errors()
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => 'Component başarılı bir şekilde aktif hale getirildi.'
        ]);
    }

    public function componentPassive($folder)
    {
        $this->component_folder = $folder;
        $component_model = new ComponentModel();
        $component = $component_model->getComponentByFolder($this->component_folder, false);

        if (!$component){
            return $this->response([
                'status' => false,
                'message' => 'Sistemde böyle bir aktif component mevcut değil.'
            ]);
        }

        $component_model->update($component->id, ['status' => STATUS_PASSIVE]);
        if ($component_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $component_model->errors()
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => 'Component başarılı bir şekilde pasif hale getirildi.'
        ]);
    }

    public function componentDelete($folder)
    {
        $this->component_folder = $folder;
        $delete = delete_directory(COMPONENTS_PATH . $this->component_folder);
        if (!$delete){
            return $this->response([
                'status' => false,
                'message' => 'Component silme işlemi esnasında bir hata meydana geldi.'
            ]);
        }

        $component_model = new ComponentModel();
        $component_model->where('folder', $this->component_folder)->delete();

        return $this->response([
            'status' => true,
            'message' => 'Component başarılı bir şekilde silindi.'
        ]);
    }
}