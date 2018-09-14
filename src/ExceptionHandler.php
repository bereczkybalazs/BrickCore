<?php

namespace BereczkyBalazs\BrickCore;

use BereczkyBalazs\BrickCore\Contracts\ExceptionHandlerInterface;
use Exception;
use stdClass;

class ExceptionHandler implements ExceptionHandlerInterface
{
    private $exception;

    public function __construct()
    {
        set_exception_handler([$this, 'handle']);
    }

    public function handle(Exception $exception)
    {
        $this->exception = $exception;
        $this->setHeaders();
        echo json_encode($this->getErrorContent());
    }

    private function setHeaders()
    {
        if ($this->exception instanceof HttpJsonException) {
            header('HTTP/1.0 ' . $this->exception->getCode());
        } else {
            header('HTTP/1.0 406');
        }
        header('Content-Type: application/json');
    }

    private function getErrorContent()
    {
        $response = new stdClass();
        $response->code = $this->exception->getCode();
        $response->message = $this->exception->getMessage();
        return $response;
    }
}