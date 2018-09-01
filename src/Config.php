<?php

namespace BereczkyBalazs\BrickCore;

use Firebase\JWT\JWT;

class Config
{
    public static function getDatabaseConnection()
    {
        return $_ENV['DB_CONNECTION'];
    }

    public static function getDatabaseHost()
    {
        return $_ENV['DB_HOST'];
    }

    public static function getDatabasePort()
    {
        return $_ENV['DB_PORT'];
    }

    public static function getDatabase()
    {
        return $_ENV['DB_DATABASE'];
    }

    public static function getDatabaseUser()
    {
        return $_ENV['DB_USER'];
    }

    public static function getDatabasePassword()
    {
        return $_ENV['DB_PASSWORD'];
    }

    public static function getApiKey()
    {
        return $_ENV['API_KEY'];
    }

    public static function getJwtKey()
    {
        return $_ENV['JWT_KEY'];
    }

    public static function getRequireApiSignature()
    {
        return filter_var($_ENV['REQUIRE_API_SIGNATURE'], FILTER_VALIDATE_BOOLEAN);
    }

    public static function getJwtAlg()
    {
        return [JWT::$supported_algs['HS256']];
    }

    private function __construct()
    {
    }
}