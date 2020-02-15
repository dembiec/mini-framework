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
            header('Location: '.$config['url'].'start');
        } else {
            $_SESSION['show'] = 'Incorrect email or password';
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    public function logout()
    {
        session_destroy();
        $config = Config::read('app');
        header('Location: '.$config['url']);
    }
}
