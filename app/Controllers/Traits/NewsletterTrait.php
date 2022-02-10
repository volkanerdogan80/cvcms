<?php


namespace App\Controllers\Traits;

use App\Libraries\EmailTo;
use App\Models\NewsletterModel;

trait NewsletterTrait
{
    protected $newsletterModel;
    protected $emailTo;

    public function __construct()
    {
        $this->newsletterModel = new NewsletterModel();
        $this->emailTo = new EmailTo();
    }

    public function unsubscribe($token)
    {
        if ($this->request->getMethod() == 'get'){
            $this->newsletterModel->where('token', $token)->delete();
            return view('admin/pages/verify/unsubscribe-success');
        }

        if ($this->request->getMethod() == 'post'){
            $id = $this->request->getPost('id');
            if (!$id){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'delete_empty_fields')
                ]);
            }
            $this->newsletterModel->delete($id);
            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'unsubscribe_success')
            ]);
        }
    }
}