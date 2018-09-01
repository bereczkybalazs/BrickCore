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
}