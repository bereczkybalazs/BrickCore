<?php

namespace BereczkyBalazs\BrickCore;

use BereczkyBalazs\BrickCore\Contracts\HeaderInterface;

final class Header implements HeaderInterface
{

    public static function getInstance()
    {
        return HeaderProvider::getInstance();
    }

    public static function add($key, $value)
    {
        return self::getInstance()->add($key, $value);
    }

    public static function build()
    {
        return self::getInstance()->build();
    }
}