<?php

// config/autoload/dependencies.global.php

use Laminas\Db\Adapter\Adapter;

return [
    'dependencies' => [
        'factories' => [
            Adapter::class => Laminas\Db\Adapter\AdapterServiceFactory::class,      
            Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
            App\Handler\AddDataHandler::class => App\Handler\AddDataHandlerFactory::class,
            App\Handler\ListPlayersHandler::class => App\Handler\ListPlayersHandlerFactory::class,
            App\Handler\UpdatePlayerHandler::class => App\Handler\UpdatePlayerHandlerFactory::class,    
            App\Handler\UpdatePlayerByEmailHandler::class => App\Handler\UpdatePlayerByEmailHandlerFactory::class,
            App\Handler\UpdateScoreByEmailHandler::class => App\Handler\UpdateScoreByEmailHandlerFactory::class,
        ],
    ],
];

