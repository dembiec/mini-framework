<?php
namespace Controller;
use Utility\view;

class Documentation
{
    public function show(array $parameter = NULL)
    {
        $viewPath =  'documentation/'.$parameter[0].'.html';
        if (file_exists(dirname(__DIR__).'/views/'.$viewPath)) {
            $twig = new View();
            $twig->twigCache(FALSE);
            $twig->twigRender($viewPath);
        } else {
            // Redirect to 404 page
        }
    }
}