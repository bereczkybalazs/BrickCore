<?php

namespace BereczkyBalazs\BrickCore;

use League\Di\Container;
use Phroute\Phroute\HandlerResolverInterface;

class RouterResolver implements HandlerResolverInterface
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function resolve($handler)
    {
        /*
         * Only attempt resolve uninstantiated objects which will be in the form:
         *
         *      $handler = ['App\Controllers\Home', 'method'];
         */
        if (is_array($handler) and is_string($handler[0])) {
            $handler[0] = $this->container->resolve($handler[0]);
        }

        return $handler;
    }
}