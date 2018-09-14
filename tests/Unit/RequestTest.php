<?php

namespace Tests\Unit;

use BereczkyBalazs\BrickCore\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    protected $request;

    public function setUp(Request $request)
    {
        $this->request = $request;
    }


}