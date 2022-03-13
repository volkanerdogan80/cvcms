<?php


namespace App\Traits;


use App\Models\NewsletterModel;

trait NewsletterTrait
{
    public function unsubscribe($token)
    {
        $newsletter_model = new NewsletterModel();
        if ($this->request->getMethod() == 'get') {
            $newsletter_model->where('token', $token)->delete();
            return view(PANEL_FOLDER . '/pages/verify/unsubscribe-success');
        }

        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getPost('id');
            $newsletter_model->delete($id);
            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success', 'unsubscribe_success')
            ]);
        }
    }
}

