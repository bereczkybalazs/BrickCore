<?php

namespace Tests\Unit;

use BereczkyBalazs\BrickCore\Constants;
use BereczkyBalazs\BrickCore\HttpJsonException;
use BereczkyBalazs\BrickCore\Request;
use PHPUnit\Framework\TestCase;

class UnauthenticatedRequest extends Request
{
    protected function authenticate()
    {
        return false;
    }
}

class InvalidRequest extends Request
{
    protected $rules = ['test' => 'required'];
}

class RequestTest extends TestCase
{
    
    const FAKE_API_KEY = 'asd123';
    const INVALID_API_KEY = '123ds';
    
    protected $request;

    public function setUp()
    {
        $_ENV['REQUIRE_API_SIGNATURE'] = true;
        $_ENV['API_KEY'] = self::FAKE_API_KEY; 
        $this->request = new Request([]);
    }
    
    /*
     * @test
     */
    public function test_unset_api_key()
    {
        $this->expectException(HttpJsonException::class);
        $this->request->validate();
    }

    /*
     * @test
     */
    public function test_invalid_api_key()
    {
        $this->expectException(HttpJsonException::class);
        $_SERVER[Constants::API_KEY] = self::INVALID_API_KEY;
        $this->request->validate();
    }

    /*
     * @test
     */
    public function test_unauthenticated_request()
    {
        $this->expectException(HttpJsonException::class);
        $_SERVER[Constants::API_KEY] = self::FAKE_API_KEY;
        $request = new UnauthenticatedRequest([]);
        $request->validate();
    }

    /*
     * @test
     */
    public function test_invalid_request()
    {
        $this->expectException(HttpJsonException::class);
        $_SERVER[Constants::API_KEY] = self::FAKE_API_KEY;
        $request = new InvalidRequest([]);
        $request->validate();
    }

    
}