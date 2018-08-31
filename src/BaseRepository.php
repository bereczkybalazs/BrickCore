<?php

namespace BereczkyBalazs\BrickCore;

abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = Connection::getInstance();
    }
}