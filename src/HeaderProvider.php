<?php

namespace BereczkyBalazs\BrickCore;

use BereczkyBalazs\BrickCore\Contracts\HeaderInterface;

final class HeaderProvider implements HeaderInterface
{
    private static $headers = [];
    private static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new HeaderProvider();
        }
        return self::$instance;
    }

    public static function add($key, $value)
    {
        self::$headers[] = [$key, $value];
        return self::$instance;
    }

    public static function build()
    {
        foreach (self::$headers as $header) {
            header($header[0] . ': ' . $header[1]);
        }
    }

    private function __construct()
    {
    }
}