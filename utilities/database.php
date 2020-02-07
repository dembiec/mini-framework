<?php
namespace Utility;
use PDO;

class Database
{
    public function connect()
    {
        $mysql_host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'mini-framework';

        $pdo = new PDO('mysql:host='.$mysql_host.';dbname='.$database, $username, $password );
        return $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $query = null)
    {
        $query = htmlspecialchars($query);
        $result = $this->connect()->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}