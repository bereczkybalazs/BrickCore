<?php


namespace BereczkyBalazs\BrickCore;

use Curl\Curl;
use ReflectionClass;

abstract class Service
{
    const API_KEY_POSTFIX = '_API_KEY';
    const API_URL_POSTFIX = '_API_URL';

    protected $apiKey;
    protected $apiUrl;
    protected $curl;

    public function __construct(Curl $curl)
    {
        $this->setAutoApiKey();
        $this->setAutoApiUrl();
        $this->curl = $curl;
        $this->curl->setHeader(Constants::API_KEY, $this->getApiKey());
    }

    private function setAutoApiKey()
    {
        if (!isset($this->apiKey)) {
            $autoApiKeyIndex = $this->getApiKeyIndex();
            if (isset($_ENV[$autoApiKeyIndex])) {
                $this->setApiKey($_ENV[$autoApiKeyIndex]);
            }
        }
    }

    private function setAutoApiUrl()
    {
        if (!isset($this->apiUrl)) {
            $autoApiUrlIndex = $this->getEnvKeyFromClassName() . self::API_URL_POSTFIX;
            if (isset($_ENV[$autoApiUrlIndex])) {
                $this->setApiUrl($_ENV[$autoApiUrlIndex]);
            }
        }
    }

    protected function getApiKeyIndex()
    {
        return $this->getEnvKeyFromClassName() . self::API_KEY_POSTFIX;
    }

    protected function getEnvKeyFromClassName()
    {
        $class = new ReflectionClass($this);
        $className = $class->getShortName();
        $className = str_replace('Service', '', $className);
        $envIndex = ltrim(strtoupper(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $className)), '_');
        return $envIndex;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    public function getApiUrl()
    {
        return $this->apiUrl;
    }
}