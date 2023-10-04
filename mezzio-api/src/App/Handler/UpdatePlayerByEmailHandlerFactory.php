<?php

// src/App/Handler/UpdatePlayerByEmailHandlerFactory.php

namespace App\Handler;

use Laminas\Db\Adapter\Adapter;
use Psr\Container\ContainerInterface;

class UpdatePlayerByEmailHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new UpdatePlayerByEmailHandler($container->get(Adapter::class));
    }
}
