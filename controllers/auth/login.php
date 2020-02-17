<?php
namespace Controller\Auth;
use Utility\View;
use Utility\Authorization;
use Utility\Config;

class Login
{
    public function index()
    {
        Authorization::forNotLogged();
        $twig = new View();
        $twig->twigRender('login.html');
    }

    public function login()
    {
        Authorization::forNotLogged();
        $auth = new Authorization();
        if ($auth->userLogin($_POST['email'], $_POST['password'])) {
            $config = Config::read('app');
            header('Location: '.$config['url'].'start');
        } else {
            $_SESSION['show'] = ['Incorrect email or password'];
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    public function logout()
    {
        Authorization::forLogged();
        session_destroy();
        $config = Config::read('app');
        header('Location: '.$config['url']);
    }
}
