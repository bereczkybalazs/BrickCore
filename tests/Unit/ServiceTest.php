<?php

use PHPUnit\Framework\TestCase;
use BereczkyBalazs\BrickCore\Service;

class ServiceTest extends TestCase
{
    private $service;

    const TEST_API_KEY = ['key' => 'TEST_API_KEY', 'value' => 'key123'];
    const TEST_API_URL = ['key' => 'TEST_API_URL', 'value' => 'http://url.com'];

    public function setUp()
    {
        $_ENV[self::TEST_API_KEY['key']] = self::TEST_API_KEY['value'];
        $_ENV[self::TEST_API_URL['key']] = self::TEST_API_URL['value'];
        $this->service = new Service();
    }
    /*
     * @test
     */
    public function test_exists()
    {
        $this->assertTrue(true);
    }
}