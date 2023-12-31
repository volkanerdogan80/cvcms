<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ThemeJavascript implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (config('system')->autoPublic){
            $view = view('theme-autoload/javascript');
            $body = $response->getBody();
            $body = str_ireplace('</body>', $view . '</body>', $body);
            $response->setBody($body);
        }
    }
}
