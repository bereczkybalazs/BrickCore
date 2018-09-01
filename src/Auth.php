<?php

namespace BereczkyBalazs\BrickCore;

use BereczkyBalazs\BrickCore\Contracts\AuthInterface;

final class Auth implements AuthInterface
{

    public static function getInstance()
    {
        return AuthProvider::getInstance();
    }

    public static function authorized()
    {
        return AuthProvider::getInstance()->authorized();
    }

    public static function getUser()
    {
        return AuthProvider::getInstance()->getUser();
    }

    public static function getToken()
    {
        return AuthProvider::getInstance()->getToken();
    }

    public static function attempt($token)
    {
        return AuthProvider::getInstance()->attempt($token);
    }

    public static function resetToken()
    {
        return AuthProvider::getInstance()->resetToken();
    }

    private function __construct()
    {
    }
}