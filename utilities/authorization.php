<?php
namespace Utility;
use Utility\Database;

class Authorization
{
    public function csrfToken(int $bytes = 32)
    {
        return bin2hex(random_bytes($bytes));
    }

    public function userLogin(string $email = null, string $password = null)
    {
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        $database = new Database();
        $result = $database->query("SELECT id, email, password FROM `users` WHERE email = '{$email}'");

        if (!empty($result[0]['password']) && password_verify($password, $result[0]['password'])) {
            $_SESSION['id'] = $result[0]['id'];
            $_SESSION['email'] = $result[0]['email'];
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
