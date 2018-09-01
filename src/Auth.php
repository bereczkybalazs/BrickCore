<?php

namespace BereczkyBalazs\BrickCore;

use Firebase\JWT\JWT;

class Auth
{
    private static $instance;

    private static $token;

    public static function getInstance()
    {
        if(!isset(self::$instance)) {
            self::$instance = new Auth();
        }
        return self::$instance;
    }

    public static function getToken()
    {
        return self::$token;
    }

    public static function setToken($token)
    {
        if (!isset(self::$token)) {
            self::$token = $token;
        }
        return self::getInstance();
    }

    private function __construct()
    {
    }
}