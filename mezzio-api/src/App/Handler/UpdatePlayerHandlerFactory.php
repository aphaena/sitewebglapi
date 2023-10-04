<?php

namespace App\Handler;

use Laminas\Db\Adapter\Adapter;
use Psr\Container\ContainerInterface;

class UpdatePlayerHandlerFactory
{
    public function __invoke(ContainerInterface $container): UpdatePlayerHandler
    {
        return new UpdatePlayerHandler($container->get(Adapter::class));
    }
}
