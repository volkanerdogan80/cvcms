<?php


namespace App\Filters;


use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LanguageControl implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = new \CodeIgniter\HTTP\URI(current_url());
        $segments = $uri->getSegments();

        if (!in_array($segments[0], config('app')->supportedLocales)){
            array_unshift($segments, config('app')->defaultLocale);
            $query = $uri->getQuery();
            $new_uri = implode('/', $segments);
            $new_uri = $query ? $new_uri . '?'. $query : $new_uri;
            return redirect()->to(base_url($new_uri));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
