<?php

// src/App/Handler/UpdateScoreByEmailHandlerFactory.php

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;
// Importe les classes nécessaires

class UpdateScoreByEmailHandlerFactory
{
    public function __invoke(ContainerInterface $container): UpdateScoreByEmailHandler
    {
        // Méthode magique __invoke, appelée lors de l'utilisation de l'objet comme fonction
        return new UpdateScoreByEmailHandler($container->get(Adapter::class));
        // Crée et retourne une instance de UpdateScoreByEmailHandler, en injectant l'adaptateur de base de données
    }
}
