<?php

namespace BereczkyBalazs\BrickCore;

use BereczkyBalazs\BrickCore\Contracts\AuthInterface;
use Firebase\JWT\JWT;

class AuthProvider implements AuthInterface
{
    private static $instance;
    private static $token;
    private static $user;

    public static function getInstance()
    {
        if(!isset(self::$instance)) {
            self::$instance = new AuthProvider();
        }
        return self::$instance;
    }

    public static function authorized()
    {
        if (isset(self::$token)) {
            return true;
        }
        return false;
    }

    public static function getUser()
    {
        return self::$user;
    }

    public static function getToken()
    {
        return self::$token;
    }

    public static function attempt($token)
    {
        if (!isset(self::$token)) {
            self::$user = JWT::decode($token, Config::getJwtKey(), [Config::getJwtAlg()]);
            self::$token = $token;
        }
        return self::getInstance();
    }

    public static function resetToken()
    {
        self::$token = null;
        return self::getInstance();
    }

    private function __construct()
    {
    }
}