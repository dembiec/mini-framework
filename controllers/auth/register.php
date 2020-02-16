<?php
namespace Controller\Auth;
use Utility\View;
use Utility\Authorization;
use Utility\Config;

class Register
{
    public function index()
    {
        Authorization::forNotLogged();
        $twig = new View();
        $twig->twigRender('register.html');
    }
}
