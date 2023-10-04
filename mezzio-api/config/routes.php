<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

/**
 * FastRoute route configuration
 *
 * @see https://github.com/nikic/FastRoute
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/{id:\d+}', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', App\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');

    // Ajoutez un player /add
    $app->post('/add', App\Handler\AddDataHandler::class, 'add.data');

    $app->get('/players', App\Handler\ListPlayersHandler::class, 'list.players');

    // mise à jour d'un persdonnage par son id
    // ici on devrait utiliser patch au lieu de post
    $app->post('/player/{id:\d+}', App\Handler\UpdatePlayerHandler::class, 'update.player');
    
    // mise à jour d'un persdonnage par son email
    // ici on devrait utiliser patch au lieu de post
    $app->post('/player/update-by-email', App\Handler\UpdatePlayerByEmailHandler::class, 'update.player.by.email');

    // mise à jour du score d'un persdonnage par son email
    $app->post('/player/update-score', App\Handler\UpdateScoreByEmailHandler::class, 'update.score.by.email');

};
