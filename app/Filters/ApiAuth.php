<?php


namespace App\Filters;


use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApiAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $request->type = REQUEST_API;

        $segment  = $request->uri->getSegments();
        $isStopUri = in_array($segment[2], config('filters')->stopAuth);

        if (!$isStopUri){
            $api_key = $request->getVar("apiKey");
            if (empty($api_key)){
                echo "API Key Göndermediniz";
                exit();
            }

            $model = new UserModel();
            $user = $model->getUserByApiKey($api_key);
            if (!$user){
                echo "Böyle bir kullanıcı bulunamadı.";
                exit();
            }

            $request->user = new \stdClass();
            $request->user->isLogin = true;
            $request->user->id = $user->id;
            $request->user->name = $user->getFullName();
            $request->user->email = $user->getEmail();
            $request->user->group = $user->slug;
            $request->user->permissions = $user->permissions;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
