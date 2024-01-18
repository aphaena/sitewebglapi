<?php

declare(strict_types=1);
// Active le mode strict pour les types en PHP

use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;
use Mezzio\Helper\ConfigProvider;
// Importe les classes nécessaires pour la configuration

// Configuration du cache
$cacheConfig = [
    'config_cache_path' => 'data/cache/config-cache.php',
];
// Définit le chemin du cache de configuration

// Création de l'agrégateur de configuration
$aggregator = new ConfigAggregator([
    // Liste des fournisseurs de configuration
    \Mezzio\Tooling\ConfigProvider::class,
    \Mezzio\Helper\ConfigProvider::class,
    \Mezzio\Router\FastRouteRouter\ConfigProvider::class,
    \Laminas\HttpHandlerRunner\ConfigProvider::class,
    \Laminas\Db\ConfigProvider::class,
    // Inclut la configuration du cache
    new ArrayProvider($cacheConfig),
    ConfigProvider::class,
    \Mezzio\ConfigProvider::class,
    \Mezzio\Router\ConfigProvider::class,
    \Laminas\Diactoros\ConfigProvider::class,

    // Configuration Swoole pour écraser certains services (si installé)
    class_exists(\Mezzio\Swoole\ConfigProvider::class)
        ? \Mezzio\Swoole\ConfigProvider::class
        : function (): array {
            return [];
        },

    // Configuration du module App par défaut
    App\ConfigProvider::class,

    // Charge la configuration de l'application dans un ordre prédéfini
    new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),

    // Charge la configuration de développement si elle existe
    new PhpFileProvider(realpath(__DIR__) . '/development.config.php'),
], $cacheConfig['config_cache_path']);
// Crée un agrégateur avec la liste des fournisseurs de configuration et le chemin du cache

return $aggregator->getMergedConfig();
// Retourne la configuration agrégée
