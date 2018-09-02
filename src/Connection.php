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
                Config::getDatabaseConnection() .
                ':host=' . Config::getDatabaseHost() . ':' . Config::getDatabasePort() .
                ';dbname=' . Config::getDatabase(),
                Config::getDatabaseUser(),
                Config::getDatabasePassword()
            );
            self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }

    private function __construct()
    {
    }

}