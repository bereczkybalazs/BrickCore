<?php

namespace BereczkyBalazs\BrickCore;

final class Helpers
{
    public static function toArray($d)
    {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }
        if (is_array($d)) {
            $callback = 'self::' . __FUNCTION__;
            return array_map($callback, $d);
        } else {
            return $d;
        }
    }

    private function __construct()
    {
    }
}