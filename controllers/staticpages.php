<?php
namespace Controller;
use Utility\Authorization;
use Utility\view;

class StaticPages
{
    public function main()
    {
        $twig = new View();
        $twig->twigRender('main.html');
    }

    public function start()
    {
        Authorization::forLogged();
        $twig = new View();
        $twig->twigRender('start.html', [
            'id' => $_SESSION['id'],
            'email' => $_SESSION['email'],
            'system' => php_uname('s'),
            'phpversion' => phpversion()
        ]);
    }
}