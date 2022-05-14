<?php

namespace App;

use PDO;

class Database extends Singleton
{
    private $pdo;

    protected function __construct()
    {
        $connect = getenv('DB_CONNECTION');
        $host = getenv('DB_HOST');
        $port = getenv('DBPORT');
        $dbname = getenv('DB_DATABASE');
        $password = getenv('DB_PASSWORD');
        $user = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');

        $dsn = "$connect:host=$host;port=$port;dbname=$dbname";

        $this->pdo = new PDO(
            $dsn,
            $user,
            $password
        );
    }

    public function __call($name, $args)
	{
		return call_user_func_array(array($this->pdo, $name), $args);
	}

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
