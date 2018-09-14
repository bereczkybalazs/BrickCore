<?php

namespace BereczkyBalazs\BrickCore\Contracts;

use Exception;

interface ExceptionHandlerInterface
{
    public function handle(Exception $exception);
}