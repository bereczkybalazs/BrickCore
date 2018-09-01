<?php


namespace BereczkyBalazs\BrickCore;


abstract class Service
{
    const API_KEY_POSTFIX = '_API_KEY';
    const API_URL_POSTFIX = '_API_URL';

    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->setAutoApiKey();
        $this->setAutoApiUrl();
    }

    private function setAutoApiKey()
    {
        if (!isset($this->apiKey)) {
            $autoApiKeyIndex = $this->getEnvKeyFromClassName() . self::API_KEY_POSTFIX;
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

    private function getEnvKeyFromClassName()
    {
        $className = get_class($this);
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