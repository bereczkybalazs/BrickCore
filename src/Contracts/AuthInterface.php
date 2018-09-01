<?php


namespace BereczkyBalazs\BrickCore\Contracts;


interface AuthInterface
{
    public static function getInstance();
    public static function authorized();
    public static function getUser();
    public static function getToken();
    public static function attempt($token);
    public static function resetToken();
}