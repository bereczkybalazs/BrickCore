<?php

namespace BereczkyBalazs\BrickCore;

use Progsmile\Validator\Validator;

class Request
{
    protected $variables;
    protected $rules = [];

    public function __construct($variables)
    {
        $this->variables = $variables;
    }

    public function get($name)
    {
        return $this->variables->{$name};
    }

    public function all()
    {
        return $this->variables;
    }

    protected function authenticate()
    {
        return true;
    }

    public function validate()
    {
        $this->validateApiKey();
        $this->authorizeRequest();
        $this->validateRequest();
    }

    protected function validateApiKey()
    {
        $requireApiSignature = Config::getRequireApiSignature();
        if ($requireApiSignature && Config::getApiKey() != '') {
            if (
                !isset($_SERVER[Constants::API_KEY]) ||
                $_SERVER[Constants::API_KEY] != Config::getApiKey()
            ) {
                throw new HttpJsonException("Unauthorized request", 401);
            }
        }
    }

    protected function validateRequest()
    {
        $validator = Validator::make(
            Helpers::toArray($this->variables),
            $this->rules
        );
        if ($validator->fails()) {
            throw new HttpJsonException('Invalid request', 406);
        }
    }

    protected function authorizeRequest()
    {
        if (!$this->authenticate()) {
            throw new HttpJsonException("Unauthorized request", 401);
        }
    }
}