<?php
// src/App/Handler/AddDataHandlerFactory.php

namespace App\Handler;

use Laminas\Db\Adapter\Adapter;
use Psr\Container\ContainerInterface;
// Importe les classes nécessaires

class AddDataHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        // Méthode magique __invoke, appelée lors de l'utilisation de l'objet comme fonction
        return new AddDataHandler($container->get(Adapter::class));
        // Crée et retourne une instance de AddDataHandler, en injectant l'adaptateur de base de données
    }
}
