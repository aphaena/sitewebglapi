<?php

namespace App\Handler;

use Laminas\Db\Adapter\Adapter;
use Psr\Container\ContainerInterface;
// Importe les classes nécessaires

class UpdatePlayerHandlerFactory
{
    public function __invoke(ContainerInterface $container): UpdatePlayerHandler
    {
        // Méthode magique __invoke, appelée lors de l'utilisation de l'objet comme fonction
        return new UpdatePlayerHandler($container->get(Adapter::class));
        // Crée et retourne une instance de UpdatePlayerHandler, en injectant l'adaptateur de base de données
    }
}
