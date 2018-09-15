<?php


namespace Tests\Unit;


use BereczkyBalazs\BrickCore\ExceptionHandler;
use BereczkyBalazs\BrickCore\Header;
use BereczkyBalazs\BrickCore\HttpJsonException;
use PHPUnit\Framework\TestCase;
use stdClass;
use Exception;

class ExceptionHandlerTest extends TestCase
{
    public function test_non_http_exception()
    {
        $response = $this->getResponse();
        $this->expectOutputString(json_encode($response));
        $header = $this->getHeaderMock();
        $header
            ->expects($this->any())
            ->method('add')
            ->withConsecutive(
                ['Content-Type', 'application/json'],
                ['HTTP/1.0', 406]
            );
        $this->headerShouldBuild($header);
        $exceptionHandler = new ExceptionHandler($header);
        $exceptionHandler->handle(new Exception($response->message, $response->code));
    }

    public function test_http_exception()
    {
        $response = $this->getResponse(401);
        $this->expectOutputString(json_encode($response));
        $header = $this->getHeaderMock();
        $header
            ->expects($this->any())
            ->method('add')
            ->withConsecutive(
                ['Content-Type', 'application/json'],
                ['HTTP/1.0', $response->code]
            );
        $this->headerShouldBuild($header);
        $exceptionHandler = new ExceptionHandler($header);
        $exceptionHandler->handle(new HttpJsonException($response->message, $response->code));
    }

    private function getResponse($code = 406, $message = 'test')
    {
        $response = new stdClass();
        $response->code = $code;
        $response->message = $message;
        return $response;
    }

    private function headerShouldBuild($header)
    {
        $header
            ->expects($this->once())
            ->method('build');
    }

    private function getHeaderMock()
    {
        return $this->getMockBuilder(Header::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}