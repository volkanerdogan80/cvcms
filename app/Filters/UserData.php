<?php


namespace App\Filters;


use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class UserData implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $request->type = REQUEST_WEB;
        $request->user = new \stdClass();
        $request->user->is_login = session('isLogin');
        $request->user->id = session('userData.id');
        $request->user->name = session('userData.name');
        $request->user->email = session('userData.email');
        $request->user->group = session('userData.group');
        $request->user->permissions = session('permissions');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
