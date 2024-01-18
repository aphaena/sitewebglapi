<?php

declare(strict_types=1);

namespace App;

/**
 * Le fournisseur de configuration pour le module App
 *
 * Fournit une structure organisée pour la configuration du module.
 */
class ConfigProvider
{
    /**
     * Retourne le tableau de configuration
     *
     * Chaque section est définie dans une méthode séparée qui retourne
     * un tableau avec sa configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Retourne les dépendances du conteneur
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
                // Définit PingHandler comme invokable (créé sans factory)
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                App\Handler\AddDataHandler::class => App\Handler\AddDataHandlerFactory::class,
                App\Handler\ListPlayersHandler::class => App\Handler\ListPlayersHandlerFactory::class,
                App\Handler\UpdatePlayerHandler::class => App\Handler\UpdatePlayerHandlerFactory::class,
                App\Handler\UpdatePlayerByEmailHandler::class => App\Handler\UpdatePlayerByEmailHandlerFactory::class,
                App\Handler\UpdateScoreByEmailHandler::class => App\Handler\UpdateScoreByEmailHandlerFactory::class,
                // Associe chaque handler à sa factory correspondante
            ],
        ];
    }

    /**
     * Retourne la configuration des templates
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
                // Définit les chemins vers les dossiers de templates
            ],
        ];
    }
}
