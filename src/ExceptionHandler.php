<?php

namespace BereczkyBalazs\BrickCore;

use BereczkyBalazs\BrickCore\Contracts\ExceptionHandlerInterface;
use Exception;
use stdClass;

class ExceptionHandler implements ExceptionHandlerInterface
{
    private $exception;
    private $header;

    public function __construct(Header $header)
    {
        $this->header = $header;
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
        $this->header->add('Content-Type', 'application/json');
        if ($this->exception instanceof HttpJsonException) {
            $this->header->add('HTTP/1.0', $this->exception->getCode());
        } else {
            $this->header->add('HTTP/1.0', 406);
        }
        $this->header->build();
    }

    private function getErrorContent()
    {
        $response = new stdClass();
        $response->code = $this->exception->getCode();
        $response->message = $this->exception->getMessage();
        return $response;
    }
}