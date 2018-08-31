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
            $headers = apache_request_headers();
            if (
                !isset($headers[BaseConstants::API_KEY]) ||
                $headers[BaseConstants::API_KEY] != Config::getApiKey()
            ) {
                new JsonError(401, "Unauthorized request");
            }
        }
    }

    protected function validateRequest()
    {
        $validator = Validator::make(
            toArray($this->variables),
            $this->rules
        );
        if ($validator->fails()) {
            new JsonError(406, 'Invalid request', $validator->firsts());
        }
    }

    protected function authorizeRequest()
    {
        if (!$this->authenticate()) {
            new JsonError(401, "Unauthorized request");
        }
    }
}