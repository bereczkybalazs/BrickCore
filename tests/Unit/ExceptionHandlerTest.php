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
        $exception = new Exception('test');
        $this->expectOutputString($this->getOutput($exception));
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
        $exceptionHandler->handle($exception);
    }

    public function test_http_exception()
    {
        $exception = new HttpJsonException('test', 401);
        $this->expectOutputString($this->getOutput($exception));
        $header = $this->getHeaderMock();
        $header
            ->expects($this->any())
            ->method('add')
            ->withConsecutive(
                ['Content-Type', 'application/json'],
                ['HTTP/1.0', $exception->getCode()]
            );
        $this->headerShouldBuild($header);
        $exceptionHandler = new ExceptionHandler($header);
        $exceptionHandler->handle($exception);
    }

    private function getOutput(Exception $exception)
    {
        $response = new stdClass();
        $response->code = $exception->getCode();
        $response->message = $exception->getMessage();
        return json_encode($response);
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