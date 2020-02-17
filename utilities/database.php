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
        return $this->connect()->query($query);
        
    }

    public function fetchAll()
    {
        return $this->query()->fetchAll(PDO::FETCH_ASSOC);
    }
}