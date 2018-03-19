<?php

namespace Awni;

use Slim\Container;

class Controller
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * Main constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}
