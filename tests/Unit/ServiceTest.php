<?php

use PHPUnit\Framework\TestCase;
use BereczkyBalazs\BrickCore\Service;

class ServiceTest extends TestCase
{
    const TEST_API_KEY = ['key' => 'MOCK_TEST_API_KEY', 'value' => 'key123'];
    const TEST_API_URL = ['key' => 'MOCK_TEST_API_URL', 'value' => 'http://url.com'];
    const MOCK_CLASS_NAME = 'MockTestService';

    private $service;

    public function setUp()
    {
        $_ENV[self::TEST_API_KEY['key']] = self::TEST_API_KEY['value'];
        $_ENV[self::TEST_API_URL['key']] = self::TEST_API_URL['value'];
        $this->service = $this->getMockForAbstractClass(
            Service::class,
            [],
            self::MOCK_CLASS_NAME
        );
    }

    /*
     * @test
     */
    public function test_setting_api_key()
    {
        $apiKey = $this->service->setApiKey(self::TEST_API_KEY['value'])->getApiKey();
        $this->assertEquals(self::TEST_API_KEY['value'], $apiKey);
    }

    /*
     * @test
     */
    public function test_setting_api_url()
    {
        $apiUrl = $this->service->setApiUrl(self::TEST_API_URL['value'])->getApiUrl();
        $this->assertEquals(self::TEST_API_URL['value'], $apiUrl);
    }

    /*
     * @test
     */
    public function test_auto_api_key()
    {
        $this->assertEquals(self::TEST_API_KEY['value'], $this->service->getApiKey());
    }

    /*
     * @test
     */
    public function test_auto_api_url()
    {
        $this->assertEquals(self::TEST_API_URL['value'], $this->service->getApiUrl());
    }
}