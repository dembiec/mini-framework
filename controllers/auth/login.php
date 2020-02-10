<?php
namespace Controller\Auth;
use Utility\View;
use Utility\Authorization;
use Utility\Config;

class Login
{
    public function index()
    {
        $twig = new View();
        $twig->twigRender('login.html');
    }

    public function login()
    {
        $auth = new Authorization();
        if ($auth->userLogin($_POST['email'], $_POST['password'])) {
            $config = Config::read('app');
            header('Location: '.$config['url']);
        } else {
            echo "Incorrect data";
        }
    }

    public function logout()
    {
        session_destroy();
        $config = Config::read('app');
        header('Location: '.$config['url']);
    }
}
