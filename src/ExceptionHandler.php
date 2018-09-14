<?php

namespace BereczkyBalazs\BrickCore;

use BereczkyBalazs\BrickCore\Contracts\ExceptionHandlerInterface;
use Exception;

class ExceptionHandler implements ExceptionHandlerInterface
{
    public function __construct()
    {
        set_exception_handler([$this, 'handle']);
    }

    public function handle(Exception $exception)
    {
        header('HTTP/1.0 ' . $exception->getCode());
        header('Content-Type: application/json');
        echo json_encode($this->getErrorContent($exception));
    }

    private function getErrorContent(Exception $exception)
    {
        $response = new stdClass();
        $response->code = $exception->getCode();
        $response->message = $exception->getMessage();
        return $response;
    }
}