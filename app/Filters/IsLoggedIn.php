<?php namespace app\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class IsLoggedIn implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $request->type = REQUEST_WEB;

        $supportLocale = $request->config->supportedLocales;
        $segment  = $request->uri->getSegments();
        $isUriLocale = in_array($segment[0], $supportLocale);
        $isStopUri = in_array($segment[2], config('filters')->stopAuth);

        if($isUriLocale && $segment[1] == 'admin' && !$isStopUri && !session()->isLogin){
            return redirect()->to(route_to('admin_login'));
        }

        if ($isUriLocale && $segment[1] == 'admin' && $isStopUri && session()->isLogin){
            return redirect()->to(route_to('admin_dashboard'));
        }

        $request->user = new \stdClass();
        $request->user->isLogin = session('isLogin');
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