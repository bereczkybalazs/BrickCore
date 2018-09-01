<?php

namespace Tests\Unit;

use BereczkyBalazs\BrickCore\Auth;
use BereczkyBalazs\BrickCore\Config;
use Firebase\JWT\JWT;
use UnexpectedValueException;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    private $auth;
    const TOKEN = ['user_id' => 4];
    const ANOTHER_TOKEN = ['user_id' => 543];
    const JWT_KEY = 'test';
    const INVALID_TOKEN = 'hello+token';

    public function setUp()
    {
        $_ENV['JWT_KEY'] = self::JWT_KEY;
        $this->auth = Auth::getInstance();
        $this->auth->resetToken();
    }

    /*
     * @test
     */
    public function test_attempt_valid_token()
    {
        $token = JWT::encode(self::TOKEN, Config::getJwtKey());
        $this->assertEquals(
            $this->auth->attempt($token)->getToken(),
            $token
        );
    }

    /*
     * @test
     */
    public function test_attempt_invalid_token()
    {
        $this->expectException(UnexpectedValueException::class);
        $token = self::INVALID_TOKEN;
        $this->auth->attempt($token);
    }

    /*
     * @test
     */
    public function test_attempt_token_cannot_be_overwritten()
    {
        $token = $this->getToken(self::TOKEN);
        $anotherToken = $this->getToken(self::ANOTHER_TOKEN);
        $this->assertEquals(
            $this->auth->attempt($token)->attempt($anotherToken)->getToken(),
            $token
        );
    }

    /*
     * @test
     */
    public function test_authorized_on_no_token()
    {
        $this->assertFalse($this->auth->authorized());
    }

    /*
     * @test
     */
    public function test_authorized_on_valid_token()
    {
        $token = $this->getToken(self::TOKEN);
        $this->auth->attempt($token);
        $this->assertTrue($this->auth->authorized());
    }

    private function getToken($data)
    {
        return JWT::encode($data, Config::getJwtKey());
    }
}