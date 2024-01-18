<?php

// src/App/Handler/UpdatePlayerByEmailHandlerFactory.php

namespace App\Handler;

use Laminas\Db\Adapter\Adapter;
use Psr\Container\ContainerInterface;
// Importe les classes nécessaires

class UpdatePlayerByEmailHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        // Méthode magique __invoke, appelée lors de l'utilisation de l'objet comme fonction
        return new UpdatePlayerByEmailHandler($container->get(Adapter::class));
        // Crée et retourne une instance de UpdatePlayerByEmailHandler, en injectant l'adaptateur de base de données
    }
}
