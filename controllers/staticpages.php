<?php
namespace Controller;
use Utility\view;

class StaticPages
{
    public function main()
    {
        $twig = new View;
        $twig->twigCache(false);
        $twig->twigRender('main.html');
    }
}