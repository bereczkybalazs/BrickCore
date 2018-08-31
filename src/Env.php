<?php

namespace BereczkyBalazs\BrickCore;

class Env
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

    public static function getRequireApiSignature()
    {
        return filter_var($_ENV['REQUIRE_API_SIGNATURE'], FILTER_VALIDATE_BOOLEAN);
    }

    private function __construct()
    {
    }
}