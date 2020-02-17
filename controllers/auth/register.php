<?php
namespace Controller\Auth;
use Utility\Authorization;
use Utility\View;
use Respect\Validation\Validator;
use Utility\Config;

class Register
{
    public function index()
    {
        Authorization::forNotLogged();
        $twig = new View();
        $twig->twigRender('register.html');
    }

    public function register()
    {
        Authorization::forNotLogged();

        $email = Validator::email()->validate($_POST['email']);
        $password = Validator::stringType()->length(8, NULL)->validate($_POST['password']);
        $passwordConfirmation = Validator::stringType()->notEmpty()->equals($_POST['password'])->validate($_POST['password_confirmation']);

        if (!$email || !$password || !$passwordConfirmation) {
            $_SESSION['show'] = [
                'email' => ($email) ? '' : 'Incorrect email address',
                'password' => ($password) ? '' : 'Password must contain at least 8 characters',
                'passwordConfirmation' => ($passwordConfirmation) ? '' : 'The passwords you have entered do not match'
            ];
            header('Location: '.$_SERVER['HTTP_REFERER']);
            exit();
        }

        $auth = new Authorization();
        if ($auth->userRegister($_POST['email'], $_POST['password'])) {
            $config = Config::read('app');
            header('Location: '.$config['url'].'login');
            exit();
        } else {
            $_SESSION['show'] = ['Email already exists in the database'];
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
}
