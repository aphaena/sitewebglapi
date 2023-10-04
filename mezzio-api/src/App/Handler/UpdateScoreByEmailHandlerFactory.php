<?php

// src/App/Handler/UpdateScoreByEmailHandlerFactory.php

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;

class UpdateScoreByEmailHandlerFactory
{
    public function __invoke(ContainerInterface $container): UpdateScoreByEmailHandler
    {
        return new UpdateScoreByEmailHandler($container->get(Adapter::class));
    }
}

