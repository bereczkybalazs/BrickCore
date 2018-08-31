<?php

namespace BereczkyBalazs\BrickCore;

use PDO;

final class Connection
{
    static private $connection;

    static public function getInstance()
    {
        if (!self::$connection) {
            self::$connection = new PDO(
                Env::getDatabaseConnection() .
                ':host=' . Env::getDatabaseHost() . ':' . Env::getDatabasePort() .
                ';dbname=' . Env::getDatabase(),
                Env::getDatabasePort(),
                Env::getDatabasePassword()
            );
            self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }
        return self::$connection;
    }

    private function __construct()
    {
    }

}