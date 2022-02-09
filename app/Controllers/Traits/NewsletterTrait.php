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
        $this->newsletterModel->where('token', $token)->delete();

        if ($this->request->getMethod() == 'get'){
            return view('admin/pages/verify/unsubscribe-success');
        }

        if ($this->request->getMethod() == 'post'){
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Başarılı bir şekilde abonelikten çıkartırıldı.'
            ]);
        }
    }
}