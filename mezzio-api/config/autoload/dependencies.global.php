<?php

// config/autoload/dependencies.global.php

use Laminas\Db\Adapter\Adapter;
// Importe la classe Adapter de Laminas\Db\Adapter

return [
    // Définit les dépendances pour l'application
    'dependencies' => [
        // Configure les factories pour les différentes classes
        'factories' => [
            Adapter::class => Laminas\Db\Adapter\AdapterServiceFactory::class,      
            // Associe la classe Adapter à son factory de service
            Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
            // Associe HomePageHandler à son factory
            App\Handler\AddDataHandler::class => App\Handler\AddDataHandlerFactory::class,
            // Associe AddDataHandler à son factory
            App\Handler\ListPlayersHandler::class => App\Handler\ListPlayersHandlerFactory::class,
            // Associe ListPlayersHandler à son factory
            App\Handler\UpdatePlayerHandler::class => App\Handler\UpdatePlayerHandlerFactory::class,    
            // Associe UpdatePlayerHandler à son factory
            App\Handler\UpdatePlayerByEmailHandler::class => App\Handler\UpdatePlayerByEmailHandlerFactory::class,
            // Associe UpdatePlayerByEmailHandler à son factory
            App\Handler\UpdateScoreByEmailHandler::class => App\Handler\UpdateScoreByEmailHandlerFactory::class,
            // Associe UpdateScoreByEmailHandler à son factory
        ],
    ],
];


