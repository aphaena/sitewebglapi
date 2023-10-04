<?php
// src/App/Handler/ListPlayersHandlerFactory.php

namespace App\Handler;

use Laminas\Db\Adapter\Adapter;
use Psr\Container\ContainerInterface;

class ListPlayersHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ListPlayersHandler($container->get(Adapter::class));
    }
}
