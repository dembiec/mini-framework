<?php
namespace Controller;
use Utility\View;

class Errors
{
    public function index404()
    {
        $twig = new View();
        $twig->twigRender('404.html');
    }
}