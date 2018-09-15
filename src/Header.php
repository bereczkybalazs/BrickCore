<?php

namespace BereczkyBalazs\BrickCore;

use BereczkyBalazs\BrickCore\Contracts\HeaderInterface;

class Header implements HeaderInterface
{
    private $headers = [];

    public function add($key, $value)
    {
        $header = new \stdClass();
        $header->key = $key;
        $header->value = $value;
        $this->headers[] = $header;
        return $this;
    }

    public function get()
    {
        return $this->headers;
    }

    public function build()
    {
        foreach ($this->headers as $header) {
            header($header->key . ': ' . $header->value);
        }
    }
}