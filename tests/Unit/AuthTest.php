<?php

namespace Tests\Unit;

use BereczkyBalazs\BrickCore\Auth;
use BereczkyBalazs\BrickCore\Config;
use Firebase\JWT\JWT;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    private $auth;
    const TOKEN = ['user_id' => 4];
    const ANOTHER_TOKEN = ['user_id' => 543];
    const JWT_KEY = 'test';

    public function setUp()
    {
        $_ENV['JWT_KEY'] = self::JWT_KEY;
        $this->auth = Auth::getInstance();
    }

    /*
     * @test
     */
    public function test_set_token()
    {
        $token = JWT::encode(self::TOKEN, Config::getJwtKey());
        $this->assertEquals(
            $this->auth->setToken($token)->getToken(),
            $token
        );
    }

    /*
     * @test
     */
    public function test_token_cannot_be_overwritten()
    {
        $token = JWT::encode(self::TOKEN, Config::getJwtKey());
        $anotherToken = JWT::encode(self::ANOTHER_TOKEN, Config::getJwtKey());
        $this->assertEquals(
            $this->auth->setToken($token)->setToken($anotherToken)->getToken(),
            $token
        );
    }
}