<?php
namespace Utility;
use Utility\Database;
use Utility\Config;

class Authorization
{
    public function csrfToken(int $bytes = 32)
    {
        return bin2hex(random_bytes($bytes));
    }

    public function userLogin(string $email = NULL, string $password = NULL)
    {
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        $database = new Database();
        $result = $database->query("SELECT id, email, password FROM `users` WHERE email = '{$email}'")->fetchAll();

        if (!empty($result[0]['password']) && password_verify($password, $result[0]['password'])) {
            $_SESSION['id'] = $result[0]['id'];
            $_SESSION['email'] = $result[0]['email'];
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function userRegister(string $email = NULL, string $password = NULL)
    {
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $database = new Database();
        $result = $database->query("INSERT INTO `users` (`email`, `password`) VALUES ('{$email}', '{$password}')");

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isLogged()
    {
        if (isset($_SESSION['id'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function forLogged()
    {
        if (!isset($_SESSION['id'])) {
            $config = Config::read('app');
            header('Location: '.$config['url']);
            exit();
        }
    }

    public function forNotLogged()
    {
        if (isset($_SESSION['id'])) {
            $config = Config::read('app');
            header('Location: '.$config['url']);
            exit();
        }
    }
}
