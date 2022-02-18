<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ThemeMeta implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $view = view(PANEL_FOLDER . '/theme/meta');

        $body = $response->getBody();
        $body = str_ireplace('</head>', $view . '</head>', $body);
        $response->setBody($body);
    }
}
