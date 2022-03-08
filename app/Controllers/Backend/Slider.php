<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\SliderEntity;
use App\Models\SliderModel;

class Slider extends BaseController
{
    protected $sliderModel;
    protected $sliderEntity;

    public function __construct()
    {
        $this->sliderModel = new SliderModel();
        $this->sliderEntity = new SliderEntity();
    }

    public function listing(string $status = null)
    {
        if (!is_null($status)){
            $sliders = $this->sliderModel->onlyDeleted()->paginate(20);
        }else{
            $sliders = $this->sliderModel->paginate(20);
        }

        return view(PANEL_FOLDER . '/pages/slider/listing',[
            'sliders' => $sliders,
            'pager' => $this->sliderModel->pager
        ]);
    }

    public function create()
    {
        $name = $this->request->getPost('name');

        $this->sliderEntity->setKey($name);
        $this->sliderEntity->setValue();

        $this->sliderModel->insert($this->sliderEntity);

        if($this->sliderModel->errors()){
            return redirect()->back()->with('error', $this->sliderModel->errors());
        }

        return redirect()->to(base_url(route_to('admin_slider_listing', null)))->with('success', cve_admin_lang('Success', 'create_success'));
    }

    public function edit(int $id)
    {
        if ($this->request->getMethod() == 'post'){
            $get_slider = $this->sliderModel->getSliderById($id);
            $sliders = $this->request->getPost('slider');
            $data = [];
            if(!$sliders){
                return redirect()->back()->with('error', cve_admin_lang('Errors', 'empty_slider_failure'));
            }
            foreach ($sliders as $key => $item){
                $data[$key] = [];
                $data[$key]['image'] = $item['image'];
                $data[$key]['text'] = [];
                $data[$key]['button'] = [];

                if (isset($item['text'])){
                    foreach ($item['text'] as $tkey => $text){
                        $text_key = cve_slug_creator($text['key']);
                        $data[$key]['text'][$text_key] = $text['lang'];
                    }
                }

                if (isset($item['button'])){
                    foreach ($item['button'] as $bkey => $button){
                        $button_key = cve_slug_creator($button['key']);
                        $data[$key]['button'][$button_key]['title'] = $button['title'];
                        $data[$key]['button'][$button_key]['url'] = $button['url'];
                    }
                }

            }

            $this->sliderEntity->setId($id);
            $this->sliderEntity->setKey($get_slider->getKey());
            $this->sliderEntity->setValue($data);

            $this->sliderModel->update($id, $this->sliderEntity);

            if($this->sliderModel->errors()){
                return redirect()->back()->with('error', $this->sliderModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang('Success', 'update_success'));

        }

        return view(PANEL_FOLDER . '/pages/slider/edit', [
            'sliders' => $this->sliderModel->find($id)
        ]);
    }

    public function delete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $delete = $this->sliderModel->delete($data);

            if(!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'invalid_request_type')
        ]);
    }

    public function undoDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $update = $this->sliderModel->update($data, ['deleted_at' => null]);

            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'undo_delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'undo_delete_success')
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'invalid_request_type')
        ]);

    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $purgeDelete = $this->sliderModel->delete($data, true);
            if(!$purgeDelete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'purge_delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'invalid_request_type')
        ]);
    }

    public function newCard(){
        return $this->response->setJSON([
            'status' => false,
            'message' => "asdasda",
            'view' => view('admin/pages/slider/partials/card', [
                'random' => random_string('alpha',4)
            ])
        ]);
    }

    public function newText(){
        return $this->response->setJSON([
            'status' => false,
            'message' => "asdasda",
            'view' => view('admin/pages/slider/partials/text', [
                'random' => random_string('alpha',4),
                'cardId' => $this->request->getGet('id')
            ])
        ]);
    }

    public function newButton(){
        return $this->response->setJSON([
            'status' => false,
            'message' => "asdasda",
            'view' => view('admin/pages/slider/partials/button', [
                'random' => random_string('alpha',4),
                'cardId' => $this->request->getGet('id')
            ])
        ]);
    }
}
