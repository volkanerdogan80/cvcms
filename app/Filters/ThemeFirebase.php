<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ThemeFirebase implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $view = view(PANEL_FOLDER . '/theme/firebase');

        $body = $response->getBody();
        $body = str_ireplace('</body>', $view . '</body>', $body);
        $response->setBody($body);
    }
}
