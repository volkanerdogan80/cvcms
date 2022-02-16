<?php namespace app\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ReCaptcha implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(config('webmaster')->reCaptchaKey){
            if($request->getMethod() == 'post'){
                if ($request->getPost('g-recaptcha-response')){
                    $client = \Config\Services::curlrequest();
                    $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                        'form_params' => [
                            'secret' => '6Let_eIZAAAAABKMXHVDrqmLxCEhLOA70dUfcUqh',
                            'response' => $request->getPost('g-recaptcha-response'),
                            'remoteip' => $request->getIPAddress()
                        ]
                    ]);

                    $res = json_decode($response->getBody());
                    if (!isset($res->success) || !$res->success){
                        return redirect()->back()->with('error', lang('Validation.text.recaptcha_validation'));
                    }
                }else{
                    return redirect()->back()->with('error', lang('Validation.text.recaptcha_validation'));
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}