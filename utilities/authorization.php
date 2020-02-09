<?php
namespace Utility;
use Utility\Database;

class Authorization
{
    public function userLogin(string $email = null, string $password = null)
    {
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        $database = new Database();
        $result = $database->query("SELECT password FROM `users` WHERE email = '{$email}'");

        if (!empty($result[0]['password']) && password_verify($password, $result[0]['password'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
