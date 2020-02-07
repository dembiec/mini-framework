<?php
namespace Utility;
use Utility\Config;
use PDO;

class Database
{
    public function connect()
    {
        $config = Config::read('database');

        $pdo = new PDO('mysql:host='.$config['host'].';dbname='.$config['database'], $config['username'], $config['password']);
        return $pdo;
    }

    public function query(string $query = null)
    {
        $query = htmlspecialchars($query);
        $result = $this->connect()->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}