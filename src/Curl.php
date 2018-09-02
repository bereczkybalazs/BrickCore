<?php

namespace BereczkyBalazs\BrickCore;

use Curl\Curl as BaseCurl;

class Curl extends BaseCurl
{
    public function getResponse()
    {
        return json_decode($this->response);
    }
}