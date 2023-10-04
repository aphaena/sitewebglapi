<?php
// src/App/Handler/AddDataHandlerFactory.php

namespace App\Handler;

use Laminas\Db\Adapter\Adapter;
use Psr\Container\ContainerInterface;

class AddDataHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new AddDataHandler($container->get(Adapter::class));
    }
}
