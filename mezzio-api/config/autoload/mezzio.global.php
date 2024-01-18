<?php

declare(strict_types=1);
// Active le mode strict pour les types en PHP, ce qui rend les déclarations de type strictes

use Laminas\ConfigAggregator\ConfigAggregator;
// Importe la classe ConfigAggregator de Laminas

return [
    // Configuration du cache
    ConfigAggregator::ENABLE_CACHE => false,
    // Désactive le cache de configuration. Utile en développement pour voir les changements de configuration immédiatement.

    // Configuration du débogage
    'debug'  => true,
    // Active le mode débogage. Cela peut être utilisé pour afficher des informations de débogage dans les templates.

    // Configuration spécifique à Mezzio
    'mezzio' => [
        // Gestionnaire d'erreurs
        'error_handler' => [
            // Template à utiliser pour les erreurs 404 (page non trouvée)
            'template_404'   => 'error::404',

            // Template à utiliser pour les autres erreurs
            'template_error' => 'error::error',
        ],
    ],
];

