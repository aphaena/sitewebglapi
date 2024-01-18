<?php

declare(strict_types=1);
// Active le mode strict pour les types en PHP

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;
// Importe les classes nécessaires pour l'application et la configuration des routes

/**
 * Configuration des routes FastRoute
 *
 * Exemples de configuration de routes :
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    // Route pour la page d'accueil
    $app->get('/', App\Handler\HomePageHandler::class, 'home');

    // Route pour une requête GET vers '/api/ping'
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');

    // Route pour ajouter un joueur via une requête POST vers '/add'
    $app->post('/add', App\Handler\AddDataHandler::class, 'add.data');

    // Route pour lister les joueurs via une requête GET vers '/players'
    $app->get('/players', App\Handler\ListPlayersHandler::class, 'list.players');

    // Route pour mettre à jour un joueur par son ID via une requête POST vers '/player/{id}'
    // Remarque : PATCH serait plus approprié pour une mise à jour
    $app->post('/player/{id:\d+}', App\Handler\UpdatePlayerHandler::class, 'update.player');
    
    // Route pour mettre à jour un joueur par son email via une requête POST vers '/player/update-by-email'
    // Remarque : PATCH serait plus approprié pour une mise à jour
    $app->post('/player/update-by-email', App\Handler\UpdatePlayerByEmailHandler::class, 'update.player.by.email');

    // Route pour mettre à jour le score d'un joueur par son email via une requête POST vers '/player/update-score'
    $app->post('/player/update-score', App\Handler\UpdateScoreByEmailHandler::class, 'update.score.by.email');

};
