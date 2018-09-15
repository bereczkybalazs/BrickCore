<?php

namespace BereczkyBalazs\BrickCore\Contracts;

interface HeaderInterface
{
    public function add($key, $value);
    public function get();
    public function build();
}