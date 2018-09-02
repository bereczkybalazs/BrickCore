<?php

namespace BereczkyBalazs\BrickCore;

use BereczkyBalazs\BrickCore\Contracts\CurlInterface;
use Curl\Curl as BaseCurl;

class Curl extends BaseCurl implements CurlInterface
{
    public function getResponse()
    {
        return json_decode($this->response);
    }
}