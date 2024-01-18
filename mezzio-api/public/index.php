<?php

declare(strict_types=1);
// Active le mode strict pour les types en PHP

// Délègue les requêtes de fichiers statiques au serveur web intégré de PHP
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}
// Si exécuté avec le serveur web intégré de PHP, les fichiers statiques sont servis directement

chdir(dirname(__DIR__));
// Change le répertoire de travail pour le répertoire parent

require 'vendor/autoload.php';
// Charge l'autoloader Composer pour gérer les dépendances

/**
 * Fonction anonyme auto-invoquée qui crée son propre scope et garde l'espace de nom global propre.
 */
(function () {

    error_reporting(E_ALL);
    ini_set('display_errors', '1');    
    // Configure PHP pour afficher toutes les erreurs

    /** @var \Psr\Container\ContainerInterface $container */
    $container = require 'config/container.php';
    // Charge le conteneur de services

    /** @var \Mezzio\Application $app */
    $app = $container->get(\Mezzio\Application::class);
    $factory = $container->get(\Mezzio\MiddlewareFactory::class);
    // Récupère l'application Mezzio et la factory de middleware du conteneur

    // Exécute la configuration de la pipeline de middleware et des routes
    (require 'config/pipeline.php')($app, $factory, $container);
    (require 'config/routes.php')($app, $factory, $container);

    $app->run();
    // Lance l'application
})();
