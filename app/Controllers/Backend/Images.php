<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\ImageEntity;
use App\Models\ImageModel;
use PHPUnit\Exception;

class Images extends BaseController
{
    protected $imageModel;
    protected $imageEntity;
    protected $imageSetting;
    protected $validation;

    public function __construct()
    {
        $this->imageEntity = new ImageEntity();
        $this->imageModel = new ImageModel();
        $this->imageSetting = config('images');
        $this->validation = \Config\Services::validation();
    }

    public function listing()
    {
        $getDateFilter = $this->request->getGet('dateFilter');
        $dateFilter = explode(' - ', $getDateFilter);
        $dateFilter = count($dateFilter) > 1 ? $dateFilter : null;

        $perPage = $this->request->getGet('per_page');
        $perPage = !empty($perPage) ? $perPage : 24;

        $search = $this->request->getGet('search');
        $search = !empty($search) ? $search : null;

        $data = [
            'perPage' => $perPage,
            'dateFilter' => $getDateFilter,
            'search' => $search,
        ];

        $getModel = $this->imageModel->getListing($search, $dateFilter, $perPage);

        $data = array_merge($data, $getModel);

        return view(PANEL_FOLDER . '/pages/image/listing', $data);
    }


    public function picker()
    {

        $data = $this->imageModel->getListing(null, null, 18);

        if ($this->request->getGet('page')){
            return $this->pickerAjax($data);
        }

        $src_id = $this->request->getGet('src');
        $area = $this->request->getGet('area');
        $input_id = $this->request->getGet('input');
        $type = $this->request->getGet('type');

        return view('admin/pages/image/picker', [
            'src_id' => $src_id ? $src_id : null,
            'input_id' => $input_id ? $input_id : null,
            'area' => $area ? $area : null,
            'variable' => random_string('alpha', 16),
            'divId' => random_string('alpha', 16),
            'images' => $data['images'],
            'pager' => $data['pager'],
            'type' => $type,
        ]);
    }

    public function pickerAjax($data){
        return $this->response->setJSON([
            'status' => true,
            'message' => cve_admin_lang('Success','create_success'),
            'view' => view(PANEL_FOLDER . '/pages/image/picker-pager', [
                'images' => $data['images'],
                'type' => $this->request->getGet('type')
            ]),
            'pager' => $data['pager']->links('default', 'cms_pager')
        ]);
    }

    public function upload()
    {
        helper(['text', 'inflector']);
        $function_number = $this->request->getGet('CKEditorFuncNum');

        if (!isset($function_number)){
            $file = $this->request->getFile('file');
        }else{
            $file = $this->request->getFile('upload');
        }

        $fileName = convert_accented_characters(underscore($file->getName()));

        if(!$this->validation->run(['file' => $file], 'imageUpload') && !isset($function_number)){
            return $this->response->setJSON([
                'status' => false,
                'message' => $this->validation->getErrors()
            ]);
        }

        $file->move(ROOTPATH . UPLOAD_FOLDER_PATH, $fileName);

        if(!$file->hasMoved()){
            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'image_upload_failure')
            ]);
        }

        $this->imageEntity->setName($file->getClientName());
        $this->imageEntity->setSlug($file->getName());
        $this->imageEntity->setUrl($file->getName());
        $this->imageEntity->setSize($file->getSize());
        $this->imageEntity->setType($file->getClientExtension());

        $insert = $this->imageModel->insert($this->imageEntity);
        if($this->imageModel->errors()){
            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'image_database_failure')
            ]);
        }

        $this->manipulation($file);

        if (!isset($function_number)){
            return $this->response->setJSON([
                'status' => true,
                'id' => $insert,
                'src' => $this->imageEntity->getUrl('187x134'),
                'original' => $this->imageEntity->getUrl(),
                'name' => $this->imageEntity->getName(),
            ]);
        }

        $url = $this->imageEntity->getUrl();
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', 'Image Uploaded');</script>";

    }

    public function delete()
    {
        helper('filesystem');

        if($this->request->isAJAX()){
            $id = $this->request->getPost('id');
            $image = $this->imageModel->find($id);

            if ($image){
                $delete = $this->imageModel->delete($id);
            }

            $folderImages = directory_map(ROOTPATH . UPLOAD_FOLDER_PATH);

            $setting = $this->imageSetting->delete;
            if($setting == 'all'){
                foreach ($folderImages as $key => $value){
                    if(strstr($value, $image->getSlug())){
                        unlink(ROOTPATH . UPLOAD_FOLDER_PATH . '/' . $value);
                    }
                }
            }

            if($setting == 'original'){
                unlink(ROOTPATH . UPLOAD_FOLDER_PATH . '/' . $image->getSlug() . '.' . $image->getType());
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'delete_success')
            ]);
        }


        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'image_deletion_failure')
        ]);
    }

    private function manipulation($file)
    {
        try {
            $manipulation = \Config\Services::image();

            $thumbnail = $this->imageSetting->thumbnail;
            $imagePath = ROOTPATH . UPLOAD_FOLDER_PATH . $file->getName();

            foreach ($thumbnail as $key => $value){
                $manipulation->withFile($imagePath);
                $nameExp = explode('.', $file->getName());
                $sizeExp = explode('x', $value);
                $width = $sizeExp[0];
                $height = $sizeExp[1];
                $name = $nameExp[0];
                $path = ROOTPATH . UPLOAD_FOLDER_PATH .$name . '-'.$value.'.' . $file->getClientExtension();
                $manipulation->fit($width, $height, 'center');
                $manipulation->save($path);
            }

            if($this->imageSetting->compressor != 0){
                $manipulation->withFile($imagePath);
                $manipulation->save($imagePath, $this->imageSetting->compressor);
            }

            $watermark = $this->imageSetting->watermark;
            if ($watermark['status']){
                $manipulation->withFile($imagePath);
                $manipulation->text($watermark['text'], [
                    'color' => $watermark['color'],
                    'opacity' => $watermark['opacity'],
                    'withShadow' => $watermark['withShadow'],
                    'fontSize' => $watermark['fontSize'],
                    'hAlign' => $watermark['hAlign'],
                    'vAlign' => $watermark['vAlign'],
                ]);
                $manipulation->save($imagePath);
            }
        }catch (\Exception $exception){

        }

    }

}