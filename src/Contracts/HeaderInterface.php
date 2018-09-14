<?php

namespace BereczkyBalazs\BrickCore\Contracts;

interface HeaderInterface
{
    public static function getInstance();
    public static function add($key, $value);
    public static function build();
}